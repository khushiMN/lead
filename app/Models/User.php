<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use  HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */

     protected $timestamp=false;

    protected $fillable = [
        'name',
        'phone_no',
        'address',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function agent_campaigns()
    {
        return $this->belongsToMany(Campaign::class,'agent_campaigns','user_id','campaign_id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class,'user_id');
    }

    // public function setPasswordAttribute($value)
    // {
        // dd($value);
        // $this->attributes['password'] = Hash::make($value);
    // }
}
