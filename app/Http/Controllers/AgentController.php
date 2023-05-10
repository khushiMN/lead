<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AgentRequestValidation;
use App\Http\Requests\UpdateAgentRequestValidation;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //// view all agents
    public function index()
    {
        $data=User::where('role','agent')->paginate(5);
        return view('viewAgent')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //// add agent
    public function create()
    {
       return view('addAgent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    ////create agent
    public function store(AgentRequestValidation $request)
    {
       if($user = User::create(['name'=>$request->name,'phone_no'=>$request->phone_no,'address'=>$request->address,'email'=>$request->email,'password'=>Hash::make(request('password')),'role'=>$request->role])){
            return redirect()->route('agent.index')->with('success','Data created');
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //// show agent 
    public function show($id)
    {
        if($data =  User::select('*')->where('id',$id)->first()){
            return view('showAgent', ['value' => $data]);
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //// edit agent
    public function edit($id)
    {
        if($data = User::select('*')->where('id',$id)->first())
        {
            return view('updateAgent', ['value' => $data]);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //// update agent
    public function update(UpdateAgentRequestValidation $request, $id)
    {
        $data = $request->only(['name','phone_no','address','email','password']);

        $old=User::where('email',$request->email)->withTrashed()->first();
        
        if($old){
            $user=User::where('id',$id)->where('email',$request->email)->first();
            if($user){
                $data['password']=Hash::make($request->password);
                User::whereId($id)->update($data);
                return redirect()->route('agent.index')->with('success','Data Updated');
            }else{
                return redirect()->route('agent.index')->with('error',' Email  Already Exists!');
            }
        }else{
            $data['password']=Hash::make($request->password);
            User::whereId($id)->update($data);
            return redirect()->route('agent.index')->with('success','Data Updated');
        }
        return redirect()->route('agent.index')->with('error','Data Not Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //// delete agent
    public function destroy($id)
    {
        //
        try{
            if(Lead::where('user_id',$id)->first()){
                return redirect()->route('agent.index')->with('error','This agent is  given Leads');
            }else{
                User::where('id',$id)->delete();
                return redirect()->route('agent.index')->with('success','Data Removed');
            }
        }
        catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->route('agent.index')->with('error','This agent is  given Leads');
        }
    }
}
