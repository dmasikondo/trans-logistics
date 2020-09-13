<style>
.nav-tabs > li > a{ background: #8DC975;}
 .nav-tabs > li > a:hover{
	background-color: #518252;
  color: #FFFFFF;
}
</style>  

        @if(Auth::user()->hasRole('admin'))
       
   <ul class="nav nav-tabs">
  <li class="dropdown  {{(Request::is('admin/users')||Request::is('admin/roles') ? 'active' : '')}}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Users
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li  {{(Request::is('admin/users') ? 'class=active' : '')}}><a href="/admin/users">All Users</a></li>
      <li><a href="/admin/carriers">Carriers</a></li>
      <li><a href="/admin/shippers">Shippers</a></li>
      <li><a href="/admin/admins">Admin</a></li>
    </ul>
  </li>
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="/nofleet">stage1: Awaiting Fleet Info</a></li>
      <li><a href="/noprofile">Stage2: Awaiting Co. Profiles</a></li>
      <li><a href="/nodirector">Stage3: Awaiting Directors Info</a></li>
      <li><a href="/notraderef">Stage4: Awaiting TradeRef Info</a></li>
      <li><a href="/complete_reg">Completely Registered</a></li>
      <li><a href="/admin/users">All Users</a></li>
    </ul>
  </li>  
  <li class="dropdown  {{(Request::is('freights')||Request::is('freights/unlisted')
      	||Request::is('freights/archived') ||Request::is('myfreight')
         ||Request::is('freights/all') ? 'active' : '')}}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Freight
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li {{(Request::is('freights') ? 'class=active' : '')}}><a href="/freights">Published</a></li>
      <li {{(Request::is('freights/unlisted') ? 'class=active' : '')}}><a href="{{action('FreightController@unlisted')}}">Awaiting Publishing</a></li>
      <li {{(Request::is('freights/archived') ? 'class=active' : '')}}><a href="{{action('FreightController@freightarchive')}}">Hidden</a></li>
      <li {{(Request::is('myfreight') ? 'class=active' : '')}}><a href="{{action('FreightController@myfreight')}}">My Freight</a></li>
      <li {{(Request::is('freights/all') ? 'class=active' : '')}}><a href="{{action('FreightController@all')}}">All Freight</a></li>
       <li {{(Request::is('freights/create') ? 'class=active' : '')}}><a href="{{action('FreightController@create')}}">Upload Freight</a></li>
    </ul>
  </li>  
    <li class="dropdown  {{(Request::is('ranes')||Request::is('ranes/notpublished')
      	||Request::is('ranes/lanestore') ||Request::is('ranes/mylane') ||Request::is('ranes/create')||Request::is('ranes/{id}')
         ||Request::is('ranes/all') ? 'active' : '')}}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">PayLoad Vehicles
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li {{(Request::is('ranes') ? 'class=active' : '')}}><a href="/ranes">Published</a></li>
      <li {{(Request::is('ranes/notpublished') ? 'class=active' : '')}}><a href="/ranes/notpublished">Awaiting Publishing</a></li>
      <li {{(Request::is('ranes/lanestore') ? 'class=active' : '')}}><a href="/ranes/lanestore">Hidden</a></li>
      <li {{(Request::is('ranes/mylane') ? 'class=active' : '')}}><a href="/ranes/mylane">My PayLoad Vehicles</a></li>
      <li {{(Request::is('ranes/all') ? 'class=active' : '')}}><a href="/ranes/all">All Vehicles</a></li>
       <li {{(Request::is('ranes/create') ? 'class=active' : '')}}><a href="/ranes/create">Upload Vehicle</a></li>
    </ul>
  </li> 
      <li><a href="/freights/bids">Bids</a></li>
  <li><a href="/consultancy/requests">Consultancy Requests</a></li>
    <li class="dropdown  {{(Request::is('articles')||Request::is('created/{period}')
      	||Request::is('articleby/{username}') ||Request::is('article/{tag}') ||Request::is('articl/myarticles')||Request::is('articl/allarticles')
       || Request::is('articl/unpublished')||Request::is('articl/published') ||Request::is('articl/publish') ? 'active' : '')}}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">News
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li {{(Request::is('articl/unpublished') ? 'class=active' : '')}}><a href="/articl/unpublished">Awaiting Publishing</a></li>
      <li {{(Request::is('articl/published') ? 'class=active' : '')}}><a href="/articl/published">Published</a></li>
      <li {{(Request::is('articl/myarticles') ? 'class=active' : '')}}><a href="/articl/myarticles">My Articles</a></li>
      <li {{(Request::is('articl/allarticles') ? 'class=active' : '')}}><a href="/articl/allarticles">All Articles</a></li>
       <li {{(Request::is('articles/create') ? 'class=active' : '')}}><a href="/articles/create">Create a New Article</a></li>
    </ul>
  </li>  
</ul>
    @endif
