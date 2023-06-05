<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\imageHelper;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models\Code_surrender;
use App\Models\Letter_surrender_transaction;
use App\Models\Letter_recipient;
use App\Models\Master_surrender_letter;
use App\Models\Setting;
use App\Models\Surrender_letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SurrenderLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['filter_selected_data']=Session::get('filter_selected_data');
        $data['codes']=Code::all();
        $data['page_name']="Surrender Letter List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Surrender Letters','active')
        );
        return view('admin.code_surrenders.letters.index',$data);
    }

    public function get_index(Request $request){
        $code_id_filter = $request->input('code_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $sign_status_filter = $request->input('sign_status_filter');
        $memo_status_filter = $request->input('memo_status_filter');

        $surrender_letters = Surrender_letter::leftJoin('users as updater_user', 'surrender_letters.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'surrender_letters.created_by', '=', 'creator_user.id')
            ->select([
                'surrender_letters.id as id',
                'surrender_letters.subject as subject',
                'surrender_letters.description as description',
                'surrender_letters.sub_header_memo_first_part as sub_header_memo_first_part',
                'surrender_letters.sub_header_memo_second_part as sub_header_memo_second_part',
                'surrender_letters.sub_header_memo_date as sub_header_memo_date',
                'surrender_letters.is_signed as is_signed',
                'surrender_letters.signature_date as signature_date',
                'surrender_letters.total_surrenders as total_surrenders',
                'surrender_letters.code_ids as code_ids',
                'surrender_letters.fiscal_years as fiscal_years',
                'surrender_letters.total_amount as total_amount',
                'surrender_letters.mail_count as mail_count',
                'surrender_letters.sms_count as sms_count',
                'creator_user.name as creator_user',
                'surrender_letters.created_at as created_at',
                'updater_user.name as updater_user',
                'surrender_letters.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter)>0, function ($q) use($code_id_filter) {
                return $q->where(function($q) use($code_id_filter){
                    foreach($code_id_filter as $code_id) {
                        $q->orWhere('surrender_letters.code_ids', 'LIKE', "%|$code_id|%");
                    }
                });
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter)>0, function ($q) use($fiscal_year_filter) {
                return $q->where(function($q) use($fiscal_year_filter){
                    foreach($fiscal_year_filter as $fiscal_year) {
                        $q->orWhere('surrender_letters.fiscal_years', 'LIKE', "%|$fiscal_year|%");
                    }
                });
            })
            ->when(isset($sign_status_filter) && $sign_status_filter!='', function ($q) use($sign_status_filter) {
                if($sign_status_filter=='not singed') {
                    return $q->where('surrender_letters.is_signed',0);
                }
                else {
                    return $q->where('surrender_letters.is_signed',1);
                }
            })
            ->when(isset($memo_status_filter) && $memo_status_filter!='', function ($q) use($memo_status_filter) {
                if($memo_status_filter=='no memo') {
                    return $q->where(function($q){
                        return $q->where('surrender_letters.sub_header_memo_second_part',null)
                            ->orWhere('surrender_letters.sub_header_memo_second_part','')
                            ->orWhere('surrender_letters.sub_header_memo_first_part',null)
                            ->orWhere('surrender_letters.sub_header_memo_first_part','');
                    });
                }
                else{
                    return $q->where(function($q){
                        return $q->where('surrender_letters.sub_header_memo_second_part','!=',null)
                            ->where('surrender_letters.sub_header_memo_second_part','!=','')
                            ->where('surrender_letters.sub_header_memo_first_part','!=',null)
                            ->where('surrender_letters.sub_header_memo_first_part','!=','');
                    });
                }
            })
            ->when(strlen($date_type_filter)>0 && isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != '', function ($q) use ($date_from_filter,$date_to_filter,$date_type_filter) {
                return $q->where($date_type_filter,'>=',$date_from_filter)->where($date_type_filter,'<=',$date_to_filter);
            })
            ->when(strlen($date_type_filter)>0 && isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == ''), function ($q) use ($date_from_filter,$date_type_filter) {
                return $q->where($date_type_filter,'=',$date_from_filter);
            })
            ->when(strlen($date_type_filter)>0 && isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == ''), function ($q) use ($date_to_filter,$date_type_filter) {
                return $q->where($date_type_filter,'=',$date_to_filter);
            })
            ->distinct();


        return DataTables::eloquent($surrender_letters)
            ->addIndexColumn()
            ->setRowId(function ($surrender_letter) {
                return 'row_' . $surrender_letter->id;
            })
            ->setRowData([
                'data-created_at' => function ($surrender_letter) {
                    return otherHelper::en2bn(otherHelper::change_date_format($surrender_letter->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($surrender_letter) {
                    return otherHelper::en2bn(otherHelper::change_date_format($surrender_letter->updated_at, true, 'd-M-Y H:i'));
                },
                'data-sub_header_memo_date' => function ($surrender_letter) {
                    return (isset($surrender_letter->sub_header_memo_date) && strlen($surrender_letter->sub_header_memo_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($surrender_letter->sub_header_memo_date, true, 'd-M-Y')): '';
                },
                'data-is_signed' => function ($surrender_letter) {
                    return ($surrender_letter->is_signed==1)?'স্বাক্ষরিত':'অস্বাক্ষরিত';
                },
                'data-signature_date' => function ($surrender_letter) {
                    return (isset($surrender_letter->signature_date) && strlen($surrender_letter->signature_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($surrender_letter->signature_date, true, 'd-M-Y')): '';
                },
                'data-total_amount' => function ($surrender_letter) {
                    return otherHelper::en2bn(otherHelper::taka_format($surrender_letter->total_amount));
                },
                'data-mail_count' => function ($surrender_letter) {
                    return otherHelper::en2bn($surrender_letter->mail_count);
                },
                'data-sms_count' => function ($surrender_letter) {
                    return otherHelper::en2bn($surrender_letter->sms_count);
                },
                'data-total_surrenders' => function ($surrender_letter) {
                    return otherHelper::en2bn($surrender_letter->total_surrenders);
                }
            ])
            ->addColumn('action', function ($surrender_letter) {
                if (auth()->user()->can('edit-surrender-letter') && auth()->user()->can('delete-surrender-letter')) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender-letter.show', [$surrender_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-surrender-letter.edit', [$surrender_letter->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-surrender-letter.destroy', [$surrender_letter->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-surrender-letter')) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender-letter.show', [$surrender_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-surrender-letter.edit', [$surrender_letter->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-surrender-letter')) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender-letter.show', [$surrender_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-surrender-letter.destroy', [$surrender_letter->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender-letter.show', [$surrender_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('subject_modified',  function($surrender_letter) {
                return $surrender_letter->subject;
            })
            ->rawColumns(['action','subject_modified'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //
        $data['codes']=Code::all();
        $data['master_surrender_letter']=Master_Surrender_letter::find(1);
        $data['page_name']="Add Surrender Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Add Surrender Letter','active')
        );
        return view('admin.code_surrenders.letters.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'header_left_logo'=>['image'],
            'header_right_logo'=>['image'],
            'signature_image'=>['image'],
//            'signature_image_2'=>['image'],
            'linked_surrenders_count'=>['required','min:1'],
        ]);
        $master_surrender_letter=Master_Surrender_letter::find(1);
        $surrender_letter=new Surrender_letter();
        $surrender_letter->header_middle_heading=$request->input('header_middle_heading');
        $surrender_letter->sub_header_memo_first_part=$request->input('sub_header_memo_first_part');
        // $surrender_letter->sub_header_memo_second_part=$request->input('sub_header_memo_second_part');
//        $surrender_letter->sub_header_memo_first_part_2=$request->input('sub_header_memo_first_part_2');
        //$surrender_letter->sub_header_memo_second_part_2=$request->input('sub_header_memo_second_part_2');
        $surrender_letter->sub_header_memo_date=$request->input('sub_header_memo_date');
        // $surrender_letter->sub_header_memo_date_2=$request->input('sub_header_memo_date_2');
        $surrender_letter->subject=$request->input('subject');
        $surrender_letter->reference=$request->input('reference');
        $surrender_letter->description=$request->input('description');
        $surrender_letter->surrender_table=$request->input('surrender_table');
        $surrender_letter->instructions=$request->input('instructions');
        $surrender_letter->signature_info_left=$request->input('signature_info_left');
        $surrender_letter->signature_info=$request->input('signature_info');
//        $surrender_letter->signature_info_2=$request->input('signature_info_2');
        if(Auth::user()->can('sign-surrender-letter')) {
            $surrender_letter->signature_date = $request->input('signature_date');
//            $surrender_letter->signature_date_2 = $request->input('signature_date_2');
            $surrender_letter->is_signed = $request->input('is_signed');
//            $surrender_letter->is_signed_2 = $request->input('is_signed_2');
        }
        $surrender_letter->letter_to=$request->input('letter_to');
//        $surrender_letter->letter_acknowledgement=$request->input('letter_acknowledgement');
        $image_folder='images/master_surrender_letters';

        $surrender_letter->header_left_logo=$master_surrender_letter->header_left_logo;
        if ($request->has('header_left_logo_delete') && $request->input('header_left_logo_delete')==1) {
            $surrender_letter->header_left_logo=null;
        }
        if($request->hasFile('header_left_logo')) {
            $surrender_letter->header_left_logo = imageHelper::image_upload($request, 'header_left_logo', $image_folder, 'header_left_logo_'.date('Ymd'), true, false,'',true,800);
        }

        $surrender_letter->header_right_logo=$master_surrender_letter->header_right_logo;
        if ($request->has('header_right_logo_delete') && $request->input('header_right_logo_delete')==1) {
            $surrender_letter->header_right_logo=null;
        }
        if($request->hasFile('header_right_logo')) {
            $surrender_letter->header_right_logo = imageHelper::image_upload($request, 'header_right_logo', $image_folder, 'header_right_logo_'.date('Ymd'), true, false,'',true,800);
        }

        $surrender_letter->signature_image=$master_surrender_letter->signature_image;
        if ($request->has('signature_image_delete') && $request->input('signature_image_delete')==1) {
            $surrender_letter->signature_image=null;
        }
        if($request->hasFile('signature_image')) {
            $surrender_letter->signature_image = imageHelper::image_upload($request, 'signature_image', $image_folder, 'signature_image_'.date('Ymd'), true, false,'',true,800);
        }

//        $surrender_letter->signature_image_2=$master_surrender_letter->signature_image_2;
//        if ($request->has('signature_image_2_delete') && $request->input('signature_image_2_delete')==1) {
//            $surrender_letter->signature_image_2=null;
//        }
//        if($request->hasFile('signature_image_2')) {
//            $surrender_letter->signature_image_2 = imageHelper::image_upload($request, 'signature_image_2', $image_folder, 'signature_image_2_'.date('Ymd'), true, false,'',true,800);
//        }
        $surrender_letter->created_by=Auth::user()->id;
        $surrender_letter->updated_by=Auth::user()->id;
        $surrender_letter->save();

        $linked_surrenders=$request->input('linked_surrenders');
        self::update_letter_surrender_transaction($surrender_letter,$linked_surrenders);

        self::update_letter_recipient($surrender_letter,$request->input('letter_to_recipient'),'letter_to');
//        self::update_letter_recipient($surrender_letter,$request->input('letter_acknowledgement_recipient'),'letter_acknowledgement');

        Logs::store(Auth::user()->name . ' সমর্পণ চিঠির তথ্য যুক্ত করেছেন।', 'Add Surrender Letter', 'success', Auth::user()->id);
        return redirect()->route('code-surrender-letter.index')->with('success', 'সমর্পণ চিঠির তথ্য সফলভাবে যুক্ত হয়েছে!');
    }

    private function update_letter_recipient(Surrender_letter $letter, $recipient_data,$field_type){
        Letter_recipient::where('letter_model','surrender_letter')->where('letter_id',$letter->id)->where('field_type',$field_type)->delete();
        if(isset($recipient_data) && count($recipient_data)>0){
            foreach ($recipient_data as $recipient_datum){
                $letter_recipient=new Letter_recipient();
                $letter_recipient->letter_model='surrender_letter';
                $letter_recipient->letter_id=$letter->id;
                $letter_recipient->field_type=$field_type;
                $letter_recipient->unit_id=$recipient_datum['unit_id'];
                $letter_recipient->recipient_type=$recipient_datum['recipient_type'];
                $letter_recipient->recipient_group_no=$recipient_datum['recipient_group_no'];
                $letter_recipient->created_by=Auth::user()->id;
                $letter_recipient->updated_by=Auth::user()->id;
                $letter_recipient->save();
            }
        }
    }

    private function update_letter_surrender_transaction(Surrender_letter $surrender_letter,$linked_surrenders){
        $letter_surrender_transactions=Letter_surrender_transaction::where('letter_id',$surrender_letter->id)->get()->toArray();
        if(count($letter_surrender_transactions)>0){
            foreach($letter_surrender_transactions as $letter_surrender_transaction){
                $code_surrender=Code_surrender::find($letter_surrender_transaction['surrender_id']);
                $code_surrender->memo=null;
                $code_surrender->memo_date=null;
                $code_surrender->save();
            }
            Letter_surrender_transaction::where('letter_id',$surrender_letter->id)->delete();
        }
        foreach ($linked_surrenders as $surrender){
            $letter_surrender_transaction= new Letter_surrender_transaction();
            $letter_surrender_transaction->letter_id=$surrender_letter->id;
            $letter_surrender_transaction->surrender_id=$surrender;
            $letter_surrender_transaction->save();
        }
        $letter_surrender_transactions=Letter_surrender_transaction::where('letter_id',$surrender_letter->id)->get()->toArray();
        if(isset($surrender_letter->sub_header_memo_first_part)
            && $surrender_letter->sub_header_memo_first_part!=''
            && isset($surrender_letter->sub_header_memo_second_part)
            && $surrender_letter->sub_header_memo_second_part!=''
            && isset($surrender_letter->sub_header_memo_date)
            && $surrender_letter->sub_header_memo_date!='')
        {
            foreach($letter_surrender_transactions as $letter_surrender_transaction){
                $code_surrender=Code_surrender::find($letter_surrender_transaction['surrender_id']);
                $code_surrender->memo=$surrender_letter->sub_header_memo_first_part.$surrender_letter->sub_header_memo_second_part;
                $code_surrender->memo_date=$surrender_letter->sub_header_memo_date;
                $code_surrender->save();
            }
        }
        $surrender_letter->total_surrenders= count($letter_surrender_transactions);
        $letter_surrender_transactions=Letter_surrender_transaction::where('letter_id',$surrender_letter->id)->get();
        $code_ids=array();
        $fiscal_years=array();
        $total_amount=0;
        foreach($letter_surrender_transactions as $letter_surrender_transaction){
            array_push($code_ids,$letter_surrender_transaction->surrender->code_id);
            array_push($fiscal_years,$letter_surrender_transaction->surrender->fiscal_year);
            $total_amount+=$letter_surrender_transaction->surrender->amount;
        }
        $code_ids=array_unique($code_ids);
        $fiscal_years=array_unique($fiscal_years);
        $surrender_letter->code_ids= '|'.implode('| |',$code_ids).'|';
        $surrender_letter->fiscal_years= '|'.implode('| |',$fiscal_years).'|';
        $surrender_letter->total_amount= $total_amount;
        $surrender_letter->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surrender_letter  $surrender_letter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Surrender_letter $surrender_letter)
    {
        //
        $data['surrender_letter']=$surrender_letter;
        $data['page_name']="Show Surrender Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Show Surrender Letter','active')
        );
        return view('admin.code_surrenders.letters.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surrender_letter  $surrender_letter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Surrender_letter $surrender_letter)
    {
        //
        $data['codes']=Code::all();
        $data['surrender_letter']=$surrender_letter;
        $data['page_name']="Edit Surrender Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Edit Surrender Letter','active')
        );
        return view('admin.code_surrenders.letters.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surrender_letter  $surrender_letter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Surrender_letter $surrender_letter)
    {
        //
        $this->validate($request,[
            'header_left_logo'=>['image'],
            'header_right_logo'=>['image'],
            'signature_image'=>['image'],
//            'signature_image_2'=>['image'],
            'linked_surrenders_count'=>['required','min:1'],
        ]);
        $surrender_letter->header_middle_heading=$request->input('header_middle_heading');
        $surrender_letter->sub_header_memo_first_part=$request->input('sub_header_memo_first_part');
        $surrender_letter->sub_header_memo_first_part_2=$request->input('sub_header_memo_first_part_2');
        $surrender_letter->sub_header_memo_date=$request->input('sub_header_memo_date');
        if($surrender_letter->is_signed==1 && isset($surrender_letter->signature_date) && $surrender_letter->signature_date!=='') {
            $surrender_letter->sub_header_memo_second_part = $request->input('sub_header_memo_second_part');
        }
//        if($surrender_letter->is_signed_2==1 && isset($surrender_letter->signature_date_2) && $surrender_letter->signature_date_2!=='') {
//            $surrender_letter->sub_header_memo_second_part_2 = $request->input('sub_header_memo_second_part_2');
//            $surrender_letter->sub_header_memo_date_2 = $request->input('sub_header_memo_date_2');
//        }
        $surrender_letter->subject=$request->input('subject');
        $surrender_letter->reference=$request->input('reference');
        $surrender_letter->description=$request->input('description');
        $surrender_letter->surrender_table=$request->input('surrender_table');
        $surrender_letter->instructions=$request->input('instructions');
        $surrender_letter->signature_info_left=$request->input('signature_info_left');
        $surrender_letter->signature_info=$request->input('signature_info');
//        $surrender_letter->signature_info_2=$request->input('signature_info_2');
        if(Auth::user()->can('sign-surrender-letter')) {
            if($request->input('is_signed') !== null && otherHelper::validateDate($request->input('signature_date')) && !($surrender_letter->sub_header_memo_second_part!='')) {
                $surrender_letter->signature_date = $request->input('signature_date');
                $surrender_letter->is_signed = $request->input('is_signed');
            }
//            if(!($surrender_letter->sub_header_memo_second_part_2!='' || $surrender_letter->sub_header_memo_date_2!='')) {
//                $surrender_letter->signature_date_2 = $request->input('signature_date_2');
//                $surrender_letter->is_signed_2 = $request->input('is_signed_2');
//            }
        }
        $surrender_letter->letter_to=$request->input('letter_to');
//        $surrender_letter->letter_acknowledgement=$request->input('letter_acknowledgement');
        $image_folder='images/master_surrender_letters';

        if ($request->has('header_left_logo_delete') && $request->input('header_left_logo_delete')==1) {
            imageHelper::image_unlink($image_folder,$surrender_letter->header_left_logo);
            $surrender_letter->header_left_logo=null;
        }
        if($request->hasFile('header_left_logo')) {
            $old_image=$surrender_letter->header_left_logo;
            $surrender_letter->header_left_logo = imageHelper::image_upload($request, 'header_left_logo', $image_folder, 'header_left_logo_'.date('Ymd'), true, true,$old_image,true,800);
        }

        if ($request->has('header_right_logo_delete') && $request->input('header_right_logo_delete')==1) {
            imageHelper::image_unlink($image_folder,$surrender_letter->header_right_logo);
            $surrender_letter->header_right_logo=null;
        }
        if($request->hasFile('header_right_logo')) {
            $old_image=$surrender_letter->header_right_logo;
            $surrender_letter->header_right_logo = imageHelper::image_upload($request, 'header_right_logo', $image_folder, 'header_right_logo_'.date('Ymd'), true, true,$old_image,true,800);
        }

        if ($request->has('signature_image_delete') && $request->input('signature_image_delete')==1) {
            imageHelper::image_unlink($image_folder,$surrender_letter->signature_image);
            $surrender_letter->signature_image=null;
        }
        if($request->hasFile('signature_image')) {
            $old_image=$surrender_letter->signature_image;
            $surrender_letter->signature_image = imageHelper::image_upload($request, 'signature_image', $image_folder, 'signature_image_'.date('Ymd'), true, true,$old_image,true,800);
        }

//        if ($request->has('signature_image_2_delete') && $request->input('signature_image_2_delete')==1) {
//            imageHelper::image_unlink($image_folder,$surrender_letter->signature_image_2);
//            $surrender_letter->signature_image_2=null;
//        }
//        if($request->hasFile('signature_image_2')) {
//            $old_image=$surrender_letter->signature_image_2;
//            $surrender_letter->signature_image_2 = imageHelper::image_upload($request, 'signature_image_2', $image_folder, 'signature_image_2_'.date('Ymd'), true, true,$old_image,true,800);
//        }

        $surrender_letter->updated_by=Auth::user()->id;
        $surrender_letter->save();

        $linked_surrenders=$request->input('linked_surrenders');
        self::update_letter_surrender_transaction($surrender_letter,$linked_surrenders);

        self::update_letter_recipient($surrender_letter,$request->input('letter_to_recipient'),'letter_to');
//        self::update_letter_recipient($surrender_letter,$request->input('letter_acknowledgement_recipient'),'letter_acknowledgement');

        Logs::store(Auth::user()->name . ' সমর্পণ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Surrender Letter', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'সমর্পণ চিঠির তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surrender_letter  $surrender_letter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Surrender_letter $surrender_letter)
    {
        //
        $letter_surrender_transactions=Letter_surrender_transaction::where('letter_id',$surrender_letter->id)->get()->toArray();
        if(count($letter_surrender_transactions)>0){
            foreach($letter_surrender_transactions as $letter_surrender_transaction){
                $code_surrender=Code_surrender::find($letter_surrender_transaction['surrender_id']);
                $code_surrender->memo=null;
                $code_surrender->memo_date=null;
                $code_surrender->save();
            }
            Letter_surrender_transaction::where('letter_id',$surrender_letter->id)->delete();
        }

        Letter_recipient::where('letter_model','surrender_letter')
            ->where('letter_id',$surrender_letter->id)
            ->delete();

        $surrender_letter->delete();
        Logs::store(Auth::user()->name . '  সমর্পণ চিঠির তথ্য ডিলিট করেন।', 'Delete Code Surrender Letter', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'কোডে সমর্পণ চিঠির তথ্য সফলভাবে ডিলিট হয়েছে!');
    }

    public function get_unlinked_surrender_by_search_key(Request $request){
        $term = $request->input('searchTerm');
        $selected = $request->input('selected');
        $allowedLinkedOptions = $request->input('allowedLinkedOptions');
        $q=Code_surrender::select('code_surrenders.id as id',
            'code_surrenders.amount as amount',
            'code_surrenders.code_id as code_id',
            'codes.code as code')
            ->join('codes','code_surrenders.code_id','codes.id')
            ->where('code_surrenders.status',1);
        if(isset($term) && $term!='') {
            $q = $q->where(function ($q) use($term){
                return $q->where('codes.code', 'Like',  '%'. $term . '%');
            });
        }
        if(isset($selected) && is_array($selected) && count($selected)>0) {
            $q = $q->whereNotIn('code_surrenders.id', $selected);
        }
        $code_surrenders=$q->whereNotIn('code_surrenders.id',function($q) use($allowedLinkedOptions){
            if(isset($allowedLinkedOptions) && count($allowedLinkedOptions)>0){
                return $q->select('letter_surrender_transactions.surrender_id')->from('letter_surrender_transactions')->whereNotIn('letter_surrender_transactions.surrender_id', $allowedLinkedOptions);
            }
            else{
                return $q->select('letter_surrender_transactions.surrender_id')->from('letter_surrender_transactions');
            }
        })->get();

        return response()->json($code_surrenders);
    }

//    public function get_letter_acknowledgement_recipient_by_search_key(Request $request){
//        $term = $request->input('searchTerm');
//        $selected = $request->input('selected');
//        if(isset($term) && $term!='') {
//            $units_with_unit_head = Unit::where('status', 1)->where('unit_head_letter_name', 'Like', '%' . $term . '%')->get();
//            $units_with_for_attention = Unit::where('status', 1)->where('for_attention_letter_name', 'Like', '%' . $term . '%')->get();
//        }
//        else{
//            $units_with_unit_head = Unit::where('status', 1)->get();
//            $units_with_for_attention = Unit::where('status', 1)->get();
//        }
//        $recipients=array();
//        foreach ($units_with_unit_head as $unit){
//            if(isset($selected)){
//                if(!in_array('unit_head_'. $unit->id,$selected)){
//                    $recipient=array();
//                    $recipient['unit_id']=$unit->id;
//                    $recipient['unit_name']=$unit->name_bangla;
//                    $recipient['unit_priority']=$unit->priority;
//                    $recipient['recipient_type']='unit_head';
//                    $recipient['letter_name']=$unit->unit_head_letter_name;
//                    $recipient['designation_id']=$unit->unit_head_designation_id;
//                    array_push($recipients,$recipient);
//                }
//            }
//            else{
//                $recipient=array();
//                $recipient['unit_id']=$unit->id;
//                $recipient['unit_name']=$unit->name_bangla;
//                $recipient['unit_priority']=$unit->priority;
//                $recipient['recipient_type']='unit_head';
//                $recipient['letter_name']=$unit->unit_head_letter_name;
//                $recipient['designation_id']=$unit->unit_head_designation_id;
//                array_push($recipients,$recipient);
//            }
//        }
//        foreach ($units_with_for_attention as $unit){
//            if(isset($unit->for_attention_letter_name) && $unit->for_attention_letter_name!=''
//                && isset($unit->for_attention_designation_id) && $unit->for_attention_designation_id>0) {
//                if (isset($selected)){
//                    if( !in_array('for_attention_' . $unit->id, $selected)) {
//                        $recipient = array();
//                        $recipient['unit_id'] = $unit->id;
//                        $recipient['unit_name']=$unit->name_bangla;
//                        $recipient['unit_priority'] = $unit->priority;
//                        $recipient['recipient_type'] = 'for_attention';
//                        $recipient['letter_name'] = $unit->for_attention_letter_name;
//                        $recipient['designation_id'] = $unit->for_attention_designation_id;
//                        array_push($recipients, $recipient);
//                    }
//                }
//                else{
//                    $recipient = array();
//                    $recipient['unit_id'] = $unit->id;
//                    $recipient['unit_name']=$unit->name_bangla;
//                    $recipient['unit_priority'] = $unit->priority;
//                    $recipient['recipient_type'] = 'for_attention';
//                    $recipient['letter_name'] = $unit->for_attention_letter_name;
//                    $recipient['designation_id'] = $unit->for_attention_designation_id;
//                    array_push($recipients, $recipient);
//                }
//            }
//        }
//        $recipients=otherHelper::array_multi_sort_by_key($recipients,'designation_id',SORT_ASC,'unit_priority');
//        return response()->json($recipients);
//    }

//    public function get_generate_letter_recipient_html(Request $request): \Illuminate\Http\JsonResponse
//    {
//        $field_type=$request->input('field_type');
//        $recipient_data=$request->input('recipient_data');
//        $htm='';
//        $elite_recipients = array();
//        $recipients = array();
//        if(is_array($recipient_data) && count($recipient_data)>0) {
//            $htm .= '<u>';
//            if ($field_type == 'letter_to') {
//                $htm .= 'বিতরণঃ';
//            } else {
//                $htm .= 'অনুলিপি সদয় জ্ঞাতার্থে ও কার্যার্থেঃ';
//            }
//
//            if (is_array($recipient_data) && count($recipient_data) > 1) {
//                $htm .= ' (জ্যেষ্ঠতার ভিত্তিতে নয়)';
//            }
//            $htm .= '</u><br>';
//            $htm .= '<table>';
//            $used_designations = array();
//            $elite_designations = Lookup::where('parent_id', 1)->where('id', '<', 3)->get();
//            $elite_designations = otherHelper::split_array($elite_designations, 'id');
//            $eu = 0;
//            $u = 0;
//            if (is_array($recipient_data) && count($recipient_data) > 0) {
//                foreach ($recipient_data as $recipient_datum) {
//                    $unit = Unit::find($recipient_datum['unit_id']);
//                    if ($recipient_datum['recipient_type'] == 'unit_head') {
//                        if (in_array($unit->unit_head_designation_id, $elite_designations)) {
//                            $elite_recipients[$eu]['unit_name'] = $unit->name_bangla;
//                            $elite_recipients[$eu]['letter_name'] = $unit->unit_head_letter_name;
//                            $elite_recipients[$eu]['designation_id'] = $unit->unit_head_designation_id;
//                            $elite_recipients[$eu]['designation'] = $unit->unit_head_designation->name;
//                            $used_designations[] = $unit->unit_head_designation_id;
//                            $elite_recipients[$eu]['unit_priority'] = $unit->priority;
//                            $elite_recipients[$eu]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
//                            $eu++;
//                        } else {
//                            $recipients[$u]['unit_name'] = $unit->name_bangla;
//                            $recipients[$u]['letter_name'] = $unit->unit_head_letter_name;
//                            $recipients[$u]['designation_id'] = $unit->unit_head_designation_id;
//                            $recipients[$u]['designation'] = $unit->unit_head_designation->name;
//                            $used_designations[] = $unit->unit_head_designation_id;
//                            $recipients[$u]['unit_priority'] = $unit->priority;
//                            $recipients[$u]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
//                            $u++;
//                        }
//                    } else {
//                        if (in_array($unit->for_attention_designation_id, $elite_designations)) {
//                            $elite_recipients[$eu]['unit_name'] = $unit->name_bangla;
//                            $elite_recipients[$eu]['letter_name'] = $unit->for_attention_letter_name;
//                            $elite_recipients[$eu]['designation_id'] = $unit->for_attention_designation_id;
//                            $elite_recipients[$eu]['designation'] = $unit->for_attention_designation->name;
//                            $used_designations[] = $unit->for_attention_designation_id;
//                            $elite_recipients[$eu]['unit_priority'] = $unit->priority;
//                            $elite_recipients[$eu]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
//                            $eu++;
//                        } else {
//                            $recipients[$u]['unit_name'] = $unit->name_bangla;
//                            $recipients[$u]['letter_name'] = $unit->for_attention_letter_name;
//                            $recipients[$u]['designation_id'] = $unit->for_attention_designation_id;
//                            $recipients[$u]['designation'] = $unit->for_attention_designation->name;
//                            $used_designations[] = $unit->for_attention_designation_id;
//                            $recipients[$u]['unit_priority'] = $unit->priority;
//                            $recipients[$u]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
//                            $u++;
//                        }
//                    }
//                }
//            }
//            $used_designations = array_unique($used_designations);
//            //$elite_recipients=otherHelper::array_multi_sort_by_key($elite_recipients,'designation_id',SORT_ASC,'unit_priority');
//            //$recipients=otherHelper::array_multi_sort_by_key($recipients,'designation_id',SORT_ASC,'unit_priority');
//            $sl = 0;
//            if ((count($elite_recipients) + count($recipients)) > 0 && count($used_designations) > 0 && $field_type == 'letter_to') {
//                foreach ($elite_recipients as $elite_recipient) {
//                    $htm .= '<tr>';
//                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $elite_recipient['letter_name'] . '</td>';
//                    $htm .= '</tr>';
//                }
//                if (count($recipients) > 0) {
//                    $recipients = otherHelper::array_group_by('designation_id', $recipients);
//                    foreach ($recipients as $recipient) {
//                        if (count($recipient) > 0) {
//                            $recipient_group = otherHelper::array_group_by('recipient_group_no', $recipient);
//                            $final_recipient = array();
//                            $used_recipient_group_no = array();
//                            $f = 0;
//                            foreach ($recipient as $r) {
//                                if ($r['recipient_group_no'] != null && $r['recipient_group_no'] != 0) {
//                                    if (count($recipient_group[$r['recipient_group_no']]) > 1) {
//                                        if (!in_array($r['recipient_group_no'], $used_recipient_group_no)) {
//                                            $final_recipient[$f] = $recipient_group[$r['recipient_group_no']];
//                                            $used_recipient_group_no[] = $r['recipient_group_no'];
//                                        }
//                                    } else {
//                                        $final_recipient[$f][0] = $r;
//                                    }
//                                } else {
//                                    $final_recipient[$f][0] = $r;
//                                }
//                                $f++;
//                            }
//                            foreach ($final_recipient as $item) {
//                                if (count($item) > 0) {
//                                    $htm .= '<tr>';
//                                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['designation'] . ', ';
//                                    $unit_names = array();
//                                    foreach ($item as $value) {
//                                        $filtered_name = str_replace('জেলা', '', $value['unit_name']);
//                                        if ($filtered_name != 'পুলিশ হেডকোয়ার্টার্স') {
//                                            $filtered_name = str_replace('পুলিশ', '', $filtered_name);
//                                        }
//                                        $filtered_name = trim($filtered_name);
//                                        $unit_names[] = $filtered_name;
//                                    }
//                                    $htm .= implode(' / ', $unit_names);
//                                    $htm .= '</td>';
//                                    $htm .= '</tr>';
//                                } else {
//                                    $htm .= '<tr>';
//                                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['letter_name'] . '</td>';
//                                    $htm .= '</tr>';
//                                }
//                            }
//                        } else {
//                            foreach ($recipient as $recipient_datum) {
//                                $htm .= '<tr>';
//                                $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $recipient_datum['letter_name'] . '</td>';
//                                $htm .= '</tr>';
//                            }
//                        }
//                    }
//                } else {
//                    foreach ($recipients as $recipient) {
//                        $htm .= '<tr>';
//                        $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $recipient['letter_name'] . '</td>';
//                        $htm .= '</tr>';
//                    }
//                }
//            } elseif ($field_type == 'letter_acknowledgement') {
//                foreach ($elite_recipients as $elite_recipient) {
//                    $htm .= '<tr>';
//                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $elite_recipient['letter_name'] . '</td>';
//                    $htm .= '</tr>';
//                }
//                $recipients = otherHelper::array_group_by('designation_id', $recipients);
//                foreach ($recipients as $recipient) {
//                    $recipient_group = otherHelper::array_group_by('recipient_group_no', $recipient);
//                    $final_recipient = array();
//                    $used_recipient_group_no = array();
//                    $f = 0;
//                    foreach ($recipient as $r) {
//                        if ($r['recipient_group_no'] != null) {
//                            if (count($recipient_group[$r['recipient_group_no']]) > 1) {
//                                if (!in_array($r['recipient_group_no'], $used_recipient_group_no)) {
//                                    $final_recipient[$f] = $recipient_group[$r['recipient_group_no']];
//                                    $used_recipient_group_no[] = $r['recipient_group_no'];
//                                }
//                            } else {
//                                $final_recipient[$f][0] = $r;
//                            }
//                        } else {
//                            $final_recipient[$f][0] = $r;
//                        }
//                        $f++;
//                    }
//                    foreach ($final_recipient as $item) {
//                        if (count($item) > 1) {
//                            $htm .= '<tr>';
//                            $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['designation'] . ', ';
//                            $unit_names = array();
//                            foreach ($item as $value) {
//                                $filtered_name = str_replace('জেলা', '', $value['unit_name']);
//                                if ($filtered_name != 'পুলিশ হেডকোয়ার্টার্স') {
//                                    $filtered_name = str_replace('পুলিশ', '', $filtered_name);
//                                }
//                                $filtered_name = trim($filtered_name);
//                                $unit_names[] = $filtered_name;
//                            }
//                            $htm .= implode(' / ', $unit_names);
//                            $htm .= '</td>';
//                            $htm .= '</tr>';
//                        } else {
//                            $htm .= '<tr>';
//                            $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['letter_name'] . '</td>';
//                            $htm .= '</tr>';
//                        }
//                    }
//
//                }
//            } else {
//                foreach ($elite_recipients as $elite_recipient) {
//                    $htm .= '<tr>';
//                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $elite_recipient['letter_name'] . '</td>';
//                    $htm .= '</tr>';
//                }
//                foreach ($recipients as $recipient) {
//                    $htm .= '<tr>';
//                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $recipient['letter_name'] . '</td>';
//                    $htm .= '</tr>';
//                }
//            }
//            $htm .= '</table>';
//        }
//        $data['htm']=$htm;
//        $data['elite_recipients']=$elite_recipients;
//        $data['recipients']=$recipients;
//        return response()->json($data);
//    }

    public function surrender_letter_sent_mail(Request $request): \Illuminate\Http\JsonResponse
    {
        $letter_id= $request->input('letter_id');
//        $mail_info= $request->input('mail_info');
//        $mail_info=explode('][',$mail_info);
        //        $settings_data = Session::get('settings_data');
        $master_surrender_letter = Master_surrender_letter::find(1);
        $settings_data = Setting::find(1);
        $surrender_letter_mail_format=$settings_data->surrender_letter_mail_format;
        $content=$surrender_letter_mail_format;
        $letter=Surrender_letter::find($letter_id);
        foreach ($letter->letter_surrender_transactions as $letter_surrender_transaction) {
            $content = str_replace('[[memo_date]]', otherHelper::en2bn(otherHelper::change_date_format($letter_surrender_transaction->letter->sub_header_memo_date, false, "d M Y")) . ' খ্রিঃ', $content);
            $content = str_replace('[[memo]]', $letter_surrender_transaction->letter->sub_header_memo_first_part . $letter_surrender_transaction->letter->sub_header_memo_second_part, $content);
            $content = str_replace('[[fiscal_year]]', otherHelper::en2bn($letter_surrender_transaction->surrender->fiscal_year), $content);
            $content = str_replace('[[code]]', $letter_surrender_transaction->surrender->code->code, $content);
            $content = str_replace('[[amount]]', otherHelper::en2bn(otherHelper::taka_format( $letter_surrender_transaction->surrender->amount)), $content);
            $param = urlencode(base64_encode('surrender_letter_' . $letter_id));
            $content .= '<br> <br> <a href="' . route('public-letter', [$param]) . '" target="_blank"><h3>ডিজিটাল পত্র দেখুন</h3></a>';
            if ($settings_data->software_mode == 'development') {
                $to_mail = 'phqtoukirahamed@gmail.com';
            } else {
                $to_mail = $master_surrender_letter->letter_to_email;
            }
            $status = EmailController::send(array(
                'view_name' => 'emails.surrender_letter_mail',
                'view_data' => array('content' => $content),
                'from_name' => $settings_data->from_mail_title,
                'to_name' => 'Finance 1',
                'to_mail' => $to_mail,
                'subject' => $settings_data->surrender_letter_mail_subject,
                'related_model_type' => 'code_surrender',
                'related_model_id' => $letter_surrender_transaction->surrender->id,
                'mail_server' => "bdchessfed.com",
            ));
            if ($status == 1) {
                $surrender_letter = Surrender_letter::find($letter_id);
                $surrender = Code_surrender::find($letter_surrender_transaction->surrender->id);
                $surrender_letter->mail_count = $surrender_letter->mail_count();
                $surrender_letter->save();
                $surrender->mail_count = $surrender->mail_count();
                $surrender->save();
            }
        }
        return response()->json($status);
    }
    public function surrender_letter_sent_sms(Request $request){
        $letter_id= $request->input('letter_id');
//        $sms_info= $request->input('sms_info');
//        $sms_info=explode('][',$sms_info);
//        $settings_data = Session::get('settings_data');
        $master_surrender_letter = Master_surrender_letter::find(1);
        $settings_data = Setting::find(1);
        $surrender_letter_sms_format=$settings_data->surrender_letter_sms_format;
        $content=$surrender_letter_sms_format;
        $letter=Surrender_letter::find($letter_id);
        foreach ($letter->letter_surrender_transactions as $letter_surrender_transaction) {
            $content = str_replace('[[memo_date]]', otherHelper::en2bn(otherHelper::change_date_format($letter_surrender_transaction->letter->sub_header_memo_date, false, "d M Y")) . ' খ্রিঃ', $content);
            $content = str_replace('[[memo]]', $letter_surrender_transaction->letter->sub_header_memo_first_part . $letter_surrender_transaction->letter->sub_header_memo_second_part, $content);
            $content = str_replace('[[fiscal_year]]', otherHelper::en2bn($letter_surrender_transaction->surrender->fiscal_year), $content);
            $content = str_replace('[[code]]', $letter_surrender_transaction->surrender->code->code, $content);
            $content = str_replace('[[amount]]', otherHelper::en2bn(otherHelper::taka_format($letter_surrender_transaction->surrender->amount)), $content);
            if ($settings_data->software_mode == 'development') {
                $number = '01754479709';
            } else {
                $number = $master_surrender_letter->letter_to_phone;
            }
            $status = SMSController::send($number, $content, 'code_surrender', $letter_surrender_transaction->surrender->id);
            if ($status == 'success') {
                $surrender_letter = Surrender_letter::find($letter_id);
                $surrender = Code_surrender::find($letter_surrender_transaction->surrender->id);
                $surrender_letter->sms_count = $surrender_letter->sms_count();
                $surrender_letter->save();
                $surrender->sms_count = $surrender->sms_count();
                $surrender->save();
            }
        }
        return response()->json($status);
    }

    public function public_letter($param){
        $param=base64_decode(urldecode($param));
        $param=explode('_',$param);
        $content='';
        $letter=null;
        if($param[0]=='surrender' && (int)$param[2]>0){
            $surrender_letter=Surrender_letter::find((int)$param[2]);
            if(isset($surrender_letter)&&isset($surrender_letter->sub_header_memo_second_part) && $surrender_letter->sub_header_memo_second_part != ''
                && isset($surrender_letter->sub_header_memo_date) && $surrender_letter->sub_header_memo_date != ''){
                $letter=$surrender_letter;
            }
            else{
                $content.='<h1 class="text-center">কোন পত্র নেই।</h1>';
            }
        }
        else{
            $content.='<h1 class="text-center">কোন পত্র নেই।</h1>';
        }
        $data['content']=$content;
        $data['surrender_letter']=$letter;
        return view('reports.surrender_letter',$data);
    }
}
