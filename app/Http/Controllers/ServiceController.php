<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\CategoryService;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services  = Service::orderBy('created_at','desc')->paginate(5);
        return view('admin.pages.service.listService', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicesCate = CategoryService::all();
        return view('admin.pages.service.addService',compact('servicesCate'));
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
                'name' => 'required|unique:services',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'serviceCate' => 'required'
            ],
            [
                'name.required' => "This Name field can't empty",
                'name.unique' => "This Name field has already exist",
                'description.required' => "This Description field can't empty",
                'image.required' => "This Image field can't empty",
                'image.image' => "Please choose image",
                'image.mimes' => "Please choose jpeg,png,jpg,gif,svg files",
                'image.max' => "Please choose image < 2048MB",
                'serviceCate.required' => "This Service Category field can't empty",
            ]
        );
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("images".$image)){
                $image = str_random(4)."_".$name;
            }
            $file->move("images",$image);
            $service->image = $image;
        } else {
            $service->image = "";
        }
        $service->cate_serviceId = $request->serviceCate;
        $service->save();
        return redirect()->route('add-service')->with('message','Add Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('admin.pages.service.detailsService',compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicesCate = CategoryService::all();
        $service = Service::find($id);
        return view('admin.pages.service.editService', compact('servicesCate','service'));
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
                'serviceCate' => 'required'
            ],
            [
                'name.required' => "This Name field can't empty",
                'description.required' => "This Description field can't empty",
                'serviceCate.required' => "This Service Category field can't empty",
            ]
        );
        $service = Service::find($id);
        $service->name = $request->name;
        $service->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_".$name;
            while(file_exists("images".$image)){
                $image = str_random(4)."_".$name;
            }
            $file->move("images",$image);
            unlink("images/".$service->image);
            $service->image = $image;
        }
        $service->cate_serviceId = $request->serviceCate;
        $service->save();
        return redirect()->route('get-edit-service',['id' => $id])->with('message','Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('service')->with('message','Deleted Successfully');
    }
}
