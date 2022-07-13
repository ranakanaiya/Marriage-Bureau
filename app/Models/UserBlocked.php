<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBlocked extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function blocked_user()
    {
        return $this->belongsTo('App\Models\User','blocked_user_id','id');
    }
}
