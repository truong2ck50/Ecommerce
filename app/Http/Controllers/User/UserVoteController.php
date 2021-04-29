<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Vote;
use App\Models\Product;
use Illuminate\Http\Request;

class UserVoteController extends Controller
{
    public function create($productID)
    {
        $pro = Product::find($productID);
        $viewData = [
            'pro' => $pro
        ];

        return view('user.vote.create', $viewData);
    }
    public function  store(Request $request, $productID)
    {
        $vote = Vote::create([
            'v_user_id'    => get_data_user('web'),
            'v_product_id' => $productID,
            'v_number'     => $request->v_number,
            'v_content'    => $request->v_content,
            'created_at'   => Carbon::now()
        ]);
        if($vote)
        {
            $product = Product::find($productID);
            $product->pro_review_total++;
            $product->pro_review_star += $request->v_number;
            $product->save();
        }

        return redirect()->back()->with('success', 'Đánh giá thành công!');
    }
}
