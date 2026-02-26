<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessModel extends Model
{
   use HasFactory;

   protected $table = 'businesses';

   protected $fillable = [
        'user_id',
        'business_name', 
        'business_logo',
        'business_address', 
        'business_email', 
        'business_phone_no'
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function invoices(){
      return $this->hasMany(Invoice::class, 'business_id');
   }
}
