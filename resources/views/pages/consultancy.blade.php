@extends('layouts.app')
@section('title','Transport consultancy')
@section('content')

<style>

.itemu {
	width:360px;
	height:250px;	
/*	border:4px solid #222;	*/
	margin:5px 5px 5px 0;
	
	/* required to hide the image after resized */
	overflow:hidden;
	
	/* for child absolute position */
	position:relative;
	
	/* display div in line */
	float:left;
}

.itemu .caption {
	width:360px;
	height:250px;
	background:#000;
	color:#fff;
	font-weight:bold;
		
	/* fix it at the bottom */
	position:absolute;
	left:0;

	/* hide it by default */
	display:none;

	/* opacity setting */
	filter:alpha(opacity=80);    /* ie  */
	-moz-opacity:0.8;    /* old mozilla browser like netscape  */
	-khtml-opacity: 0.8;    /* for really really old safari */  
	opacity: 0.8;    /* css standard, currently it works in most modern browsers like firefox,  */

}

.itemu .caption button {
	text-decoration:none;
	color: #F4EEEE;
	font-size:16px;	
	
	/* add spacing and make the whole row clickable*/
	padding:5px;
	display:block;
}

.itemu .caption p {
	padding:5px;	
	margin:0;
	font-size:10px;
}

.itemu img {
	border:0;
	
	/* allow javascript moves the img position*/
	position:absolute;
}

.clear {
	clear:both;	
}
.row {margin-bottom:10px;}

</style>
<script>
$(document).ready(function() {

	//move the image in pixel
	var move = -15;
	
	//zoom percentage, 1.2 =120%
	var zoom = 1.2;

	//On mouse over those thumbnail
	$('.itemu').hover(function() {
		
		//Set the width and height according to the zoom percentage
		width = $('.itemu').width() * zoom;
		height = $('.itemu').height() * zoom;
		
		//Move and zoom the image
		$(this).find('img').stop(false,true).animate({'width':width, 'height':height, 'top':move, 'left':move}, {duration:200});
		
		//Display the caption
		$(this).find('div.caption').stop(false,true).fadeIn(200);
	},
	function() {
		//Reset the image
		$(this).find('img').stop(false,true).animate({'width':$('.itemu').width(), 'height':$('.itemu').height(), 'top':'0', 'left':'0'}, {duration:100});	

		//Hide the caption
		$(this).find('div.caption').stop(false,true).fadeOut(200);
	});

});
////////slide in
$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});
</script>

<?php $user =Auth::user();?>
<section id="consultancy">
<div class="container">
	<div class="jumbotron">
    	<h2><i class="fa fa-heartbeat"></i> Transport Consultancy</h2>
        <p contenteditable="false" class="consa"> Transpartner Logistics' team of highly motivated and experienced 
        men and women dedicated to impart a competitive edge, is on hot standby to offer you a wide range of transport 
        consultancy services. Be it starting and managing freight or passenger companies, driver management, extended freight 
        forwarding services, assistance to acquire licences, market research or training services; we are ready for you.</p> 
        <h3>Talk to us today! Simply click on the header of the service that you want to know more about, fill in a quick-form and we will contact you</h3> 
    </div>  
<div class="row">
	<div class="col-md-4">
      <div class="itemu">
          <a href="#"><img src="/img/transport company.jpg" class="img-rounded" alt="how to start and manage a transport company"
           title="" width="340" height="250"/></a>
          <div class="caption">
          @if(Auth::user())
              <button class="btn-primary lg" data-toggle ="modal"
               data-target ="#consulModal" data-service ="Transport Company" >         
              Click for Start and Manage a Transport Co.</button>
           @else
           <a href="/login-for-consultancy" class="btn btn-primary lg">Click for Start and Manage a Transport Co.</a>  
           @endif 
              <p>
              <li>Running a Passenger Company</li>
              <li>Running a Freight Company</li>
              <li>Start & Manage a Transport Company</li>
              </p>
          </div>
      </div>
    </div>
     <div class="col-md-4">
      <div class="itemu" id="extended-freight">
          <a href="#"><img src="/img/extended freight forwarding services.jpg" class="img-rounded" alt="extended freight forwarding services" width="340" height="250"/></a>
          <div class="caption">
          @if(Auth::user())          
              <button class="btn-primary lg" data-toggle ="modal"
               data-target ="#consulModal" data-service ="Extended Freight Forwarding Services" >
              Click for Extended Freight Forwarding Services</button>
           @else
           <a href="/login-for-consultancy" class="btn btn-primary lg">Click for Extended Freight Forwarding Services</a>  
           @endif              
              <ul>
                <li>Customs Clearance:</li> 
                <li>Other Vital Documentation</li>
                <li>We can identify documentation requirements</li>
                <li>We can make necessary arrangements on your behalf</li>
              </ul>
      </div>
     </div>
    </div>
     <div class="col-md-4">
      <div class="itemu">
          <a href="#"><img src="/img/driver management.jpg" class="img-rounded" alt="driver management" title="" width="340" height="250"/></a>
          <div class="caption">
          @if(Auth::user())           
              <button class="btn-primary lg" data-toggle ="modal"
               data-target ="#consulModal" data-service ="Driver Management" >
              Click for Driver Management</button>
           @else
           <a href="/login-for-consultancy" class="btn btn-primary lg">Click for Driver Management</a>  
           @endif               
              <p>
              <li>Ability Training</li>
              <li>Aptitude Training</li>
              <li>Attitude Training</li>
              </p>
          </div>
      </div>
    </div>
   </div>  
<div class="row  slideanim">
    <div class="col-md-4">
      <div class="itemu">
          <a href="#"><img src="/img/licences and permits.jpg" class="img-rounded" alt="assistance to acquire licences and permits" width="340" height="250"/></a>
          <div class="caption">
           @if(Auth::user()) 
              <button class="btn-primary lg" data-toggle ="modal"
               data-target ="#consulModal" data-service ="Licences and Permits" >
              Click for Assistance to Acquire Licences & Permits</button>
           @else
           <a href="/login-for-consultancy" class="btn btn-primary lg">Click for Assistance to Acquire Licences & Permits</a>  
           @endif               
              <p>
              <li>Operator's Licence and Permits</li>
              <li>Route Authority</li>
              <li>Vehicle Licence</li>
              </p>
          </div>
      </div>
    </div>
      
    <div class="col-md-4">
      <div class="itemu">
          <a href="#"><img src="/img/market research.jpg" class="img-rounded" title="market research" width="340" height="250"/></a>
          <div class="caption">
           @if(Auth::user()) 
              <button class="btn-primary lg" data-toggle ="modal"
               data-target ="#consulModal" data-service ="Market Research" >
              Click for Market Research:</button>
           @else
           <a href="/login-for-consultancy" class="btn btn-primary lg">Click for Market Research:</a>  
           @endif               
              <p>
                <ul>
                  <li>Be aware of Opportunites</li>
                  <li>Environment Threats</li>
                  <li>Strategy Formulation</li>
                  <li>Strategy Implementation & Control</li>
                </ul>
              </p>
          </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="itemu">
          <a href="#"><img src="/img/training.jpg" class="img-rounded" title="training" alt="training services" width="340" height="250"/></a>
          <div class="caption">
           @if(Auth::user()) 
              <button class="btn-primary lg" data-toggle ="modal"
               data-target ="#consulModal" data-service ="Training" >
              Click for Training Services For:</button>
           @else
           <a href="/login-for-consultancy" class="btn btn-primary lg">Click for Training Services For:</a>  
           @endif           
              <p>
              		<ul>
                    <li>Transport Managers</li>
                    <li>Drivers</li>
                    <li>Supervisors</li>
                    <li>Office Bearers</li>
                    <li>Transport Practioneers</li>
                    </ul>
              </p>
          </div>
      </div>
    </div>
   </div>
      
 </div> 
</section>

 <script>
 $('button[data-toggle=modal]').click(function(){
	 var services = $(this).data('service');
	$('#requirements').val(services);
 });
</script>
 
@include('inc.modals.consul_modal')
@stop