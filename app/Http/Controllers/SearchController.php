<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class SearchController extends Controller
{
    public function searchBlog(Request $request){
        $search = $request->keyword;
        $blogs = Blog::where('title', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.pages.blog.listBlog',compact('blogs'));
    }
}
