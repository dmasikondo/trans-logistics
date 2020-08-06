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
   <contact-component user="{{Auth::user()}}"></contact-component>
</div>
@endsection
