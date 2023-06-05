<?php

namespace App\Http\Controllers;

use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code;
use App\Models\Letter_allotment_transaction;
use App\Models\Lookup;
use App\Models\Master_allotment_letter;
use App\Models\Unit;
use App\Models\Unit_allotment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function allotment_report(){
        $data['codes']=Code::all();
        $data['page_name']="Allotment Report ";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Reports','active'),
            array('Allotment Report','active')
        );
        return view('admin.reports.allotment_report',$data);
    }
    public function allotment_report_new(){
        $data['codes']=Code::all();
        $data['page_name']="Allotment Report";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Reports','active'),
            array('Allotment Report','active')
        );
        return view('admin.reports.allotment_report_new',$data);
    }

    public function get_allotment_report(Request $request): \Illuminate\Http\JsonResponse
    {
        $fiscal_year_filter=$request->input('fiscal_year_filter');
        $unit_id_filter=$request->input('unit_id_filter');
        $code_id_filter=$request->input('code_id_filter');
        $date_from_filter=$request->input('date_from_filter');
        $date_to_filter=$request->input('date_to_filter');

        $allotments=Unit_allotment::where('status',1)->where('memo','!=','')
            ->whereNotNull('memo')->where('memo_date','!=','')->whereNotNull('memo_date');

        if(isset($fiscal_year_filter) && count($fiscal_year_filter)>0) {
            $allotments=$allotments->whereIn('fiscal_year',$fiscal_year_filter);
            $fiscal_year_filter = array_sort($fiscal_year_filter);
            $last = array_pop($fiscal_year_filter);
            $fiscal_year_filter_str = count($fiscal_year_filter) ? implode(", ", $fiscal_year_filter) . " এবং " . $last : $last;
            $data['fiscal_year_filter_str'] = otherHelper::en2bn($fiscal_year_filter_str);

        }
        else{
            $data['fiscal_year_filter_str']='সকল';
        }

        if(isset($unit_id_filter) && count($unit_id_filter)>0){
            $allotments=$allotments->whereIn('unit_id',$unit_id_filter);
            $units=Unit::select('name_bangla')->whereIn('id',$unit_id_filter)->orderBy('priority','asc')->get();
            $unit_name_array=otherHelper::split_array($units,'name_bangla');
            $last = array_pop($unit_name_array);
            $unit_name_filter_str = count($unit_name_array) ? implode(", ", $unit_name_array) . " এবং " . $last : $last;
            $data['unit_id_filter_str']=$unit_name_filter_str;
        }
        else{
            $data['unit_id_filter_str']='বিভিন্ন';
        }

        $code_totals=array();
        if(isset($code_id_filter) && count($code_id_filter)>0){
            $allotments=$allotments->whereIn('code_id',$code_id_filter);
            foreach ($code_id_filter as $code_id){
                $code_totals[$code_id.'c']=Unit_allotment::where('code_id',$code_id)->where('status',1)->where('memo','!=','')
                    ->whereNotNull('memo')->where('memo_date','!=','')->whereNotNull('memo_date')->sum('amount');
            }
            $codes=Code::select('code_name')->whereIn('id',$code_id_filter)->get();
            $code_name_array=otherHelper::split_array($codes,'code_name');
            $last = array_pop($code_name_array);
            $code_name_filter_str = count($code_name_array) ? implode(", ", $code_name_array) . " এবং " . $last : $last;
            $data['code_id_filter_str']=$code_name_filter_str;
        }
        else{
            foreach (Code::all() as $code){
                $code_id=$code->id;
                $code_totals[$code_id.'c']=Unit_allotment::where('code_id',$code_id)->where('status',1)->where('memo','!=','')
                    ->whereNotNull('memo')->where('memo_date','!=','')->whereNotNull('memo_date')->sum('amount');
            }
            $data['code_id_filter_str']='সকল';
        }

        $allotments=$allotments->when(isset($date_from_filter) && $date_from_filter!='' && isset($date_to_filter) && $date_to_filter!='', function ($q) use($date_from_filter,$date_to_filter){
            return $q->where('memo_date','>=',$date_from_filter)->where('memo_date','<=',$date_to_filter);
        })->when(isset($date_from_filter) && $date_from_filter!='' && (!isset($date_to_filter) || $date_to_filter==''),function ($q) use($date_from_filter){
            return $q->where('memo_date','>=',$date_from_filter);
        })->when(isset($date_to_filter) && $date_to_filter!='' && (!isset($date_from_filter) || $date_from_filter==''),function ($q) use($date_to_filter){
            return $q->where('memo_date','>=',$date_to_filter);
        });
        $date_from_filter_str=otherHelper::en2bn(otherHelper::change_date_format($date_from_filter,false));
        $date_to_filter_str=otherHelper::en2bn(otherHelper::change_date_format($date_to_filter,false));
        if(isset($date_from_filter) && $date_from_filter!='' && isset($date_to_filter) && $date_to_filter!=''){
            $data['date_filter_str']=$date_from_filter_str.' ইং তারিখ থেকে '.$date_to_filter_str.' ইং তারিখ পর্যন্ত';
        }
        elseif(isset($date_from_filter) && $date_from_filter!='' && (!isset($date_to_filter) || $date_to_filter=='')){
            $data['date_filter_str']=$date_from_filter_str.' ইং তারিখে';
        }
        elseif(isset($date_to_filter) && $date_to_filter!='' && (!isset($date_from_filter) || $date_from_filter=='')){
            $data['date_filter_str']=$date_to_filter_str.' ইং তারিখে';
        }
        else{
            $data['date_filter_str']='';
        }
        $allotments=$allotments->orderBy('memo_date','desc')->get();
        $data['allotments']=array();
        $a=0;
        $data['total_demand']=0;
        $data['total_allotment']=0;
        foreach ($allotments as $allotment){
            $data['allotments'][$a]['fiscal_year']=otherHelper::en2bn($allotment->fiscal_year);
            $data['allotments'][$a]['unit_name']=$allotment->unit->name_bangla;
            $data['allotments'][$a]['code']=$allotment->code->code_name;
            $data['allotments'][$a]['memo']=$allotment->memo;
            $data['allotments'][$a]['memo_date']=otherHelper::en2bn(otherHelper::change_date_format($allotment->memo_date,false,'d/m/Y'));
            $data['total_demand']+=$allotment->demand_amount;
            $data['allotments'][$a]['demand']=otherHelper::en2bn(otherHelper::taka_format($allotment->demand_amount));
            $data['total_allotment']+=$allotment->amount;
            $data['allotments'][$a]['allotment']=otherHelper::en2bn(otherHelper::taka_format($allotment->amount));
            $data['allotments'][$a]['code_total']=otherHelper::en2bn(otherHelper::taka_format($code_totals[$allotment->code_id.'c']));
            $a++;
        }
        $data['total_demand']=otherHelper::en2bn(otherHelper::taka_format($data['total_demand']));
        $data['total_allotment']=otherHelper::en2bn(otherHelper::taka_format($data['total_allotment']));
        return response()->json($data);
    }


    public function get_allotment_report_new(Request $request): \Illuminate\Http\JsonResponse
    {
        $fiscal_year_filter=$request->input('fiscal_year_filter');
        $unit_id_filter=$request->input('unit_id_filter');
        $code_id_filter=$request->input('code_id_filter');
        $date_from_filter=$request->input('date_from_filter');
        $date_to_filter=$request->input('date_to_filter');

        $allotments=Unit_allotment::where('status',1)->where('memo','!=','')
            ->whereNotNull('memo')->where('memo_date','!=','')->whereNotNull('memo_date');

        if(isset($fiscal_year_filter) && count($fiscal_year_filter)>0) {
            $allotments=$allotments->whereIn('fiscal_year',$fiscal_year_filter);
            $fiscal_year_filter = array_sort($fiscal_year_filter);
            $last = array_pop($fiscal_year_filter);
            $fiscal_year_filter_str = count($fiscal_year_filter) ? implode(", ", $fiscal_year_filter) . " এবং " . $last : $last;
            $data['fiscal_year_filter_str'] = otherHelper::en2bn($fiscal_year_filter_str);

        }
        else{
            $data['fiscal_year_filter_str']='সকল';
        }

        if(isset($unit_id_filter) && count($unit_id_filter)>0){
            $allotments=$allotments->whereIn('unit_id',$unit_id_filter);
            $units=Unit::select('name_bangla')->whereIn('id',$unit_id_filter)->orderBy('priority','asc')->get();
            $unit_name_array=otherHelper::split_array($units,'name_bangla');
            $last = array_pop($unit_name_array);
            $unit_name_filter_str = count($unit_name_array) ? implode(", ", $unit_name_array) . " এবং " . $last : $last;
            $data['unit_id_filter_str']=$unit_name_filter_str;
        }
        else{
            $data['unit_id_filter_str']='বিভিন্ন';
        }

        $code_totals=array();
        if(isset($code_id_filter) && count($code_id_filter)>0){
            $allotments=$allotments->whereIn('code_id',$code_id_filter);
            foreach ($code_id_filter as $code_id){
                $code_totals[$code_id.'c']=Unit_allotment::where('code_id',$code_id)->where('status',1)->where('memo','!=','')
                    ->whereNotNull('memo')->where('memo_date','!=','')->whereNotNull('memo_date')->sum('amount');
            }
            $codes=Code::select('code_name')->whereIn('id',$code_id_filter)->get();
            $code_name_array=otherHelper::split_array($codes,'code_name');
            $last = array_pop($code_name_array);
            $code_name_filter_str = count($code_name_array) ? implode(", ", $code_name_array) . " এবং " . $last : $last;
            $data['code_id_filter_str']=$code_name_filter_str;
        }
        else{
            foreach (Code::all() as $code){
                $code_id=$code->id;
                $code_totals[$code_id.'c']=Unit_allotment::where('code_id',$code_id)->where('status',1)->where('memo','!=','')
                    ->whereNotNull('memo')->where('memo_date','!=','')->whereNotNull('memo_date')->sum('amount');
            }
            $data['code_id_filter_str']='সকল';
        }

        $allotments=$allotments->when(isset($date_from_filter) && $date_from_filter!='' && isset($date_to_filter) && $date_to_filter!='', function ($q) use($date_from_filter,$date_to_filter){
            return $q->where('memo_date','>=',$date_from_filter)->where('memo_date','<=',$date_to_filter);
        })->when(isset($date_from_filter) && $date_from_filter!='' && (!isset($date_to_filter) || $date_to_filter==''),function ($q) use($date_from_filter){
            return $q->where('memo_date','>=',$date_from_filter);
        })->when(isset($date_to_filter) && $date_to_filter!='' && (!isset($date_from_filter) || $date_from_filter==''),function ($q) use($date_to_filter){
            return $q->where('memo_date','>=',$date_to_filter);
        });
        $date_from_filter_str=otherHelper::en2bn(otherHelper::change_date_format($date_from_filter,false));
        $date_to_filter_str=otherHelper::en2bn(otherHelper::change_date_format($date_to_filter,false));
        if(isset($date_from_filter) && $date_from_filter!='' && isset($date_to_filter) && $date_to_filter!=''){
            $data['date_filter_str']=$date_from_filter_str.' ইং তারিখ থেকে '.$date_to_filter_str.' ইং তারিখ পর্যন্ত';
        }
        elseif(isset($date_from_filter) && $date_from_filter!='' && (!isset($date_to_filter) || $date_to_filter=='')){
            $data['date_filter_str']=$date_from_filter_str.' ইং তারিখে';
        }
        elseif(isset($date_to_filter) && $date_to_filter!='' && (!isset($date_from_filter) || $date_from_filter=='')){
            $data['date_filter_str']=$date_to_filter_str.' ইং তারিখে';
        }
        else{
            $data['date_filter_str']='';
        }
        $allotments=$allotments->orderBy('memo_date','desc')->get();
        $data['allotments']=array();
        $a=0;
        $data['total_demand']=0;
        $data['total_allotment']=0;
        foreach ($allotments as $allotment){
            $data['allotments'][$a]['fiscal_year']=otherHelper::en2bn($allotment->fiscal_year);
            $data['allotments'][$a]['unit_name']=$allotment->unit->name_bangla;
            $data['allotments'][$a]['code']=$allotment->code->code_name;
            $data['allotments'][$a]['memo']=$allotment->memo;
            $data['allotments'][$a]['memo_date']=otherHelper::en2bn(otherHelper::change_date_format($allotment->memo_date,false,'d/m/Y'));
            $data['total_demand']+=$allotment->demand_amount;
            $data['allotments'][$a]['demand']=otherHelper::en2bn(otherHelper::taka_format($allotment->demand_amount));
            $data['total_allotment']+=$allotment->amount;
            $data['allotments'][$a]['allotment']=otherHelper::en2bn(otherHelper::taka_format($allotment->amount));
            $data['allotments'][$a]['code_total']=otherHelper::en2bn(otherHelper::taka_format($code_totals[$allotment->code_id.'c']));
            $a++;
        }
        $data['total_demand']=otherHelper::en2bn(otherHelper::taka_format($data['total_demand']));
        $data['total_allotment']=otherHelper::en2bn(otherHelper::taka_format($data['total_allotment']));
        return response()->json($data);
    }

    public function top_sheet(){
        $data['codes']=Code::all();
        $master_allotment_letter=Master_allotment_letter::find(1);
        $data['signature_info']=$master_allotment_letter->signature_info;
        $data['page_name']="Top Sheet";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Reports','active'),
            array('Top Sheet','active')
        );
        return view('admin.reports.top_sheet',$data);
    }
    public function top_sheet_new(){
        $data['codes']=Code::all();
        $master_allotment_letter=Master_allotment_letter::find(1);
        $data['signature_info']=$master_allotment_letter->signature_info;
        $data['page_name']="Top Sheet new";
        $data['breadcumb']=array(
            array('Home','home'),
            array('Reports ','active'),
            array('Top Sheet ','active')
        );
        return view('admin.reports.top_sheet_new',$data);
    }

    public function get_top_sheet(Request $request): \Illuminate\Http\JsonResponse
    {
        $unit_id_filter=$request->input('unit_id_filter');
        $code_id_filter=$request->input('code_id_filter');
        $date_from_filter=$request->input('date_from_filter');
        $date_to_filter=$request->input('date_to_filter');
        $memo_filter=$request->input('memo_filter');

        $data=array();
        $q=Letter_allotment_transaction::leftJoin('allotment_letters as letters','letter_allotment_transactions.letter_id','=','letters.id')
        ->leftJoin('unit_allotments as allotments','letter_allotment_transactions.allotment_id','=','allotments.id')
        ->leftJoin('units','allotments.unit_id','=','units.id')
        ->orderBy('allotments.memo_date','asc')->orderBy('allotments.memo','asc');

        if(isset($code_id_filter) && is_array($code_id_filter) && count($code_id_filter)>0) {
            $q = $q->whereIn('allotments.code_id', $code_id_filter);
        }
        if(isset($unit_id_filter) && is_array($unit_id_filter) && count($unit_id_filter)>0) {
            $q = $q->whereIn('allotments.unit_id', $unit_id_filter);
        }
        if(isset($memo_filter) && is_array($memo_filter) && count($memo_filter)>0) {
            $q = $q->whereIN('letter_allotment_transactions.letter_id',$memo_filter);
        }
        if(isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != ''){
            $q= $q->where('allotments.memo_date','>=',$date_from_filter)->where('allotments.memo_date','<=',$date_to_filter);
        }
        if(isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == '')){
            $q= $q->where('allotments.memo_date','=',$date_from_filter);
        }
        if(isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == '')){
            $q= $q->where('allotments.memo_date','=',$date_to_filter);
        }
        $allotments=$q->get()->toArray();


        $codes=otherHelper::split_array($allotments,'code_id');
        $codes_unique=array_unique($codes);
        $code_arr=array();
        $i=0;
        foreach ($codes_unique as $code_u){
            $code=Code::find($code_u);
            $code_arr[$i]['id']=$code['id'];
            $code_arr[$i]['code']=$code['code'];
            $i++;
        }
        $data['code_columns']=$code_arr;

        $letter_group = otherHelper::array_group_by('letter_id', $allotments);
        $data['final_data']=array();
        foreach ($letter_group as $item){
            $final_datum=array();
            $final_datum['memo']=$item[0]['sub_header_memo_second_part'];
            $final_datum['memo_date']=otherHelper::en2bn(otherHelper::change_date_format($item[0]['sub_header_memo_date'],false,'d/m/Y'));
            $unit_group= otherHelper::array_group_by('unit_id', $item);
            $final_datum['unit_data']=array();
            foreach ($unit_group as $value){
                $arr=array();
                $arr['unit_name']=$value[0]['name_bangla'] ?? '';
                $arr['office_id']=$value[0]['office_id'] ?? '';
                $arr['ddo_id']=$value[0]['ddo_id'] ?? '';
                foreach ($code_arr as $code){
                    $arr['code'.$code['id']]='-';
                }
                foreach ($value as $v){
                    $arr['code'.$v['code_id']]=otherHelper::en2bn(otherHelper::taka_format($v['amount'])).'/-';
                }
                $final_datum['unit_data'][]=$arr;
            }
            $final_datum['rowspan']=count($final_datum['unit_data']);
            $data['final_data'][]=$final_datum;
        }
        return response()->json($data);
    }
    public function get_top_sheet_new(Request $request): \Illuminate\Http\JsonResponse
    {
        $unit_id_filter=$request->input('unit_id_filter');
        $code_id_filter=$request->input('code_id_filter');
        $date_from_filter=$request->input('date_from_filter');
        $date_to_filter=$request->input('date_to_filter');
        $memo_filter=$request->input('memo_filter');

        $data=array();
        $q=Letter_allotment_transaction::leftJoin('allotment_letters as letters','letter_allotment_transactions.letter_id','=','letters.id')
        ->leftJoin('unit_allotments as allotments','letter_allotment_transactions.allotment_id','=','allotments.id')
        ->leftJoin('units','allotments.unit_id','=','units.id')
        ->orderBy('allotments.memo_date','asc')->orderBy('allotments.memo','asc');

        if(isset($code_id_filter) && is_array($code_id_filter) && count($code_id_filter)>0) {
            $q = $q->whereIn('allotments.code_id', $code_id_filter);
        }
        if(isset($unit_id_filter) && is_array($unit_id_filter) && count($unit_id_filter)>0) {
            $q = $q->whereIn('allotments.unit_id', $unit_id_filter);
        }
        if(isset($memo_filter) && is_array($memo_filter) && count($memo_filter)>0) {
            $q = $q->whereIN('letter_allotment_transactions.letter_id',$memo_filter);
        }
        if(isset($date_from_filter) && $date_from_filter != '' && isset($date_to_filter) && $date_to_filter != ''){
            $q= $q->where('allotments.memo_date','>=',$date_from_filter)->where('allotments.memo_date','<=',$date_to_filter);
        }
        if(isset($date_from_filter) && $date_from_filter != '' && (!isset($date_to_filter) || $date_to_filter == '')){
            $q= $q->where('allotments.memo_date','=',$date_from_filter);
        }
        if(isset($date_to_filter) && $date_to_filter != '' && (!isset($date_from_filter) || $date_from_filter == '')){
            $q= $q->where('allotments.memo_date','=',$date_to_filter);
        }
        $allotments=$q->get()->toArray();


        $codes=otherHelper::split_array($allotments,'code_id');
        $codes_unique=array_unique($codes);
        $code_arr=array();
        $i=0;
        foreach ($codes_unique as $code_u){
            $code=Code::find($code_u);
            $code_arr[$i]['id']=$code['id'];
            $code_arr[$i]['code']=$code['code'];
            $i++;
        }
        $data['code_columns']=$code_arr;

        $letter_group = otherHelper::array_group_by('letter_id', $allotments);
        $data['final_data']=array();
        foreach ($letter_group as $item){
            $final_datum=array();
            $final_datum['memo']=$item[0]['sub_header_memo_second_part'];
            $final_datum['memo_date']=otherHelper::en2bn(otherHelper::change_date_format($item[0]['sub_header_memo_date'],false,'d/m/Y'));
            $unit_group= otherHelper::array_group_by('unit_id', $item);
            $final_datum['unit_data']=array();
            foreach ($unit_group as $value){
                $arr=array();
                $arr['unit_name']=$value[0]['name_bangla'] ?? '';
                $arr['office_id']=$value[0]['office_id'] ?? '';
                $arr['ddo_id']=$value[0]['ddo_id'] ?? '';
                foreach ($code_arr as $code){
                    $arr['code'.$code['id']]='-';
                }
                foreach ($value as $v){
                    $arr['code'.$v['code_id']]=otherHelper::en2bn(otherHelper::taka_format($v['amount'])).'/-';
                }
                $final_datum['unit_data'][]=$arr;
            }
            $final_datum['rowspan']=count($final_datum['unit_data']);
            $data['final_data'][]=$final_datum;
        }
        return response()->json($data);
    }

}
