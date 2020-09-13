@extends('layouts.app')
@section('title','For exceptional national and cross border freight transport')
@section('content')
<style>
/* Services
---------------------------------*/
h2{	font-size:44px;
	color:#222222;
	font-family: 'Montserrat', sans-serif;
	font-weight:700;
	letter-spacing: -1px;
	margin:0 0 15px 0;
	text-align:center;
	text-transform:uppercase;
	}
h6{
	font-size:38px;
	color:#888888;
	font-family: 'Open Sans', sans-serif;
	font-weight:400;
	text-align:center;
	margin:0 0 60px 0;
}
.service-list{
	padding:0 0 0 0;
	font-size:14px;
	margin-bottom:40px;
}
.service-list-col1{
	float:left;
	width:60px;
}
.service-list-col1 i{
	font-style:normal;
	font-size:38px;
	display:block;
	color:#222;
	font-family: 'FontAwesome';
	line-height:38px;
}
.service-list-col2{
	overflow:hidden;	
}
.main-section.alabaster{
	background:#fafafa;
}
/* Featured Work
---------------------------------*/
.featured-work{
	font-size:14px;
}
.featured-work h2{
	text-align:left;
}
.featured-box{
	padding:0 0 0 0;
	margin-bottom:25px;
	font-size:14px;
}
.featured-box h3{
	margin-bottom:5px;
}
.featured-box p{
	line-height:22px;
}
.featured-work p.padding-b{
	padding-bottom:35px;
}
.featured-box-col1{
	width:60px;
	float:left;
}
.featured-box-col1 i{
	display:block;
	line-height:38px;
	font-family: 'FontAwesome';
	font-size:38px;
	color:#777777;
	font-style:normal;
}
.featured-box-col2{ overflow:hidden;}
.featured-box.magic{
	background:url(../img/magic.png) left top no-repeat;
}
.featured-box.packaged{
	background:url(../img/packaged.png) left top no-repeat;
}
.featured-box.seo{
	background:url(../img/seo.png) left top no-repeat;
}
.Learn-More{
	display:inline-block;
	padding:0 5px 0 0;
	color:#7cc576;
	font-size:16px;
	text-transform:uppercase;
	font-family: 'Montserrat', sans-serif;
	font-weight:400;
	line-height:24px;
	transition:all 0.3s ease-in-out;
	-moz-transition:all 0.3s ease-in-out;
	-webkit-transition:all 0.3s ease-in-out;
	display: none;
}
.Learn-More i{ 
	padding-right:15px;
}

.Learn-More:hover, .Learn-More:focus{ 
	text-decoration:none;
	color: #111;
}



</style>
@section('content')
<section class="main-section" id="service"><!--main-section-start-->
	<div class="container">
    	<h2 style="font-size:30px;">Services</h2>
    	<h6 style="font-size:18px; line-height:30px; margin-bottom:40px; border-bottom: 2px solid #2F93CF;">
        We offer exceptional national and cross border road freight transport. Not only can we arrange safe
        and secure transport, we can also provide a full range of service to make the whole transport process as smooth 
      as possible.</h6>
        <div class="row">
        	<div class="col-lg-4 col-sm-6 wow fadeInLeft delay-05s">
            	<div class="service-list">
                	<div class="service-list-col1">
                   	  <i class="fa-fax"></i>
                    </div>
                	<div class="service-list-col2">
                        <h3>Office to Office Deleveries</h3>
                        <p>We have managed to stay on top of travel plans and package delivery hassles.</p>
                    </div>
                </div>
                <div class="service-list">
                	<div class="service-list-col1">
                   	  <i class="fa-cube"></i>
                    </div>
                	<div class="service-list-col2">
                        <h3>Containerised Cargo</h3>
                        <p>Has been greatly simplified by our easy access to flat bed and drop side fleet.</p>
                    </div>
                </div>
                <div class="service-list">
                	<div class="service-list-col1">
                   	  <i class="fa-cubes"></i>
                    </div>
                	<div class="service-list-col2">
                        <h3>Break Bulk Cargo</h3>
                        <p>Transported in bags, boxes, crates, drums, barrels.</p>
                    </div>
                </div>
                <div class="service-list">
                	<div class="service-list-col1">
                   	  <i class="fa-bomb"></i>
                    </div>
                	<div class="service-list-col2">
                        <h3>Hazardous Cargo</h3>
                        <p>Dangerous goods in solid, liquid and gaseous format.</p>
                    </div>
                </div>
                <div class="service-list">
                	<div class="service-list-col1">
                   	  <i class="fa-cart-plus"></i>
                    </div>
                	<div class="service-list-col2">
                        <h3>Express Cargo</h3>
                        <p>We have been providing high priority logistics services to mining, petroleum, manufacturing
                         and other like sector clients.</p>
                    </div>
                </div>   
                <div class="service-list">
                	<div class="service-list-col1">
                   	  <i class="fa-spinner"></i>
                    </div>
                	<div class="service-list-col2">
                        <h3>Delivery Destinations</h3>
                        <p>Over the years we have been arranging deliveries to retailers, mines, schools and companies</p>
                    </div>
                </div>                              
            </div>
            <figure class="col-lg-8 col-sm-6  text-right wow fadeInUp delay-02s">
            	<img src="/img/transpartner_logistics_services.jpg" alt="" class="img-thumbnail">
            </figure>
         <div class="col-lg-7 col-lg-offset-1 col-sm-6 wow fadeInRight delay-05s">
                    <div class="accordion">
                        <h2>Why Transport clients like us?</h2>
                        <div class="panel-group" id="accordion1">
                          <div class="panel panel-default">
                            <div class="panel-heading active">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                  Adherence to Moral Principles
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>

                            <div id="collapseOne1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                  <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="/img/adherence to moral principles.jpg">
                                        </div>
                                        <div class="media-body">
                                             <h4>Integrity and ethics</h4>
                                             <p>We pride ourselves in managing our business through principles of integrity and emphasise ethical
                                             business practice. Our passion is transporting goods on behalf of our Clients in such a manner that they
                                             are thoroughly satisfied. We believe in providing a business solution that is tailored specifically to meet
                                             our dedicated clients' transport needs. </p>
                                        </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                  Cost Effectiveness
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                              <div class="panel-body">
                                Our team of professionals has knowledge and experience to select the most appropriate and
                                cost effective method of transport for your goods. In dealing with us you can drastically
                                reduce shipping costs and simplify your operations. With our vast knowledge of international
                                transport, our access to the best rates of carriage and ability to consolidate shipment, we 
                                can help you to cut the cost of international shipping.
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                  Insurance Cover
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                              <div class="panel-body">
                                 As is widely known that insurance cover for goods is extrem;y important and your goods have to have
                                 adequate insurance cover whilst in transit or storage. At Transpartner Logistics, we can arrange insurance 
                                 for your goods.
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                  Operational Efficiency
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                              <div class="panel-body">
                                Our partners and affliates around the world are established organisations providing various solutions. They are 
                                experts in business improvement, engineering and software development, project management as well as in 
                                numerous international standards. They share our philosophy of ensuring maximum gain to our customers.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFive1">
                                  Reliability and security
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFive1" class="panel-collapse collapse">
                              <div class="panel-body">
                                As freight forwarders, we firmly believe that we are as good as our designated carriers. Therefore, all 
                                hauliers are referenced and carefully verified before we offer them any work. As an established business 
                                we put a strong emphasis on our reputation.
                              </div>
                            </div>
                          </div> 
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseSix1">
                                  Convinience to Shippers and Carriers
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseSix1" class="panel-collapse collapse">
                              <div class="panel-body">
                                We allow our clients to find offers both ways; suitable freight to carry that suit your 
                                vehicle at a competitive rates, and available vehicle space for shippers (customer with goods
                                looking for trucks). This is conducted at affordable rates whereby you only pay for the actual
                                 distance covered. Rates bidding is also allowed.
                              </div>
                            </div>
                          </div>                                                    
                        </div><!--/#accordion1-->
                    </div>
                </div>        
        </div>
       
   
    
    </div>
    <h2> <a href="/freights/create " class="btn btn-success"> Upload You Consignment For Carriage Now </a>
    <a href="/consultancy " class="btn btn-success"> Check on Consultancy Services </a> </h2>
</section><!--main-section-end-->






@stop