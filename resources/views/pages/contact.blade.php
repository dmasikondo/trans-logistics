@extends('layouts.app')
@section('title','How to contact us via address, phone, whatsapp and social media')
@section('content')

<section id="contact-info">
    <div class="center">                
        <h2>Want to Reach Us?</h2>
        <p class="lead">We are available on <a href="https://www.facebook.com/transpartnerlogisticsZim">Facebook, </a> 
        <a href="https://twitter.com/TranspartnerLog">Twitter, </a> 
        <a href="https://www.linkedin.com/company/transpartner-logistics-company?trk=biz-companies-cym">LinkedIn,</a> 
        <a href="mailto: marketing@transpartnerlogistics.co.zw">Email, </a> Whatsapp and Phone</p>
    </div>
 </section>
 

                                                                                                      
<div class="container">
 <div class="row">
	<div class="col-lg-6 wow fadeInLeft">
		<div class="feature-wrap">
            <i class="fa fa-map-marker"></i>
            <h2>Physical Address</h2>
            <span>Transpartner Logistics (Pvt) Ltd<br>266 Empowerment Way, Willovale<br>Harare, Zimbabwe</span>                              
        </div>

		<div class="feature-wrap">
            <i class="fa fa-phone"></i>
            <h2>Phone No.s</h2>
            <span>+263 42933951<br>+263 772 930 514</span> <br> +263 772 930 514                            
        </div>   
		<div class="feature-wrap">
            <i class="fa fa-whatsapp"></i>
            <h2>Whatsapp</h2>
            <span> +263772930514 </span>                           
        </div>     
		<div class="feature-wrap">
            <i class="fa fa-envelope"></i>
            <h2>Email</h2>
            <span>info@transpartnerlogistics.co.zw<br>marketing@transpartnerlogistics.co.zw</span>                          
        </div>  
		<div class="feature-wrap">
            <i class="fa fa-clock-o"></i>
            <h2>Our Business Hours</h2>
            <span><strong>Monday - Friday:</strong> 8 am - 4.30 pm<br><strong>Sunday:</strong>  8 am - 4.30 pm.</span>                                     
        </div> 

	   </div>
        <div class="col-lg-6  wow fadeInUp delay-05s">
        	<div class="card">
                <div class="card-header">
                    <h2>Contact Us</h2>
                </div>
        		<div class="card-body">
            	<div class="form">

                	<form action="/send" method="post">
                   	 @csrf

                    <div class="form-group input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-user"></i></span> 
                        </div>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name', Auth::check()? auth()->user()->organisation : '') }}" required>
                        <label class="floating-label">Name</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                               
                    </div>    
					
					<div class="form-group input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-envelope"></i></span> 
                        </div>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"   value="{{ old('email', Auth::check()? auth()->user()->email : '')}}"  required>
                        <label class="floating-label">Email Address</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                               
                    </div> 

                    <div class="form-group input-group">
                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-newspaper-o"></i></span> 
                        </div>                        
                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" required rows="10">{{old('message')}}</textarea>
                        <label for="message" class="floating-label">Message</label>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                               
                    </div> 
                    <div class="form-group">
                    	<button class="btn btn-outline-info form-control" type="submit">Send Message</button>
                    </div>
                    </form>

			        <ul class="social_icons">
			        	<li class="twitter"><a href="https://twitter.com/TranspartnerLog"><i class="fa fa-twitter"></i></a></li>
			            <li class="facebook"><a href="https://www.facebook.com/transpartnerlogisticsZim"><i class="fa fa-facebook"></i></a></li>
			            <li class="facebook"><a href="https://www.linkedin.com/company/transpartner-logistics-company?trk=biz-companies-cym"><i class="fa fa-linkedin"></i></a></li>
			        </ul> 
                </div>        			
        		</div>
        	</div>
	
            </div>
        </div>
      </div>

@stop