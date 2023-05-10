<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Lead;
use App\Models\AgentCampaign;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CampaignRequestValidation;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //// view all campaigns
    public function index()
    {
        $data=Campaign::with('agent_campaigns','leads')->paginate(5);
        return view('viewCampaign')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //// add campaigns
    public function create()
    {
        $data=User::where('role','agent')->get();
        return view('addCampaign')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //// create campaigns
    public function store(CampaignRequestValidation $request)
    {
        if($campaign_id=Campaign::create($request->all())){
            $agent_campaign['user_id']=$request->user_id;
            foreach($agent_campaign['user_id'] as $key=>$value){
                $campaign_id->agent_campaigns()->attach(($value));
            }
            return redirect()->route('campaign.index')->with('success','Data created');
        } 
        return abort(404); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //// show campaigns details
    public function show($id)
    {
        $data =  Campaign::with('agent_campaigns')->where('id',$id)->first();
        return view('showCampaign', ['value' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //// edit campaigns
    public function edit($id)
    {
        $data =  Campaign::with('agent_campaigns')->select('*')->where('id',$id)->first();
        if(!$data)
            return redirect()->back()->with('error','user not found');

        $user_id=[];
        foreach($data->agent_campaigns as $value){
            $user_id[]=$value->id;
        }        
        $users=User::where('role','agent')->whereNotIn('id',$user_id)->get();
        return view('updateCampaign', ['value' => $data,'users'=>$users]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //// update campaigns
    public function update(CampaignRequestValidation $request, $id)
    {
        $data = $request->only(['campaign_name','description','cost_per_lead','conversion_cost_per_lead']);
        Campaign::whereId($id)->update($data);

        $campaign_id=Campaign::find($id);        
        if($request->user_id){
            foreach($request->user_id as $key=>$value){
                $campaign_id->agent_campaigns()->attach(($value));
            }
        }
        return redirect()->route('campaign.index')->with('success','Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     //// delete campaigns
    public function destroy($id)
    {
        if(Lead::where('campaign_id',$id)->first()){
            return redirect()->route('campaign.index')->with('error','This campaigns is assign Leads to Agent ');
        }else{
            Campaign::with('agent_campaigns')->find($id)->delete();
            return redirect()->route('campaign.index')->with('success','Data Removed');
        }
    }
}
