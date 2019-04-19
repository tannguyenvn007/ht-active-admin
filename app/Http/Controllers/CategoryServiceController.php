<?php

namespace App\Http\Controllers;
use App\CategoryService;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cateSevice = CategoryService::all();
        return view('admin.pages.serviceCategory.listServiceCategory',compact('cateSevice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.serviceCategory.addServiceCategory');
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
                'name' => 'required|unique:category_services',
                'description' => 'required',
                'icon' => 'required',
            ],
            [
                'name.required' => "This Name field can't empty",
                'name.unique' => "This Name field already exist",
                'description.required' => "This Description field can't empty",
                'icon.required' => "This Icon field can't empty",
            ]
        );
        $serviceCate = new CategoryService;
        $serviceCate->name = $request->name;
        $serviceCate->description = $request->description;
        $serviceCate->icon = $request->icon;
        $serviceCate->save();

        return redirect()->route('add-service-category')->with('message','Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cateService = CategoryService::find($id);
        return view('admin.pages.serviceCategory.editServiceCategory', compact('cateService'));
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
                'name' => 'required',
                'description' => 'required',
                'icon' => 'required',
            ],
            [
                'name.required' => "This Name field can't empty",
                'name.unique' => "This Name field already exist",
                'description.required' => "This Description field can't empty",
                'icon.required' => "This Icon field can't empty",
            ]
        );
        $cateService = CategoryService::find($id);
        $cateService->name = $request->name;
        $cateService->description = $request->description;
        $cateService->icon = $request->icon;
        $cateService->save();

        return redirect()->route('get-edit-service-category',[ 'id' => $id ])->with('message','Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cateService = CategoryService::find($id);
        $cateService->delete();

        return redirect()->route('service-category')->with('message','Deleted Successfully');
    }
}

