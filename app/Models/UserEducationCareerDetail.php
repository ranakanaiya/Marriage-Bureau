<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducationCareerDetail extends Model
{
    use HasFactory;
    protected $table = 'user_education_career_details';
    protected $guarded = ['id'];
}
