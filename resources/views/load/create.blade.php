@extends('layouts.app')

@section('content')
	<load-component :user="{{Auth::user()}}" :edit-mode="false"></load-component>
@endsection
