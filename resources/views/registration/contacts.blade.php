@extends('layouts.app')

@section('content')
	<contact-component :user="{{$user}}"></contact-component>
@endsection