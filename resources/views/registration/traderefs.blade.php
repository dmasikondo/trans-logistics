@extends('layouts.app')

@section('content')
	<traderef-component :user="{{$user}}"></traderef-component>
@endsection