@extends('layouts.app')
@section('content')
	<div class="container">
   		<div class="row">
        <?php $var=['one','two','three','four','five'];?>
		@include('partials.lane_asideleft')
        <div class="col-md-8">
      @foreach($var as $varb)
        
        	<div class="col-md-6">
              <div class="blog" transition="expand">
                <div class="blog-item" style="margin-top:2%;" >
                <div class="text-center  well">
                    <div class="entry-meta">
                        <span id="publish_date">Liked ~ bla</span>
               
                        <span><i class="fa fa-user"></i> <a href="/admin/users/$bid->user->username">bid->user->username</a></span>
                        <span><i class="fa fa-compressed"></i> <a href="/admin/users/bid->user->username"><strong>Company: </strong>bid->user->organisation</a></span>
                        <span><i class="fa fa-phone"></i><a href="#">
                      	<strong>Contact: </strong>bid->user->contact_phone / <strong>Whatsapp:</strong> bid->user->whatsapp</a></span>
                      	<span><i class="fa fa-envelope-o"></i><a href="mailto:bid->user->email">
                        <strong>Contact Mail: </strong>bid->user->email</a></span> 
                   </div> 
                   <span class="badge">1 of 3 </span>                       
                </div>            
            </div>
           </div>
          </div>
           @endforeach
       </div> 
  
@include('partials.lane_asideright')                      
   		</div>
    
	</div>

@stop