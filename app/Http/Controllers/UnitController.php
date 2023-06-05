<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Allotment_letter;
use App\Models\Letter_allotment_transaction;
use App\Models\Letter_recipient;
use App\Models\Letter_surrender_transaction;
use App\Models\Lookup;
use App\Models\Recipient;
use App\Models\Surrender_letter;
use App\Models\Unit;
use App\Models\Unit_allotment;
use App\Models\Unit_surrender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
//        $replacements=array(
//            array(123,80),
//            array(134,84),
//            array(85,54),
//        );
//        foreach ($replacements as $replacement){
//            self::replace_unit($replacement[0],$replacement[1]);
//        }
        $data['range_metros']=Lookup::where('parent_id',8)->where('status',1)->orderBy('priority','asc')->get();
        $data['page_name']="Unit List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Units','active')
        );
        return view('admin.units.index',$data);
    }

    public function get_index(Request $request){
        $parent_unit_id_filter = $request->input('parent_unit_id_filter');
        $status_filter = $request->input('status_filter');

        $units = Unit::leftJoin('users as updater_user', 'units.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'units.created_by', '=', 'creator_user.id')
            ->leftJoin('lookups as parent_unit', 'units.parent_unit_id', '=', 'parent_unit.id')
            ->leftJoin('lookups as unit_head_designation', 'units.unit_head_designation_id', '=', 'unit_head_designation.id')
            ->leftJoin('lookups as for_attention_designation', 'units.for_attention_designation_id', '=', 'for_attention_designation.id')
            ->select([
                'units.id as id',
                'units.name as name',
                'units.name_bangla as name_bangla',
                'units.parent_unit_id as parent_unit_id',
                'parent_unit.name as parent_unit_name',
                'units.unit_head_name as unit_head_name',
                'units.unit_head_letter_name as unit_head_letter_name',
                'units.unit_head_email as unit_head_email',
                'units.unit_head_mobile as unit_head_mobile',
                'units.unit_head_designation_id as unit_head_designation_id',
                'unit_head_designation.name as unit_head_designation',
                'units.for_attention_name as for_attention_name',
                'units.for_attention_letter_name as for_attention_letter_name',
                'units.for_attention_email as for_attention_email',
                'units.for_attention_mobile as for_attention_mobile',
                'units.for_attention_designation_id as for_attention_designation_id',
                'for_attention_designation.name as for_attention_designation',
                'units.institution_code as institution_code',
                'units.office_id as office_id',
                'units.ddo_id as ddo_id',
                'units.status as status',
                'units.priority as priority',
                'units.description as description',
                'creator_user.name as creator_user',
                'units.created_at as created_at',
                'updater_user.name as updater_user',
                'units.updated_at as updated_at',
            ])
            ->when(isset($parent_unit_id_filter) && count($parent_unit_id_filter)>0, function ($q) use($parent_unit_id_filter) {
                return $q->whereIn('units.parent_unit_id',$parent_unit_id_filter);
            })
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('units.status',$status_filter);
            })
            ->distinct();


        return DataTables::eloquent($units)
            ->addIndexColumn()
            ->setRowId(function ($unit) {
                return 'row_' . $unit->id;
            })
            ->setRowData([
                'data-created_at' => function ($unit) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($unit) {
                    return otherHelper::en2bn(otherHelper::change_date_format($unit->updated_at, true, 'd-M-Y H:i'));
                },

            ])
            ->addColumn('action', function ($unit) {
                if (auth()->user()->can('edit-unit') && auth()->user()->can('delete-unit')) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit.show', [$unit->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('unit.edit', [$unit->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('unit.destroy', [$unit->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-unit')) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit.show', [$unit->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('unit.edit', [$unit->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-unit')) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit.show', [$unit->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('unit.destroy', [$unit->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('unit.show', [$unit->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('status_modified',  function($unit) {
                if($unit->status==1){
                    return '<span class="badge badge-success">সক্রিয়</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">নিষ্ক্রিয়</span>';
                }
            })
            ->addColumn('description_modified',  function($unit) {
                return otherHelper::show_less_more($unit->description);
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
        $data['designations']=Lookup::where('parent_id',1)->where('status',1)->orderBy('priority','asc')->get();
        $data['range_metros']=Lookup::where('parent_id',8)->where('status',1)->orderBy('priority','asc')->get();
        $data['page_name']="Add Unit";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Units','unit.index'),
            array('Add','active')
        );
        return view('admin.units.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        //
        $request->validate([
            'name' => ['required'],
            'name_bangla' => ['required'],
            'unit_head_name' => ['required'],
            'unit_head_letter_name' => ['required'],
            'unit_head_email' => ['nullable','email'],
            'unit_head_mobile' => ['nullable','numeric','digits_between:0,11'],
            'for_attention_email' => ['nullable','email'],
            'for_attention_mobile' => ['nullable','numeric','digits_between:0,11'],
        ]);
        $unit=new Unit();
        $unit->name=$request->input('name');
        $unit->name_bangla=$request->input('name_bangla');
        $unit->parent_unit_id=$request->input('parent_unit_id');
        $unit->institution_code=$request->input('institution_code');
        $unit->office_id=$request->input('office_id');
        $unit->ddo_id=$request->input('ddo_id');
        $unit->unit_head_name=$request->input('unit_head_name');
        $unit->unit_head_letter_name=$request->input('unit_head_letter_name');
        $unit->unit_head_email=$request->input('unit_head_email');
        $unit->unit_head_mobile=$request->input('unit_head_mobile');
        $unit->unit_head_designation_id=$request->input('unit_head_designation_id');
        $unit->for_attention_name=$request->input('for_attention_name');
        $unit->for_attention_letter_name=$request->input('for_attention_letter_name');
        $unit->for_attention_email=$request->input('for_attention_email');
        $unit->for_attention_mobile=$request->input('for_attention_mobile');
        $unit->for_attention_designation_id=$request->input('for_attention_designation_id');
        $unit->priority=$request->input('priority');
        $unit->status=$request->input('status');
        $unit->description=$request->input('description');
        $unit->created_by=Auth::user()->id;
        $unit->updated_by=Auth::user()->id;
        $unit->save();

        Logs::store(Auth::user()->name . ' ' . $unit->name_bangla . ' নামে ইউনিটের তথ্য যুক্ত করেছেন।', 'Add Unit', 'success', Auth::user()->id);

        if($request->submitButton=='fastSubmitForm'){
            return redirect()->route('unit.create')->with('success', 'ইউনিটের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        }
        else{
            return redirect()->route('unit.index')->with('success', 'ইউনিটের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Unit $unit)
    {
        //
        $data['unit']=$unit;
        $data['page_name']="Show Unit";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Units','unit.index'),
            array('Show','active')
        );
        return view('admin.units.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Unit $unit)
    {
        //
        $data['designations']=Lookup::where('parent_id',1)->where('status',1)->orderBy('priority','asc')->get();
        $data['range_metros']=Lookup::where('parent_id',8)->where('status',1)->orderBy('priority','asc')->get();
        $data['unit']=$unit;
        $data['page_name']="Edit Unit";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Units','unit.index'),
            array('Edit','active')
        );
        return view('admin.units.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Unit $unit)
    {
        //
        $request->validate([
            'name' => ['required'],
            'name_bangla' => ['required'],
            'unit_head_name' => ['required'],
            'unit_head_letter_name' => ['required'],
            'unit_head_email' => ['nullable','email'],
            'unit_head_mobile' => ['nullable','numeric','digits_between:0,11'],
            'for_attention_email' => ['nullable','email'],
            'for_attention_mobile' => ['nullable','numeric','digits_between:0,11'],
        ]);
        $unit->name=$request->input('name');
        $unit->name_bangla=$request->input('name_bangla');
        $unit->parent_unit_id=$request->input('parent_unit_id');
        $unit->institution_code=$request->input('institution_code');
        $unit->office_id=$request->input('office_id');
        $unit->ddo_id=$request->input('ddo_id');
        $unit->unit_head_name=$request->input('unit_head_name');
        $unit->unit_head_letter_name=$request->input('unit_head_letter_name');
        $unit->unit_head_email=$request->input('unit_head_email');
        $unit->unit_head_mobile=$request->input('unit_head_mobile');
        $unit->unit_head_designation_id=$request->input('unit_head_designation_id');
        $unit->for_attention_name=$request->input('for_attention_name');
        $unit->for_attention_letter_name=$request->input('for_attention_letter_name');
        $unit->for_attention_email=$request->input('for_attention_email');
        $unit->for_attention_mobile=$request->input('for_attention_mobile');
        $unit->for_attention_designation_id=$request->input('for_attention_designation_id');
        $unit->priority=$request->input('priority');
        $unit->status=$request->input('status');
        $unit->description=$request->input('description');
        $unit->updated_by=Auth::user()->id;
        $unit->save();

        Logs::store(Auth::user()->name . ' ' . $unit->name_bangla . ' নামে ইউনিটের তথ্য পরিবর্তন করেছেন।', 'Edit Unit', 'success', Auth::user()->id);

        return redirect()->back()->with('success', 'ইউনিটের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Unit $unit)
    {
        //
        if(!self::check_unit_used($unit)){
            $deleted=$unit;
            $unit->delete();
            Logs::store(Auth::user()->name . ' ' . $deleted->name_bangla . ' নামে ইউনিটের তথ্য ডিলিট করেছেন।', 'Delete Unit', 'success', Auth::user()->id);
            return redirect()->back()->with('success', 'ইউনিটের তথ্য সফলভাবে ডিলিট হয়েছে!');
        }
        else{
            return redirect()->back()->with('error', 'এই ইউনিটে কোন লেনদেনের রেকর্ড আছে। তাই, ডিলিট করা সম্ভব হচ্ছে না!');
        }
    }

    public function check_unit_used(Unit $unit): bool
    {
        if(Unit_allotment::where('unit_id',$unit->id)->count()>0){
            return true;
        }
        elseif(Unit_surrender::where('unit_id',$unit->id)->count()>0){
            return true;
        }
        elseif(Letter_Recipient::where('unit_id',$unit->id)->count()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_unit_by_search_key(Request $request): \Illuminate\Http\JsonResponse
    {
        $term = $request->input('searchTerm');
        $selected = $request->input('selected');

        $q=Unit::where('status',1);
        if(isset($term) && $term!='') {
            $q = $q->where(function ($q) use($term){
                return $q->where('name_bangla', 'Like',  '%'. $term . '%')
                    ->orWhere('name', 'Like',  '%'. $term . '%');
            });
        }
        if(isset($selected) && is_array($selected) && count($selected)>0) {
            $q = $q->whereNotIn('id', $selected);
        }
        elseif (isset($selected) && !is_array($selected) && $selected>0){
            $q = $q->where('id','!=', $selected);
        }
        $units=$q->orderBy('priority','ASC')->get();

        return response()->json($units);
    }

    public function replace_unit($replaceable_id,$replaced_by_id)
    {
        $letter_recipients=Letter_Recipient::where('unit_id',$replaceable_id)->where('field_type','letter_to')->get();
        DB::table('unit_allotments')
            ->where('unit_id', $replaceable_id)
            ->update(['unit_id' => $replaced_by_id]);
        DB::table('unit_surrenders')
            ->where('unit_id', $replaceable_id)
            ->update(['unit_id' => $replaced_by_id]);
        DB::table('letter_recipients')
            ->where('unit_id', $replaceable_id)
            ->update(['unit_id' => $replaced_by_id]);
        foreach ($letter_recipients as $letter_recipient){
            if($letter_recipient->letter_model=='allotment_letter'){
                $letter=Allotment_letter::find($letter_recipient->letter_id);
                $letter_allotment_transactions=Letter_allotment_transaction::where('letter_id',$letter->id)->get();
                $unit_arr=array();
                foreach ($letter_allotment_transactions as $letter_allotment_transaction){
                    $unit_arr[]=$letter_allotment_transaction->allotment->unit_id;
                }
                $letter->unit_ids= '|'.implode('| |',$unit_arr).'|';
                $letter->save();
            }
            else{
                $letter=Surrender_letter::find($letter_recipient->letter_id);
                $letter_surrender_transactions=Letter_surrender_transaction::where('letter_id',$letter->id)->get();
                $unit_arr=array();
                foreach ($letter_surrender_transactions as $letter_surrender_transaction){
                    $unit_arr[]=$letter_surrender_transaction->surrender->unit_id;
                }
                $letter->unit_ids= '|'.implode('| |',$unit_arr).'|';
                $letter->save();
            }
        }
        $delete_unit=Unit::find($replaceable_id);
        if(isset($delete_unit)) {
            $delete_unit->delete();
            Logs::store(Auth::user()->name . ' ' . $delete_unit->name_bangla . ' নামে ইউনিটের তথ্য ডিলিট করেছেন।', 'Delete Unit', 'success', Auth::user()->id);
        }
    }
}
