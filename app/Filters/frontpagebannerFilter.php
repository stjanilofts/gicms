<?php namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class frontpagebannerFilter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
   		return $image->fit(1400, 700)
   		  //->greyscale()
   		  //->colorize(0, 16, 0)
   		  //->blur(10)
        //->pixelate(256)
   		  ->contrast(-15)
   		  ->brightness(15)
   		  ->gamma(2);
    }
}