<!DOCTYPE html>
<html lang="en">
<head>
<title>Events</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<!--  -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!--  -->
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
</head>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <div class="w3-bar-block">
   <a href="{{route('public.index')}}" >Home</a><br> 
    <a href="{{route('public.events')}}">All events</a><br>
     @if (Route::has('login'))
     @auth
    <a href="{{ url('/home') }}">Dashboard</a></br>
     @else
    <a href="{{ route('login') }}">Login</a><br>
     @if (Route::has('register'))
    <a href="{{ route('register') }}">Register</a>
     @endif
     @endauth
     @endif
   </nav>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
  <!-- Event List -->
  <div class="w3-container" id="packages" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Events By Users.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
    <div class="row" style="margin-bottom: 10px;">
      <div class="col-6"><input type="text" style="float: right;" id="search" placeholder="Search.."></div>
      <div class="col-6"><input type="text" name="daterange" value="05/01/2022 - 05/15/2022" /></div>
     </div>
  </div>
  <div id="event-container">
     <div id="event-container">
  <div class="container">
  @if(count($events))
  @foreach($events as $event)
  <div class="w3-row-padding">
    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-dark-grey w3-xlarge w3-padding-32">{{$event->event_name}}</li>
        <li class="w3-padding-16">Created by : {{$event->first_name}}{{$event->last_name}}</li>
        <li class="w3-padding-16">Starting at : {{$event->start_date}}</li>
        <li class="w3-padding-16">Ending on :{{$event->end_date}}</li>
      </ul>
    </div>
  </div>
  @endforeach
 {{ $events->links() }}
  @else
  <p>No events to list</p>
  @endif
</div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </body>
<script type="text/javascript">
  //Search ..
  $("#search").keyup(function(){
    var value = $('#search').val();
    $.ajax({
      type: 'post',
      url: '{{ URL::route("PublicPostManage") }}',
      data: {_token:'{{ csrf_token() }}',value:value,type:'search'},
      success: function(data) {
       if(data.statusCode == 6000){
         var searchdata = data.result.html;
         $('#event-container').empty();
         $('#event-container').append(searchdata);       
       }
       else{
         return false;
         window.location.reload();
       }
      }
    });
  });
</script>
<script type="text/javascript">
 //Date Search..
 $(function() {
  $('input[name="daterange"]').daterangepicker({opens: 'left'}, function(start, end, label) {
     var start_date=start.format('YYYY-MM-DD');
     var end_date=end.format('YYYY-MM-DD');
   $.ajax({
     type: 'post',
     url: '{{ URL::route("PublicPostManage") }}',
     data: {_token:'{{ csrf_token() }}',start_date:start_date,end_date:end_date,type:'search_by_date_range'},
     success: function(data) {
      if(data.statusCode == 6000)
      {
        var searchdata = data.result.html;
        $('#event-container').empty();
        $('#event-container').append(searchdata);
      }
      else{
          return false;
          window.location.reload();
      }
     }
   });
  });
 });
</script>
</html>
