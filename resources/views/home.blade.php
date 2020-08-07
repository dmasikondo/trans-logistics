@extends('layouts.app')
<style scoped>
html,body{
 background: url(@{{asset('storage/images')}}/city_night.jpg) no-repeat;
background-size: cover;
height: 100%;
}

.container{
height: 100%;
align-content: center;
}
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>
                        <span class="fa fa-link"></span> Joining Transpartner Logistics...
                    </h1>
                </div>

                <div class="card-body">
                    <h2>Are you a ...
                        <button class="btn btn-default btn-lg">
                            <span class="fa fa-truck"  style="font-size:6em;"></span><br> Transport Carrier?
                        </button>
                    </h2>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/organisation-contacts?carrier=yes&{{uniqid()}}">
                                <span class="fa fa-check"  style="font-size:4em;"> Yes</span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="/organisation-contacts?carrier=no&{{uniqid()}}" class="text-danger">
                                 <span class="fa fa-remove"  style="font-size:4em;"> No</span>
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
</div>
@endsection
