@extends('layouts.app')

@section('content')
	<profile-component :uzer="{{$user}}"></profile-component>
@endsection