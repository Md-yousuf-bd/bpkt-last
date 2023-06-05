<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\imageHelper;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Allotment_letter;
use App\Models\Code;
use App\Models\Letter_allotment_transaction;
use App\Models\Letter_recipient;
use App\Models\Lookup;
use App\Models\Master_allotment_letter;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\Unit_allotment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AllotmentLetterController extends Controller
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
        $data['page_name']="Allotment Letter List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Allotment Letters','active')
        );
        return view('admin.unit_allotments.letters.index',$data);
    }

    public function get_index(Request $request){
        $code_id_filter = $request->input('code_id_filter');
        $unit_id_filter = $request->input('unit_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $sign_status_filter = $request->input('sign_status_filter');
        $memo_status_filter = $request->input('memo_status_filter');

        $allotment_letters = Allotment_letter::leftJoin('users as updater_user', 'allotment_letters.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'allotment_letters.created_by', '=', 'creator_user.id')
            ->select([
                'allotment_letters.id as id',
                'allotment_letters.subject as subject',
                'allotment_letters.description as description',
                'allotment_letters.sub_header_memo_first_part as sub_header_memo_first_part',
                'allotment_letters.sub_header_memo_second_part as sub_header_memo_second_part',
                'allotment_letters.sub_header_memo_date as sub_header_memo_date',
                'allotment_letters.sub_header_memo_first_part_2 as sub_header_memo_first_part_2',
                'allotment_letters.sub_header_memo_second_part_2 as sub_header_memo_second_part_2',
                'allotment_letters.sub_header_memo_date_2 as sub_header_memo_date_2',
                'allotment_letters.is_signed as is_signed',
                'allotment_letters.signature_date as signature_date',
                'allotment_letters.is_signed_2 as is_signed_2',
                'allotment_letters.signature_date_2 as signature_date_2',
                'allotment_letters.total_allotments as total_allotments',
                'allotment_letters.total_units as total_units',
                'allotment_letters.unit_ids as unit_ids',
                'allotment_letters.code_ids as code_ids',
                'allotment_letters.fiscal_years as fiscal_years',
                'allotment_letters.total_amount as total_amount',
                'allotment_letters.mail_count as mail_count',
                'allotment_letters.sms_count as sms_count',
                'creator_user.name as creator_user',
                'allotment_letters.created_at as created_at',
                'updater_user.name as updater_user',
                'allotment_letters.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter)>0, function ($q) use($code_id_filter) {
                return $q->where(function($q) use($code_id_filter){
                    foreach($code_id_filter as $code_id) {
                        $q->orWhere('allotment_letters.code_ids', 'LIKE', "%|$code_id|%");
                    }
                });
            })
            ->when(isset($unit_id_filter) && count($unit_id_filter)>0, function ($q) use($unit_id_filter) {
                return $q->where(function($q) use($unit_id_filter){
                    foreach($unit_id_filter as $unit_id) {
                        $q->orWhere('allotment_letters.unit_ids', 'LIKE', "%|$unit_id|%");
                    }
                });
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter)>0, function ($q) use($fiscal_year_filter) {
                return $q->where(function($q) use($fiscal_year_filter){
                    foreach($fiscal_year_filter as $fiscal_year) {
                        $q->orWhere('allotment_letters.fiscal_years', 'LIKE', "%|$fiscal_year|%");
                    }
                });
            })
            ->when(isset($sign_status_filter) && $sign_status_filter!='', function ($q) use($sign_status_filter) {
                if($sign_status_filter=='not singed') {
                    return $q->where('allotment_letters.is_signed',0)->where('allotment_letters.is_signed_2',0);
                }
                elseif ($sign_status_filter=='both singed'){
                    return $q->where('allotment_letters.is_signed',1)->where('allotment_letters.is_signed_2',1);
                }
                elseif ($sign_status_filter=='only 1st singed'){
                    return $q->where('allotment_letters.is_signed',1)->where('allotment_letters.is_signed_2',0);
                }
                elseif ($sign_status_filter=='only 2nd singed'){
                    return $q->where('allotment_letters.is_signed',0)->where('allotment_letters.is_signed_2',1);
                }
                else{
                    return $q->where(function($q){
                            return $q->where(function($q){
                                return $q->where('allotment_letters.is_signed',1)->where('allotment_letters.is_signed_2',0);
                            })->orWhere(function($q){
                                return $q->where('allotment_letters.is_signed',0)->where('allotment_letters.is_signed_2',1);
                            });
                    });
                }
            })
            ->when(isset($memo_status_filter) && $memo_status_filter!='', function ($q) use($memo_status_filter) {
                if($memo_status_filter=='no memo') {
                    return $q->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part',null)
                            ->orWhere('allotment_letters.sub_header_memo_second_part','')
                            ->orWhere('allotment_letters.sub_header_memo_first_part',null)
                            ->orWhere('allotment_letters.sub_header_memo_first_part','');
                    })->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part_2',null)
                            ->orWhere('allotment_letters.sub_header_memo_second_part_2','')
                            ->orWhere('allotment_letters.sub_header_memo_first_part_2',null)
                            ->orWhere('allotment_letters.sub_header_memo_first_part_2','');
                    });
                }
                elseif ($memo_status_filter=='both memo'){
                    return $q->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part','!=',null)
                            ->where('allotment_letters.sub_header_memo_second_part','!=','')
                            ->where('allotment_letters.sub_header_memo_first_part','!=',null)
                            ->where('allotment_letters.sub_header_memo_first_part','!=','');
                    })->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part_2','!=',null)
                            ->where('allotment_letters.sub_header_memo_second_part_2','!=','')
                            ->where('allotment_letters.sub_header_memo_first_part_2','!=',null)
                            ->where('allotment_letters.sub_header_memo_first_part_2','!=','');
                    });
                }
                elseif ($memo_status_filter=='only 1st memo'){
                    return $q->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part','!=',null)
                            ->where('allotment_letters.sub_header_memo_second_part','!=','')
                            ->where('allotment_letters.sub_header_memo_first_part','!=',null)
                            ->where('allotment_letters.sub_header_memo_first_part','!=','');
                    })->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part_2',null)
                            ->orWhere('allotment_letters.sub_header_memo_second_part_2','')
                            ->orWhere('allotment_letters.sub_header_memo_first_part_2',null)
                            ->orWhere('allotment_letters.sub_header_memo_first_part_2','');
                    });
                }
                elseif ($memo_status_filter=='only 2nd memo'){
                    return $q->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part',null)
                            ->orWhere('allotment_letters.sub_header_memo_second_part','')
                            ->orWhere('allotment_letters.sub_header_memo_first_part',null)
                            ->orWhere('allotment_letters.sub_header_memo_first_part','');
                    })->where(function($q){
                        return $q->where('allotment_letters.sub_header_memo_second_part_2','!=',null)
                            ->where('allotment_letters.sub_header_memo_second_part_2','!=','')
                            ->where('allotment_letters.sub_header_memo_first_part_2','!=',null)
                            ->where('allotment_letters.sub_header_memo_first_part_2','!=','');
                    });
                }
                else{
                    return $q->where(function($q){
                        return $q->where(function($q){
                            return $q->where(function($q){
                                return $q->where('allotment_letters.sub_header_memo_second_part','!=',null)
                                    ->where('allotment_letters.sub_header_memo_second_part','!=','')
                                    ->where('allotment_letters.sub_header_memo_first_part','!=',null)
                                    ->where('allotment_letters.sub_header_memo_first_part','!=','');
                            })->where(function($q){
                                return $q->where('allotment_letters.sub_header_memo_second_part_2',null)
                                    ->orWhere('allotment_letters.sub_header_memo_second_part_2','')
                                    ->orWhere('allotment_letters.sub_header_memo_first_part_2',null)
                                    ->orWhere('allotment_letters.sub_header_memo_first_part_2','');
                            });
                        })->orWhere(function($q){
                            return $q->where(function($q){
                                return $q->where('allotment_letters.sub_header_memo_second_part',null)
                                    ->orWhere('allotment_letters.sub_header_memo_second_part','')
                                    ->orWhere('allotment_letters.sub_header_memo_first_part',null)
                                    ->orWhere('allotment_letters.sub_header_memo_first_part','');
                            })->where(function($q){
                                return $q->where('allotment_letters.sub_header_memo_second_part_2','!=',null)
                                    ->where('allotment_letters.sub_header_memo_second_part_2','!=','')
                                    ->where('allotment_letters.sub_header_memo_first_part_2','!=',null)
                                    ->where('allotment_letters.sub_header_memo_first_part_2','!=','');
                            });
                        });
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


        return DataTables::eloquent($allotment_letters)
            ->addIndexColumn()
            ->setRowId(function ($allotment_letter) {
                return 'row_' . $allotment_letter->id;
            })
            ->setRowData([
                'data-created_at' => function ($allotment_letter) {
                    return otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($allotment_letter) {
                    return otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->updated_at, true, 'd-M-Y H:i'));
                },
                'data-sub_header_memo_date' => function ($allotment_letter) {
                    return (isset($allotment_letter->sub_header_memo_date) && strlen($allotment_letter->sub_header_memo_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->sub_header_memo_date, true, 'd-M-Y')): '';
                },
                'data-sub_header_memo_date_2' => function ($allotment_letter) {
                    return (isset($allotment_letter->sub_header_memo_date_2) && strlen($allotment_letter->sub_header_memo_date_2)>0)? otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->sub_header_memo_date_2, true, 'd-M-Y')): '';
                },
                'data-is_signed' => function ($allotment_letter) {
                    return ($allotment_letter->is_signed==1)?'স্বাক্ষরিত':'অস্বাক্ষরিত';
                },
                'data-signature_date' => function ($allotment_letter) {
                    return (isset($allotment_letter->signature_date) && strlen($allotment_letter->signature_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->signature_date, true, 'd-M-Y')): '';
                },
                'data-is_signed_2' => function ($allotment_letter) {
                    return ($allotment_letter->is_signed_2==1)?'স্বাক্ষরিত':'অস্বাক্ষরিত';
                },
                'data-signature_date_2' => function ($allotment_letter) {
                    return (isset($allotment_letter->signature_date_2) && strlen($allotment_letter->signature_date_2)>0)? otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->signature_date_2, true, 'd-M-Y')): '';
                },
                'data-total_amount' => function ($allotment_letter) {
                    return otherHelper::en2bn(otherHelper::taka_format($allotment_letter->total_amount));
                },
                'data-mail_count' => function ($allotment_letter) {
                    return otherHelper::en2bn($allotment_letter->mail_count);
                },
                'data-sms_count' => function ($allotment_letter) {
                    return otherHelper::en2bn($allotment_letter->sms_count);
                },
                'data-total_allotments' => function ($allotment_letter) {
                    return otherHelper::en2bn($allotment_letter->total_allotments);
                },
                'data-total_units' => function ($allotment_letter) {
                    return otherHelper::en2bn($allotment_letter->total_units);
                }
            ])
            ->addColumn('action', function ($allotment_letter) {
                if (auth()->user()->can('edit-allotment-letter') && auth()->user()->can('delete-allotment-letter')) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment-letter.show', [$allotment_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-allotment-letter.edit', [$allotment_letter->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-allotment-letter.destroy', [$allotment_letter->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-allotment-letter')) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment-letter.show', [$allotment_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-allotment-letter.edit', [$allotment_letter->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-allotment-letter')) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment-letter.show', [$allotment_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-allotment-letter.destroy', [$allotment_letter->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment-letter.show', [$allotment_letter->id]) . '"  ><span class="fa fa-envelope">  ' . Lang::get('commons/buttons.Letter') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('subject_modified',  function($allotment_letter) {
                return $allotment_letter->subject;
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
        $data['master_allotment_letter']=Master_allotment_letter::find(1);
        $data['page_name']="Add Allotment Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Add Allotment Letter','active')
        );
        return view('admin.unit_allotments.letters.create',$data);
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
            'signature_image_2'=>['image'],
            'linked_allotments_count'=>['required','min:1'],
        ]);
        $master_allotment_letter=Master_allotment_letter::find(1);
        $allotment_letter=new Allotment_letter();
        $allotment_letter->header_middle_heading=$request->input('header_middle_heading');
        $allotment_letter->sub_header_memo_first_part=$request->input('sub_header_memo_first_part');
       // $allotment_letter->sub_header_memo_second_part=$request->input('sub_header_memo_second_part');
        $allotment_letter->sub_header_memo_first_part_2=$request->input('sub_header_memo_first_part_2');
        //$allotment_letter->sub_header_memo_second_part_2=$request->input('sub_header_memo_second_part_2');
        $allotment_letter->sub_header_memo_date=$request->input('sub_header_memo_date');
        $allotment_letter->sub_header_memo_date_2=$request->input('sub_header_memo_date_2');
        $allotment_letter->subject=$request->input('subject');
        $allotment_letter->reference=$request->input('reference');
        $allotment_letter->description=$request->input('description');
        $allotment_letter->allotment_table=$request->input('allotment_table');
        $allotment_letter->instructions=$request->input('instructions');
        $allotment_letter->signature_info_left=$request->input('signature_info_left');
        $allotment_letter->signature_info=$request->input('signature_info');
        $allotment_letter->signature_info_2=$request->input('signature_info_2');
        if(Auth::user()->can('sign-allotment-letter')) {
            $allotment_letter->signature_date = $request->input('signature_date');
            $allotment_letter->signature_date_2 = $request->input('signature_date_2');
            $allotment_letter->is_signed = $request->input('is_signed');
            $allotment_letter->is_signed_2 = $request->input('is_signed_2');
        }
        $allotment_letter->letter_to=$request->input('letter_to');
        $allotment_letter->letter_acknowledgement=$request->input('letter_acknowledgement');
        $image_folder='images/master_allotment_letters';

        $allotment_letter->header_left_logo=$master_allotment_letter->header_left_logo;
        if ($request->has('header_left_logo_delete') && $request->input('header_left_logo_delete')==1) {
            $allotment_letter->header_left_logo=null;
        }
        if($request->hasFile('header_left_logo')) {
            $allotment_letter->header_left_logo = imageHelper::image_upload($request, 'header_left_logo', $image_folder, 'header_left_logo_'.date('Ymd'), true, false,'',true,800);
        }

        $allotment_letter->header_right_logo=$master_allotment_letter->header_right_logo;
        if ($request->has('header_right_logo_delete') && $request->input('header_right_logo_delete')==1) {
            $allotment_letter->header_right_logo=null;
        }
        if($request->hasFile('header_right_logo')) {
            $allotment_letter->header_right_logo = imageHelper::image_upload($request, 'header_right_logo', $image_folder, 'header_right_logo_'.date('Ymd'), true, false,'',true,800);
        }

        $allotment_letter->signature_image=$master_allotment_letter->signature_image;
        if ($request->has('signature_image_delete') && $request->input('signature_image_delete')==1) {
            $allotment_letter->signature_image=null;
        }
        if($request->hasFile('signature_image')) {
            $allotment_letter->signature_image = imageHelper::image_upload($request, 'signature_image', $image_folder, 'signature_image_'.date('Ymd'), true, false,'',true,800);
        }

        $allotment_letter->signature_image_2=$master_allotment_letter->signature_image_2;
        if ($request->has('signature_image_2_delete') && $request->input('signature_image_2_delete')==1) {
            $allotment_letter->signature_image_2=null;
        }
        if($request->hasFile('signature_image_2')) {
            $allotment_letter->signature_image_2 = imageHelper::image_upload($request, 'signature_image_2', $image_folder, 'signature_image_2_'.date('Ymd'), true, false,'',true,800);
        }
        $allotment_letter->created_by=Auth::user()->id;
        $allotment_letter->updated_by=Auth::user()->id;
        $allotment_letter->save();

        $linked_allotments=$request->input('linked_allotments');
        self::update_letter_allotment_transaction($allotment_letter,$linked_allotments);

        self::update_letter_recipient($allotment_letter,$request->input('letter_to_recipient'),'letter_to');
        self::update_letter_recipient($allotment_letter,$request->input('letter_acknowledgement_recipient'),'letter_acknowledgement');

        Logs::store(Auth::user()->name . ' বরাদ্দ চিঠির তথ্য যুক্ত করেছেন।', 'Add Allotment Letter', 'success', Auth::user()->id);
        return redirect()->route('unit-allotment-letter.index')->with('success', 'বরাদ্দ চিঠির তথ্য সফলভাবে যুক্ত হয়েছে!');
    }

    private function update_letter_recipient(Allotment_letter $letter, $recipient_data,$field_type){
        Letter_recipient::where('letter_model','allotment_letter')->where('letter_id',$letter->id)->where('field_type',$field_type)->delete();
        if(isset($recipient_data) && count($recipient_data)>0){
            foreach ($recipient_data as $recipient_datum){
                $letter_recipient=new Letter_recipient();
                $letter_recipient->letter_model='allotment_letter';
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

    private function update_letter_allotment_transaction(Allotment_letter $allotment_letter,$linked_allotments){
        $letter_allotment_transactions=Letter_allotment_transaction::where('letter_id',$allotment_letter->id)->get()->toArray();
        if(count($letter_allotment_transactions)>0){
            foreach($letter_allotment_transactions as $letter_allotment_transaction){
                $unit_allotment=Unit_allotment::find($letter_allotment_transaction['allotment_id']);
                $unit_allotment->memo=null;
                $unit_allotment->memo_date=null;
                $unit_allotment->save();
            }
            Letter_allotment_transaction::where('letter_id',$allotment_letter->id)->delete();
        }
        foreach ($linked_allotments as $allotment){
            $letter_allotment_transaction= new Letter_allotment_transaction();
            $letter_allotment_transaction->letter_id=$allotment_letter->id;
            $letter_allotment_transaction->allotment_id=$allotment;
            $letter_allotment_transaction->save();
        }
        $letter_allotment_transactions=Letter_allotment_transaction::where('letter_id',$allotment_letter->id)->get()->toArray();
        if(isset($allotment_letter->sub_header_memo_first_part)
            && $allotment_letter->sub_header_memo_first_part!=''
            && isset($allotment_letter->sub_header_memo_second_part)
            && $allotment_letter->sub_header_memo_second_part!=''
            && isset($allotment_letter->sub_header_memo_date)
            && $allotment_letter->sub_header_memo_date!='')
        {
            foreach($letter_allotment_transactions as $letter_allotment_transaction){
                $unit_allotment=Unit_allotment::find($letter_allotment_transaction['allotment_id']);
                $unit_allotment->memo=$allotment_letter->sub_header_memo_first_part.$allotment_letter->sub_header_memo_second_part;
                $unit_allotment->memo_date=$allotment_letter->sub_header_memo_date;
                $unit_allotment->save();
            }
        }
        $allotment_letter->total_allotments= count($letter_allotment_transactions);
        $letter_allotment_transactions=Letter_allotment_transaction::where('letter_id',$allotment_letter->id)->get();
        $unit_ids=array();
        $code_ids=array();
        $fiscal_years=array();
        $total_amount=0;
        foreach($letter_allotment_transactions as $letter_allotment_transaction){
            array_push($unit_ids,$letter_allotment_transaction->allotment->unit_id);
            array_push($code_ids,$letter_allotment_transaction->allotment->code_id);
            array_push($fiscal_years,$letter_allotment_transaction->allotment->fiscal_year);
            $total_amount+=$letter_allotment_transaction->allotment->amount;
        }
        $unit_ids=array_unique($unit_ids);
        $code_ids=array_unique($code_ids);
        $fiscal_years=array_unique($fiscal_years);
        $allotment_letter->total_units= count($unit_ids);
        $allotment_letter->unit_ids= '|'.implode('| |',$unit_ids).'|';
        $allotment_letter->code_ids= '|'.implode('| |',$code_ids).'|';
        $allotment_letter->fiscal_years= '|'.implode('| |',$fiscal_years).'|';
        $allotment_letter->total_amount= $total_amount;
        $allotment_letter->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allotment_letter  $allotment_letter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Allotment_letter $allotment_letter)
    {
        //
        $data['allotment_letter']=$allotment_letter;
        $data['page_name']="Show Allotment Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Show Allotment Letter','active')
        );
        return view('admin.unit_allotments.letters.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allotment_letter  $allotment_letter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Allotment_letter $allotment_letter)
    {
        //
        $data['allotment_letter']=$allotment_letter;
        $data['page_name']="Edit Allotment Letter";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Edit Allotment Letter','active')
        );
        return view('admin.unit_allotments.letters.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allotment_letter  $allotment_letter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Allotment_letter $allotment_letter)
    {
        //
        $this->validate($request,[
            'header_left_logo'=>['image'],
            'header_right_logo'=>['image'],
            'signature_image'=>['image'],
            'signature_image_2'=>['image'],
            'linked_allotments_count'=>['required','min:1'],
        ]);
        $allotment_letter->header_middle_heading=$request->input('header_middle_heading');
        $allotment_letter->sub_header_memo_first_part=$request->input('sub_header_memo_first_part');
        $allotment_letter->sub_header_memo_first_part_2=$request->input('sub_header_memo_first_part_2');
        $allotment_letter->sub_header_memo_date=$request->input('sub_header_memo_date');
        if($allotment_letter->is_signed==1 && isset($allotment_letter->signature_date) && $allotment_letter->signature_date!=='') {
            $allotment_letter->sub_header_memo_second_part = $request->input('sub_header_memo_second_part');
        }
        $allotment_letter->sub_header_memo_date_2 = $request->input('sub_header_memo_date_2');
        if($allotment_letter->is_signed_2==1 && isset($allotment_letter->signature_date_2) && $allotment_letter->signature_date_2!=='') {
            $allotment_letter->sub_header_memo_second_part_2 = $request->input('sub_header_memo_second_part_2');
        }
        $allotment_letter->subject=$request->input('subject');
        $allotment_letter->reference=$request->input('reference');
        $allotment_letter->description=$request->input('description');
        $allotment_letter->allotment_table=$request->input('allotment_table');
        $allotment_letter->instructions=$request->input('instructions');
        $allotment_letter->signature_info_left=$request->input('signature_info_left');
        $allotment_letter->signature_info=$request->input('signature_info');
        $allotment_letter->signature_info_2=$request->input('signature_info_2');
        if(Auth::user()->can('sign-allotment-letter')) {
            if($request->input('is_signed') !== null && otherHelper::validateDate($request->input('signature_date')) && !($allotment_letter->sub_header_memo_second_part!='')) {
                $allotment_letter->signature_date = $request->input('signature_date');
                $allotment_letter->is_signed = $request->input('is_signed');
            }
            if($request->input('is_signed_2') !== null && otherHelper::validateDate($request->input('signature_date_2')) && !($allotment_letter->sub_header_memo_second_part_2!='')) {
                $allotment_letter->signature_date_2 = $request->input('signature_date_2');
                $allotment_letter->is_signed_2 = $request->input('is_signed_2');
            }
        }
        $allotment_letter->letter_to=$request->input('letter_to');
        $allotment_letter->letter_acknowledgement=$request->input('letter_acknowledgement');
        $image_folder='images/master_allotment_letters';

        if ($request->has('header_left_logo_delete') && $request->input('header_left_logo_delete')==1) {
            imageHelper::image_unlink($image_folder,$allotment_letter->header_left_logo);
            $allotment_letter->header_left_logo=null;
        }
        if($request->hasFile('header_left_logo')) {
            $old_image=$allotment_letter->header_left_logo;
            $allotment_letter->header_left_logo = imageHelper::image_upload($request, 'header_left_logo', $image_folder, 'header_left_logo_'.date('Ymd'), true, true,$old_image,true,800);
        }

        if ($request->has('header_right_logo_delete') && $request->input('header_right_logo_delete')==1) {
            imageHelper::image_unlink($image_folder,$allotment_letter->header_right_logo);
            $allotment_letter->header_right_logo=null;
        }
        if($request->hasFile('header_right_logo')) {
            $old_image=$allotment_letter->header_right_logo;
            $allotment_letter->header_right_logo = imageHelper::image_upload($request, 'header_right_logo', $image_folder, 'header_right_logo_'.date('Ymd'), true, true,$old_image,true,800);
        }

        if ($request->has('signature_image_delete') && $request->input('signature_image_delete')==1) {
            imageHelper::image_unlink($image_folder,$allotment_letter->signature_image);
            $allotment_letter->signature_image=null;
        }
        if($request->hasFile('signature_image')) {
            $old_image=$allotment_letter->signature_image;
            $allotment_letter->signature_image = imageHelper::image_upload($request, 'signature_image', $image_folder, 'signature_image_'.date('Ymd'), true, true,$old_image,true,800);
        }

        if ($request->has('signature_image_2_delete') && $request->input('signature_image_2_delete')==1) {
            imageHelper::image_unlink($image_folder,$allotment_letter->signature_image_2);
            $allotment_letter->signature_image_2=null;
        }
        if($request->hasFile('signature_image_2')) {
            $old_image=$allotment_letter->signature_image_2;
            $allotment_letter->signature_image_2 = imageHelper::image_upload($request, 'signature_image_2', $image_folder, 'signature_image_2_'.date('Ymd'), true, true,$old_image,true,800);
        }

        $allotment_letter->updated_by=Auth::user()->id;
        $allotment_letter->save();

        $linked_allotments=$request->input('linked_allotments');
        self::update_letter_allotment_transaction($allotment_letter,$linked_allotments);

        self::update_letter_recipient($allotment_letter,$request->input('letter_to_recipient'),'letter_to');
        self::update_letter_recipient($allotment_letter,$request->input('letter_acknowledgement_recipient'),'letter_acknowledgement');

        Logs::store(Auth::user()->name . ' বরাদ্দ চিঠির তথ্য পরিবর্তন করেছেন।', 'Edit Allotment Letter', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'বরাদ্দ চিঠির তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allotment_letter  $allotment_letter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Allotment_letter $allotment_letter): \Illuminate\Http\RedirectResponse
    {
        //
        $letter_allotment_transactions=Letter_allotment_transaction::where('letter_id',$allotment_letter->id)->get()->toArray();
        if(count($letter_allotment_transactions)>0){
            foreach($letter_allotment_transactions as $letter_allotment_transaction){
                $unit_allotment=Unit_allotment::find($letter_allotment_transaction['allotment_id']);
                $unit_allotment->memo=null;
                $unit_allotment->memo_date=null;
                $unit_allotment->save();
            }
            Letter_allotment_transaction::where('letter_id',$allotment_letter->id)->delete();
        }

        Letter_recipient::where('letter_model','allotment_letter')
            ->where('letter_id',$allotment_letter->id)
            ->delete();

        $allotment_letter->delete();
        Logs::store(Auth::user()->name . '  বরাদ্দ চিঠির তথ্য ডিলিট করেন।', 'Delete Unit Allotment Letter', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'ইউনিটে বরাদ্দ চিঠির তথ্য সফলভাবে ডিলিট হয়েছে!');
    }

    public function get_unlinked_allotment_by_search_key(Request $request): \Illuminate\Http\JsonResponse
    {
        $term = $request->input('searchTerm');
        $selected = $request->input('selected');
        $allowedLinkedOptions = $request->input('allowedLinkedOptions');
        $q=Unit_allotment::select('unit_allotments.id as id',
            'unit_allotments.allocation_sector as allocation_sector',
            'unit_allotments.amount as amount',
            'codes.code as code',
            'codes.code_name as code_name',
            'units.id as unit_id',
            'units.office_id as unit_office_id',
            'units.ddo_id as unit_ddo_id',
            'units.name_bangla as unit_name')
            ->join('units','unit_allotments.unit_id','units.id')
            ->join('codes','unit_allotments.code_id','codes.id')
            ->where('unit_allotments.status',1);
        if(isset($term) && $term!='') {
            $q = $q->where(function ($q) use($term){
                return $q->where('units.name_bangla', 'Like',  '%'. $term . '%')
                    ->orWhere('units.name', 'Like',  '%'. $term . '%');
            });
        }
        if(isset($selected) && is_array($selected) && count($selected)>0) {
            $q = $q->whereNotIn('unit_allotments.id', $selected);
        }
        $unit_allotments=$q->whereNotIn('unit_allotments.id',function($q) use($allowedLinkedOptions){
            if(isset($allowedLinkedOptions) && count($allowedLinkedOptions)>0){
                return $q->select('letter_allotment_transactions.allotment_id')->from('letter_allotment_transactions')->whereNotIn('letter_allotment_transactions.allotment_id', $allowedLinkedOptions);
            }
            else{
                return $q->select('letter_allotment_transactions.allotment_id')->from('letter_allotment_transactions');
            }
        })->get();

        foreach ($unit_allotments as $unit_allotment){
            $code_name_arr=explode('-',$unit_allotment->code_name);
            $unit_allotment->short_name1=$code_name_arr[0].'-'.$code_name_arr[1].'-'.$code_name_arr[2];
            $unit_allotment->short_name2=$code_name_arr[3].'-'.$code_name_arr[4];
            $unit_allotment->allocation_sector=(isset($unit_allotment->allocation_sector)) ? $unit_allotment->allocation_sector : '-';
            $unit_allotment->unit_office_id=(isset($unit_allotment->unit_office_id)) ? $unit_allotment->unit_office_id : '-';
            $unit_allotment->unit_ddo_id=(isset($unit_allotment->unit_ddo_id)) ? $unit_allotment->unit_ddo_id : '-';
        }

        return response()->json($unit_allotments);
    }

    public function get_letter_acknowledgement_recipient_by_search_key(Request $request): \Illuminate\Http\JsonResponse
    {
        $term = $request->input('searchTerm');
        $selected = $request->input('selected');
        if(isset($term) && $term!='') {
            $units_with_unit_head = Unit::where('status', 1)->where('unit_head_letter_name', 'Like', '%' . $term . '%')->get();
            $units_with_for_attention = Unit::where('status', 1)->where('for_attention_letter_name', 'Like', '%' . $term . '%')->get();
        }
        else{
            $units_with_unit_head = Unit::where('status', 1)->get();
            $units_with_for_attention = Unit::where('status', 1)->get();
        }
        $recipients=array();
        foreach ($units_with_unit_head as $unit){
            if(isset($selected)){
                if(!in_array('unit_head_'. $unit->id,$selected)){
                    $recipient=array();
                    $recipient['unit_id']=$unit->id;
                    $recipient['unit_name']=$unit->name_bangla;
                    $recipient['unit_priority']=$unit->priority;
                    $recipient['recipient_type']='unit_head';
                    $recipient['letter_name']=$unit->unit_head_letter_name;
                    $recipient['designation_id']=$unit->unit_head_designation_id;
                    array_push($recipients,$recipient);
                }
            }
            else{
                $recipient=array();
                $recipient['unit_id']=$unit->id;
                $recipient['unit_name']=$unit->name_bangla;
                $recipient['unit_priority']=$unit->priority;
                $recipient['recipient_type']='unit_head';
                $recipient['letter_name']=$unit->unit_head_letter_name;
                $recipient['designation_id']=$unit->unit_head_designation_id;
                array_push($recipients,$recipient);
            }
        }
        foreach ($units_with_for_attention as $unit){
            if(isset($unit->for_attention_letter_name) && $unit->for_attention_letter_name!=''
                && isset($unit->for_attention_designation_id) && $unit->for_attention_designation_id>0) {
                if (isset($selected)){
                    if( !in_array('for_attention_' . $unit->id, $selected)) {
                        $recipient = array();
                        $recipient['unit_id'] = $unit->id;
                        $recipient['unit_name']=$unit->name_bangla;
                        $recipient['unit_priority'] = $unit->priority;
                        $recipient['recipient_type'] = 'for_attention';
                        $recipient['letter_name'] = $unit->for_attention_letter_name;
                        $recipient['designation_id'] = $unit->for_attention_designation_id;
                        array_push($recipients, $recipient);
                    }
                }
                else{
                    $recipient = array();
                    $recipient['unit_id'] = $unit->id;
                    $recipient['unit_name']=$unit->name_bangla;
                    $recipient['unit_priority'] = $unit->priority;
                    $recipient['recipient_type'] = 'for_attention';
                    $recipient['letter_name'] = $unit->for_attention_letter_name;
                    $recipient['designation_id'] = $unit->for_attention_designation_id;
                    array_push($recipients, $recipient);
                }
            }
        }
        $recipients=otherHelper::array_multi_sort_by_key($recipients,'designation_id',SORT_ASC,'unit_priority');
        return response()->json($recipients);
    }

    public function get_generate_letter_recipient_html(Request $request): \Illuminate\Http\JsonResponse
    {
        $field_type=$request->input('field_type');
        $recipient_data=$request->input('recipient_data');
        $htm='';
        $elite_recipients = array();
        $recipients = array();
        if(is_array($recipient_data) && count($recipient_data)>0) {
            $htm .= '<u>';
            if ($field_type == 'letter_to') {
                $htm .= 'বিতরণঃ';
            } else {
                $htm .= 'অনুলিপি সদয় জ্ঞাতার্থে ও কার্যার্থেঃ';
            }

            if (is_array($recipient_data) && count($recipient_data) > 1) {
                $htm .= ' (জ্যেষ্ঠতার ভিত্তিতে নয়)';
            }
            $htm .= '</u><br>';
            $htm .= '<table>';
            $used_designations = array();
            $elite_designations = Lookup::where('parent_id', 1)->where('id', '<', 3)->get();
            $elite_designations = otherHelper::split_array($elite_designations, 'id');
            $eu = 0;
            $u = 0;
            if (is_array($recipient_data) && count($recipient_data) > 0) {
                foreach ($recipient_data as $recipient_datum) {
                    $unit = Unit::find($recipient_datum['unit_id']);
                    if ($recipient_datum['recipient_type'] == 'unit_head') {
                        if (in_array($unit->unit_head_designation_id, $elite_designations)) {
                            $elite_recipients[$eu]['unit_name'] = $unit->name_bangla;
                            $elite_recipients[$eu]['letter_name'] = $unit->unit_head_letter_name;
                            $elite_recipients[$eu]['designation_id'] = $unit->unit_head_designation_id;
                            $elite_recipients[$eu]['designation'] = $unit->unit_head_designation->name;
                            $used_designations[] = $unit->unit_head_designation_id;
                            $elite_recipients[$eu]['unit_priority'] = $unit->priority;
                            $elite_recipients[$eu]['designation_priority'] = $unit->unit_head_designation->priority;
                            $elite_recipients[$eu]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
                            $eu++;
                        } else {
                            $recipients[$u]['unit_name'] = $unit->name_bangla;
                            $recipients[$u]['letter_name'] = $unit->unit_head_letter_name;
                            $recipients[$u]['designation_id'] = $unit->unit_head_designation_id;
                            $recipients[$u]['designation'] = $unit->unit_head_designation->name;
                            $used_designations[] = $unit->unit_head_designation_id;
                            $recipients[$u]['unit_priority'] = $unit->priority;
                            $recipients[$u]['designation_priority'] = $unit->unit_head_designation->priority;
                            $recipients[$u]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
                            $u++;
                        }
                    } else {
                        if (in_array($unit->for_attention_designation_id, $elite_designations)) {
                            $elite_recipients[$eu]['unit_name'] = $unit->name_bangla;
                            $elite_recipients[$eu]['letter_name'] = $unit->for_attention_letter_name;
                            $elite_recipients[$eu]['designation_id'] = $unit->for_attention_designation_id;
                            $elite_recipients[$eu]['designation'] = $unit->for_attention_designation->name;
                            $used_designations[] = $unit->for_attention_designation_id;
                            $elite_recipients[$eu]['unit_priority'] = $unit->priority;
                            $elite_recipients[$eu]['designation_priority'] = $unit->for_attention_designation->priority;
                            $elite_recipients[$eu]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
                            $eu++;
                        } else {
                            $recipients[$u]['unit_name'] = $unit->name_bangla;
                            $recipients[$u]['letter_name'] = $unit->for_attention_letter_name;
                            $recipients[$u]['designation_id'] = $unit->for_attention_designation_id;
                            $recipients[$u]['designation'] = $unit->for_attention_designation->name;
                            $used_designations[] = $unit->for_attention_designation_id;
                            $recipients[$u]['unit_priority'] = $unit->priority;
                            $recipients[$u]['designation_priority'] = $unit->for_attention_designation->priority;
                            $recipients[$u]['recipient_group_no'] = $recipient_datum['recipient_group_no'];
                            $u++;
                        }
                    }
                }
            }
            //dd($recipients);
            $used_designations = array_unique($used_designations);
            //$elite_recipients=otherHelper::array_multi_sort_by_key($elite_recipients,'designation_priority',SORT_ASC,'unit_priority');
            //$elite_recipients=otherHelper::array_multi_sort_by_key($elite_recipients,'designation_id',SORT_ASC,'unit_priority');
            $recipients=otherHelper::array_multi_sort_by_key($recipients,'designation_priority',SORT_ASC,'unit_priority');
            //$recipients=otherHelper::array_multi_sort_by_key($recipients,'designation_id',SORT_ASC,'unit_priority');
            $sl = 0;
            if ((count($elite_recipients) + count($recipients)) > 0 && count($used_designations) > 0 && $field_type == 'letter_to') {
                foreach ($elite_recipients as $elite_recipient) {
                    $htm .= '<tr>';
                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $elite_recipient['letter_name'] . '</td>';
                    $htm .= '</tr>';
                }
                if (count($recipients) > 0) {
                    $recipients = otherHelper::array_group_by('designation_id', $recipients);
                    foreach ($recipients as $recipient) {
                        if (count($recipient) > 1) {
                            $recipient_group = otherHelper::array_group_by('recipient_group_no', $recipient);
                            $final_recipient = array();
                            $used_recipient_group_no = array();
                            $f = 0;
                            foreach ($recipient as $r) {
                                if ($r['recipient_group_no'] != null && $r['recipient_group_no'] != 0) {
                                    if (count($recipient_group[$r['recipient_group_no']]) > 1) {
                                        if (!in_array($r['recipient_group_no'], $used_recipient_group_no)) {
                                            $final_recipient[$f] = $recipient_group[$r['recipient_group_no']];
                                            $used_recipient_group_no[] = $r['recipient_group_no'];
                                        }
                                    } else {
                                        $final_recipient[$f][0] = $r;
                                    }
                                } else {
                                    $final_recipient[$f][0] = $r;
                                }
                                $f++;
                            }
                            foreach ($final_recipient as $item) {
                                if (count($item) > 0) {
                                    $htm .= '<tr>';
                                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['designation'] . ', ';
                                    $unit_names = array();
                                    foreach ($item as $value) {
//                                        $filtered_name = str_replace('জেলা', '', $value['unit_name']);
//                                        if ($filtered_name != 'পুলিশ হেডকোয়ার্টার্স') {
//                                            $filtered_name = str_replace('পুলিশ', '', $filtered_name);
//                                        }
//                                        $filtered_name = trim($filtered_name);
//                                        $unit_names[] = $filtered_name;
                                        $unit_names[] = $value['unit_name'];
                                    }
                                    $htm .= implode(' / ', $unit_names);
                                    $htm .= '</td>';
                                    $htm .= '</tr>';
                                } else {
                                    $htm .= '<tr>';
                                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['letter_name'] . '</td>';
                                    $htm .= '</tr>';
                                }
                            }
                        } else {
                            foreach ($recipient as $recipient_datum) {
                                $htm .= '<tr>';
                                $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $recipient_datum['letter_name'] . '</td>';
                                $htm .= '</tr>';
                            }
                        }
                    }
                } else {
                    foreach ($recipients as $recipient) {
                        $htm .= '<tr>';
                        $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $recipient['letter_name'] . '</td>';
                        $htm .= '</tr>';
                    }
                }
            }
            elseif ($field_type == 'letter_acknowledgement') {
                foreach ($elite_recipients as $elite_recipient) {
                    $htm .= '<tr>';
                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $elite_recipient['letter_name'] . '</td>';
                    $htm .= '</tr>';
                }
                $recipients = otherHelper::array_group_by('designation_id', $recipients);
                foreach ($recipients as $recipient) {
                    $recipient_group = otherHelper::array_group_by('recipient_group_no', $recipient);
                    $final_recipient = array();
                    $used_recipient_group_no = array();
                    $f = 0;
                    foreach ($recipient as $r) {
                        if ($r['recipient_group_no'] != null) {
                            if (count($recipient_group[$r['recipient_group_no']]) > 1) {
                                if (!in_array($r['recipient_group_no'], $used_recipient_group_no)) {
                                    $final_recipient[$f] = $recipient_group[$r['recipient_group_no']];
                                    $used_recipient_group_no[] = $r['recipient_group_no'];
                                }
                            } else {
                                $final_recipient[$f][0] = $r;
                            }
                        } else {
                            $final_recipient[$f][0] = $r;
                        }
                        $f++;
                    }
                    foreach ($final_recipient as $item) {
                        if (count($item) > 1) {
                            $htm .= '<tr>';
                            $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['designation'] . ', ';
                            $unit_names = array();
                            foreach ($item as $value) {
//                                        $filtered_name = str_replace('জেলা', '', $value['unit_name']);
//                                        if ($filtered_name != 'পুলিশ হেডকোয়ার্টার্স') {
//                                            $filtered_name = str_replace('পুলিশ', '', $filtered_name);
//                                        }
//                                        $filtered_name = trim($filtered_name);
//                                        $unit_names[] = $filtered_name;
                                $unit_names[] = $value['unit_name'];
                            }
                            $htm .= implode(' / ', $unit_names);
                            $htm .= '</td>';
                            $htm .= '</tr>';
                        } else {
                            $htm .= '<tr>';
                            $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $item[0]['letter_name'] . '</td>';
                            $htm .= '</tr>';
                        }
                    }

                }
            }
            else {
                foreach ($elite_recipients as $elite_recipient) {
                    $htm .= '<tr>';
                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $elite_recipient['letter_name'] . '</td>';
                    $htm .= '</tr>';
                }
                foreach ($recipients as $recipient) {
                    $htm .= '<tr>';
                    $htm .= '<td>' . otherHelper::en2bn(++$sl) . '। ' . $recipient['letter_name'] . '</td>';
                    $htm .= '</tr>';
                }
            }
            $htm .= '</table>';
        }
        $data['htm']=$htm;
        $data['elite_recipients']=$elite_recipients;
        $data['recipients']=$recipients;
        return response()->json($data);
    }

    public function allotment_letter_sent_mail(Request $request): \Illuminate\Http\JsonResponse
    {
        $letter_id= $request->input('letter_id');
        $mail_info= $request->input('mail_info');
        $mail_info=explode('][',$mail_info);
        //        $settings_data = Session::get('settings_data');
        $settings_data = Setting::find(1);
        $allotment_letter_mail_format=$settings_data->allotment_letter_mail_format;
        $content=$allotment_letter_mail_format;
        $content=str_replace('[[memo_date]]',$mail_info[2],$content);
        $content=str_replace('[[memo]]',$mail_info[3],$content);
        $content=str_replace('[[course_name]]',$mail_info[4],$content);
        $content=str_replace('[[fiscal_year]]',$mail_info[5],$content);
        $content=str_replace('[[code]]',$mail_info[6],$content);
        $content=str_replace('[[unit_name]]',$mail_info[7],$content);
        $content=str_replace('[[amount]]',$mail_info[8],$content);
        $param=urlencode(base64_encode('allotment_letter_'.$letter_id));
        $content.='<br> <br> <a href="'.route('public-letter',[$param]).'" target="_blank"><h3>ডিজিটাল পত্র দেখুন</h3></a>';
        if($settings_data->software_mode=='development'){
            $to_mail='phqtoukirahamed@gmail.com';
        }
        else{
            $to_mail=$mail_info[0];
        }
        $status= EmailController::send(array(
            'view_name' => 'emails.allotment_letter_mail',
            'view_data' => array('content'=>$content),
            'from_name' => $settings_data->from_mail_title,
            'to_mail' => $to_mail,
            'to_name' => $mail_info[1],
            'subject' => $mail_info[9],
            'related_model_type' => $mail_info[10],
            'related_model_id' => $mail_info[11],
            'mail_server' => "bdchessfed.com",
        ));
        if($status==1){
            $allotment_letter=Allotment_letter::find($letter_id);
            $allotment=Unit_allotment::find($mail_info[11]);
            $allotment_letter->mail_count=$allotment_letter->mail_count();
            $allotment_letter->save();
            $allotment->mail_count=$allotment->mail_count();
            $allotment->save();
        }
        return response()->json($status);
    }
    public function allotment_letter_sent_sms(Request $request): \Illuminate\Http\JsonResponse
    {
        $letter_id= $request->input('letter_id');
        $sms_info= $request->input('sms_info');
        $sms_info=explode('][',$sms_info);
//        $settings_data = Session::get('settings_data');
        $settings_data = Setting::find(1);
        $allotment_letter_sms_format=$settings_data->allotment_letter_sms_format;
        $content=$allotment_letter_sms_format;
        $content=str_replace('[[memo_date]]',$sms_info[2],$content);
        $content=str_replace('[[memo]]',$sms_info[3],$content);
        $content=str_replace('[[course_name]]',$sms_info[4],$content);
        $content=str_replace('[[fiscal_year]]',$sms_info[5],$content);
        $content=str_replace('[[code]]',$sms_info[6],$content);
        $content=str_replace('[[unit_name]]',$sms_info[7],$content);
        $content=str_replace('[[amount]]',$sms_info[8],$content);
        if($settings_data->software_mode=='development'){
            $number='01754479709';
        }
        else{
            $number=$sms_info[0];
        }
        $status= SMSController::send($number,$content,$sms_info[10],$sms_info[11]);
        if($status=='success'){
            $allotment_letter=Allotment_letter::find($letter_id);
            $allotment=Unit_allotment::find($sms_info[11]);
            $allotment_letter->sms_count=$allotment_letter->sms_count();
            $allotment_letter->save();
            $allotment->sms_count=$allotment->sms_count();
            $allotment->save();
        }
        return response()->json($status);
    }

    public function public_letter($param){
        $param=base64_decode(urldecode($param));
        $param=explode('_',$param);
        $content='';
        $letter=null;
        if($param[0]=='allotment' && (int)$param[2]>0){
            $allotment_letter=Allotment_letter::find((int)$param[2]);
            if(isset($allotment_letter)&&isset($allotment_letter->sub_header_memo_second_part) && $allotment_letter->sub_header_memo_second_part != ''
                && isset($allotment_letter->sub_header_memo_date) && $allotment_letter->sub_header_memo_date != ''){
                $letter=$allotment_letter;
            }
            else{
                $content.='<h1 class="text-center">কোন পত্র নেই।</h1>';
            }
        }
        else{
            $content.='<h1 class="text-center">কোন পত্র নেই।</h1>';
        }
        $data['content']=$content;
        $data['allotment_letter']=$letter;
        return view('reports.allotment_letter',$data);
    }

    public function get_memo_by_search_key(Request $request): \Illuminate\Http\JsonResponse
    {
        $term = $request->input('searchTerm');
        $selected = $request->input('selected');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');

        $q=Allotment_letter::whereNotNull('sub_header_memo_second_part')->where('sub_header_memo_second_part','!=','')->orderBy('sub_header_memo_second_part','ASC');
        if(isset($term) && $term!='') {
            $q = $q->where('sub_header_memo_second_part', 'Like',  $term . '%');
        }
        if(isset($term) && $term!='') {
            $q = $q->where(function ($q) use($term){
                return $q->$q->where('sub_header_memo_second_part', 'Like',  $term . '%')
                    ->orWhere('sub_header_memo_first_part', 'Like',  '%' . $term . '%');
            });
        }
        if(isset($selected) && is_array($selected) && count($selected)>0) {
            $q = $q->whereNotIn('id', $selected);
        }
        elseif (isset($selected) && !is_array($selected) && $selected>0){
            $q = $q->where('id','!=', $selected);
        }
        if(isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != ''){
            $q= $q->where('sub_header_memo_date','>=',$date_from_filter)->where('sub_header_memo_date','<=',$date_to_filter);
        }
        if(isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == '')){
            $q= $q->where('sub_header_memo_date','=',$date_from_filter);
        }
        if(isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == '')){
            $q= $q->where('sub_header_memo_date','=',$date_to_filter);
        }
        $allotment_letters=$q->get();

        return response()->json($allotment_letters);
    }
}
