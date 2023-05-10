<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['campaign_name','description','cost_per_lead','conversion_cost_per_lead'];

    public function agent_campaigns()
    {
        return $this->belongsToMany(User::class,'agent_campaigns','campaign_id','user_id')->whereNull('agent_campaigns.deleted_at')->withTimestamps();
    }

    public function leads()
    {
        return $this->hasMany(Lead::class,'campaign_id');
    }
}
