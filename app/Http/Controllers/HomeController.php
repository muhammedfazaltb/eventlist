<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Userevent;
use App\EventuserList;

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
    // Home page
    public function index()
    {
      $user = Auth::user();
      $data['user'] = $user;
      $data['result']= Userevent::where('user_id',$user->id)->paginate(10);
        if( $data['result']){
            foreach($data['result'] as $key=>$result){
               $event_users=EventuserList::where('event_id', $result->id)->get();    
               $data['result'][$key]['event_user_list']=$event_users;
            }
        } 
    return view('home')->with($data);
    }
    // Event page
    public function event()
    {
      return view('event');
    }
    // Create Event
    public function eventpost(Request $request)
    {
      $user = Auth::user();
      $data['user'] = $user;
      $result=Userevent::create([
                             'user_id' =>Auth::user()->id,
                             'event_name'=>$request->get('event_name'),
                             'start_date' =>$request->get('start_date'),
                             'end_date' =>$request->get('end_date')
                              ]);
      $data['result']= Userevent::where('user_id',$user->id)->get();
      return redirect('/home')->with($data);
    }
    //Invite and withdraw invitation.
    public function userPostManage(Request $request){
      $user = Auth::user();
      $message = "";
      $statusCode = 6004;
      $result = null;
      $url = "";
     switch ($request->get('type')){
      case 'invite_user': 
      $result= EventuserList::create([
                        'event_id'=>$request->get('event_id'),
                        'invitees_email' =>$request->get('invitees_email')
                                  ]);
      $message = "Invitation added";
      $statusCode = 6000;
      break;  
      case 'delete_user': 
      $invitees_id=$request->get('id');
      $result= EventuserList::where('id',$invitees_id)->delete();
      $message = "Invitation withdrawn";
      $statusCode = 6000;
      break;
     }
      return response()->json(['statusCode' => $statusCode, 'message' => $message, 'result' => $result]);
    }
}

