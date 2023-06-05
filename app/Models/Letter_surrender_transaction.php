<?php

namespace App\Models;

use App\Http\PigeonHelpers\otherHelper;
use Illuminate\Database\Eloquent\Model;

class Letter_surrender_transaction extends Model
{
    //

    public $timestamps=false;

    public function letter(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Surrender_letter::class,'id','letter_id');
    }

    public function surrender(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Code_surrender::class,'id','surrender_id');
    }

//    public function mail_info($to_person_type='Unit Head'): string
//    {
//        $surrender_letter=$this->letter;
//        $surrender=$this->allotment;
//        $mail_arr=array();
//        if($to_person_type=='For Attention'){
//            $mail_arr['to_mail']='';
//            $mail_arr['to_name']='';
//            if(isset($surrender->unit->for_attention_email) && $surrender->unit->for_attention_email!=''){
//                $mail_arr['to_mail']=$surrender->unit->for_attention_email;
//                $mail_arr['to_name']=$surrender->unit->for_attention_name;
//            }
//        }
//        else{
//            if(isset($surrender->unit->unit_head_email) && $surrender->unit->unit_head_email!='') {
//                $mail_arr['to_mail'] = $surrender->unit->unit_head_email;
//                $mail_arr['to_name'] = $surrender->unit->unit_head_name;
//            }
//        }
//
//        if(isset($mail_arr['to_mail']) && $mail_arr['to_mail']!='') {
//            $mail_arr['memo_date'] = otherHelper::en2bn(otherHelper::change_date_format($surrender_letter->sub_header_memo_date, false, "d M Y")) . ' খ্রিঃ';
//            $mail_arr['memo'] = $surrender_letter->sub_header_memo_first_part . $surrender_letter->sub_header_memo_second_part;
//            $mail_arr['fiscal_year'] = otherHelper::en2bn($surrender->fiscal_year);
//            $mail_arr['code'] = $surrender->code->code;
//            $mail_arr['amount'] = otherHelper::en2bn(otherHelper::taka_format($surrender->amount));
//            //        $settings_data = Session::get('settings_data');
//            $settings_data = Setting::find(1);
//            $mail_arr['subject'] = $settings_data->surrender_letter_mail_subject;
//            $mail_arr['related_model_type'] = 'code_surrender';
//            $mail_arr['related_model_id'] = $surrender->id;
//            return implode('][', $mail_arr);
//        }
//        else{
//            return '';
//        }
//    }
//    public function sms_info($to_person_type='Unit Head'): string
//    {
//        $surrender_letter=$this->letter;
//        $surrender=$this->allotment;
//        $sms_arr=array();
//        if($to_person_type=='For Attention'){
//            $sms_arr['to_mobile']='';
//            $sms_arr['to_name']='';
//            if(isset($surrender->unit->for_attention_mobile) && $surrender->unit->for_attention_mobile!=''){
//                $sms_arr['to_mobile']=$surrender->unit->for_attention_mobile;
//                $sms_arr['to_name']=$surrender->unit->for_attention_name;
//            }
//        }
//        else{
//            if(isset($surrender->unit->unit_head_mobile) && $surrender->unit->unit_head_mobile!='') {
//                $sms_arr['to_mobile'] = $surrender->unit->unit_head_mobile;
//                $sms_arr['to_name'] = $surrender->unit->unit_head_name;
//            }
//        }
//
//        if(isset($sms_arr['to_mobile']) && $sms_arr['to_mobile']!='') {
//            $sms_arr['memo_date'] = otherHelper::en2bn(otherHelper::change_date_format($surrender_letter->sub_header_memo_date, false, "d M Y")) . ' খ্রিঃ';
//            $sms_arr['memo'] = $surrender_letter->sub_header_memo_first_part . $surrender_letter->sub_header_memo_second_part;
//            $sms_arr['fiscal_year'] = otherHelper::en2bn($surrender->fiscal_year);
//            $sms_arr['code'] = $surrender->code->code;
//            $sms_arr['amount'] = otherHelper::en2bn(otherHelper::taka_format($surrender->amount));
//            //        $settings_data = Session::get('settings_data');
//            $settings_data = Setting::find(1);
//            $sms_arr['subject'] = $settings_data->surrender_letter_mail_subject;
//            $sms_arr['related_model_type'] = 'code_surrender';
//            $sms_arr['related_model_id'] = $surrender->id;
//            return implode('][', $sms_arr);
//        }
//        else{
//            return '';
//        }
//    }
}
