<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory,SoftDeletes;

    // protected $timestamp=false;
    protected $fillable = ['name','status','email','phone_no','user_id','campaign_id'];

    public function campaigns()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
