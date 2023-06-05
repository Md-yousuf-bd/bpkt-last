<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Unit_surrender extends Model
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

    public function approver(): ?\Illuminate\Database\Eloquent\Relations\HasOne
    {
        if(isset($this->approved_by)) {
            return $this->hasOne(User::class, 'id', 'approved_by');
        }
        else{
            return null;
        }
    }

    public function code(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Code::class,'id','code_id');
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Unit::class,'id','unit_id');
    }
}
