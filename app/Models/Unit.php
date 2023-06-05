<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
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

    public function parent_unit(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Lookup::class,'id','parent_unit_id');
    }

    public function unit_head_designation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Lookup::class,'id','unit_head_designation_id');
    }
    public function for_attention_designation(): ?\Illuminate\Database\Eloquent\Relations\HasOne
    {
        if($this->for_attention_designation_id>0) {
            return $this->hasOne(Lookup::class, 'id', 'for_attention_designation_id');
        }
        else{
            return NULL;
        }
    }

//    public function unit_head(): \Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        return $this->hasOne(Recipient::class,'id','unit_head_id');
//    }
//
//    public function for_attention(): ?\Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        if($this->for_attention_id>0) {
//            return $this->hasOne(Recipient::class, 'id', 'for_attention_id');
//        }
//        else{
//            return NULL;
//        }
//    }
}
