<!DOCTYPE html>
<html lang="en">
<head>
<title>Events</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
    <a href="{{route('public.index')}}" >Home</a> <br>
    <a href="{{route('public.events')}}">All events</a> <br>
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
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">
    <div class="w3-container" id="packages" style="margin-top:75px">
     <h1 class="w3-xxxlarge w3-text-red"><b>Event System</b></h1>
    </div>
  <div class="w3-row-padding">
    <div class="w3-half w3-margin-bottom">
      <ul class="w3-ul w3-light-grey w3-center">
        <li class="w3-padding-16">Total Users in system :{{$users_count}}</li>
        <li class="w3-padding-16">Total Events in system :{{$event_count}}</li>
        <li class="w3-padding-16">Average Events :{{$average_event}}</li>
        </ul>
    </div>
    </div>
  </div>
</div>
</body>
</html>
