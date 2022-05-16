<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Userevent;
use App\EventuserList;

class PublicController extends Controller
{
    //Public section index page
     public function index()
    {
      $count_events=Userevent::count();
      $count_users=User::count();
      $data['average_event'] = 0;
         if($count_users > 0 && $count_events > 0){
            $average=$count_events/$count_users;
            $data['average_event']=$average;
         }
      $data['users_count']=$count_users;
      $data['event_count']=$count_events;
      return view('welcome')->with($data);
    }
    // public section All event listing page
    public function allevents()
    {
      $data['events']=Userevent::join('users','users.id','user_event.user_id')->paginate(5);
      return view('allevents')->with($data);
    }
    // Public Search functions.
    public function PublicPostManage(Request $request){
      $message = "";
      $statusCode = 6004;
      $result = null;
      $url = "";
    switch($request->get('type')){
      case 'search':
      $value=$request->get('value');
      $result=User::leftjoin('user_event','user_event.user_id','users.id')->where(function($q) use ($value){
                               $q->where('first_name','LIKE',"%{$value}%")
                               ->orWhere('last_name','LIKE',"%{$value}%")
                               ->orWhere('event_name','LIKE',"%{$value}%");
                                })->get();
      $html="";
        foreach($result as $result){
           $html.=' <div class="w3-row-padding"><div class="w3-half w3-margin-bottom"><ul class="w3-ul w3-light-grey     w3-center"><li class="w3-dark-grey w3-xlarge w3-padding-32">'.$result->event_name.'</li>
               <li class="w3-padding-16">Created by : '.$result->first_name.' '.$result->last_name.'</li>
               <li class="w3-padding-16">Starting at : '.$result->start_date.'</li>
               <li class="w3-padding-16">Ending on :'.$result->end_date.'</li></ul></div></div>';
        }
      $result['html']=$html;
      $message = "";
      $statusCode = 6000;
      break; 
      case 'search_by_date_range':
      $start_date=$request->get('start_date');
      $end_date=$request->get('end_date');
      $results=User::leftjoin('user_event','user_event.user_id','users.id')->whereDate('start_date', '>=', $start_date)
                   ->whereDate('end_date', '<=', $end_date)->get();
      $html="";
        foreach($results as $result){
           $html.=' <div class="w3-row-padding"><div class="w3-half w3-margin-bottom"><ul class="w3-ul w3-light-grey w3-center"><li class="w3-dark-grey w3-xlarge w3-padding-32">'.$result->event_name.'</li>
              <li class="w3-padding-16">Created by : '.$result->first_name.' '.$result->last_name.'</li>
              <li class="w3-padding-16">Starting at : '.$result->start_date.'</li>
              <li class="w3-padding-16">Ending on :'.$result->end_date.'</li></ul></div></div>';
        }
      $result['html']=$html;
      $message = "";
      $statusCode = 6000; 
      break;  
    }
      return response()->json(['statusCode' => $statusCode, 'message' => $message, 'result' => $result]);
    }
}
