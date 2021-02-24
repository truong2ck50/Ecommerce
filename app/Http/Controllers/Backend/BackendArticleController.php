<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendArticleController extends Controller
{
    protected $folder = 'backend.article.';
    public function index() {
        return view($this->folder.'index');
    }

    public function create() {
        return view($this->folder.'create');
    }

    public function store() {

    }

    public function edit($id) {
        return view($this->folder.'update');
    }

    public function update($id) {

    }

    public function delete($id) {
        
    }
}
