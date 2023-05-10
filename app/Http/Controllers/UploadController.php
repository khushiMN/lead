<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Lead;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    // upload file 
    public function upload(Request $request) {
       
        $campaign_id=$request->campaign_id;
        $file = $request->file('csv');
        $filename = $request->campaign_id.'.'.$file->getClientOriginalExtension();
        $file->storeAs('files', $filename);
        $users = [];
        if (($open = fopen(storage_path().'/app/files/'.$filename , "r")) !== FALSE) {
            
            while (($data = fgetcsv($open,500,",")) !== FALSE) {
               $users[]=$data;
            }
            
            fclose($open);
        }
        $column = array_shift($users);
        $user = [];
        foreach ($users as $row) {
            $user[] = array_combine($column, $row);
        }
        if($user!=[]){
            return response()->json(['success' => true,'column'=>$column,'user'=>$users,'campaign_id'=>$campaign_id,'filename'=>$filename]);
        }else{
            return response()->json(['success' => false]);
        }
      }

    /// create lead
      public function userData(Request $request) {
          $filename=$request->filename;
          $campaign_id=$request->campaign_id;
          $campaign=Campaign::with('agent_campaigns')->where('id',$campaign_id)->first();
          $users = [];

          if (($open = fopen(storage_path().'/app/files/'.$filename , "r")) !== FALSE) {
              
              while (($data = fgetcsv($open,500,",")) !== FALSE) {
                  $users[]=$data;
                }
                
                fclose($open);
            }
            $column1 = array_shift($users);
            
            $column = $request->column;
            $count_column=0;
            $count_phone=0;
            foreach($column as $value){
                if($value!=null){
                    $count_column++;
                    if($value=='phone_no'){
                        $count_phone++;
                    }
                }
            }
            if(!$count_column){
                return redirect()->route('campaign.index')->with('error',"please select any column in uploaded file");
            }
            if(!$count_phone){
                return redirect()->route('campaign.index')->with('error',"please select phone no. in uploaded file");
            }
            $user = [];
            foreach ($users as $row) {
                $user[] = array_combine($column, $row);
            }


            $filteredArray = array_map(function($user) {
                unset($user[""]);
                return $user;
            }, $user);

            $user_id=[];
            foreach($campaign->agent_campaigns as $value){
                $user_id[]=$value->id;
            }
            
            $temp=0;
            $j1=0;
            if(count($user_id)==1){
                for($i=0;$i<count($user_id);$i++){
                    for($j=0;$j<count($filteredArray);$j++){
                        $filteredArray[$j]['user_id']=$user_id[$i];
                        $filteredArray[$j]['campaign_id']=$campaign_id;
                    }
                }
            }else{
                for($i=0;$i<count($user_id);$i++){
                    $c=0;
                    for($j=0;$j<count($filteredArray);$j++){
                        $c++;
                        if($temp==count($filteredArray)-1){
                            break;
                        }
                        if($j==0){
                            $j=$temp;
                        }
                        $filteredArray[$j]['user_id']=$user_id[$i];
                        $filteredArray[$j]['campaign_id']=$campaign_id;
                        $j1=$j;
                        if($c==2){
                            break;
                        }
                    }
                    $temp=$j1;
                    if($i==1){
                        $i=-1;
                    }
                    if($temp==count($filteredArray)-1){
                        $filteredArray[$j]['user_id']=$user_id[count($user_id)-1];
                        break;
                    }
                }
            }
            $total_no=0;
            try {
                $getUsersIdArray = $user_id;
                $setLeadToUserId = 0;
                foreach($filteredArray as $oneRecord){
                    $count = Lead::where('phone_no',$oneRecord['phone_no'])->where('campaign_id',$oneRecord['campaign_id'])->count();
                    if($count <= 0) {
                        $total_no++;
                        $oneRecord['user_id'] = $getUsersIdArray[$setLeadToUserId];
                        $user=Lead::create($oneRecord);
                        $setLeadToUserId++;
                        $setLeadToUserId = isset($getUsersIdArray[$setLeadToUserId]) ? $setLeadToUserId : 0;
                    }
                }
            }catch (Exception $e) {
                return redirect()->route('campaign.index')->with('error','File Not Upload');
            }
            if(file_exists(storage_path().'/app/files/'.$filename)){
                unlink(storage_path().'/app/files/'.$filename);
            }
            if($count > 0) {
                return redirect()->route('campaign.index')->with('error',"this recode is available in Campaign $request->campaign_id");
            }else{
                return redirect()->route('campaign.index')->with('success',"Upload File Successfully and $total_no record inserted successful in Campaign $request->campaign_id");
            }
      }
      
}