@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<title>Event Listing</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}
</style>
</head>
<body>
 <nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href="{{route('user.event')}}">create an event</a>
 </nav>
<!-- Listing Event of Authenticated user -->
<div class="w3-main" style="margin-left:250px">
<h3>Events</h3>
  @if(count($result))
  @foreach($result as $key=>$event)
  <div class="w3-row">
    <div class="w3-twothird w3-container">
      <h2 class="w3-text-teal">{{$event->event_name}}</h2>
      <hr>
      <p>Start Date :{{$event->start_date}} , End date :{{$event->end_date}}</p>
      <div class="row">
        <div class="col-4">
            <input id="invite_user{{$key}}" type="text" class="form-control"  name="invite_user">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary" id="inviteuser" onclick="inviteuser({{$key}},{{$event->id}})">Invite</button>
        </div>
        <div class="col-6"></div>
      </div>               
      @foreach($event['event_user_list'] as $userlist)
          <br>
          <div class="row">
            <div class="col-4">
               <input id="invitees_email" type="email" class="form-control"  name="invitees_email" value="{{$userlist->invitees_email}}" disabled>
            </div>
            <div class="col-2">
                <button class="btn btn-danger" onclick="deleteuser({{$userlist->id}})">Withdraw invitation</button>
            </div>
            <div class="col-6"></div>
          </div>
      @endforeach  
    </div>
     </div>
 @endforeach
 {{ $result->links() }}
 @else
 <p>No events...</p>
 @endif
</div>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
// Invite user to event
function inviteuser(key,event_id) {
    var invitees_email = $('#invite_user'+key).val();
    var event_id = event_id;
    $.ajax({
          type: 'post',
          url: '{{ URL::route("UserPostManage") }}',
          data: {_token:'{{ csrf_token() }}',event_id:event_id,invitees_email:invitees_email,type:'invite_user'},
          success: function(data) {
            if(data.statusCode == 6000){
                 swal(data.message).then(function(){
                 window.location.reload();
                 });
            }
            else{
                alert('Invitation failed');
            }
          }
    });
}
// Withdraw invitation 
function deleteuser(id){
    $.ajax({
          type: 'post',
          url: '{{ URL::route("UserPostManage") }}',
          data: {_token:'{{ csrf_token() }}',id:id,type:'delete_user'},
          success: function(data) {
            if(data.statusCode == 6000){
                 swal(data.message).then(function(){
                 window.location.reload();
                 });
            }
            else{
                return false;
                window.location.reload();
            }
          }
    });
}
</script>
</html>
@endsection