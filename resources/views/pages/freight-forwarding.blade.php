@extends('layouts.app')
@section('title','Carriers and Shipers in need for return loads')
@section('content')
<style>
.row{margin-top:2em;}
.jumbotron{opacity:0.8;}
a.btn-transparent{
  border: 3px solid #2E94BE;
  background: transparent;
  color: #454545;
}

a.btn-transparent:hover {
/*  border-color: rgba(255, 255, 255, 0.5);*/
border-color: #518252;
color: #518252;
}
</style>
<div class="container" id="freight-forwarding">
  <div class="row">
      <div class="col-md-5 jumbotron wow fadeInLeft">
      	<h2><i class="fa fa-truck"></i> Are you a Carrier?</h2>
        <h3>Looking for goods to transport or return loads?</h3>
        <p>We allow our clients to find  suitable freight to carry that suit 
        your vehicle at competitive rates</p>
        <p><a href="/lanes/create" class="btn btn-transparent">Upload Available Vehicles</a></p>
        <p><a href="/freights" class="btn btn-transparent">Find Truck Loads Now</a></p>
         <p>&nbsp;</p>
      </div>
      <div class="col-md-5 col-md-offset-2 jumbotron wow fadeInRight">
      	<h2><i class="fa fa-cubes"></i> Are you a Shipper?</h2>
        <h3>Do you have any goods that you want to transport in the Southern Africa region?</h3>
        <p>We have carefully vetted carriers at affordable rates whereby you can even  pay only for the actual 
        distance covered.</p>
        <p><a href="/freights/create" class="btn btn-transparent" >Upload Consignment for Carriage Now</a>    </p>
       <p> <a href="/lanes" class="btn btn-transparent" >Find Available Vehicles</a>  </p>
      
      </div>    
  </div>
</div>
@stop