<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models\Letter_allotment_transaction;
use App\Models\Unit_allotment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UnitAllotmentController extends Controller
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
        $data['page_name']="Unit Allotment List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Unit Allotments','active')
        );
        return view('admin.unit_allotments.index',$data);
    }

    public function get_index(Request $request){
        $code_id_filter = $request->input('code_id_filter');
        $unit_id_filter = $request->input('unit_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $status_filter = $request->input('status_filter');
        $memo_status_filter = $request->input('memo_status_filter');

        $unit_allotments = Unit_allotment::leftJoin('users as updater_user', 'unit_allotments.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'unit_allotments.created_by', '=', 'creator_user.id')
            ->leftJoin('users as approved_user', 'unit_allotments.approved_by', '=', 'approved_user.id')
            ->leftJoin('codes as code', 'unit_allotments.code_id', '=', 'code.id')
            ->leftJoin('units as unit', 'unit_allotments.unit_id', '=', 'unit.id')
            ->select([
                'unit_allotments.id as id',
                'unit_allotments.code_id as code_id',
                'code.code as code',
                'unit_allotments.unit_id as unit_id',
                'unit.name_bangla as unit_name_bangla',
                'unit_allotments.allocation_sector as allocation_sector',
                'unit_allotments.status as status',
                'unit_allotments.approved_by as approved_by',
                'unit_allotments.approved_at as approved_at',
                'unit_allotments.fiscal_year as fiscal_year',
                'unit_allotments.transaction_date as transaction_date',
                'unit_allotments.amount as amount',
                'unit_allotments.demand_amount as demand_amount',
                'unit_allotments.memo as memo',
                'unit_allotments.memo_date as memo_date',
                'unit_allotments.demand_memo as demand_memo',
                'unit_allotments.demand_memo_date as demand_memo_date',
                'unit_allotments.description as description',
                'unit_allotments.mail_count as mail_count',
                'unit_allotments.sms_count as sms_count',
                'approved_user.name as approved_user',
                'creator_user.name as creator_user',
                'unit_allotments.created_at as created_at',
                'updater_user.name as updater_user',
                'unit_allotments.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter)>0, function ($q) use($code_id_filter) {
                return $q->whereIn('unit_allotments.code_id',$code_id_filter);
            })
            ->when(isset($unit_id_filter) && count($unit_id_filter)>0, function ($q) use($unit_id_filter) {
                return $q->whereIn('unit_allotments.unit_id',$unit_id_filter);
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter)>0, function ($q) use($fiscal_year_filter) {
                return $q->whereIn('unit_allotments.fiscal_year',$fiscal_year_filter);
            })
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('unit_allotments.status',$status_filter);
            })
            ->when(isset($memo_status_filter) && $memo_status_filter!='', function ($q) use($memo_status_filter) {
               if($memo_status_filter=='with memo') {
                   return $q->where('unit_allotments.memo','!=','')->where('unit_allotments.memo','!=',null);
               }
               else{
                   return $q->where('unit_allotments.memo','');
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


        return DataTables::eloquent($unit_allotments)
            ->addIndexColumn()
            ->setRowId(function ($unit_allotment) {
                return 'row_' . $unit_allotment->id;
            })
            ->setRowData([
                'data-created_at' => function ($unit_allotment) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($unit_allotment) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->updated_at, true, 'd-M-Y H:i'));
                },
                'data-approved_at' => function ($unit_allotment) {
                    return (isset($unit_allotment->approved_at) && $unit_allotment->approved_at!='')?otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->approved_at, true, 'd-M-Y H:i')):'';
                },
                'data-transaction_date' => function ($unit_allotment) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->transaction_date, true, 'd-M-Y'));
                },
                'data-memo_date' => function ($unit_allotment) {
                    return (isset($unit_allotment->memo_date) && strlen($unit_allotment->memo_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->memo_date, true, 'd-M-Y')): '';
                },
                'data-demand_memo_date' => function ($unit_allotment) {
                    return (isset($unit_allotment->demand_memo_date) && strlen($unit_allotment->demand_memo_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->demand_memo_date, true, 'd-M-Y')): '';
                },
                'data-amount' => function ($unit_allotment) {
                    return otherHelper::en2bn(otherHelper::taka_format($unit_allotment->amount));
                },
                'data-demand_amount' => function ($unit_allotment) {
                    return otherHelper::en2bn(otherHelper::taka_format($unit_allotment->demand_amount));
                },
                'data-mail_count' => function ($unit_allotment) {
                    return otherHelper::en2bn($unit_allotment->mail_count);
                },
                'data-sms_count' => function ($unit_allotment) {
                    return otherHelper::en2bn($unit_allotment->sms_count);
                },
                'data-fiscal_year' => function ($unit_allotment) {
                    return otherHelper::en2bn($unit_allotment->fiscal_year);
                },
            ])
            ->addColumn('action', function ($unit_allotment) {
                if (auth()->user()->can('edit-unit-allotment') && auth()->user()->can('delete-unit-allotment') && $unit_allotment->status==0) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-allotment.edit', [$unit_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-allotment.destroy', [$unit_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-unit-allotment') && in_array($unit_allotment->status,array(0,1))) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-allotment.edit', [$unit_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-unit-allotment') && $unit_allotment->status==0) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-allotment.destroy', [$unit_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('status_modified',  function($unit_allotment) {
                if($unit_allotment->status==1){
                    if(auth()->user()->can('unapproved-unit-allotment') && strlen($unit_allotment->memo)==0) {
                        return '<a class="btn btn-sm btn-success text-light" title="অননুমোদিত করতে ক্লিক করুন।" onclick="unapproved(' . $unit_allotment->id . ')">অনুমোদিত</a>';
                    }
                    else{
                        return '<span class="badge badge-success text-light">অনুমোদিত</a>';
                    }
                }
                else
                {
                    if(auth()->user()->can('approved-unit-allotment') && strlen($unit_allotment->memo)==0) {
                        return '<a class="btn btn-sm btn-danger text-light" title="অনুমোদিত করতে ক্লিক করুন।" onclick="approved('.$unit_allotment->id.')"> অননুমোদিত</a>';
                    }
                    else{
                        return '<span class="badge badge-danger text-light">অননুমোদিত</a>';
                    }
                }
            })
            ->addColumn('description_modified',  function($unit_allotment) {
                return otherHelper::show_less_more($unit_allotment->description);
            })
            ->rawColumns(['action','status_modified','description_modified'])
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
        $data['page_name']="Add Unit Allotment";
        $data['codes']=Code::all();
        $data['breadcumb']=array(
            array('Home','home'),
            array('Unit Allotments','unit-allotment.index'),
            array('Add','active')
        );
        return view('admin.unit_allotments.create',$data);
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
        $request->validate([
            'unit_id' => ['required'],
            'amount' => ['required','numeric','min:1'],
            'transaction_date' => ['required'],
        ]);
        $unit_allotment=new Unit_allotment();
        $unit_allotment->code_id=$request->input('code_id');
        $unit_allotment->unit_id=$request->input('unit_id');
        $unit_allotment->allocation_sector=$request->input('allocation_sector');
        $unit_allotment->amount=$request->input('amount');
        $unit_allotment->demand_amount=$request->input('demand_amount');
        $unit_allotment->transaction_date=$request->input('transaction_date');
        $unit_allotment->demand_memo=$request->input('demand_memo');
        $unit_allotment->demand_memo_date=$request->input('demand_memo_date');
        $unit_allotment->fiscal_year=otherHelper::get_fiscal_year_by_date($unit_allotment->transaction_date);
        $unit_allotment->status=0;
        $unit_allotment->description=$request->input('description');
        $unit_allotment->approved_at=null;
        $unit_allotment->approved_by=null;
        $unit_allotment->created_by=Auth::user()->id;
        $unit_allotment->updated_by=Auth::user()->id;
        $unit_allotment->save();


        Logs::store(Auth::user()->name . ' '.$unit_allotment->unit->name_bangla.' তে '. otherHelper::en2bn($unit_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($unit_allotment->amount)).' টাকা বরাদ্দ যুক্ত করেন।', 'Add Unit Allotment', 'success', Auth::user()->id);

        if($request->submitButton=='fastSubmitForm'){
            return redirect()->route('unit-allotment.create')->with('success', 'ইউনিটে বরাদ্দের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        }
        else{
            return redirect()->route('unit-allotment.index')->with('success', 'ইউনিটে বরাদ্দের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit_allotment  $unit_allotment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Unit_allotment $unit_allotment)
    {
        //
        $data['page_name']="Show Unit Allotment";
        $data['unit_allotment']=$unit_allotment;
        $data['breadcumb']=array(
            array('Home','home'),
            array('Unit Allotments','unit-allotment.index'),
            array('Show','active')
        );
        return view('admin.unit_allotments.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit_allotment  $unit_allotment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Unit_allotment $unit_allotment)
    {
        //
        $data['page_name']="Edit Unit Allotment";
        $data['codes']=Code::all();
        $data['unit_allotment']=$unit_allotment;
        $data['breadcumb']=array(
            array('Home','home'),
            array('Unit Allotments','unit-allotment.index'),
            array('Edit','active')
        );
        return view('admin.unit_allotments.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit_allotment  $unit_allotment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Unit_allotment $unit_allotment)
    {
        //
        $request->validate([
            'unit_id' => ['required'],
            'amount' => ['required','numeric','min:1'],
            'transaction_date' => ['required'],
        ]);
        $unit_allotment->code_id=$request->input('code_id');
        $unit_allotment->unit_id=$request->input('unit_id');
        $unit_allotment->allocation_sector=$request->input('allocation_sector');
        if($unit_allotment->status==0) {
            $unit_allotment->amount = $request->input('amount');
        }
        $unit_allotment->demand_amount = $request->input('demand_amount');
        $unit_allotment->transaction_date=$request->input('transaction_date');
        $unit_allotment->demand_memo=$request->input('demand_memo');
        $unit_allotment->demand_memo_date=$request->input('demand_memo_date');
        $unit_allotment->fiscal_year=otherHelper::get_fiscal_year_by_date($unit_allotment->transaction_date);
        $unit_allotment->description=$request->input('description');
        $unit_allotment->updated_by=Auth::user()->id;
        $unit_allotment->save();

        Logs::store(Auth::user()->name . ' '.$unit_allotment->unit->name_bangla.' তে '. otherHelper::en2bn($unit_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($unit_allotment->amount)).' টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Unit Allotment', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'ইউনিটে বরাদ্দের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit_allotment  $unit_allotment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Unit_allotment $unit_allotment)
    {
        //
        Letter_allotment_transaction::where('allotment_id',$unit_allotment->id)->delete();
        $deleted=$unit_allotment;
        $unit_allotment->delete();
        Logs::store(Auth::user()->name . ' '.$deleted->unit->name_bangla.' তে '. otherHelper::en2bn($deleted->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($deleted->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($deleted->amount)).' টাকা বরাদ্দের তথ্য ডিলিট করেন।', 'Delete Unit Allotment', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'ইউনিটে বরাদ্দের তথ্য সফলভাবে ডিলিট হয়েছে!');
    }

    public function approved(Request $request)
    {
        //
        $unit_allotment=Unit_allotment::find($request->input('id'));
        $code=Code::find($unit_allotment->code_id);
        if($code->unapproved_balance()>=$unit_allotment->amount) {
            $unit_allotment->status = 1;
            $unit_allotment->approved_by = Auth::user()->id;
            $unit_allotment->approved_at = date('Y-m-d H:i:s');
            $unit_allotment->save();
            Logs::store(Auth::user()->name . ' ' . $unit_allotment->unit->name_bangla . ' তে ' . otherHelper::en2bn($unit_allotment->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_allotment->amount)) . ' টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Unit Allotment', 'success', Auth::user()->id);
            $data['approved_by'] = Auth::user()->name;
            $data['approved_at'] = otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->approved_at, true, 'd-M-Y H:i'));
            $data['memo_length'] = strlen($unit_allotment->memo);
            if (auth()->user()->can('edit-unit-allotment') && auth()->user()->can('delete-unit-allotment') && $unit_allotment->status == 0) {
                $data['action'] = '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-allotment.edit', [$unit_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-allotment.destroy', [$unit_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
            } elseif (auth()->user()->can('edit-unit-allotment') && in_array($unit_allotment->status, array(0, 1))) {
                $data['action'] = '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-allotment.edit', [$unit_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
            } elseif (auth()->user()->can('delete-unit-allotment') && $unit_allotment->status == 0) {
                $data['action'] = '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-allotment.destroy', [$unit_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
            } else {
                $data['action'] = '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
            }
            $data['message']="বরাদ্দটি অনুমোদিত হয়েছে।";
            return response()->json($data);
        }
        else{
            $data['message']="কোডে পর্যাপ্ত টাকা অনুনোমোদিত না থাকায়, বরাদ্দটি অনুমোদিত হয়নি।";
            return response()->json($data);
        }
    }

    public function unapproved(Request $request)
    {
        //
        $unit_allotment=Unit_allotment::find($request->input('id'));
        $unit_allotment->status=0;
        $unit_allotment->approved_by=null;
        $unit_allotment->approved_at=null;
        $unit_allotment->save();
        Logs::store(Auth::user()->name . ' '.$unit_allotment->unit->name_bangla.' তে '. otherHelper::en2bn($unit_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($unit_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($unit_allotment->amount)).' টাকা পরিমাণে বরাদ্দর তথ্য অননুমোদন করেন।', 'Unapproved Unit Allotment', 'success', Auth::user()->id);
        $data['approved_by']='';
        $data['approved_at']='';
        $data['memo_length']=strlen($unit_allotment->memo);
        if (auth()->user()->can('edit-unit-allotment') && auth()->user()->can('delete-unit-allotment') && $unit_allotment->status==0) {
            $data['action']=  '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-allotment.edit', [$unit_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-allotment.destroy', [$unit_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        elseif (auth()->user()->can('edit-unit-allotment') && in_array($unit_allotment->status,array(0,1))) {
            $data['action']=  '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-allotment.edit', [$unit_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
        }
        elseif (auth()->user()->can('delete-unit-allotment') && $unit_allotment->status==0) {
            $data['action']=  '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-allotment.destroy', [$unit_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        else {
            $data['action']=  '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-allotment.show', [$unit_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
        }
        return response()->json($data);
    }
}
