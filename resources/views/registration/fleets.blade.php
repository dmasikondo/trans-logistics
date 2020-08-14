@extends('layouts.app')

@section('content')
	<fleet-component :user="{{$user}}"></fleet-component>
@endsection