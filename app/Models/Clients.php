<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
      protected $fillable = [
        'company_name',
        'company_email',
        'company_address',
        'PIC_Name',
        'phone_no',
        'user_id',
    ];





}
