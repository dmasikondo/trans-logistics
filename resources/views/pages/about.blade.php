@extends('layouts.app')
@section('title','About freight forwarding and transport consultancy')
@section('content')
<section id="about-us">
        <div class="container">
      <div class="about center wow fadeInDown">
        <h2>About Transpartner Logistics</h2>
        <p class="lead"> We are a Southern Africa based Logistics, Freight Forwarding and Transport Consultancy Company </p>
      </div>
<!-- Our Skill -->
      <!--<div class="skill-wrap clearfix">-->
      
        <div class="wow fadeInDown">
          <h2>Our Legacy</h2>
          <p class="lead">Transpartner Logistics (Pvt) Ltd (TPL), is a private company, which is fully registered
                    under the Company Act Chapter 24:03 and also with Zimra for the submission of statutory payments. It
                    was incoporated in 2011. Essentially the company is a connected web of freight carriers who owns and operates 
                    hundreds of trucks within and across Zimbabwe.
                      <ul>
                          <li>
                              The core busines is logistics and transport consultancy.
                            </li>
                          <li>
                              It provides logistics services to supply chains, service institutions, NGOs and government department. 
                            </li> 
                            <li>
                               It offers freight forwarding and brokerage services
                            </li> 
                             <li>
                                It provides vehicle tracking and insurance
                             </li>  
                               <li>
                                 It serves to assist start-ups to pitch and gain a foothold in transport market, diagnose and solve transport problems affecting current transport operators as well as marketing vehicle tracking.
                               </li>
                          <li>
                              It is to market freight services. We are really a link between those with goods looking for 
                                transport and trucking companies looking for return loads in Zimbabwe and Southern Africa. Its wide network
                                and integration comprising sales representatives in various cities in Zimbabwe and sea ports in SADC made it
                                a distinctive logistics market oriented company.
                            </li>                                                       
                        </ul>
                    </p>
        </div>            
      
    <!--</div>-->
<!-- our-team -->

      <div class="team">
        <div class="center wow fadeInDown">
          <h3>Transpartner Logistics Values</h3>
          <p style="text-align:left;">As freight forwarders, we firmly believe that we are as good as our designated carriers.
                    Therefore, all carriers or hauliers are referenced and scrutinised before we offer them our consignments.</p>
        </div>

        <div class="row">
          <div class="col-md-6"> 
            <div class="single-profile-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="media">
                <div class="float-left">
                  <a href="#"><img class="media-object img-rounded" src="/images/vision.jpg" alt="Transpartner Logistics Vision"></a>
                </div>
                <div class="media-body">
                  <h4>Our Vision</h4>
                  <h5>Your Preferred Logistics Partner</h5>
                  <ul class="tag clearfix">
                    <li class="btn"><a href="#">Professionalism</a></li>
                    <li class="btn"><a href="#">Integrity</a></li>
                    <li class="btn"><a href="#">Reliability</a></li>
                  </ul>
                  
                  <ul class="social_icons">
                    @include('inc.social_icons')
                  </ul>
                </div>
              </div><!--/.media -->
              <p>To be the the leading freight forwarding and transport consultancy company in Southern Africa.</p>
                            <p>&nbsp;</p>
            </div>
          </div><!--/.col-lg-4 -->
          
          
          <div class="col-md-6"> 
            <div class="single-profile-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="media">
                <div class="float-left">
                  <a href="#"><img class="media-object img-rounded" src="/images/mission.jpg" 
                                    alt="Transpartner logistics mission"></a>
                </div>
                <div class="media-body">
                  <h4> We are on a mission</h4>
                  <h5>Your Preferred Logistics Partner</h5>
                  <ul class="tag clearfix">
                    <li class="btn"><a href="#">Reliability</a></li>
                    <li class="btn"><a href="#">Integrity</a></li>
                  </ul>
                  <ul class="social_icons">
                    @include('inc.social_icons')
                  </ul>
                </div>
              </div><!--/.media -->
              <p>To provide cost effective and reliable transportation of different goods in Zimbabwe and SADC region. 
                            We aim to train transport practioners and provide lasting solutions to transport challenges.</p>
            </div>
          </div><!--/.col-lg-4 -->          
        </div> <!--/.row -->
        <div class="row team-bar">
          <div class="first-one-arrow hidden-xs">
            <hr>
          </div>
          <div class="first-arrow hidden-xs">
            <hr> <i class="fa fa-angle-up"></i>
          </div>
          <div class="second-arrow hidden-xs">
            <hr> <i class="fa fa-angle-down"></i>
          </div>
          <div class="third-arrow hidden-xs">
            <hr> <i class="fa fa-angle-up"></i>
          </div>
          <div class="fourth-arrow hidden-xs">
            <hr> <i class="fa fa-angle-down"></i>
          </div>
        </div> <!--skill_border-->       

        <div class="row">   
          <div class="col-md-6"> 
            <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
              <div class="media">
                <div class="float-left">
                  <a href="#"><img class="media-object img-rounded" src="/images/concern.jpg" 
                                    alt="Transpartner logistics concern"></a>
                </div>

                <div class="media-body">
                  <h4>Our Concern</h4>
                  <h5>Your Preferred Logistics Partner</h5>
                  <ul class="tag clearfix">
                    <li class="btn"><a href="#">Expertise</a></li>
                    <li class="btn"><a href="#">Team Work</a></li>
                  </ul>
                  <ul class="social_icons">
                    @include('inc.social_icons')
                  </ul>
                </div>
              </div><!--/.media -->
              <p>Service and attention to quality is The Transpartner Logistics difference that you
                            can expect and count on us. In this age, it is becoming increasingly difficult to 
                            find services you can trust. So we take this very seriously.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
              <div class="media">
                <div class="float-left">
                  <a href="#"><img class="media-object img-rounded" src="/images/our way.jpg" 
                                    alt="Transpartner logistics way"></a>
                </div>
                <div class="media-body">
                  <h4>Our way</h4>
                  <h5>Your Preferred Logistics Partner</h5>
                  <ul class="tag clearfix">
                    <li class="btn"><a href="#">Expertise</a></li>
                    <li class="btn"><a href="#">Team Work</a></li>
                    <li class="btn"><a href="#">Service Excellence</a></li>
                  </ul>
                  <ul class="social_icons">
                    @include('inc.social_icons')
                  </ul>
                </div>
              </div><!--/.media -->
              <p> <strong>Safe and Reliable</strong> - Legal compliancy, authenticity and availability. <strong>Team work</strong>
                            - Our goal is excellency through team work. <strong>Great efficiency</strong> - Quality consultancy and arbitraging services</p>
            </div>
          </div>
        </div>  <!--/.row-->                
         </div>   
  </div>
  <div class="container wow fadeInRight delay-05s mt-4">
    <h4>Why Transport Customers Adore Us</h4>
<div id="accordion" style="letter-spacing: 1px;">
  <div class="card">
    <div class="card-header" id="headingOne text-white bg-primary">
      <h2 class="mb-0">
        <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Adherence to Moral Principles 
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <h5>Integrity and ethics</h5>

        We pride ourselves in managing our business through principles of integrity and emphasise ethical business practice. Our passion is transporting goods on behalf of our Clients in such a manner that they are thoroughly satisfied. We believe in providing a business solution that is tailored specifically to meet our dedicated clients' transport needs.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Cost Effectiveness 
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Our team of professionals has knowledge and experience to select the most appropriate and cost effective method of transport for your goods. In dealing with us you can drastically reduce shipping costs and simplify your operations. With our vast knowledge of international transport, our access to the best rates of carriage and ability to consolidate shipment, we can help you to cut the cost of international shipping. 
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Insurance Cover
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        As is widely known that insurance cover for goods is extremly important and your goods have to have adequate insurance cover whilst in transit or storage. At Transpartner Logistics, we can arrange insurance for your goods. 
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Operational Efficiency
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
        Our partners and affliates around the world are established organisations providing various solutions. They are experts in business improvement, engineering and software development, project management as well as in numerous international standards. They share our philosophy of ensuring maximum gain to our customers. 
      </div>
    </div>
  </div> 
  <div class="card">
    <div class="card-header" id="headingFive">
      <h2 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Reliability and Security
        </button>
      </h2>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
      <div class="card-body">
        As freight forwarders, we firmly believe that we are as good as our designated carriers. Therefore, all hauliers are referenced and carefully verified before we offer them any work. As an established business we put a strong emphasis on our reputation.  
      </div>
    </div>
  </div> 
  <div class="card">
    <div class="card-header" id="headingSix">
      <h2 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          Convinience to Shippers and Carriers 
        </button>
      </h2>
    </div>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
      <div class="card-body">
        We allow our clients to find offers both ways; suitable freight to carry that suit your vehicle at a competitive rates, and available vehicle space for shippers (customer with goods looking for trucks). This is conducted at affordable rates whereby you only pay for the actual distance covered. Rates bidding is also allowed.2 
      </div>
    </div>
  </div>     
</div>                     
                  
  </div>
  </section>
@stop     