<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamilyDetail extends Model
{
    use HasFactory;
    protected $table = 'user_family_details';
    protected $guarded = ['id'];
}
