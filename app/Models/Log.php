<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Log extends Model
{
    //
    protected $fillable=['description','action','type','created_by'];

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
}
