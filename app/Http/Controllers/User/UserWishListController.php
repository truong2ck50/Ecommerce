<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserWishListController extends Controller
{
   public function index()
   {
       $wishLists = WishList::with('product')->where('pf_user_id', get_data_user('web'))
            ->orderByDesc('id')->get();

        $viewData = [
            'wishLists' => $wishLists
        ];
       return view('user.wishlist.index', $viewData);
   }

   public function addToWishList($id)
   {
        $favoriteExist = WishList::where(['pf_product_id' => $id, 'pf_user_id' => get_data_user('web')])->first();

        if($favoriteExist)
        {
            return redirect()->back()->with('danger', 'Đã thêm vào yêu thích');
        }

        $idFavorite = WishList::create([
            'pf_user_id'    => get_data_user('web'),
            'pf_product_id' => $id,
            'created_at'   => Carbon::now()
        ]);

        if($idFavorite)
        {
            return redirect()->back()->with('success', 'Thêm vào yêu thích thành công');
        }

        return redirect()->back()->with('danger', 'Thêm vào yêu thích thất bại');
   }

   public function delete($id)
   {
       DB::table('products_favorite')->where('id', $id)->delete();
       return redirect()->back()->with('success', 'Đã xoá sản phẩm yêu thích thành công');
   }
}
