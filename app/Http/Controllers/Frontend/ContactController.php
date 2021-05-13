<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\WishList;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function lienHe()
   {
         $countProductFavorites = WishList::where('pf_user_id', get_data_user('web'))->count();
         $slide = Slide::limit(1)->first();

         $viewData = [
            'slide'                 => $slide,
            'countProductFavorites' => $countProductFavorites
         ];
      return view('frontend.contact.index', $viewData);
   } 
}
