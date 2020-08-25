@extends('layouts.app')

@section('content')
	<load-component :user="{{$user}}" :freight=Object></load-component>
@endsection