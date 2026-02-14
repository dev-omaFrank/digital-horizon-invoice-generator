<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;
    protected $table = 'client_profile';

    protected $fillable = [
        'client_name',
        'client_email',
        'client_phone_no',
        'client_address',
    ];
}
