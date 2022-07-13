<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;
    protected $table = 'users_preferences';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
