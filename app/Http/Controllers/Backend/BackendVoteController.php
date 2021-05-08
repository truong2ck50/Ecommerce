<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BackendVoteController extends Controller
{
    public function index()
    {
        $votes = Vote::orderByDesc('id')->with('user:id,name', 'product:id,pro_name,pro_slug')->get();

        $viewData = [
            'votes' => $votes
        ];

        return view('backend.vote.index', $viewData);
    }

    public function delete($id)
    {
        DB::table('votes')->where('id', $id)->delete();
        return redirect()->route('get_backend.vote.index')->with('success','Xoá đánh giá thành công');
    }
}
