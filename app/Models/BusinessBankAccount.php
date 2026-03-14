<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessBankAccount extends Model
{
    protected $casts = [
        'account_number' => 'encrypted'
    ];


    public function business(){
        return $this->belongsTo(BusinessModel::class);
    }
}
