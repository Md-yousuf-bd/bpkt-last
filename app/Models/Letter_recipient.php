<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Letter_recipient extends Model
{
    //
    protected $guarded=['created_at','updated_at'];

    public function letter(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Allotment_letter::class,'id','letter_id');
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Unit::class,'id','unit_id');
    }

    public function creator(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function updater(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','updated_by');
    }
}
