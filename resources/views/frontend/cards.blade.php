@extends('frontend.layout')

@section('crumbs')

	@include('frontend._crumbs', ['crumbs'=>crumbs()])

@stop

@section('content')

	<div class="container">

		@foreach($subs as $sub)

			@include('frontend._image-card', ['item'=>$sub])

		@endforeach

	</div>
	
@stop