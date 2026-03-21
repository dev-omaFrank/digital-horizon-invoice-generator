<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessBankAccount extends Model
{
    protected $casts = [
        'account_number' => 'encrypted'
    ];

    protected $fillable = [
        'account_name',
        'account_number',
        'bank_name',
        'bank_code',
    ];


    public function business(){
        return $this->belongsTo(BusinessModel::class);
    }
}
