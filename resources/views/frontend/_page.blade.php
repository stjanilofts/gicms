@if(isset($page))
	<h1>{{ $page->title }}</h1>

	{!! cmsContent($page) !!}

	@if(\Request::is('hafa-samband'))
		@include('frontend.forms.contact')
	@endif
@endif