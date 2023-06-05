<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
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

    public function designation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Lookup::class,'id','designation_id');
    }
}
