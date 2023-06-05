<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Allotment_letter extends Model
{
    //
    protected $guarded=['id','created_at','updated_at'];

    public function updater(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','updated_by');
    }

    public function letter_allotment_transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Letter_allotment_transaction::class,'letter_id','id');
    }

    public function letter_to_recipients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Letter_recipient::class,'letter_id','id')
            ->where('letter_model','allotment_letter')
            ->where('field_type','letter_to');
    }

    public function letter_acknowledgement_recipients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Letter_recipient::class,'letter_id','id')
            ->where('letter_model','allotment_letter')
            ->where('field_type','letter_acknowledgement');
    }

    public function mail_count()
    {
        return Letter_allotment_transaction::join('emails','emails.related_model_id','letter_allotment_transactions.allotment_id')
            ->where('letter_allotment_transactions.letter_id',$this->id)
            ->where('emails.related_model_type','unit_allotment')
            ->where('emails.status',1)
            ->count();
    }

    public function sms_count()
    {
        return Letter_allotment_transaction::join('s_m_s','s_m_s.related_model_id','letter_allotment_transactions.allotment_id')
            ->where('letter_allotment_transactions.letter_id',$this->id)
            ->where('s_m_s.related_model_type','unit_allotment')
            ->where('s_m_s.status','success')
            ->count();
    }
}
