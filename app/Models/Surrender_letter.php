<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Surrender_letter extends Model
{
    //
    protected $guarded=['id','created_at','updated_at'];

    public function updater(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','updated_by');
    }

    public function letter_surrender_transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Letter_surrender_transaction::class,'letter_id','id');
    }

    public function letter_to_recipients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Letter_recipient::class,'letter_id','id')
            ->where('letter_model','surrender_letter')
            ->where('field_type','letter_to');
    }

    public function letter_acknowledgement_recipients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Letter_recipient::class,'letter_id','id')
            ->where('letter_model','surrender_letter')
            ->where('field_type','letter_acknowledgement');
    }

    public function mail_count()
    {
        return Letter_surrender_transaction::join('emails','emails.related_model_id','letter_surrender_transactions.surrender_id')
            ->where('letter_surrender_transactions.letter_id',$this->id)
            ->where('emails.related_model_type','code_surrender')
            ->where('emails.status',1)
            ->count();
    }

    public function sms_count()
    {
        return Letter_surrender_transaction::join('s_m_s','s_m_s.related_model_id','letter_surrender_transactions.surrender_id')
            ->where('letter_surrender_transactions.letter_id',$this->id)
            ->where('s_m_s.related_model_type','code_surrender')
            ->where('s_m_s.status','success')
            ->count();
    }
}
