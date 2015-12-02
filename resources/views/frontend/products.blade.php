@extends('frontend.layout')

@section('crumbs')

	@include('frontend._crumbs', ['crumbs'=>crumbs()])

@stop

@section('content')

	@include('frontend._products', ['items'=>$items])

@stop