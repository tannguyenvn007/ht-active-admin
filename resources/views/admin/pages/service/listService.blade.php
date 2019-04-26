@extends('admin.index')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Service</h1>
    <a href="{{route('add-service')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Service</a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Lists</h6>
            <div class="dropdown no-arrow">

            </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table class="table table-bordered table-cus text-center">
                    <thead class="bg-primary text-white ">
                        <tr>
                            <th scope="col">Stt</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Service Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $key => $service)
                            <tr>
                                <th class="text-center" scope="row">{{++$key}}</th>
                                <td class="text-center"><img src="{{asset('images').'/'.$service->image}}" alt="" width="100px" height="100px"></td>
                                <td>{{$service->name}}</td>
                                <td class="description-p">{!!$service->description!!}</td>
                                <td>{{$service->categoryService->name}}</td>
                                <td>
                                    <a href="{{ route('get-service-detaitls',['id' => $service->id]) }}"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('get-edit-service',['id' => $service->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('delete-service',['id' => $service->id]) }}"  onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 paginate">
        {{ $services->links() }}
    </div>
</div>
@endsection
