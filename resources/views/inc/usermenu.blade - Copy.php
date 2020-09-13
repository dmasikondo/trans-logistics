  
        @if(Auth::user()->hasRole('shipper'))
        <li {{(Request::is('myfreight') ? 'class=active' : '')}}>
            <a href="/myfreight" class="list-group-item list-group-item-success">
            	<i class="glyphicon glyphicon-briefcase"></i> My Freight</a>
         </li>
         <li>
            <a href="/freights/create" class="list-group-item list-group-item-success">
            	<i class="glyphicon glyphicon-send"></i> Upload Consignment</a>
         </li>
         <li>
            <a href="#" class="list-group-item list-group-item-success">            
            	<i class="glyphicon glyphicon-cog"></i> Settings</a>
        </li>
    @endif
        @if(Auth::user()->hasRole('carrier'))
         <li>
            <a href="#" class="list-group-item list-group-item-success">
            	<i class="glyphicon glyphicon-shopping-cart"></i> My bids</a>
         </li>
         <li>
            <a href="/freights" class="list-group-item list-group-item-success">
            	<i class="glyphicon glyphicon-briefcase"></i> Find Truck Load</a> 
         </li>
         <li>
            <a href="/lanes/create" class="list-group-item list-group-item-success">
            	<i class="glyphicon glyphicon-road"></i> Find Pay Loads</a> 
         </li>         
         <li>               
            <a href="#" class="list-group-item list-group-item-success">
            	<i class="glyphicon glyphicon-cog"></i> Settings</a>
          </li>
    @endif
        @if(Auth::user()->hasRole('admin'))
     <li class="dropdown">
    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
           Users <span class="caret"></span>
     	</a>    
 
    <ul class="dropdown-menu" role="menu">
      <li  {{(Request::is('admin/users') ? 'class=active' : '')}}><a href="/admin/users">All Users</a></li>
      <li><a href="/admin/roles">Carriers</a></li>
      <li><a href="/admin/roles">Shippers</a></li>
      <li><a href="/admin/roles">Admin</a></li>
    </ul>
  </li>
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="{{action('UsersController@nofleet')}}">Awaiting Fleet Info</a></li>
      <li><a href="{{action('UsersController@noprofile')}}">Awaiting Co. Profiles</a></li>
      <li><a href="#/admin/roles">Awaiting Profile Filling</a></li>
      <li><a href="#/admin/roles">Completely registered</a></li>
      <li><a href="#/admin/roles">All Users</a></li>
    </ul>
  </li>  
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bids
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#/admin/roles">New</a></li>
      <li><a href="#/admin/users">Awaiting Co. Profiles</a></li>
      <li><a href="#/admin/roles">Awaiting Profile Upload</a></li>
       <li><a href="#/admin/roles">Awaiting Admin Filling</a></li>
      <li><a href="#/admin/roles">Completely registered</a></li>
      <li><a href="#/admin/roles">All Users</a></li>
    </ul>
  </li> 
  <li class="dropdown  {{(Request::is('freights')||Request::is('freights/unlisted')
      	||Request::is('freights/archived') ||Request::is('myfreight')
         ||Request::is('freights/all') ? 'active' : '')}}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Freight
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li {{(Request::is('freights') ? 'class=active' : '')}}><a href="/freights">Listed</a></li>
      <li {{(Request::is('freights/unlisted') ? 'class=active' : '')}}><a href="{{action('FreightController@unlisted')}}">Awaiting Listing</a></li>
      <li {{(Request::is('freights/archived') ? 'class=active' : '')}}><a href="{{action('FreightController@freightarchive')}}">Archived</a></li>
      <li {{(Request::is('myfreight') ? 'class=active' : '')}}><a href="{{action('FreightController@myfreight')}}">My Freight</a></li>
      <li {{(Request::is('freights/all') ? 'class=active' : '')}}><a href="{{action('FreightController@all')}}">All Freight</a></li>
    </ul>
  </li>  
  <li><a href="#">Consultancy Requests</a></li>

    @endif


