<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    //
    protected $fillable=['parent_id','name','description','priority','status','updated_by'];

    public function parent()
    {
        return $this->hasOne(self::class,'id','parent_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','updated_by');
    }
}
