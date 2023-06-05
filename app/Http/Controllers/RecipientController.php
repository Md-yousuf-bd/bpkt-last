<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogController as Logs;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Lookup;
use App\Models\Recipient;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //
        $data['designations']=Lookup::where('parent_id',1)->where('status',1)->orderBy('priority','asc')->get();
        $data['page_name']="Recipient List";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Recipients','active')
        );
        return view('admin.recipients.index',$data);
    }

    public function get_index(Request $request){
        $designation_id_filter = $request->input('designation_id_filter');
        $status_filter = $request->input('status_filter');

        $recipients = Recipient::leftJoin('users as updater_user', 'recipients.updated_by', '=', 'updater_user.id')
            ->leftJoin('users as creator_user', 'recipients.created_by', '=', 'creator_user.id')
            ->leftJoin('lookups as designation', 'recipients.designation_id', '=', 'designation.id')
            ->select([
                'recipients.id as id',
                'recipients.name as name',
                'recipients.name_bangla as name_bangla',
                'recipients.letter_name as letter_name',
                'recipients.email as email',
                'recipients.mobile as mobile',
                'recipients.designation_id as designation_id',
                'designation.name as designation_name',
                'recipients.status as status',
                'recipients.priority as priority',
                'recipients.description as description',
                'creator_user.name as creator_user',
                'recipients.created_at as created_at',
                'updater_user.name as updater_user',
                'recipients.updated_at as updated_at',
            ])
            ->when(isset($designation_id_filter) && count($designation_id_filter)>0, function ($q) use($designation_id_filter) {
                return $q->whereIn('recipients.designation_id',$designation_id_filter);
            })
            ->when(isset($status_filter) && count($status_filter)>0, function ($q) use($status_filter) {
                return $q->whereIn('recipients.status',$status_filter);
            })
            ->distinct();


        return DataTables::eloquent($recipients)
            ->addIndexColumn()
            ->setRowId(function ($recipient) {
                return 'row_' . $recipient->id;
            })
            ->setRowData([
                'data-created_at' => function ($recipient) {
                    return otherHelper::en2bn(otherHelper::change_date_format($recipient->created_at, true, 'd-M-Y H:i'));
                },
                'data-updated_at' => function ($recipient) {
                    return otherHelper::en2bn(otherHelper::change_date_format($recipient->updated_at, true, 'd-M-Y H:i'));
                },

            ])
            ->addColumn('action', function ($recipient) {
                if (auth()->user()->can('edit-recipient') && auth()->user()->can('delete-recipient')) {
                    return '<div style="width:33%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('recipient.show', [$recipient->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:33%; float: left;"><a class="btn btn-xs btn-primary text-white no-print " href="' . route('recipient.edit', [$recipient->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a>
                            </div>
                            <div style="float:left; width:33%; text-align:center;">
                                <form action="' . route('recipient.destroy', [$recipient->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                elseif (auth()->user()->can('edit-recipient')) {
                    return '<div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('recipient.show', [$recipient->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                            <div style="width:50%; float: left;"><a class="btn btn-xs btn-primary text-white no-print" href="' . route('recipient.edit', [$recipient->id]) . '"  ><span class="fa fa-edit">  ' . Lang::get('commons/buttons.Edit') . '</i></a></div>';
                }
                elseif (auth()->user()->can('delete-recipient')) {
                    return '
                        <div style="width:50%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('recipient.show', [$recipient->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>
                        <div style="float:left; width:50%; text-align:center;">
                                <form action="' . route('recipient.destroy', [$recipient->id]) . '" method="post" class="">' . csrf_field() . '<input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger no-print" value="Delete" onclick="return confirm(\'আপনি কি সত্যিই এটি ডিলিট করতে চান? \');"><span class="fa fa-trash"></span> ' . Lang::get('commons/buttons.Delete') . '</button></form>
                            </div>';
                }
                else {
                    return '<div style="width:100%; float: left;"><a class="btn btn-xs btn-info text-white no-print " href="' . route('recipient.show', [$recipient->id]) . '"  ><span class="fa fa-info-circle">  ' . Lang::get('commons/buttons.Detail') . '</i></a>
                            </div>';
                }
            })
            ->addColumn('status_modified',  function($recipient) {
                if($recipient->status==1){
                    return '<span class="badge badge-success">সক্রিয়</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">নিষ্ক্রিয়</span>';
                }
            })
            ->addColumn('description_modified',  function($recipient) {
                return otherHelper::show_less_more($recipient->description);
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
        $data['page_name']="Add Recipient";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Recipients','recipient.index'),
            array('Add','active')
        );
        return view('admin.recipients.create',$data);
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
            'name' => ['required'],
            'name_bangla' => ['required'],
            'letter_name' => ['required'],
            'email' => ['nullable','email'],
            'mobile' => ['nullable','numeric','digits_between:0,11'],
        ]);
        $recipient=new Recipient();
        $recipient->name=$request->input('name');
        $recipient->name_bangla=$request->input('name_bangla');
        $recipient->letter_name=$request->input('letter_name');
        $recipient->email=$request->input('email');
        $recipient->mobile=$request->input('mobile');
        $recipient->designation_id=$request->input('designation_id');
        $recipient->priority=$request->input('priority');
        $recipient->status=$request->input('status');
        $recipient->description=$request->input('description');
        $recipient->created_by=Auth::user()->id;
        $recipient->updated_by=Auth::user()->id;
        $recipient->save();

        Logs::store(Auth::user()->name . ' ' . $recipient->letter_name . ' নামে প্রাপকের তথ্য যুক্ত করেছেন।', 'Add Recipient', 'success', Auth::user()->id);

        if($request->submitButton=='fastSubmitForm'){
            return redirect()->route('recipient.create')->with('success', 'প্রাপকের তথ্য সফলভাবে যুক্ত হয়েছে!')->withInput();
        }
        else{
            return redirect()->route('recipient.index')->with('success', 'প্রাপকের তথ্য সফলভাবে যুক্ত হয়েছে!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Recipient $recipient)
    {
        //
        $data['recipient']=$recipient;
        $data['page_name']="Show Recipient";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Recipients','recipient.index'),
            array('Show','active')
        );
        return view('admin.recipients.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Recipient $recipient)
    {
        //
        $data['designations']=Lookup::where('parent_id',1)->where('status',1)->orderBy('priority','asc')->get();
        $data['recipient']=$recipient;
        $data['page_name']="Edit Recipient";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Recipients','recipient.index'),
            array('Edit','active')
        );
        return view('admin.recipients.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Recipient $recipient)
    {
        //
        $request->validate([
            'name' => ['required'],
            'name_bangla' => ['required'],
            'letter_name' => ['required'],
            'email' => ['nullable','email'],
            'mobile' => ['nullable','numeric','digits_between:0,11'],
        ]);
        $recipient->name=$request->input('name');
        $recipient->name_bangla=$request->input('name_bangla');
        $recipient->letter_name=$request->input('letter_name');
        $recipient->email=$request->input('email');
        $recipient->mobile=$request->input('mobile');
        $recipient->designation_id=$request->input('designation_id');
        $recipient->priority=$request->input('priority');
        $recipient->status=$request->input('status');
        $recipient->description=$request->input('description');
        $recipient->updated_by=Auth::user()->id;
        $recipient->save();

        Logs::store(Auth::user()->name . ' ' . $recipient->letter_name . ' নামে প্রাপকের তথ্য পরিবর্তন করেছেন।', 'Edit Recipient', 'success', Auth::user()->id);

        return redirect()->back()->with('success', 'প্রাপকের তথ্য সফলভাবে পরিবর্তন হয়েছে!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipient  $recipient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Recipient $recipient)
    {
        //
        if(!self::check_recipient_used($recipient)){
            $deleted=$recipient;
            $recipient->delete();
            Logs::store(Auth::user()->name . ' ' . $deleted->letter_name . ' নামে প্রাপকের তথ্য ডিলিট করেছেন।', 'Delete Recipient', 'success', Auth::user()->id);
            return redirect()->back()->with('success', 'প্রাপকের তথ্য সফলভাবে ডিলিট হয়েছে!');
        }
        else{
            return redirect()->back()->with('error', 'এই প্রাপক কোন ইউনিটে লিংকড আছেন। তাই, ডিলিট করা সম্ভব হচ্ছে না!');
        }
    }

    public function check_recipient_used(Recipient $recipient): bool
    {
        if(Unit::where('unit_head_id',$recipient->id)->orWhere('for_attention_id',$recipient->id)->count()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function get_recipient_by_search_key(Request $request){
        $term = $request->input('searchTerm');
        $selected = $request->input('selected');

//        DB::enableQueryLog();
        $q=Recipient::where('status',1);
        if(isset($term) && $term!='') {
            $q = $q->where(function ($q) use($term){
                return $q->where('letter_name', 'Like',  '%'. $term . '%')
                    ->orWhere('name_bangla', 'Like',  '%'. $term . '%')
                    ->orWhere('name', 'Like',  '%'. $term . '%');
            });
        }
        if(isset($selected) && is_array($selected) && count($selected)>0) {
            $q = $q->whereNotIn('id', $selected);
        }
        $recipients=$q->orderBy('priority','ASC')->get();
//dd(DB::getQueryLog());
        return response()->json($recipients);
    }
}
