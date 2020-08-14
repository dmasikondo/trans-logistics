@extends('layouts.app')

@section('content')
	<director-component :user="{{$user}}"></director-component>
@endsection