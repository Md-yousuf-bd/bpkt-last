<?php

namespace App\Models;

use App\Http\PigeonHelpers\otherHelper;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Letter_allotment_transaction extends Model
{
    //
    public $timestamps=false;

    public function letter(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Allotment_letter::class,'id','letter_id');
    }

    public function allotment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Unit_allotment::class,'id','allotment_id');
    }

    public function mail_info($to_person_type='Unit Head'): string
    {
        $allotment_letter=$this->letter;
        $allotment=$this->allotment;
        $mail_arr=array();
        if($to_person_type=='For Attention'){
            $mail_arr['to_mail']='';
            $mail_arr['to_name']='';
            if(isset($allotment->unit->for_attention_email) && $allotment->unit->for_attention_email!=''){
                $mail_arr['to_mail']=$allotment->unit->for_attention_email;
                $mail_arr['to_name']=$allotment->unit->for_attention_name;
            }
        }
        else{
            if(isset($allotment->unit->unit_head_email) && $allotment->unit->unit_head_email!='') {
                $mail_arr['to_mail'] = $allotment->unit->unit_head_email;
                $mail_arr['to_name'] = $allotment->unit->unit_head_name;
            }
        }

        if(isset($mail_arr['to_mail']) && $mail_arr['to_mail']!='') {
            $mail_arr['memo_date'] = otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->sub_header_memo_date, false, "d M Y")) . ' খ্রিঃ';
            $mail_arr['memo'] = $allotment_letter->sub_header_memo_first_part . $allotment_letter->sub_header_memo_second_part;
            $mail_arr['course_name'] = $allotment->allocation_sector;
            $mail_arr['fiscal_year'] = otherHelper::en2bn($allotment->fiscal_year);
            $mail_arr['code'] = $allotment->code->code;
            $mail_arr['unit_name'] = $allotment->unit->name_bangla;
            $mail_arr['amount'] = otherHelper::en2bn(otherHelper::taka_format($allotment->amount));
            //        $settings_data = Session::get('settings_data');
            $settings_data = Setting::find(1);
            $mail_arr['subject'] = $settings_data->allotment_letter_mail_subject;
            $mail_arr['related_model_type'] = 'unit_allotment';
            $mail_arr['related_model_id'] = $allotment->id;
            return implode('][', $mail_arr);
        }
        else{
            return '';
        }
    }
    public function sms_info($to_person_type='Unit Head'): string
    {
        $allotment_letter=$this->letter;
        $allotment=$this->allotment;
        $sms_arr=array();
        if($to_person_type=='For Attention'){
            $sms_arr['to_mobile']='';
            $sms_arr['to_name']='';
            if(isset($allotment->unit->for_attention_mobile) && $allotment->unit->for_attention_mobile!=''){
                $sms_arr['to_mobile']=$allotment->unit->for_attention_mobile;
                $sms_arr['to_name']=$allotment->unit->for_attention_name;
            }
        }
        else{
            if(isset($allotment->unit->unit_head_mobile) && $allotment->unit->unit_head_mobile!='') {
                $sms_arr['to_mobile'] = $allotment->unit->unit_head_mobile;
                $sms_arr['to_name'] = $allotment->unit->unit_head_name;
            }
        }

        if(isset($sms_arr['to_mobile']) && $sms_arr['to_mobile']!='') {
            $sms_arr['memo_date'] = otherHelper::en2bn(otherHelper::change_date_format($allotment_letter->sub_header_memo_date, false, "d M Y")) . ' খ্রিঃ';
            $sms_arr['memo'] = $allotment_letter->sub_header_memo_first_part . $allotment_letter->sub_header_memo_second_part;
            $sms_arr['course_name'] = $allotment->allocation_sector;
            $sms_arr['fiscal_year'] = otherHelper::en2bn($allotment->fiscal_year);
            $sms_arr['code'] = $allotment->code->code;
            $sms_arr['unit_name'] = $allotment->unit->name_bangla;
            $sms_arr['amount'] = otherHelper::en2bn(otherHelper::taka_format($allotment->amount));
            //        $settings_data = Session::get('settings_data');
            $settings_data = Setting::find(1);
            $sms_arr['subject'] = $settings_data->allotment_letter_mail_subject;
            $sms_arr['related_model_type'] = 'unit_allotment';
            $sms_arr['related_model_id'] = $allotment->id;
            return implode('][', $sms_arr);
        }
        else{
            return '';
        }
    }
}
