<?php

namespace App\Observers;

use App\Models\Campaign;
use App\Models\AgentCampaign;
use Illuminate\Support\Facades\Log;

class CampaignObserver
{
    /**
     * Handle the Campaign "created" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */

     public $afterCommit = true;

    public function created(Campaign $campaign)
    {
        //
        // Log::info('Showing the user profile for user: '.$id);
    }

    /**
     * Handle the Campaign "updated" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function updated(Campaign $campaign)
    {
        //
    }

    /**
     * Handle the Campaign "deleted" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */


     public function deleting(Campaign $campaign)
     {
        AgentCampaign::where('campaign_id',$campaign->id)->delete();
        Log::info("Data is being deleted campaign".$campaign);
     }


    public function deleted(Campaign $campaign)
    {
        //
    }

    /**
     * Handle the Campaign "restored" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function restored(Campaign $campaign)
    {
        //
    }

    /**
     * Handle the Campaign "force deleted" event.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return void
     */
    public function forceDeleted(Campaign $campaign)
    {
        //
    }
}
