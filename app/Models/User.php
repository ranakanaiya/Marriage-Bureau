<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'step',
        'is_blocked',
        'subscribed',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'step',
        'subscribed',
        'last_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function personal_detail()
    {
        return $this->belongsTo('App\Models\UserPersonalDetail','id','user_id');
    }

    public function family_detail()
    {
        return $this->belongsTo('App\Models\UserFamilyDetail','id','user_id');
    }

    public function education_career_detail()
    {
        return $this->belongsTo('App\Models\UserEducationCareerDetail','id','user_id');
    }

    public function horoscope_detail()
    {
        return $this->belongsTo('App\Models\UserHoroscopeDetail','id','user_id');
    }

    public function preferences()
    {
        return $this->belongsTo('App\Models\UserPreferences','id','user_id');
    }

    public function sent_request($receiver=1)
    {
        return $this->belongsTo('App\Models\UserRequest','id','sender_id')->where('type',0)->where('user_id',$receiver)->first();
    }

    public function received_request($sender=1)
    {
        return $this->belongsTo('App\Models\UserRequest','id','user_id')->where('type',0)->where('sender_id',$sender)->first();
    }

    public function sent_image_request($receiver=1)
    {
        return $this->belongsTo('App\Models\UserRequest','id','sender_id')->where('type',1)->where('user_id',$receiver)->first();
    }

    public function received_image_request($sender=1)
    {
        return $this->belongsTo('App\Models\UserRequest','id','user_id')->where('type',1)->where('sender_id',$sender)->first();
    }
}
