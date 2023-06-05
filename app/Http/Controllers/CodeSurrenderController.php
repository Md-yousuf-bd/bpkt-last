<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models\Code_surrender;
use App\Models\Letter_surrender_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CodeSurrenderController extends Controller
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
        $data['page_name']="Code Surrender List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Surrenders','active')
        );
        return view('admin.code_surrenders.index',$data);
    }

    public function get_index(Request $request){
        $code_id_filter = $request->input('code_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $status_filter = $request->input('status_filter');
        $memo_status_filter = $request->input('memo_status_filter');

        $code_surrenders = Code_surrender::leftJoin('users as updater_user', 'code_surrenders.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'code_surrenders.created_by', '=', 'creator_user.id')
            ->leftJoin('users as approved_user', 'code_surrenders.approved_by', '=', 'approved_user.id')
            ->leftJoin('codes as code', 'code_surrenders.code_id', '=', 'code.id')
            ->select([
                'code_surrenders.id as id',
                'code_surrenders.code_id as code_id',
                'code.code as code',
                'code_surrenders.status as status',
                'code_surrenders.approved_by as approved_by',
                'code_surrenders.approved_at as approved_at',
                'code_surrenders.fiscal_year as fiscal_year',
                'code_surrenders.transaction_date as transaction_date',
                'code_surrenders.amount as amount',
                'code_surrenders.memo as memo',
                'code_surrenders.memo_date as memo_date',
                'code_surrenders.description as description',
                'code_surrenders.mail_count as mail_count',
                'code_surrenders.sms_count as sms_count',
                'approved_user.name as approved_user',
                'creator_user.name as creator_user',
                'code_surrenders.created_at as created_at',
                'updater_user.name as updater_user',
                'code_surrenders.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter)>0, function ($q) use($code_id_filter) {
                return $q->whereIn('code_surrenders.code_id',$code_id_filter);
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter)>0, function ($q) use($fiscal_year_filter) {
                return $q->whereIn('code_surrenders.fiscal_year',$fiscal_year_filter);
            })
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('code_surrenders.status',$status_filter);
            })
            ->when(isset($memo_status_filter) && $memo_status_filter!='', function ($q) use($memo_status_filter) {
                if($memo_status_filter=='with memo') {
                    return $q->where('code_surrenders.memo','!=','')->where('code_surrenders.memo','!=',null);
                }
                else{
                    return $q->where('code_surrenders.memo','');
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


        return DataTables::eloquent($code_surrenders)
            ->addIndexColumn()
            ->setRowId(function ($code_surrender) {
                return 'row_' . $code_surrender->id;
            })
            ->setRowData([
                'data-created_at' => function ($code_surrender) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code_surrender->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($code_surrender) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code_surrender->updated_at, true, 'd-M-Y H:i'));
                },
                'data-approved_at' => function ($code_surrender) {
                    return (isset($code_surrender->approved_at) && $code_surrender->approved_at!='')?otherHelper::en2bn(otherHelper::change_date_format($code_surrender->approved_at, true, 'd-M-Y H:i')):'';
                },
                'data-transaction_date' => function ($code_surrender) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code_surrender->transaction_date, true, 'd-M-Y'));
                },
                'data-memo_date' => function ($code_surrender) {
                    return (isset($code_surrender->memo_date) && strlen($code_surrender->memo_date)>0)? otherHelper::en2bn(otherHelper::change_date_format($code_surrender->memo_date, true, 'd-M-Y')): '';
                },
                'data-amount' => function ($code_surrender) {
                    return otherHelper::en2bn(otherHelper::taka_format($code_surrender->amount));
                },
                'data-mail_count' => function ($code_surrender) {
                    return otherHelper::en2bn($code_surrender->mail_count);
                },
                'data-sms_count' => function ($code_surrender) {
                    return otherHelper::en2bn($code_surrender->sms_count);
                },
                'data-fiscal_year' => function ($code_surrender) {
                    return otherHelper::en2bn($code_surrender->fiscal_year);
                },
            ])
            ->addColumn('action', function ($code_surrender) {
                if (auth()->user()->can('edit-code-surrender') && auth()->user()->can('delete-code-surrender') && $code_surrender->status==0) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-surrender.edit', [$code_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-surrender.destroy', [$code_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-code-surrender') && in_array($code_surrender->status,array(0,1))) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-surrender.edit', [$code_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-code-surrender') && $code_surrender->status==0) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-surrender.destroy', [$code_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('status_modified',  function($code_surrender) {
                if($code_surrender->status==1){
                    if(auth()->user()->can('unapproved-code-surrender') && strlen($code_surrender->memo)==0) {
                        return '<a class="btn btn-sm btn-success text-light" title="অননুমোদিত করতে ক্লিক করুন।" onclick="unapproved(' . $code_surrender->id . ')">অনুমোদিত</a>';
                    }
                    else{
                        return '<span class="badge badge-success text-light">অনুমোদিত</a>';
                    }
                }
                else
                {
                    if(auth()->user()->can('approved-code-surrender') && strlen($code_surrender->memo)==0) {
                        return '<a class="btn btn-sm btn-danger text-light" title="অনুমোদিত করতে ক্লিক করুন।" onclick="approved('.$code_surrender->id.')"> অননুমোদিত</a>';
                    }
                    else{
                        return '<span class="badge badge-danger text-light">অননুমোদিত</a>';
                    }
                }
            })
            ->addColumn('description_modified',  function($code_surrender) {
                return otherHelper::show_less_more($code_surrender->description);
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
        $data['page_name']="Add Code Surrender";
        $data['codes']=Code::all();
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Surrenders','code-surrender.index'),
            array('Add','active')
        );
        return view('admin.code_surrenders.create',$data);
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
        $code_surrender=new Code_surrender();
        $code_surrender->code_id=$request->input('code_id');
        $code_surrender->amount=$request->input('amount');
        $code_surrender->transaction_date=$request->input('transaction_date');
        $code_surrender->fiscal_year=otherHelper::get_fiscal_year_by_date($code_surrender->transaction_date);
        $code_surrender->status=0;
        $code_surrender->description=$request->input('description');
        $code_surrender->approved_at=null;
        $code_surrender->approved_by=null;
        $code_surrender->created_by=Auth::user()->id;
        $code_surrender->updated_by=Auth::user()->id;
        $code_surrender->save();


        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_surrender->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_surrender->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_surrender->amount)).' টাকা সমর্পন যুক্ত করেন।', 'Add Code Surrender', 'success', Auth::user()->id);

        if($request->submitButton=='fastSubmitForm'){
            return redirect()->route('code-surrender.create')->with('success', 'কোডে সমর্পণের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        }
        else{
            return redirect()->route('code-surrender.index')->with('success', 'কোডে সমর্পণের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code_surrender  $code_surrender
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Code_surrender $code_surrender)
    {
        //
        $data['page_name']="Show Code Surrender";
        $data['code_surrender']=$code_surrender;
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Surrenders','code-surrender.index'),
            array('Show','active')
        );
        return view('admin.code_surrenders.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code_surrender  $code_surrender
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Code_surrender $code_surrender)
    {
        //
        $data['page_name']="Edit Code Surrender";
        $data['codes']=Code::all();
        $data['code_surrender']=$code_surrender;
        $data['breadcumb']=array(
            array('Home','home'),
            array('Code Surrenders','code-surrender.index'),
            array('Edit','active')
        );
        return view('admin.code_surrenders.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code_surrender  $code_surrender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Code_surrender $code_surrender)
    {
        //
        $request->validate([
            'amount' => ['required','numeric','min:1'],
            'transaction_date' => ['required'],
        ]);
        $code_surrender->code_id=$request->input('code_id');
        if($code_surrender->status==0) {
            $code_surrender->amount = $request->input('amount');
        }
        $code_surrender->transaction_date=$request->input('transaction_date');
        $code_surrender->fiscal_year=otherHelper::get_fiscal_year_by_date($code_surrender->transaction_date);
        $code_surrender->description=$request->input('description');
        $code_surrender->updated_by=Auth::user()->id;
        $code_surrender->save();

        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_surrender->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_surrender->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_surrender->amount)).' টাকা সমর্পন পরিবর্তন করেন।', 'Edit Code Surrender', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'কোডে সমর্পনের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code_surrender  $code_surrender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Code_surrender $code_surrender)
    {
        //
        Letter_surrender_transaction::where('surrender_id',$code_surrender->id)->delete();
        $deleted=$code_surrender;
        $code_surrender->delete();
        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($deleted->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($deleted->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($deleted->amount)).' টাকা সমর্পনের তথ্য ডিলিট করেন।', 'Delete Code Surrender', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'কোডে সমর্পণের তথ্য সফলভাবে ডিলিট হয়েছে!');
    }

    public function approved(Request $request)
    {
        //
        $code_surrender=Code_surrender::find($request->input('id'));
        $code=Code::find($code_surrender->code_id);
        if($code->unapproved_balance()>=$code_surrender->amount) {
            $code_surrender->status = 1;
            $code_surrender->approved_by = Auth::user()->id;
            $code_surrender->approved_at = date('Y-m-d H:i:s');
            $code_surrender->save();
            Logs::store(Auth::user()->name . ' ' . otherHelper::en2bn($code_surrender->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($code_surrender->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($code_surrender->amount)) . ' টাকা পরিমাণে সমর্পণের তথ্য অনুমোদন করেন।', 'Approve Code Surrender', 'success', Auth::user()->id);
            $data['approved_by'] = Auth::user()->name;
            $data['approved_at'] = otherHelper::en2bn(otherHelper::change_date_format($code_surrender->approved_at, true, 'd-M-Y H:i'));
            $data['memo_length'] = strlen($code_surrender->memo);
            if (auth()->user()->can('edit-code-surrender') && auth()->user()->can('delete-code-surrender') && $code_surrender->status == 0) {
                $data['action'] = '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-surrender.edit', [$code_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-surrender.destroy', [$code_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
            } elseif (auth()->user()->can('edit-code-surrender') && in_array($code_surrender->status, array(0, 1))) {
                $data['action'] = '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-surrender.edit', [$code_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
            } elseif (auth()->user()->can('delete-code-surrender') && $code_surrender->status == 0) {
                $data['action'] = '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-surrender.destroy', [$code_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
            } else {
                $data['action'] = '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
            }
            $data['message']="সমর্পণটি অনুমোদিত হয়েছে।";
            return response()->json($data);
        }
        else{
            $data['message']="কোডে পর্যাপ্ত টাকা অনুনোমোদিত না থাকায়, সমর্পণটি অনুমোদিত হয়নি।";
            return response()->json($data);
        }
    }

    public function unapproved(Request $request)
    {
        //
        $code_surrender=Code_surrender::find($request->input('id'));
        $code_surrender->status=0;
        $code_surrender->approved_by=null;
        $code_surrender->approved_at=null;
        $code_surrender->save();
        Logs::store(Auth::user()->name . ' '. otherHelper::en2bn($code_surrender->code->code) . ' কোডে '.otherHelper::en2bn(otherHelper::change_date_format($code_surrender->transaction_date)).' ইং তারিখে '.otherHelper::en2bn(otherHelper::taka_format($code_surrender->amount)).' টাকা পরিমাণে সমর্পণের তথ্য অননুমোদন করেন।', 'Unapproved Code Surrender', 'success', Auth::user()->id);
        $data['approved_by']='';
        $data['approved_at']='';
        $data['memo_length']=strlen($code_surrender->memo);
        if (auth()->user()->can('edit-code-surrender') && auth()->user()->can('delete-code-surrender') && $code_surrender->status==0) {
            $data['action']=  '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code-surrender.edit', [$code_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('code-surrender.destroy', [$code_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        elseif (auth()->user()->can('edit-code-surrender') && in_array($code_surrender->status,array(0,1))) {
            $data['action']=  '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code-surrender.edit', [$code_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
        }
        elseif (auth()->user()->can('delete-code-surrender') && $code_surrender->status==0) {
            $data['action']=  '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code-surrender.destroy', [$code_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        }
        else {
            $data['action']=  '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('code-surrender.show', [$code_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
        }
        return response()->json($data);
    }
}
