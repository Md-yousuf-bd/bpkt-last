<?php

namespace App\Http\Controllers;

use App\Http\PigeonHelpers\imageHelper;
use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models;
use App\Models\Code_allotment;
use App\Models\Code_surrender;
use App\Models\Unit_allotment;
use App\Models\Unit_surrender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['codes']=Code::all();
        $data['page_name']='Dashboard';
        $data['breadcumb']=array(
            array('Dashboard','active')
        );
        return view('admin.home',$data);
    }

    public function ckeditor_image_upload(Request $request){
        if($request->hasFile('upload')) {
            $picture = imageHelper::image_upload($request, 'upload', 'images/ckeditor', 'ck_'.rand(1,100000000000), true, false,'',true,700);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url= asset('storage/images/ckeditor/'.$picture);
            $msg="Image Uploaded Successfully.";
            $response="<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function get_total_amounts(Request $request){
        $code_id_filter=$request->input('code_id_filter');
        $fiscal_year_filter=$request->input('fiscal_year_filter');
        $code_allotments=Code_allotment::where('status',1);
        $unit_allotments=Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null);
        $unit_surrenders=Unit_surrender::where('status',1);
        $code_surrenders=Code_surrender::where('status',1)->where('memo','!=','')->where('memo','!=',null);
        if($code_id_filter!=null && $code_id_filter!='' && $code_id_filter>0){
            $code_allotments=$code_allotments->where('code_id',$code_id_filter);
            $unit_allotments=$unit_allotments->where('code_id',$code_id_filter);
            $unit_surrenders=$unit_surrenders->where('code_id',$code_id_filter);
            $code_surrenders=$code_surrenders->where('code_id',$code_id_filter);
        }

        if(isset($fiscal_year_filter) && is_array($fiscal_year_filter) && count($fiscal_year_filter)>0){
            $code_allotments=$code_allotments->whereIn('fiscal_year',$fiscal_year_filter);
            $unit_allotments=$unit_allotments->whereIn('fiscal_year',$fiscal_year_filter);
            $unit_surrenders=$unit_surrenders->whereIn('fiscal_year',$fiscal_year_filter);
            $code_surrenders=$code_surrenders->whereIn('fiscal_year',$fiscal_year_filter);
        }

        $div=100;

        $data['code_allotment_transactions']=otherHelper::en2bn($code_allotments->get()->count('id'));
        $data['code_allotment_amount']=$code_allotments->sum('amount')/$div;
        $data['unit_allotment_transactions']=otherHelper::en2bn($unit_allotments->get()->count('id'));
        $data['unit_allotment_amount']=$unit_allotments->sum('amount')/$div;
        $data['unit_surrender_transactions']=otherHelper::en2bn($unit_surrenders->get()->count('id'));
        $data['unit_surrender_amount']=$unit_surrenders->sum('amount')/$div;
        $data['code_surrender_transactions']=otherHelper::en2bn($code_surrenders->get()->count('id'));
        $data['code_surrender_amount']=$code_surrenders->sum('amount')/$div;
        $data['total_balance']=(double)$data['code_allotment_amount']-(double)$data['unit_allotment_amount']+(double)$data['unit_surrender_amount']-(double)$data['code_surrender_amount'];
        return response()->json($data);
    }

    public function show_transaction_list(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data['code_id_filter']=($request->input('code_id_filter')>0)?array($request->input('code_id_filter')):array();
        $data['fiscal_year_filter']=array($request->input('fiscal_year_filter'));
        $data['status_filter']=1;
        $type_filter=$request->input('type_filter');
        if($type_filter=='code_allotment'){
            return redirect()->route('code-allotment.index')->with('filter_selected_data',$data);
        }
        elseif($type_filter=='unit_allotment'){
            $data['memo_status_filter']="with memo";
            return redirect()->route('unit-allotment.index')->with('filter_selected_data',$data);
        }
        elseif($type_filter=='unit_surrender'){
            return redirect()->route('unit-surrender.index')->with('filter_selected_data',$data);
        }
        else{
            $data['memo_status_filter']="with memo";
            return redirect()->route('code-surrender.index')->with('filter_selected_data',$data);
        }
    }

    public function get_all_code_total_amounts(Request $request){
        $fiscal_year_filter=$request->input('fiscal_year_filter');
        $codes=Code::all();
        $data=array();
        $i=0;
        $div=100;
        foreach($codes as $code){
            $data[$i]['code_id']=$code->id;
            $data[$i]['code']=$code->code;
            $code_allotments=Code_allotment::where('status',1);
            $unit_allotments=Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null);
            $unit_surrenders=Unit_surrender::where('status',1);
            $code_surrenders=Code_surrender::where('status',1)->where('memo','!=','')->where('memo','!=',null);
            $code_allotments=$code_allotments->where('code_id',$code->id);
            $unit_allotments=$unit_allotments->where('code_id',$code->id);
            $unit_surrenders=$unit_surrenders->where('code_id',$code->id);
            $code_surrenders=$code_surrenders->where('code_id',$code->id);
            $code_allotments=$code_allotments->where('fiscal_year',$fiscal_year_filter);
            $unit_allotments=$unit_allotments->where('fiscal_year',$fiscal_year_filter);
            $unit_surrenders=$unit_surrenders->where('fiscal_year',$fiscal_year_filter);
            $code_surrenders=$code_surrenders->where('fiscal_year',$fiscal_year_filter);
            $data[$i]['code_allotment_amount']=$code_allotments->sum('amount')/$div;
            $data[$i]['unit_allotment_amount']=$unit_allotments->sum('amount')/$div;
            $data[$i]['unit_surrender_amount']=$unit_surrenders->sum('amount')/$div;
            $data[$i]['code_surrender_amount']=$code_surrenders->sum('amount')/$div;
            $data[$i]['total_balance']=(double)$data[$i]['code_allotment_amount']-(double)$data[$i]['unit_allotment_amount']+(double)$data[$i]['unit_surrender_amount']-(double)$data[$i]['code_surrender_amount'];
            $i++;
        }
        return response()->json($data);
    }

    public function replace_linked($table,$column,$replaceable,$replacing_with){
       $updates= DB::table($table)
            ->where($column, $replaceable)
            ->update([$column => $replacing_with]);
            dd($updates);
    }

}
