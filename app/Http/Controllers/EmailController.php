<?php

namespace App\Http\Controllers;

use App\Http\PigeonHelpers\otherHelper;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['page_name']="Send Email List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Send Emails','active')
        );
        return view('admin.emails.index',$data);
    }

    public function get_index(Request $request){
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $status_filter = $request->input('status_filter');

        $emails = Email::leftJoin('users as updater_user', 'emails.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'emails.created_by', '=', 'creator_user.id')
            ->leftJoin('unit_allotments as unit_allotments', 'emails.related_model_id', '=', 'unit_allotments.id')
            ->leftJoin('units as units', 'unit_allotments.unit_id', '=', 'units.id')
            ->leftJoin('codes as codes', 'unit_allotments.code_id', '=', 'codes.id')
            ->select([
                'emails.id as id',
                'emails.mail_server as mail_server',
                'unit_allotments.allocation_sector as allocation_sector',
                'codes.code as code',
                'units.name_bangla as unit_name',
                'emails.status as status',
                'emails.from_mail as from_mail',
                'emails.to_mail as to_mail',
                'emails.subject as subject',
                'emails.content as content',
                'creator_user.name as creator_user',
                'emails.created_at as created_at',
                'updater_user.name as updater_user',
                'emails.updated_at as updated_at',
            ])
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('emails.status',$status_filter);
            })
            ->when(isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != '', function ($q) use ($date_from_filter,$date_to_filter) {
                return $q->where('emails.created_at','>=',$date_from_filter.' 00:00:00')->where('emails.created_at','<=',$date_to_filter.' 23:59:59');
            })
            ->when(isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == ''), function ($q) use ($date_from_filter) {
                return $q->where('emails.created_at','>=',$date_from_filter.' 00:00:00')->where('emails.created_at','<=',$date_from_filter.' 23:59:59');
            })
            ->when(isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == ''), function ($q) use ($date_to_filter) {
                return $q->where('emails.created_at','>=',$date_to_filter.' 00:00:00')->where('emails.created_at','<=',$date_to_filter.' 23:59:59');
            })
            ->distinct();


        return DataTables::eloquent($emails)
            ->addIndexColumn()
            ->setRowId(function ($email) {
                return 'row_' . $email->id;
            })
            ->setRowData([
                'data-created_at' => function ($email) {
                    return otherHelper::en2bn(otherHelper::change_date_format($email->created_at, true, 'd-M-Y H:i'));
                }
            ])
            ->addColumn('status_modified',  function($email) {
                if($email->status==1){
                    return '<span class="badge badge-success text-light">সফল</a>';
                }
                else
                {
                    return '<span class="badge badge-danger text-light">অসফল</a>';
                }
            })
            ->addColumn('content_modified',  function($email) {
                return $email->content;
            })
            ->rawColumns(['status_modified','content_modified'])
            ->toJson();
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

    public static function send($mail_data)
    {
        Mail::send($mail_data['view_name'], $mail_data['view_data'], function ($m) use($mail_data){
            $m->from(env("MAIL_FROM_ADDRESS", "training@bdchessfed.com"), $mail_data['from_name']);
            $m->to($mail_data['to_mail'], $mail_data['to_name'])
                ->subject($mail_data['subject']);
        });

        $email=new Email();
        $email->content=view($mail_data['view_name'], $mail_data['view_data']);
        $email->mail_server=$mail_data['mail_server'];
        $email->from_mail=env("MAIL_FROM_ADDRESS", "training@bdchessfed.com");
        $email->to_mail=$mail_data['to_mail'];
        $email->subject=$mail_data['subject'];
        if( count(Mail::failures()) > 0 ) {
            $email->status=0;
        }
        else{
            $email->status=1;
        }
        $email->related_model_type=$mail_data['related_model_type'];
        $email->related_model_id=$mail_data['related_model_id'];
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();
        return $email->status;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mail $mail)
    {
        //
    }
}
