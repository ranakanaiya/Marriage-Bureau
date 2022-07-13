<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHoroscopeDetail extends Model
{
    use HasFactory;
    protected $table = 'user_horoscope_details';
    protected $guarded = ['id'];
}
