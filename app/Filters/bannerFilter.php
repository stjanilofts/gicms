<?php namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class bannerFilter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
   		return $image->fit(1400, 700)
   		  ->greyscale()
   		  //->colorize(25, 0, 0)
   		  ->blur(50)
   		  ->gamma(3.5);
    }
}