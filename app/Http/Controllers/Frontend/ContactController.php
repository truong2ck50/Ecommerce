<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function lienHe()
   {
      
         $slide = Slide::limit(1)->first();

         $viewData = [
            'slide' => $slide
         ];
      return view('frontend.contact.index', $viewData);
   } 
}
