<?php

namespace App\Models;

use App\Http\PigeonHelpers\otherHelper;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //
    protected $guarded=['id','created_at','updated_at'];


    public function creator(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function updater(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','updated_by');
    }

    public function unapproved_balance()
    {
       $total_code_allotment=Code_allotment::where('code_id',$this->id)->where('status',1)->sum('amount');
       $total_unit_allotment=Unit_allotment::where('code_id',$this->id)->where('status',1)->sum('amount');
       $total_unit_surrender=Unit_surrender::where('code_id',$this->id)->where('status',1)->sum('amount');
       $total_code_surrender=Code_surrender::where('code_id',$this->id)->where('status',1)->sum('amount');
       return $total_code_allotment-$total_unit_allotment+$total_unit_surrender-$total_code_surrender;
    }

    public function code_current_fiscal_year_allotment(){
        $current_fiscal_year=otherHelper::get_fiscal_year_by_date(date('Y-m-d'));
        $total_code_allotment= Code_allotment::where('code_id',$this->id)->where('fiscal_year',$current_fiscal_year)->where('status',1)->sum('amount');
        $total_code_surrender=Code_surrender::where('code_id',$this->id)->where('fiscal_year',$current_fiscal_year)->where('memo','!=','')->where('memo','!=',null)->where('status',1)->sum('amount');
        return $total_code_allotment-$total_code_surrender;
    }

    public function code_current_fiscal_year_expense(){
        $current_fiscal_year=otherHelper::get_fiscal_year_by_date(date('Y-m-d'));
        $total_unit_allotment=Unit_allotment::where('code_id',$this->id)->where('fiscal_year',$current_fiscal_year)->where('memo','!=','')->where('memo','!=',null)->where('status',1)->sum('amount');
        $total_unit_surrender=Unit_surrender::where('code_id',$this->id)->where('fiscal_year',$current_fiscal_year)->where('status',1)->sum('amount');
        return $total_unit_allotment- $total_unit_surrender;
    }
}
