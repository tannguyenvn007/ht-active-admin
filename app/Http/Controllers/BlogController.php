<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at','desc')->paginate(5);
        return view('admin.pages.blog.listBlog',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.pages.blog.addBlog',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|unique:blogs',
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => "This Title field can't empty",
                'title.unique' => "This Title field already exist",
                'content.required' => "This Description field can't empty",
                'image.required' => "This Image field can't empty",
                'image.image' => "Please choose image",
                'image.mimes' => "Please choose jpeg,png,jpg,gif,svg files",
                'image.max' => "Please choose image size < 2048MB",
            ]
        );
        $blog = new Blog();
        $blog->title = $request->title;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("images".$image)){
                $image = str_random(4)."_".$name;
            }
            $file->move("images",$image);
            $blog->image = $image;
        } else {
            $blog->image = "";
        }
        $blog->content = $request->content;
        $blog->userId = Auth::user()->id;
        $blog->save();

        return redirect()->route('add-blog')->with('message','Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('admin.pages.blog.detailsBlog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $user = Auth::user();
        return view('admin.pages.blog.editBlog',compact('blog','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => "This Title field can't empty",
                'content.required' => "This Description field can't empty",
            ]
        );
        $blog = Blog::find($id);
        $blog->title = $request->title;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("images".$image)){
                $image = str_random(4)."_".$name;
            }
            $file->move("images",$image);
            unlink("images/".$blog->image);
            $blog->image = $image;
        }
        $blog->content = $request->content;
        $blog->userId = Auth::user()->id;
        $blog->save();

        return redirect()->route('get-edit-blog',['id' => $id])->with('message','Add Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return redirect()->route('blog')->with('message','Deleted Successfully');
    }
}
