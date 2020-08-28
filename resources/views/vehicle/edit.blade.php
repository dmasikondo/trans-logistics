@extends('layouts.app')

@section('content')
	<vehicle-component :vehicle='{{$vehicle}}' :edit-mode='true'></vehicle-component>">
@endsection