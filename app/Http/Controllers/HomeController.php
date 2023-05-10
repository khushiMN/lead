<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AgentCampaign;
use App\Models\Lead;
// use App\Http\Controllers\Auth;
use App\Models\Campaign;
use Illuminate\Support\Facades\Hash;
use App\Models\TransactionHistory;
use App\Http\Requests\UpdateAgentRequestValidation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
 
    public function userDelete(Request $request,$id)
    {
        AgentCampaign::where('user_id',$id)->where('campaign_id',$request->campaign_id)->delete();
        return redirect()->route('campaign.index')->with('success','User Data Removed');
    }
    
    public function profile()
    {
        $data=User::where('id',Auth::user()->id)->first();
        return view('profile')->with('data',$data);;
    }

    public function editProfile()
    {
        $data=User::where('id',Auth::user()->id)->first();
        return view('editProfile')->with('data',$data);;
    }

    public function update(UpdateAgentRequestValidation $request)
    {
        $data = $request->only(['name','phone_no','address','email','password']);
        $user=User::where('id',Auth::user()->id)->where('email',$request->email)->first();
        $old=User::where('email',$request->email)->withTrashed()->first();
        if($old){
            if($user){
                $data['password']=Hash::make($request->password);
                User::whereId(Auth::user()->id)->update($data);
                return redirect()->route('profile')->with('success','Data Updated');
            }else{
                return redirect()->route('profile')->with('error','data not update bcz this email id already exit');
            }
        }else{
            $data['password']=Hash::make($request->password);
            User::whereId(Auth::user()->id)->update($data);
            return redirect()->route('profile')->with('success','Data Updated');
        }
    }
    
    public function viewLead($id)
    {
        $data=Lead::where('user_id',$id)->paginate(5);
        return view('viewLead')->with('data',$data);
    }
    public function showLead($id)
    {
        $data=Lead::where('id',$id)->first();
        return view('showLead')->with('data',$data);
    }
    
}
