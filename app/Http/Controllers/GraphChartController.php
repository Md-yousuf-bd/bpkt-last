<?php

namespace App\Http\Controllers;

use App\Http\PigeonHelpers\otherHelper;
use App\Models\Code_allotment;
use App\Models\Code_surrender;
use App\Models\Unit_allotment;
use App\Models\Unit_surrender;
use Illuminate\Http\Request;

class GraphChartController extends Controller
{
    //
    public function get_chart(Request $request): \Illuminate\Http\JsonResponse
    {
        $input=$request->input();
        $chart_type=$input['chartType'];
        if($chart_type=='balance_pie_chart'){
            $data=self::balance_pie_chart($input);
        }
        elseif($chart_type=='unit_allotment_3d_donut_chart'){
            $data=self::unit_allotment_3d_donut_chart($input);
        }
        elseif($chart_type=='unit_allotment_bar_chart'){
            $data=self::unit_allotment_bar_chart($input);
        }
        else{
            $data=null;
        }
        return response()->json($data);
    }

    private function balance_pie_chart($input): array
    {
        $data=array();
        $current_fiscal_year=otherHelper::get_fiscal_year_by_date(date('Y-m-d'));
        $data['text']=otherHelper::en2bn($current_fiscal_year).' অর্থবছরে ব্যালেন্স এবং বরাদ্দ';
        $data['code_allotment_amount']=Code_allotment::where('status',1)->where('fiscal_year',$current_fiscal_year)->sum('amount');
        $data['code_surrender_amount']=Code_surrender::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->sum('amount');
        $data['unit_allotment_amount']=Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->sum('amount');
        $data['unit_surrender_amount']=Unit_surrender::where('status',1)->where('fiscal_year',$current_fiscal_year)->sum('amount');
        $data['actual_unit_allotment']=(double)$data['unit_allotment_amount']-(double)$data['unit_surrender_amount'];
        $data['actual_balance']=(double)$data['code_allotment_amount']-(double)$data['unit_allotment_amount']+(double)$data['unit_surrender_amount']-(double)$data['code_surrender_amount'];
        $data['in_total']=$data['actual_unit_allotment']+$data['actual_balance'];
        $data['actual_unit_allotment_percent']=($data['in_total']>0)?($data['actual_unit_allotment']*100)/$data['in_total']:0;
        $data['actual_balance_percent']=($data['in_total']>0)?($data['actual_balance']*100)/$data['in_total']:0;
        $data['actual_unit_allotment_tk']=otherHelper::en2bn(otherHelper::taka_format($data['actual_unit_allotment'])).' টাকা';
        $data['actual_balance_tk']=otherHelper::en2bn(otherHelper::taka_format($data['actual_balance'])).' টাকা';
        $data['actual_unit_allotment_text']='ইউনিটে বরাদ্দঃ '.otherHelper::en2bn(otherHelper::taka_format($data['actual_unit_allotment_percent'])).'%';
        $data['actual_balance_text']='ব্যালেন্সঃ '.otherHelper::en2bn(otherHelper::taka_format($data['actual_balance_percent'])).'%';

        return $data;
    }
    private function unit_allotment_3d_donut_chart($input): array
    {
        $data=array();
        $current_fiscal_year=otherHelper::get_fiscal_year_by_date(date('Y-m-d'));
        $data['text']=otherHelper::en2bn($current_fiscal_year).' অর্থবছরে মোট বরাদ্দ এবং সমর্পণ';
        $data['unit_allotment_amount']=Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->sum('amount');
        $data['unit_surrender_amount']=Unit_surrender::where('status',1)->where('fiscal_year',$current_fiscal_year)->sum('amount');
        $data['actual_unit_allotment']=(double)$data['unit_allotment_amount']-(double)$data['unit_surrender_amount'];
        $data['actual_unit_allotment_percent']=((double)$data['unit_allotment_amount']>0)?($data['actual_unit_allotment']*100)/(double)$data['unit_allotment_amount']:0;
        $data['unit_surrender_percent']=((double)$data['unit_allotment_amount']>0)?((double)$data['unit_surrender_amount']*100)/(double)$data['unit_allotment_amount']:0;
        $data['actual_unit_allotment_tk']=otherHelper::en2bn(otherHelper::taka_format($data['actual_unit_allotment'])).' টাকা';
        $data['unit_surrender_tk']=otherHelper::en2bn(otherHelper::taka_format((double)$data['unit_surrender_amount'])).' টাকা';
        $data['actual_unit_allotment_text']='ইউনিটে বরাদ্দঃ '.otherHelper::en2bn(otherHelper::taka_format($data['actual_unit_allotment_percent'])).'%';
        $data['unit_surrender_text']='ইউনিট থেকে সমর্পণঃ '.otherHelper::en2bn(otherHelper::taka_format($data['unit_surrender_percent'])).'%';

        return $data;
    }
    private function unit_allotment_bar_chart($input): array
    {
        $data=array();
        $current_fiscal_year=otherHelper::get_fiscal_year_by_date(date('Y-m-d'));
        $current_fiscal_year_arr=explode('-',$current_fiscal_year);
        $data['text']=otherHelper::en2bn($current_fiscal_year).' অর্থবছরে ইউনিটে মাসভিত্তিক বরাদ্দ';
        $data['unit_allotment_amount'][0]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[0].'-07-01')->where('memo_date','<=',$current_fiscal_year_arr[0].'-07-31')->sum('amount');
        $data['unit_allotment_amount'][1]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[0].'-08-01')->where('memo_date','<=',$current_fiscal_year_arr[0].'-08-31')->sum('amount');
        $data['unit_allotment_amount'][2]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[0].'-09-01')->where('memo_date','<=',$current_fiscal_year_arr[0].'-09-30')->sum('amount');
        $data['unit_allotment_amount'][3]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[0].'-10-01')->where('memo_date','<=',$current_fiscal_year_arr[0].'-10-31')->sum('amount');
        $data['unit_allotment_amount'][4]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[0].'-11-01')->where('memo_date','<=',$current_fiscal_year_arr[0].'-11-30')->sum('amount');
        $data['unit_allotment_amount'][5]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[0].'-12-01')->where('memo_date','<=',$current_fiscal_year_arr[0].'-12-31')->sum('amount');
        $data['unit_allotment_amount'][6]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[1].'-01-01')->where('memo_date','<=',$current_fiscal_year_arr[1].'-01-31')->sum('amount');
        $data['unit_allotment_amount'][7]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[1].'-02-01')->where('memo_date','<=',$current_fiscal_year_arr[1].'-02-29')->sum('amount');
        $data['unit_allotment_amount'][8]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[1].'-03-01')->where('memo_date','<=',$current_fiscal_year_arr[1].'-03-31')->sum('amount');
        $data['unit_allotment_amount'][9]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[1].'-04-01')->where('memo_date','<=',$current_fiscal_year_arr[1].'-04-30')->sum('amount');
        $data['unit_allotment_amount'][10]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[1].'-05-01')->where('memo_date','<=',$current_fiscal_year_arr[1].'-05-31')->sum('amount');
        $data['unit_allotment_amount'][11]=(double)Unit_allotment::where('status',1)->where('memo','!=','')->where('memo','!=',null)->where('fiscal_year',$current_fiscal_year)->where('memo_date','>=',$current_fiscal_year_arr[1].'-06-01')->where('memo_date','<=',$current_fiscal_year_arr[1].'-06-30')->sum('amount');
        return $data;
    }
}
