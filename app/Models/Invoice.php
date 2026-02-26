<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'business_id',
        'client_id',
        'invoice_number',
        'issue_date',
        'due_date',
        'status',
        'subtotal',
        'tax',
        'discount',
        'total',
        'currency',
        'notes',
    ];

    public function business(){
        return $this->belongsTo(BusinessModel::class);
    }

    public function client(){
        return $this->belongsTo(ClientModel::class, 'client_id');
    }

    public function items(){
        return $this->hasMany(InvoiceItem::class);
    }
}

