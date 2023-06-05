<?php

namespace App\Http\Controllers;

use App\Http\PigeonHelpers\otherHelper;
use App\Models\Setting;
use App\Models\SMS;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['page_name']="Send SMS List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Send SMS','active')
        );
        return view('admin.sms.index',$data);
    }

    public function get_index(Request $request){
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $status_filter = $request->input('status_filter');

        $s_m_s = SMS::leftJoin('users as updater_user', 's_m_s.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 's_m_s.created_by', '=', 'creator_user.id')
            ->leftJoin('unit_allotments as unit_allotments', 's_m_s.related_model_id', '=', 'unit_allotments.id')
            ->leftJoin('units as units', 'unit_allotments.unit_id', '=', 'units.id')
            ->leftJoin('codes as codes', 'unit_allotments.code_id', '=', 'codes.id')
            ->select([
                's_m_s.id as id',
                's_m_s.sms_bulk as sms_bulk',
                'unit_allotments.allocation_sector as allocation_sector',
                'codes.code as code',
                'units.name_bangla as unit_name',
                's_m_s.status as status',
                's_m_s.sender_id as sender_id',
                's_m_s.to_number as to_number',
                's_m_s.sms_count as sms_count',
                's_m_s.per_sms_charge as per_sms_charge',
                's_m_s.total_charge as total_charge',
                's_m_s.status_message as status_message',
                's_m_s.content as content',
                'creator_user.name as creator_user',
                's_m_s.created_at as created_at',
                'updater_user.name as updater_user',
                's_m_s.updated_at as updated_at',
            ])
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('s_m_s.status',$status_filter);
            })
            ->when(isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != '', function ($q) use ($date_from_filter,$date_to_filter) {
                return $q->where('s_m_s.created_at','>=',$date_from_filter.' 00:00:00')->where('s_m_s.created_at','<=',$date_to_filter.' 23:59:59');
            })
            ->when(isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == ''), function ($q) use ($date_from_filter) {
                return $q->where('s_m_s.created_at','>=',$date_from_filter.' 00:00:00')->where('s_m_s.created_at','<=',$date_from_filter.' 23:59:59');
            })
            ->when(isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == ''), function ($q) use ($date_to_filter) {
                return $q->where('s_m_s.created_at','>=',$date_to_filter.' 00:00:00')->where('s_m_s.created_at','<=',$date_to_filter.' 23:59:59');
            })
            ->distinct();


        return DataTables::eloquent($s_m_s)
            ->addIndexColumn()
            ->setRowId(function ($sms) {
                return 'row_' . $sms->id;
            })
            ->setRowData([
                'data-created_at' => function ($sms) {
                    return otherHelper::en2bn(otherHelper::change_date_format($sms->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($sms) {
                    return otherHelper::en2bn(otherHelper::change_date_format($sms->updated_at, true, 'd-M-Y H:i'));
                },
                'data-sms_count' => function ($sms) {
                    return otherHelper::en2bn($sms->sms_count);
                },
                'data-per_sms_charge' => function ($sms) {
                    return otherHelper::en2bn(otherHelper::taka_format($sms->per_sms_charge));
                },
                'data-total_charge' => function ($sms) {
                    return otherHelper::en2bn(otherHelper::taka_format($sms->total_charge));
                },
            ])
            ->addColumn('status_modified',  function($sms) {
                if($sms->status=='success'){
                    return '<span class="badge badge-success text-light">সফল</a>';
                }
                else
                {
                    return '<span class="badge badge-danger text-light">অসফল</a>';
                }
            })
            ->addColumn('content_modified',  function($sms) {
                return $sms->content;
            })
            ->addColumn('status_message_modified',  function($sms) {
                return $sms->status_message;
            })
            ->rawColumns(['status_modified','content_modified','status_message_modified'])
            ->toJson();
    }

    public static function send($number,$message='This is a test SMS.',$related_model_type=null,$related_model_id=null)
    {
            //        $settings_data = Session::get('settings_data');
            $settings_data = Setting::find(1);
            $api_key = $settings_data->sms_api;
            $sender_id = $settings_data->sms_sender_id;
            $bulk_company = $settings_data->sms_company;
            $per_sms_cost = $settings_data->per_sms_cost;
            $contacts = '88' . $number;
            $URL = "http://bangladeshsms.com/smsapi?api_key=".urlencode($api_key)."&type=text&contacts=".urlencode($contacts)."&senderid=".urlencode($sender_id)."&msg=".urlencode($message);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,$URL);

            curl_setopt($ch, CURLOPT_HEADER, 0);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

            curl_setopt($ch, CURLOPT_POST, 0);

            try{

                $output = curl_exec($ch);

                // print_r($output);

            }catch(Exception $ex){

                $output = "-100";

            }

            $sms_length=strlen($message)/160;
            $round_sms_length=intval(round(strlen($message),2,PHP_ROUND_HALF_UP )/160);
            if($sms_length>$round_sms_length){
                $round_sms_length=$round_sms_length+1;
            }

            $sms=new SMS();
            $sms->sms_bulk=$bulk_company;
            $sms->sender_id=$sender_id;
            $sms->to_number=$number;
            $sms->content=$message;
            $sms->sms_count=$round_sms_length;
            $sms->per_sms_charge=$per_sms_cost;
            $sms->related_model_type=$related_model_type;
            $sms->related_model_id=$related_model_id;
            if($output==1012)
            {
                $sms->per_sms_charge=0;
                $status='danger';
                $status_text=$output.': Number is not Valid.';
            }
            elseif (($output>=1002 && $output<=1006)||($output>=1008 && $output<=1011))
            {
                $sms->per_sms_charge=0;
                $status='danger';
                $status_text=$output.': Found Error from Company Side while sending SMS.';
            }
            elseif ($output==1007)
            {
                $sms->per_sms_charge=0;
                $status='danger';
                $status_text=$output.': Insufficient balance in SMS Bulk Account.';
            }
            else
            {
                $status='success';
                $status_text= $status;
            }
            $sms->total_charge= $sms->per_sms_charge*$sms->sms_count;
            $sms->status=$status;
            $sms->status_code=$output;
            $sms->status_message=$status_text;
            $sms->created_by=Auth::user()->id;
            $sms->updated_by=Auth::user()->id;
            $sms->save();

            return $sms->status_message;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function show(SMS $sMS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SMS $sMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sMS)
    {
        //
    }
}
