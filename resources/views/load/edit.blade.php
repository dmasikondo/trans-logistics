@extends('layouts.app')
@section('content')
	<load-component :user="{{$load->user}}" :freight="{{$load}}" :edit-mode="true"></load-component>
@endsection
