<div class="container">

	@foreach($items as $item)

		@include('frontend._card', ['item'=>$item])

	@endforeach

</div>