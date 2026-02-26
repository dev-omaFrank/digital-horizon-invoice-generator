<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'description', 
        'quantity',
        'price',
        'total'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
