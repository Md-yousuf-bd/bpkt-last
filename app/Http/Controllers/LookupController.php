<?php

namespace App\Http\Controllers;

use App\Http\PigeonHelpers\otherHelper;
use App\Models\Lookup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\LogController as Logs;
use Illuminate\Support\Facades\Auth;

class LookupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['page_name']="Lookup List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Settings','active'),
            array('Lookups','active')
        );
        return view('admin.lookups.index',$data);
    }

    public function get_index(Request $request)
    {
        $lookups=Lookup::query();

        return DataTables::eloquent($lookups)
            ->addIndexColumn()
            ->setRowId(function($lookup){
                return 'row_'.$lookup->id;
            })
            ->setRowData([
                'data-parent' => function($lookup) {
                    if(isset($lookup->parent)){
                        return $lookup->parent->name;
                    }
                    else{
                        return 'None';
                    }
                },
                'data-updated_by' => function($lookup) {
                    return $lookup->user->name;
                },
                'data-updated_at' => function($lookup) {
                    return otherHelper::change_date_format($lookup->updated_at,true,'d-M-Y h:i A');
                },
            ])
            ->addColumn('status',  function($lookup) {
                if($lookup->status==1){
                    return '<span class="badge badge-success">Active</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action',  function($lookup) {
                if(auth()->user()->can('edit-lookup')&&auth()->user()->can('delete-lookup')){
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white" href="'.route('settings.lookup.edit',[$lookup->id]).'" target="_blank" ><span class="fa fa-edit">  Edit</i></a></div>
                            <div style="float:left; width:50%; text-align:center;">
                                    <form action="'.route('settings.lookup.destroy',[$lookup->id]).'" method="post" class="">'.csrf_field().'<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger" value="Delete" onclick="return confirm(\'Do you really want to delete? \');"><span class="fa fa-trash"></span> Delete</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-lookup')){
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-primary text-white" href="'.route('settings.lookup.edit',[$lookup->id]).'" target="_blank" ><span class="fa fa-edit">  Edit</i></a></div>';
                }
                elseif (auth()->user()->can('delete-lookup')){
                    return '<div style="float:left; width:100%; text-align:center;">
                                    <form action="'.route('settings.lookup.destroy',[$lookup->id]).'" method="post" class="">'.csrf_field().'<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger" value="Delete" onclick="return confirm(\'Do you really want to delete? \');"><span class="fa fa-trash"></span> Delete</button></form>
                            </div>';
                }
                else{
                    return '<div style="width:100%; float: left;"></div>';
                }
            })
            ->rawColumns(['action','status'])
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
        $data['parents']=Lookup::where('parent_id','=',0)->orderBy('id','desc')->get();
        $data['page_name']="Add Lookup";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Settings','active'),
            array('Lookups','settings.lookup.index'),
            array('Add','active')
        );
        return view('admin.lookups.create',$data);
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
        $lookup_names=explode('=',$request->input('name'));
        foreach($lookup_names as $name){
            $lookup=new Lookup();
            $lookup->name=$name;
            $lookup->parent_id=$request->input('parent_id');
            $lookup->priority=$request->input('priority');
            $lookup->status=$request->input('status');
            $lookup->updated_by=Auth::user()->id;
            $lookup->description=$request->input('description');
            $lookup->save();
            Logs::store(Auth::user()->name.' has Added New Lookup '.$lookup->name,'Add Lookup','success',Auth::user()->id);
        }


        return redirect()->route('settings.lookup.index')->with('success','Lookup has been Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\Response
     */
    public function show(Lookup $lookup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($lookup)
    {
        //
        $data['parents']=Lookup::where('parent_id','=',0)->orderBy('id','desc')->get();
        $data['lookup']=Lookup::find($lookup);
        $data['page_name']="Edit Lookup";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Settings','active'),
            array('Lookups','settings.lookup.index'),
            array('Edit','active')
        );
        return view('admin.lookups.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lookup  $lookup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $lookup)
    {
        //

        $lookup=Lookup::find($lookup);

        $lookup->name=$request->input('name');
        $lookup->parent_id=$request->input('parent_id');
        $lookup->priority=$request->input('priority');
        $lookup->status=$request->input('status');
        $lookup->updated_by=Auth::user()->id;
        $lookup->description=$request->input('description');
        $lookup->save();
        Logs::store(Auth::user()->name.' has Edited Lookup '.$lookup->name,'Edit Lookup','info',Auth::user()->id);
        return redirect()->route('settings.lookup.edit',[$lookup])->with('success','Lookup has been Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lookup  $lookup
     * @return bool
     */
    public function check_lookup_used($lookup_id){
            return false;
    }

    public function destroy($id)
    {
        //
        if (!self::check_lookup_used($id)) {
            $lookup = Lookup::find($id);
            if ($lookup->parent_id != 0) {
                $children = Lookup::where('parent_id', $id)->get();
                foreach ($children as $child) {
                    $child->parent_id = 0;
                    $child->save();
                }

                $lookup->delete();

                Logs::store(Auth::user()->name . ' has Deleted Lookup ' . $lookup->name, 'Delete Lookup', 'danger', Auth::user()->id);

                return back()->with('success', 'Lookup has been Deleted Successfully!');
            } else {
                return back()->with('error', 'You can not delete a Parent Lookup!');
            }
        }
        else{
            return back()->with('error', 'This lookup is in used. So you cannot delete it!');
        }

    }


    public static function lookup_checkup($value,$parent_id){
        if(is_numeric($value) && $value>0){
            $children=Lookup::where('parent_id',$parent_id)->where('id',$value)->count();
            if($children>0){
                return $value;
            }
            else{
                $lookup= new Lookup();
                $lookup->name=$value;
                $lookup->parent_id=$parent_id;
                $lookup->priority=0;
                $lookup->status=1;
                $lookup->updated_by=Auth::user()->id;
                $lookup->description=$value;

                $lookup->save();

                Logs::store(Auth::user()->name.' has Added New Lookup '.$lookup->name,'Add Lookup','success',Auth::user()->id);
                return $lookup->id;
            }
        }
        else{
            $duplicate=Lookup::where('parent_id',$parent_id)->where('name',$value)->get()->toArray();
            if(count($duplicate)>0){
                return $duplicate[0]->id;
            }
            else {
                $lookup = new Lookup();
                $lookup->name = $value;
                $lookup->parent_id = $parent_id;
                $lookup->priority = 0;
                $lookup->status = 1;
                $lookup->updated_by = Auth::user()->id;
                $lookup->description = $value;

                $lookup->save();

                Logs::store(Auth::user()->name . ' has Added New Lookup ' . $lookup->name, 'Add Lookup', 'success', Auth::user()->id);
                return $lookup->id;
            }
        }
    }
}
