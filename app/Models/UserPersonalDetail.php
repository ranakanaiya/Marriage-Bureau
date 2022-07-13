<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalDetail extends Model
{
    use HasFactory;
    protected $table = 'user_personal_details';
    protected $guarded = ['id'];
    protected $dates = ['dob','created_at','updated_at'];

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id','id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id','id');
    }
}
