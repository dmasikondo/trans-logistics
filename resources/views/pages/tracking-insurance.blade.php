@extends('layouts.app')
@section('title','Tracking systems and insurance cover')
@section('content')
<style>
.row{margin-top:2em;}
.jumbotron{opacity:0.8}
a.btn-transparent,  .btn-transparent{
  border: 3px solid #2E94BE;
  background: transparent;
  color: #454545;
}
a.btn-transparent{
	padding: 5px;
}

a.btn-transparent:hover,  .btn-transparent:hover {
/*  border-color: rgba(255, 255, 255, 0.5);*/
border-color: #518252;
color: #518252;
}
</style>
<?php $user =Auth::user();?>
<div class="container">
  <div class="row">
      <div class="col-md-5 jumbotron wow fadeInLeft">
      	<h2><i class="fa fa-map-marker"></i> Tracking System</h2>
        <h3>We have a wide range of tracking products including</h3>
        <ul>
          <li>Vehicle Tracking Systems</li>
          <li>Fleet Management Systems</li>
          <li>Fleet Reporting Systems</li>
          <li>Load Security</li>
        </ul>
      @if(Auth::user())
        <button class="btn btn-transparent" data-toggle ="modal"
         data-target ="#consulModal" data-service ="Tracking System" >Ask more on Tracking Systems</button> 
      @else 
     <a href="/login-for-tracking-insurance" class="btn-transparent">Ask more on Tracking Systems?</a>  
     @endif           
      </div>
      <div class="col-md-5 col-md-offset-2 jumbotron wow fadeInRight">
      	<h2><i class="fa fa-umbrella"></i> Insurance Cover</h2>
        <h3>It is extremly important that your goods have adequate insurance cover whilst in transit or storage.</h3>
        <p>We can arrange insurance for your goods</p>
     	<br>
        <br>
     @if(Auth::user())
        <button class="btn-transparent" data-toggle ="modal"
         data-target ="#consulModal" data-service ="Insurance Cover" >Ask more on Insurance?</button>  
     @else
     <a href="/login-for-tracking-insurance" class="btn-transparent">Ask more on Insurance?</a>  
     @endif 
      </div>    
  </div>
</div>
 <script>
 $('button[data-toggle=modal]').click(function(){
	 var services = $(this).data('service');
	$('#requirements').val(services);
 });
</script>
 
@include('inc.modals.consul_modal')
@stop