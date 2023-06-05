<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models\Code_allotment;
use App\Models\Code_surrender;
use App\Models\Unit_allotment;
use App\Models\Unit_surrender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['page_name']="Code List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Codes','active')
        );
        return view('admin.codes.index',$data);
    }

    public function get_index(Request $request){

        $codes = Code::leftJoin('users as updater_user', 'codes.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'codes.created_by', '=', 'creator_user.id')
            ->select([
                'codes.id as id',
                'codes.code as code',
                'codes.code_name as code_name',
                'codes.description as description',
                'creator_user.name as creator_user',
                'codes.created_at as created_at',
                'updater_user.name as updater_user',
                'codes.updated_at as updated_at',
            ])
            ->distinct();


        return DataTables::eloquent($codes)
            ->addIndexColumn()
            ->setRowId(function ($code) {
                return 'row_' . $code->id;
            })
            ->setRowData([
                'data-created_at' => function ($code) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($code) {
                    return otherHelper::en2bn(otherHelper::change_date_format($code->updated_at, true, 'd-M-Y H:i'));
                },

            ])
            ->addColumn('action', function ($code) {
                if (auth()->user()->can('edit-code') && auth()->user()->can('delete-code')) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('code.edit', [$code->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('code.destroy', [$code->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-code')) {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('code.edit', [$code->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-code')) {
                    return '
                        <div style="float:left; width:100%; text-align:center;">
                                <form action="' . route('code.destroy', [$code->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"></div>';
                }
            })
            ->addColumn('description_modified',  function($code) {
                return otherHelper::show_less_more($code->description);
            })
            ->rawColumns(['action','description_modified'])
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
        $data['page_name']="Add Code";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Codes','code.index'),
            array('Add','active')
        );
        return view('admin.codes.create',$data);
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
            'code_name' => ['required'],
            'code' => ['required','unique:codes'],
        ]);

        $code=new Code();
        $code->code=$request->input('code');
        $code->code_name=$request->input('code_name');
        $code->description=$request->input('description');
        $code->created_by=Auth::user()->id;
        $code->updated_by=Auth::user()->id;
        $code->save();

        Logs::store(Auth::user()->name . ' ' . $code->code_name . ' নামে ['.$code->code.'] কোড নং যুক্ত করেছেন।', 'Add Code', 'success', Auth::user()->id);

        if($request->submitButton=='fastSubmitForm'){
            return redirect()->route('code.create')->with('success', 'কোডের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        }
        else{
            return redirect()->route('code.index')->with('success', 'কোডের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Code $code)
    {
        //
        $data['code']=$code;
        $data['page_name']="Edit Code";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Codes','code.index'),
            array('Edit','active')
        );
        return view('admin.codes.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Code $code)
    {
        //

        $request->validate([
            'code_name' => ['required'],
            'code' => ['required','unique:codes,code,' . $code->id],
        ]);
        $code->code=$request->input('code');
        $code->code_name=$request->input('code_name');
        $code->description=$request->input('description');
        $code->updated_by=Auth::user()->id;
        $code->save();

        Logs::store(Auth::user()->name . ' ' . $code->code_name . ' নামে ['.$code->code.'] কোড নং পরিবর্তন করেছেন।', 'Edit Code', 'success', Auth::user()->id);

        return redirect()->back()->with('success', 'কোডের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Code $code)
    {
        //
        if(!self::check_code_used($code)){
            $deleted=$code;
            $code->delete();
            Logs::store(Auth::user()->name . ' ' . $deleted->code_name . ' নামে ['.$deleted->code.'] কোড নং ডিলিট করেছেন।', 'Delete Code', 'success', Auth::user()->id);
            return redirect()->back()->with('success', 'কোডের তথ্য সফলভাবে ডিলিট হয়েছে!');
        }
        else{
            return redirect()->back()->with('error', 'এই কোডে লেনদেনের রেকর্ড থাকায় কোডটি ডিলিট করা সম্ভব হচ্ছে না!');
        }
    }

    public function check_code_used(Code $code): bool
    {
        if(Code_allotment::where('code_id',$code->id)->count()>0){
            return true;
        }
        elseif(Code_surrender::where('code_id',$code->id)->count()>0){
            return true;
        }
        elseif (Unit_allotment::where('code_id',$code->id)->count()>0){
            return true;
        }
        elseif (Unit_surrender::where('code_id',$code->id)->count()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_unapproved_balance(Request $request){
        $code=Code::find($request->input('code_id'));
        $data['unapproved_balance']=$code->unapproved_balance();
        return response()->json($data);
    }
}
