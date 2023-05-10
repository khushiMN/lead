<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lead;
use App\Models\Campaign;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','campaign_id','lead_id','conversion_cost_per_lead','create_at'];

    public function leads()
    {
        return $this->belongsTo(Lead::class,'lead_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function campaigns()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
