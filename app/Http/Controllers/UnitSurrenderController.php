<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Code;
use App\Models\unit_expense;
use Illuminate\Http\Request;
use App\Models\Unit_surrender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\PigeonHelpers\otherHelper;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\LogController as Logs;

class UnitSurrenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['filter_selected_data'] = Session::get('filter_selected_data');
        $data['codes'] = Code::all();
        $data['page_name'] = "Unit Surrender List";
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Surrenders', 'active')
        );
        return view('admin.unit_surrenders.index', $data);
    }

    public function get_index(Request $request)
    {
        $code_id_filter = $request->input('code_id_filter');
        $unit_id_filter = $request->input('unit_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');
        $status_filter = $request->input('status_filter');

        $unit_surrenders = Unit_surrender::leftJoin('users as updater_user', 'unit_surrenders.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'unit_surrenders.created_by', '=', 'creator_user.id')
            ->leftJoin('users as approved_user', 'unit_surrenders.approved_by', '=', 'approved_user.id')
            ->leftJoin('codes as code', 'unit_surrenders.code_id', '=', 'code.id')
            ->leftJoin('units as unit', 'unit_surrenders.unit_id', '=', 'unit.id')
            ->select([
                'unit_surrenders.id as id',
                'unit_surrenders.code_id as code_id',
                'code.code as code',
                'unit_surrenders.unit_id as unit_id',
                'unit.name_bangla as unit_name_bangla',
                'unit_surrenders.status as status',
                'unit_surrenders.approved_by as approved_by',
                'unit_surrenders.approved_at as approved_at',
                'unit_surrenders.fiscal_year as fiscal_year',
                'unit_surrenders.transaction_date as transaction_date',
                'unit_surrenders.amount as amount',
                'unit_surrenders.surrender_memo as surrender_memo',
                'unit_surrenders.surrender_memo_date as surrender_memo_date',
                'unit_surrenders.description as description',
                'approved_user.name as approved_user',
                'creator_user.name as creator_user',
                'unit_surrenders.created_at as created_at',
                'updater_user.name as updater_user',
                'unit_surrenders.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter) > 0, function ($q) use ($code_id_filter) {
                return $q->whereIn('unit_surrenders.code_id', $code_id_filter);
            })
            ->when(isset($unit_id_filter) && count($unit_id_filter) > 0, function ($q) use ($unit_id_filter) {
                return $q->whereIn('unit_surrenders.unit_id', $unit_id_filter);
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter) > 0, function ($q) use ($fiscal_year_filter) {
                return $q->whereIn('unit_surrenders.fiscal_year', $fiscal_year_filter);
            })
            ->when(isset($status_filter) && count($status_filter) > 0, function ($q) use ($status_filter) {
                return $q->whereIn('unit_surrenders.status', $status_filter);
            })
            ->when(strlen($date_type_filter) > 0 && isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != '', function ($q) use ($date_from_filter, $date_to_filter, $date_type_filter) {
                return $q->where($date_type_filter, '>=', $date_from_filter)->where($date_type_filter, '<=', $date_to_filter);
            })
            ->when(strlen($date_type_filter) > 0 && isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == ''), function ($q) use ($date_from_filter, $date_type_filter) {
                return $q->where($date_type_filter, '=', $date_from_filter);
            })
            ->when(strlen($date_type_filter) > 0 && isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == ''), function ($q) use ($date_to_filter, $date_type_filter) {
                return $q->where($date_type_filter, '=', $date_to_filter);
            })
            ->distinct();


        return DataTables::eloquent($unit_surrenders)
            ->addIndexColumn()
            ->setRowId(function ($unit_surrender) {
                return 'row_' . $unit_surrender->id;
            })
            ->setRowData([
                'data-created_at' => function ($unit_surrender) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($unit_surrender) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->updated_at, true, 'd-M-Y H:i'));
                },
                'data-approved_at' => function ($unit_surrender) {
                    return (isset($unit_surrender->approved_at) && $unit_surrender->approved_at != '') ? otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->approved_at, true, 'd-M-Y H:i')) : '';
                },
                'data-transaction_date' => function ($unit_surrender) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->transaction_date, true, 'd-M-Y'));
                },
                'data-surrender_memo_date' => function ($unit_surrender) {
                    return (isset($unit_surrender->surrender_memo_date) && strlen($unit_surrender->surrender_memo_date) > 0) ? otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->surrender_memo_date, true, 'd-M-Y')) : '';
                },
                'data-amount' => function ($unit_surrender) {
                    return otherHelper::en2bn(otherHelper::taka_format($unit_surrender->amount));
                },
                'data-fiscal_year' => function ($unit_surrender) {
                    return otherHelper::en2bn($unit_surrender->fiscal_year);
                },
            ])
            ->addColumn('action', function ($unit_surrender) {
                if (auth()->user()->can('edit-unit-surrender') && auth()->user()->can('delete-unit-surrender') && $unit_surrender->status == 0) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-surrender.edit', [$unit_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-surrender.destroy', [$unit_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                } elseif (auth()->user()->can('edit-unit-surrender') && in_array($unit_surrender->status, array(0, 1))) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-surrender.edit', [$unit_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                } elseif (auth()->user()->can('delete-unit-surrender') && $unit_surrender->status == 0) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-surrender.destroy', [$unit_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                } else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('status_modified',  function ($unit_surrender) {
                if ($unit_surrender->status == 1) {
                    if (auth()->user()->can('unapproved-unit-surrender')) {
                        return '<a class="btn btn-sm btn-success text-light" title="অননুমোদিত করতে ক্লিক করুন।" onclick="unapproved(' . $unit_surrender->id . ')">অনুমোদিত</a>';
                    } else {
                        return '<span class="badge badge-success text-light">অনুমোদিত</a>';
                    }
                } else {
                    if (auth()->user()->can('approved-unit-surrender')) {
                        return '<a class="btn btn-sm btn-danger text-light" title="অনুমোদিত করতে ক্লিক করুন।" onclick="approved(' . $unit_surrender->id . ')"> অননুমোদিত</a>';
                    } else {
                        return '<span class="badge badge-danger text-light">অননুমোদিত</a>';
                    }
                }
            })
            ->addColumn('description_modified',  function ($unit_surrender) {
                return otherHelper::show_less_more($unit_surrender->description);
            })
            ->rawColumns(['action', 'status_modified', 'description_modified'])
            ->toJson();
    }
    public function get_expense(Request $request)
    {
        $code_id_filter = $request->input('code_id_filter');
        $unit_id_filter = $request->input('unit_id_filter');
        $fiscal_year_filter = $request->input('fiscal_year_filter');
        $date_type_filter = $request->input('date_type_filter');
        $date_from_filter = $request->input('date_from_filter');
        $date_to_filter = $request->input('date_to_filter');

        $unit_expenses = unit_expense::leftJoin('users as updater_user', 'unit_expenses.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'unit_expenses.created_by', '=', 'creator_user.id')
            // ->leftJoin('users as approved_user', 'unit_expenses.approved_by', '=', 'approved_user.id')
            ->leftJoin('codes as code', 'unit_expenses.code_id', '=', 'code.id')
            ->leftJoin('units as unit', 'unit_expenses.unit_id', '=', 'unit.id')
            ->select([
                'unit_expenses.id as id',
                'unit_expenses.code_id as code_id',
                'code.code as code',
                'unit_expenses.unit_id as unit_id',
                'unit.name_bangla as unit_name_bangla',
                // 'unit_expenses.status as status',
                // 'unit_expenses.approved_by as approved_by',
                // 'unit_expenses.approved_at as approved_at',
                'unit_expenses.fiscal_year as fiscal_year',
                'unit_expenses.transaction_date as transaction_date',
                'unit_expenses.amount as amount',
                'unit_expenses.expense_memo as expense_memo',
                'unit_expenses.expense_memo_date as expense_memo_date',
                'unit_expenses.description as description',
                // 'approved_user.name as approved_user',
                'creator_user.name as creator_user',
                'unit_expenses.created_at as created_at',
                'updater_user.name as updater_user',
                'unit_expenses.updated_at as updated_at',
            ])
            ->when(isset($code_id_filter) && count($code_id_filter) > 0, function ($q) use ($code_id_filter) {
                return $q->whereIn('unit_expenses.code_id', $code_id_filter);
            })
            ->when(isset($unit_id_filter) && count($unit_id_filter) > 0, function ($q) use ($unit_id_filter) {
                return $q->whereIn('unit_expenses.unit_id', $unit_id_filter);
            })
            ->when(isset($fiscal_year_filter) && count($fiscal_year_filter) > 0, function ($q) use ($fiscal_year_filter) {
                return $q->whereIn('unit_expenses.fiscal_year', $fiscal_year_filter);
            })
            // ->when(isset($status_filter) && count($status_filter) > 0, function ($q) use ($status_filter) {
            //     return $q->whereIn('unit_expenses.status', $status_filter);
            // })
            ->when(strlen($date_type_filter) > 0 && isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != '', function ($q) use ($date_from_filter, $date_to_filter, $date_type_filter) {
                return $q->where($date_type_filter, '>=', $date_from_filter)->where($date_type_filter, '<=', $date_to_filter);
            })
            ->when(strlen($date_type_filter) > 0 && isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == ''), function ($q) use ($date_from_filter, $date_type_filter) {
                return $q->where($date_type_filter, '=', $date_from_filter);
            })
            ->when(strlen($date_type_filter) > 0 && isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == ''), function ($q) use ($date_to_filter, $date_type_filter) {
                return $q->where($date_type_filter, '=', $date_to_filter);
            })
            ->distinct();




        return DataTables::eloquent($unit_expenses)
            ->addIndexColumn()
            ->setRowId(function ($unit_expense) {
                return 'row_' . $unit_expense->id;
            })
            ->setRowData([
                'data-created_at' => function ($unit_expense) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_expense->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($unit_expense) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_expense->updated_at, true, 'd-M-Y H:i'));
                },
                // 'data-approved_at' => function ($unit_expense) {
                //     return (isset($unit_expense->approved_at) && $unit_expense->approved_at != '') ? otherHelper::en2bn(otherHelper::change_date_format($unit_expense->approved_at, true, 'd-M-Y H:i')) : '';
                // },
                'data-transaction_date' => function ($unit_expense) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit_expense->transaction_date, true, 'd-M-Y'));
                },
                'data-expense_memo_date' => function ($unit_expense) {
                    return (isset($unit_expense->expense_memo_date) && strlen($unit_expense->expense_memo_date) > 0) ? otherHelper::en2bn(otherHelper::change_date_format($unit_expense->expense_memo_date, true, 'd-M-Y')) : '';
                },
                'data-amount' => function ($unit_expense) {
                    return otherHelper::en2bn(otherHelper::taka_format($unit_expense->amount));
                },
                'data-fiscal_year' => function ($unit_expense) {
                    return otherHelper::en2bn($unit_expense->fiscal_year);
                },
            ])
            ->addColumn('action', function ($unit_expense) {
                // dd($unit_expense);
                if (auth()->user()->can('edit-unit-surrender') && auth()->user()->can('delete-unit-surrender')) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-expense.show_expense', [$unit_expense->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-expense.edit_expense', [$unit_expense->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-expense.delete', [$unit_expense->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
            })
            // ->addColumn('status_modified',  function ($unit_expense) {
            //     if ($unit_expense->status == 1) {
            //         if (auth()->user()->can('unapproved-unit-surrender')) {
            //             return '<a class="btn btn-sm btn-success text-light" title="অননুমোদিত করতে ক্লিক করুন।" onclick="unapproved(' . $unit_expense->id . ')">অনুমোদিত</a>';
            //         } else {
            //             return '<span class="badge badge-success text-light">অনুমোদিত</a>';
            //         }
            //     } else {
            //         if (auth()->user()->can('approved-unit-surrender')) {
            //             return '<a class="btn btn-sm btn-danger text-light" title="অনুমোদিত করতে ক্লিক করুন।" onclick="approved(' . $unit_expense->id . ')"> অননুমোদিত</a>';
            //         } else {
            //             return '<span class="badge badge-danger text-light">অননুমোদিত</a>';
            //         }
            //     }
            // })
            ->addColumn('description_modified',  function ($unit_expense) {
                return otherHelper::show_less_more($unit_expense->description);
            })
            ->rawColumns(['action', 'status_modified', 'description_modified'])
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
        $data['page_name'] = "Add Unit Surrender";
        $data['codes'] = Code::all();
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Surrenders', 'unit-surrender.index'),
            array('Add', 'active')
        );
        return view('admin.unit_surrenders.create', $data);
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
            'amount' => ['required', 'numeric', 'min:1'],
            'transaction_date' => ['required'],
        ]);
        $unit_surrender = new Unit_surrender();
        $unit_surrender->code_id = $request->input('code_id');
        $unit_surrender->unit_id = $request->input('unit_id');
        $unit_surrender->amount = $request->input('amount');
        $unit_surrender->transaction_date = $request->input('transaction_date');
        $unit_surrender->surrender_memo = $request->input('surrender_memo');
        $unit_surrender->surrender_memo_date = $request->input('surrender_memo_date');
        $unit_surrender->fiscal_year = otherHelper::get_fiscal_year_by_date($unit_surrender->transaction_date);
        $unit_surrender->status = 0;
        $unit_surrender->description = $request->input('description');
        $unit_surrender->approved_at = null;
        $unit_surrender->approved_by = null;
        $unit_surrender->created_by = Auth::user()->id;
        $unit_surrender->updated_by = Auth::user()->id;
        $unit_surrender->save();


        Logs::store(Auth::user()->name . ' ' . $unit_surrender->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($unit_surrender->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_surrender->amount)) . ' টাকা সমর্পণের তথ্য যুক্ত করেন।', 'Add Unit Surrender', 'success', Auth::user()->id);

        if ($request->submitButton == 'fastSubmitForm') {
            return redirect()->route('unit-surrender.create')->with('success', 'ইউনিট থেকে সমর্পণের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        } else {
            return redirect()->route('unit-surrender.index')->with('success', 'ইউনিট থেকে সমর্পণের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    public function create_unitExpense()
    {
        //
        $data['page_name'] = "Add Unit Expense";
        $data['codes'] = Code::all();
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Expense', 'unit-surrender.expense-list'),
            array('Add', 'active')
        );
        return view('admin.unit_surrenders.create_unitExpense', $data);
    }

    public function store_expense(Request $request)
    {
        //
        // dd($request);
        $request->validate([
            'unit_id' => ['required'],
            'amount' => ['required', 'numeric', 'min:1'],
            'transaction_date' => ['required'],
        ]);
        $unit_expense = new unit_expense();
        $unit_expense->code_id = $request->input('code_id');
        $unit_expense->unit_id = $request->input('unit_id');
        $unit_expense->amount = $request->input('amount');
        $unit_expense->transaction_date = $request->input('transaction_date');
        $unit_expense->expense_memo = $request->input('expense_memo');
        $unit_expense->expense_memo_date = $request->input('expense_memo_date');
        if ($request->input('expense_memo_date') == null) {
            $unit_expense->expense_month = Carbon::parse($request->input('expense_memo'))->format('Y-m');
        } else {
            $unit_expense->expense_month = Carbon::parse($request->input('expense_memo_date'))->format('Y-m');
        }
        // $unit_expense->expense_month = $request->input('expense_month');
        $unit_expense->fiscal_year = otherHelper::get_fiscal_year_by_date($unit_expense->transaction_date);
        $unit_expense->description = $request->input('description');
        // $unit_expense->approved_at = null;
        // $unit_expense->approved_by = null;
        $unit_expense->created_by = Auth::user()->id;
        $unit_expense->updated_by = Auth::user()->id;
        // dd($unit_expense);

        $unit_expense->save();


        Logs::store(Auth::user()->name . ' ' . $unit_expense->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($unit_expense->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_expense->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_expense->amount)) . ' টাকা সমর্পণের তথ্য যুক্ত করেন।', 'Add Unit Surrender', 'success', Auth::user()->id);

        if ($request->submitButton == 'fastSubmitForm') {
            return redirect()->route('unit-surrender.create-expense')->with('success', 'ইউনিট থেকে খরচের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        } else {
            return redirect()->route('unit-surrender.get_index')->with('success', 'ইউনিট থেকে খরচের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    public function expense_list()
    {
        //
        $data['filter_selected_data'] = Session::get('filter_selected_data');
        $data['codes'] = Code::all();
        $data['page_name'] = "Unit Expense List";
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Expense', 'active')
        );
        // dd($data);
        return view('admin.unit_surrenders.expense-list', $data);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit_surrender  $unit_surrender
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Unit_surrender $unit_surrender)
    {
        //
        $data['page_name'] = "Show Unit Surrender";
        $data['unit_surrender'] = $unit_surrender;
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Surrenders', 'unit-surrender.index'),
            array('Show', 'active')
        );
        return view('admin.unit_surrenders.show', $data);
    }
    public function show_expense(unit_expense $unit_expense)
    {
        //
        $data['page_name'] = "Show Unit Expense";
        $data['unit_expense'] = $unit_expense;
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Expense', 'unit-surrender.index'),
            array('Show', 'active')
        );
        return view('admin.unit_surrenders.show_expense', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit_surrender  $unit_surrender
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Unit_surrender $unit_surrender)
    {
        //
        $data['page_name'] = "Edit Unit Surrender";
        $data['codes'] = Code::all();
        $data['unit_surrender'] = $unit_surrender;
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Surrenders', 'unit-surrender.index'),
            array('Edit', 'active')
        );
        return view('admin.unit_surrenders.edit', $data);
    }
    public function edit_expense(unit_expense $unit_expense)
    {
        //

        $data['page_name'] = "Edit Unit Expense";
        $data['codes'] = Code::all();
        $data['unit_expense'] = $unit_expense;
        $data['breadcumb'] = array(
            array('Home', 'home'),
            array('Unit Expense', 'unit-surrender.index'),
            array('Edit', 'active')
        );
        return view('admin.unit_surrenders.edit_expense', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit_surrender  $unit_surrender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Unit_surrender $unit_surrender)
    {
        //
        $request->validate([
            'unit_id' => ['required'],
            'amount' => ['required', 'numeric', 'min:1'],
            'transaction_date' => ['required'],
        ]);
        $unit_surrender->code_id = $request->input('code_id');
        $unit_surrender->unit_id = $request->input('unit_id');
        if ($unit_surrender->status == 0) {
            $unit_surrender->amount = $request->input('amount');
        }
        $unit_surrender->transaction_date = $request->input('transaction_date');
        $unit_surrender->surrender_memo = $request->input('surrender_memo');
        $unit_surrender->surrender_memo_date = $request->input('surrender_memo_date');
        $unit_surrender->fiscal_year = otherHelper::get_fiscal_year_by_date($unit_surrender->transaction_date);
        $unit_surrender->description = $request->input('description');
        $unit_surrender->updated_by = Auth::user()->id;
        $unit_surrender->save();

        Logs::store(Auth::user()->name . ' ' . $unit_surrender->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($unit_surrender->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_surrender->amount)) . ' টাকা সমর্পণের তথ্য পরিবর্তন করেন।', 'Edit Unit Surrender', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'ইউনিট থেকে সমর্পণের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }
    public function update_expense(Request $request, unit_expense $unit_expense)
    {
        //
        $request->validate([
            'unit_id' => ['required'],
            'amount' => ['required', 'numeric', 'min:1'],
            'transaction_date' => ['required'],
        ]);
        $unit_expense->code_id = $request->input('code_id');
        $unit_expense->unit_id = $request->input('unit_id');
        // if ($unit_expense->status == 0) {
        // }
        $unit_expense->amount = $request->input('amount');
        $unit_expense->transaction_date = $request->input('transaction_date');
        $unit_expense->expense_memo = $request->input('surrender_memo');
        $unit_expense->expense_memo_date = $request->input('surrender_memo_date');
        $unit_expense->fiscal_year = otherHelper::get_fiscal_year_by_date($unit_expense->transaction_date);
        $unit_expense->description = $request->input('description');
        $unit_expense->updated_by = Auth::user()->id;
        $unit_expense->save();

        Logs::store(Auth::user()->name . ' ' . $unit_expense->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($unit_expense->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_expense->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_expense->amount)) . ' টাকা সমর্পণের তথ্য পরিবর্তন করেন।', 'Edit Unit Surrender', 'success', Auth::user()->id);
        // return redirect()->back()->with('success', 'ইউনিট থেকে খরচের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
        return redirect()->route('unit-surrender.expense-list')->with('success', 'ইউনিট থেকে খরচের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit_surrender  $unit_surrender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Unit_surrender $unit_surrender)
    {
        //
        $deleted = $unit_surrender;
        $unit_surrender->delete();
        Logs::store(Auth::user()->name . ' ' . $deleted->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($deleted->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($deleted->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($deleted->amount)) . ' টাকা সমর্পণের তথ্য ডিলিট করেন।', 'Delete Unit Surrender', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'ইউনিট থেকে সমর্পণের তথ্য সফলভাবে ডিলিট হয়েছে!');
    }

    public function delete(unit_expense $unit_expense)
    {
        //
        $deleted = $unit_expense;
        $unit_expense->delete();
        Logs::store(Auth::user()->name . ' ' . $deleted->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($deleted->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($deleted->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($deleted->amount)) . ' টাকা সমর্পণের তথ্য ডিলিট করেন।', 'Delete Unit Surrender', 'success', Auth::user()->id);
        return redirect()->back()->with('success', 'ইউনিট থেকে খরচের তথ্য সফলভাবে ডিলিট হয়েছে!');
    }





    public function approved(Request $request)
    {
        //
        $unit_surrender = Unit_surrender::find($request->input('id'));
        $unit_surrender->status = 1;
        $unit_surrender->approved_by = Auth::user()->id;
        $unit_surrender->approved_at = date('Y-m-d H:i:s');
        $unit_surrender->save();
        Logs::store(Auth::user()->name . ' ' . $unit_surrender->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($unit_surrender->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_surrender->amount)) . ' টাকা পরিমাণে সমর্পণের তথ্য অনুমোদন করেন।', 'Approve Unit Surrender', 'success', Auth::user()->id);
        $data['approved_by'] = Auth::user()->name;
        $data['approved_at'] = otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->approved_at, true, 'd-M-Y H:i'));
        if (auth()->user()->can('edit-unit-surrender') && auth()->user()->can('delete-unit-surrender') && $unit_surrender->status == 0) {
            $data['action'] =  '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-surrender.edit', [$unit_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-surrender.destroy', [$unit_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        } elseif (auth()->user()->can('edit-unit-surrender') && in_array($unit_surrender->status, array(0, 1))) {
            $data['action'] =  '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-surrender.edit', [$unit_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
        } elseif (auth()->user()->can('delete-unit-surrender') && $unit_surrender->status == 0) {
            $data['action'] =  '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-surrender.destroy', [$unit_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        } else {
            $data['action'] =  '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
        }
        return response()->json($data);
    }

    public function unapproved(Request $request)
    {
        //
        $unit_surrender = Unit_surrender::find($request->input('id'));
        $unit_surrender->status = 0;
        $unit_surrender->approved_by = null;
        $unit_surrender->approved_at = null;
        $unit_surrender->save();
        Logs::store(Auth::user()->name . ' ' . $unit_surrender->unit->name_bangla . ' থেকে ' . otherHelper::en2bn($unit_surrender->code->code) . ' কোডে ' . otherHelper::en2bn(otherHelper::change_date_format($unit_surrender->transaction_date)) . ' ইং তারিখে ' . otherHelper::en2bn(otherHelper::taka_format($unit_surrender->amount)) . ' টাকা সমর্পণের তথ্য অননুমোদন করেন।', 'Unapproved Unit Surrender', 'success', Auth::user()->id);
        $data['approved_by'] = '';
        $data['approved_at'] = '';
        if (auth()->user()->can('edit-unit-surrender') && auth()->user()->can('delete-unit-surrender') && $unit_surrender->status == 0) {
            $data['action'] =  '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit-surrender.edit', [$unit_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit-surrender.destroy', [$unit_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        } elseif (auth()->user()->can('edit-unit-surrender') && in_array($unit_surrender->status, array(0, 1))) {
            $data['action'] =  '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit-surrender.edit', [$unit_surrender->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
        } elseif (auth()->user()->can('delete-unit-surrender') && $unit_surrender->status == 0) {
            $data['action'] =  '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit-surrender.destroy', [$unit_surrender->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
        } else {
            $data['action'] =  '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit-surrender.show', [$unit_surrender->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
        }
        return response()->json($data);
    }
}
