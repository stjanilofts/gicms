<?php 

$prefix = '';

if(isset($page) && $page->title) {
	$prefix = $page->title;
}

if(isset($category) && $category->title) {
	$prefix = $category->title;
}

if(isset($product) && $product->title) {
	$prefix = $product->title;
}

if(isset($item) && $item->title) {
	$prefix = $item->title;
}

?>
@if($prefix){{ $prefix }} | {{ config('formable.site_title') }}@else{{ config('formable.site_title') }}@endif