<?php

namespace App\Http\Controllers;
use App\Portfolio;
use App\CategoryService;
use Illuminate\Http\Request;

class PortfoliosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.pages.portfolios.listPortfolios',compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryService::all();
        return view('admin.pages.portfolios.addPortfolios',compact('categories'));
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
                'title' => 'required|unique:portfolios',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'technology' => 'required',
                'category' => 'required'
            ],
            [
                'title.required' => "This Title field can't empty",
                'title.unique' => "This Title field already exist",
                'description.required' => "This Description field can't empty",
                'image.required' => "This Image field can't empty",
                'image.image' => "Please choose image",
                'image.mimes' => "Please choose jpeg,png,jpg,gif,svg files",
                'image.max' => "Please choose image size < 2048MB",
                'technology' => "This Technology field can't empty",
                'category.required' => "This Category field can't empty",
            ]
        );
        $portfolios = new Portfolio();
        $portfolios->title = $request->title;
        $portfolios->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("images".$image)){
                $image = str_random(4)."_".$name;
            }
            $file->move("images",$image);
            $portfolios->image = $image;
        } else {
            $portfolios->image = "";
        }
        $portfolios->technology = $request->technology;
        $portfolios->details = $request->details;
        $portfolios->cateId = $request->category;
        $portfolios->save();
        return redirect()->route('add-portfolios')->with('message','Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolios = Portfolio::find($id);
        return view('admin.pages.portfolios.detailsPortfolios',compact('portfolios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = CategoryService::all();
        $portfolios = Portfolio::find($id);
        return view('admin.pages.portfolios.editPortfolios', compact('categories','portfolios'));
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
                'description' => 'required',
                'technology' => 'required',
                'category' => 'required'
            ],
            [
                'title.required' => "This Name field can't empty",
                'description.required' => "This Description field can't empty",
                'technology.required' => "This Technology field can't empty",
                'category.required' => "This Category field can't empty",
            ]
        );
        $portfolios = Portfolio::find($id);
        $portfolios->title = $request->title;
        $portfolios->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("images".$image)){
                $image = str_random(4)."_".$name;
            }
            $file->move("images",$image);
            unlink("images/".$portfolios->image);
            $portfolios->image = $image;
        }
        $portfolios->technology = $request->technology;
        $portfolios->details = $request->details;
        $portfolios->cateId = $request->category;
        $portfolios->save();
        return redirect()->route('get-edit-portfolios',['id' => $id])->with('message','Add Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolios = Portfolio::find($id);
        $portfolios->delete();

        return redirect()->route('portfolios')->with('message','Deleted Successfully');
    }
}
