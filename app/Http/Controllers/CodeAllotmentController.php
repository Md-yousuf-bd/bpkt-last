<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models\Code_allotment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CodeAllotmentController extends Controller
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
        $data['page_name']="Code Allotment List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Allotments','active')
        );
        return view('admin.code_allotments.index',$data);
    }

    public function get_index(Request $request){
        $code_id_filter = $request->input('code_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $status_filter = $request->input('status_filter');

        $code_allotments = Code_allotment::leftJoin('users as updater_user', 'code_allotments.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'code_allotments.created_by', '=', 'creator_user.id')
            ->leftJoin('users as approved_user', 'code_allotments.approved_by', '=', 'approved_user.id')
            ->leftJoin('codes as code', 'code_allotments.code_id', '=', 'code.id')
            ->select([
                'code_allotments.id as id',
                'code_allotments.code_id as code_id',
                'code.code as code',
                'code_allotments.status as status',
                'code_allotments.approved_by as approved_by',
                'code_allotments.approved_at as approved_at',
                'code_allotments.fiscal_year as fiscal_year',
                'code_allotments.transaction_date as transaction_date',
                'code_allotments.amount as amount',
                'code_allotments.allotment_memo as allotment_memo',
                'code_allotments.allotment_memo_date as allotment_memo_date',
                'code_allotments.description as description',
                'approved_user.name as approved_user',
                'creator_user.name as creator_user',
                'code_allotments.created_at as created_at',
                'updater_user.name as updater_user',
                'code_allotments.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter)>0, function ($q) use($code_id_filter) {
                return $q->whereIn('code_allotments.code_id',$code_id_filter);
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter)>0, function ($q) use($fiscal_year_filter) {
                return $q->whereIn('code_allotments.fiscal_year',$fiscal_year_filter);
            })
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('code_allotments.status',$status_filter);
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


        return DataTables::eloquent($code_allotments)
            ->addIndexColumn()
            ->setRowId(function ($code_allotment) {
                return 'row_' . $code_allotment->id;
            })
            ->setRowData([
                'data-created_at' => function ($code_allotment) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code_allotment->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($code_allotment) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code_allotment->updated_at, true, 'd-M-Y H:i'));
                },
                'data-approved_at' => function ($code_allotment) {
                    return (isset($code_allotment->approved_at) && $code_allotment->approved_at!='')?otherHelper::en2bn(otherHelper::change_date_format($code_allotment->approved_at, true, 'd-M-Y H:i')):'';
                },
                'data-transaction_date' => function ($code_allotment) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code_allotment->transaction_date, true, 'd-M-Y'));
                },
                'data-allotment_memo_date' => function ($code_allotment) {
                    return (isset($code_allotment->allotment_memo_date) && strlen($code_allotment->allotment_memo_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($code_allotment->allotment_memo_date, true, 'd-M-Y')): '';
                },
                'data-amount' => function ($code_allotment) {
                    return otherHelper::en2bn(otherHelper::taka_format($code_allotment->amount));
                },
                'data-fiscal_year' => function ($code_allotment) {
                    return otherHelper::en2bn($code_allotment->fiscal_year);
                },
            ])
            ->addColumn('action', function ($code_allotment) {
                if (auth()->user()->can('edit-code-allotment') && auth()->user()->can('delete-code-allotment') && $code_allotment->status==0) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-allotment.edit', [$code_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-allotment.destroy', [$code_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-code-allotment') && in_array($code_allotment->status,array(0,1))) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-allotment.edit', [$code_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-code-allotment') && $code_allotment->status==0) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-allotment.destroy', [$code_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('status_modified',  function($code_allotment) {
                if($code_allotment->status==1){
                    if(auth()->user()->can('unapproved-code-allotment')) {
                        return '<a class="btn btn-sm btn-success text-light" title="অননুমোদিত করতে ক্লিক করুন।" onclick="unapproved(' . $code_allotment->id . ')">অনুমোদিত</a>';
                    }
                    else{
                        return '<span class="badge badge-success text-light">অনুমোদিত</a>';
                    }
                }
                else
                {
                    if(auth()->user()->can('approved-code-allotment')) {
                        return '<a class="btn btn-sm btn-danger text-light" title="অনুমোদিত করতে ক্লিক করুন।" onclick="approved('.$code_allotment->id.')"> অননুমোদিত</a>';
                    }
                    else{
                        return '<span class="badge badge-danger text-light">অননুমোদিত</a>';
                    }
                }
            })
            ->addColumn('description_modified',  function($code_allotment) {
                return otherHelper::show_less_more($code_allotment->description);
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
        $data['page_name']="Add Code Allotment";
        $data['codes']=Code::all();
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Allotments','code-allotment.index'),
            array('Add','active')
        );
        return view('admin.code_allotments.create',$data);
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
            'amount' => ['required','numeric','min:1'],
            'transaction_date' => ['required'],
        ]);
        $code_allotment=new Code_allotment();
        $code_allotment->code_id=$request->input('code_id');
        $code_allotment->amount=$request->input('amount');
        $code_allotment->transaction_date=$request->input('transaction_date');
        $code_allotment->allotment_memo=$request->input('allotment_memo');
        $code_allotment->allotment_memo_date=$request->input('allotment_memo_date');
        $code_allotment->fiscal_year=otherHelper::get_fiscal_year_by_date($code_allotment->transaction_date);
        $code_allotment->status=0;
        $code_allotment->description=$request->input('description');
        $code_allotment->approved_at=null;
        $code_allotment->approved_by=null;
        $code_allotment->created_by=Auth::user()->id;
        $code_allotment->updated_by=Auth::user()->id;
        $code_allotment->save();


        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_allotment->amount)).' টাকা বরাদ্দ যুক্ত করেন।', 'Add Code Allotment', 'success', Auth::user()->id);

        if($request->submitButton=='fastSubmitForm'){
            return redirect()->route('code-allotment.create')->with('success', 'কোডে বরাদ্দের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        }
        else{
            return redirect()->route('code-allotment.index')->with('success', 'কোডে বরাদ্দের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code_allotment  $code_allotment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Code_allotment $code_allotment)
    {
        //
        $data['page_name']="Show Code Allotment";
        $data['code_allotment']=$code_allotment;
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Allotments','code-allotment.index'),
            array('Show','active')
        );
        return view('admin.code_allotments.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code_allotment  $code_allotment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Code_allotment $code_allotment)
    {
        //
        $data['page_name']="Edit Code Allotment";
        $data['codes']=Code::all();
        $data['code_allotment']=$code_allotment;
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Allotments','code-allotment.index'),
            array('Edit','active')
        );
        return view('admin.code_allotments.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code_allotment  $code_allotment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Code_allotment $code_allotment)
    {
        //
        $request->validate([
            'amount' => ['required','numeric','min:1'],
            'transaction_date' => ['required'],
        ]);
        $code_allotment->code_id=$request->input('code_id');
        if($code_allotment->status==0) {
            $code_allotment->amount = $request->input('amount');
        }
        $code_allotment->transaction_date=$request->input('transaction_date');
        $code_allotment->allotment_memo=$request->input('allotment_memo');
        $code_allotment->allotment_memo_date=$request->input('allotment_memo_date');
        $code_allotment->fiscal_year=otherHelper::get_fiscal_year_by_date($code_allotment->transaction_date);
        $code_allotment->description=$request->input('description');
        $code_allotment->updated_by=Auth::user()->id;
        $code_allotment->save();

        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_allotment->amount)).' টাকা বরাদ্দ পরিবর্তন করেন।', 'Edit Code Allotment', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'কোডে বরাদ্দের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code_allotment  $code_allotment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Code_allotment $code_allotment)
    {
        //
        $deleted=$code_allotment;
        $code_allotment->delete();
        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($deleted->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($deleted->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($deleted->amount)).' টাকা বরাদ্দের তথ্য ডিলিট করেন।', 'Delete Code Allotment', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'কোডে বরাদ্দের তথ্য সফলভাবে ডিলিট হয়েছে!');
    }

    public function approved(Request $request)
    {
        //
        $code_allotment=Code_allotment::find($request->input('id'));
        $code_allotment->status=1;
        $code_allotment->approved_by=Auth::user()->id;
        $code_allotment->approved_at=date('Y-m-d H:i:s');
        $code_allotment->save();
        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_allotment->amount)).' টাকা পরিমাণে বরাদ্দর তথ্য অনুমোদন করেন।', 'Approve Code Allotment', 'success', Auth::user()->id);
        $data['approved_by']=Auth::user()->name;
        $data['approved_at']=otherHelper::en2bn(otherHelper::change_date_format($code_allotment->approved_at, true,'d-M-Y H:i'));
        if (auth()->user()->can('edit-code-allotment') && auth()->user()->can('delete-code-allotment') && $code_allotment->status==0) {
            $data['action']=  '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-allotment.edit', [$code_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-allotment.destroy', [$code_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        elseif (auth()->user()->can('edit-code-allotment') && in_array($code_allotment->status,array(0,1))) {
            $data['action']=  '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-allotment.edit', [$code_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
        }
        elseif (auth()->user()->can('delete-code-allotment') && $code_allotment->status==0) {
            $data['action']=  '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-allotment.destroy', [$code_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        else {
            $data['action']=  '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
        }
        return response()->json($data);
    }

    public function unapproved(Request $request)
    {
        //
        $code_allotment=Code_allotment::find($request->input('id'));
        $code_allotment->status=0;
        $code_allotment->approved_by=null;
        $code_allotment->approved_at=null;
        $code_allotment->save();
        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_allotment->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_allotment->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_allotment->amount)).' টাকা পরিমাণে বরাদ্দর তথ্য অননুমোদন করেন।', 'Unapproved Code Allotment', 'success', Auth::user()->id);
        $data['approved_by']='';
        $data['approved_at']='';
        if (auth()->user()->can('edit-code-allotment') && auth()->user()->can('delete-code-allotment') && $code_allotment->status==0) {
            $data['action']=  '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-allotment.edit', [$code_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-allotment.destroy', [$code_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        elseif (auth()->user()->can('edit-code-allotment') && in_array($code_allotment->status,array(0,1))) {
            $data['action']=  '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-allotment.edit', [$code_allotment->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
        }
        elseif (auth()->user()->can('delete-code-allotment') && $code_allotment->status==0) {
            $data['action']=  '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-allotment.destroy', [$code_allotment->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        else {
            $data['action']=  '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-allotment.show', [$code_allotment->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
        }
        return response()->json($data);
    }
}
