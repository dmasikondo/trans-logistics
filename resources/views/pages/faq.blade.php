@extends('layouts.app')
@section('title','Frequently asked questions')
@section('content')
<style>
 body {
      position: relative;
  }
  .affix {
      top: 20px;
  }
  div.col-sm-8 div {
     /* height: 250px;*/
      /*font-size: 28px;*/
  }
  .jumbotron{opacity:.8; color: #454545;}
  
  ##get_truck_load { background-color: #1E88E5;}
 #upload_consignment { background-color: #673ab7;}
  #insurance {background-color: #ff9800;}
  #tracking {background-color: #00bcd4;}
  #why_registering {background-color: #673ab7;}
  
  @media screen and (max-width: 810px) {
    #get_truck_load, #upload_consignment, #insurance, #section4, #tracking, #why_registering {
        margin-left: 150px;
    }
	    #get_truck_load a, #upload_consignment a, #insurance a,  #tracking a, #why_registering  {
			font-weight:bold;        
    }
  }
  </style>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="15">

<div class="container faq" style="background-color:#518252;color:#fff;height:180px;">
    <img src="/img/questions.jpg" align="left" class="col-md-3 col-xs-12 wow fadeInLeft">
    <div class="col-md-9 col-xs-12 wow fadeInRight">
      <h1>Frequently Asked Questions</h1>
      <h2  style="color: #C5BEBF;">Find answers and general information quickly about Transpartner Logistics' operations and procedures</h2>
       
  </div>
</div>
<br>

<div class="container">
  <div class="row">
    <nav class="col-md-4" id="myScrollspy">
      <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
        <li><a href="#get_truck_load">How do I Get Available Truck Loads?</a></li>
        <li><a href="#upload_consignment">How do I place my Consignment for Carriage?</a></li>
        <li><a href="#insurance">What if I don't have insurance cover?</a></li>
        <li><a href="#tracking">What tracking systems do you have?</a></li>
        <li><a href="#why_registering">Why should I register to get some services</a></li>
  
      </ul>
    </nav>
    <div class="col-md-8 wow fadeInDown">
      <div id="get_truck_load">
      	<div class="jumbotron">
        	<h2><i class="glyphicon glyphicon-bed"></i> How to Get Truck Load Data in Zimbabwe and Southern Africa?</h2>
            <ul>
            	<li> <a href="/register">Register</a> for a transporter's account / <a href="/login">login</a> if already registered</li>
              <li><i class="glyphicon glyphicon-road"></i> Click Services <i class="glyphicon glyphicon-hand-right"></i>
                	Available Loads
                </li>
                <p>
               	  <i class="glyphicon glyphicon-saved"></i> <a href="/freights">Get Truck Loads Now!</a>
                </p>
                <p>We allow our clients to find suitable freight to carry that suit your vehicle at a competitive rates
                </p>
            </ul>
        
        </div>
      </div>
      <div id="upload_consignment">
      	<div class="jumbotron">
        	<h2><i class="glyphicon glyphicon-briefcase"></i> How to Place A Consignment For Carriage in Zimbabwe and Southern Africa?</h2>
            <ul>
            	<li><i class="glyphicon glyphicon-user"></i> Join Transpartner Logistics through <a href="/register">registration</a> as
                 a shipping customer or <a href="/login">login</a> if already registered</li>
              <li><i class="glyphicon glyphicon-road"></i> Click Services <i class="glyphicon glyphicon-hand-right"></i>
               <i class="glyphicon glyphicon-briefcase"></i>
                   Upload your freight details to our servers via Services <i class="glyphicon glyphicon-hand-right"></i>
                   Freight Forwarding <i class="glyphicon glyphicon-hand-right"></i> Upload Consignment
                </li>               
                <li><i class="glyphicon glyphicon-usd"></i>
                   We agree on payment details and give your consignment to our hotstandby carriers for carriage
                </li>
                 <p>
               	  <i class="glyphicon glyphicon-saved"></i> <a href="/freights/create">Upload Consignment now</a>
                </p>
                <p>We allow our clients to find vehicle space for their at affordable rates whereby you only pay for the
                 actual distance covered. Our Carriers are carefully vetted. Our Routes are restricted to Southern Africa (SADC region) states.
                </p>
            </ul>        
        </div>   
      </div>
      <div id="insurance">
      	<div class="jumbotron">
        	<h2><i class="glyphicon glyphicon-tags"></i> What if I do not have insurance cover?</h2>
            <ul>
            	<p>It is extremly important that your goods have insurance cover whilst in storage or transit.
                </p>
            	<p>If you don't have an insurance cover then simply <a href="/tracking-insurance">contact us here</a> or you can
                do so via Services <i class="glyphicon glyphicon-hand-right"></i> Tracking and Insurance
                <i class="glyphicon glyphicon-hand-right"></i> <i class="fa fa-umbrella"></i> Insurance Cover and Select 
                "Ask more on Insurance?" and we can arrange insurance for your goods. 
                </p>
                <p>Our partners are reputable and have a vast experience
                </p>
            </ul>        
        </div> 
      </div>
      <div id="tracking">
      	<div class="jumbotron">
        	<h2><i class="glyphicon glyphicon-screenshot"></i> What tracking systems do you have?</h2>
            <ul>
            	<p>At Transpartner Logistics we deal in almost all your tracking needs. We do have highly qualified and
                experienced engineers who can even design tracking systems to suit your unique tests.
                </p>
            	<p>Most of our clients have been requesting for tracking systems for:
                </p>
                <li>Tracking Driving Behaviour</li>
                <li>Tracking Fuel Consumption</li>
                <li>Tracking Geographical Position</li>
                <li>Load Security</li>
                <li>Negligence Alerts</li>
                <p>Ask more about <a href="/tracking-insurance">Tracking Systems?</a></p>
            </ul>        
        </div> 
      </div>      
      <div id="why_registering">
      	<div class="jumbotron">
          <h2><i class="glyphicon glyphicon-lock"></i> Why must I sign up to view additional resources</h2>
          <p>At Transpartner logistics we take issues of secure browsing and safety very seriously</p>
          <p>When you sign up with us this enables us to easily: </p>
          <ul>
          	<li>Ensure we are dealing with real people with existing email addresses</li>
            <li>Customise our services to you </li>
            <li>Create great user experience</li>
          </ul>
          <p>We use standard encrpytion technologies to ensure your details are safe in our custody.</p>
          <p>We keep your data confidential and do not sell your data to advertisers</p> 
         @if(!Auth::check()) <a href="/register">Register</a> with Transpartner Logistics Now! @endif
     	 </div>      
       </div>

    </div>
  </div>
</div>

</body>
@stop