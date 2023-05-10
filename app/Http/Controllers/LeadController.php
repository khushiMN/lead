<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\AgentCampaign;
use App\Models\Lead;
use App\Models\Campaign;
use Illuminate\Support\Facades\Hash;
use App\Models\TransactionHistory;
use App\Http\Requests\UpdateAgentProfileRequestValidation;

class LeadController extends Controller
{



    //// update status
    public function updateStatus(Request $request)
    {
        if($request->status=="conveted"){
            $data=Lead::with('campaigns')->findOrFail($request->id);
            $data->status=$request->status;
            $data->save();
            $wallet=[];
            $wallet['user_id']=$data->user_id;
            $wallet['campaign_id']=$data->campaign_id;
            $wallet['lead_id']=$data->id;
            $wallet['conversion_cost_per_lead']=$data->campaigns->conversion_cost_per_lead;
            TransactionHistory::create($wallet);
        }else{
            $data=Lead::findOrFail($request->id);
            $data->status=$request->status;
            $data->save();
        }
        return response()->json(['success'=>"Update Status successfully"]);
    }

    ///create wallet
    public function wallet()
    {
        $data=TransactionHistory::with(['leads','users','campaigns'])->where('user_id',Auth::user()->id)->get();
        $total=0;
        foreach($data as $value){
            $total += $value->conversion_cost_per_lead;
        }
        $data=TransactionHistory::with(['leads','users','campaigns'])->where('user_id',Auth::user()->id)->paginate(5);
        return view('wallet')->with(['data'=>$data,'total'=>$total]);
    }

    // view reports
    public function reports()
    {
        $data=Lead::with(['users','campaigns'])->paginate(5);
        return view('reports')->with('data',$data);

    }

     // it will render for adding a single lead  page by admin
     public function addLead($id)
     {
         $data=Campaign::with("agent_campaigns")->where('id',$id)->first();
         return view('addLead')->with('data',$data);
     }

    //// insert lead
    public function insertLead(Request $request)
    {
        $request->validate([
            'phone_no' => 'required',
            'user_id'=>'required',
        ]);
        if($user = Lead::create($request->all())){
            return redirect()->route('campaign.index')->with('success','Data created');
        }
        return redirect()->route('campaign.index')->with('error','Data Not created');
    }
}
