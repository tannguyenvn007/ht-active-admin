@extends('admin.index')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category</h1>
    <a href="{{route('add-service-category')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Category</a>
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
                <table class="table table-bordered ">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th scope="col">Stt</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cateSevice as $key => $itemCateSevice)
                            <tr>
                                <th scope="row" class="text-center">{{++$key}}</th>
                                {{-- <td><img src="{{$itemCateSevice->icon}}" alt="" width="50px" height="50px"></td> --}}
                                <td  class="text-center"><i class="{{$itemCateSevice->icon}}"></i></td>
                                <td  class="text-center">{{$itemCateSevice->name}}</td>
                                <td>{{$itemCateSevice->description}}</td>
                                <td  class="text-center">
                                    <a href="{{ route('get-service-category-detaitls',['id' => $itemCateSevice->id]) }}"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('get-edit-service-category',['id' => $itemCateSevice->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('delete-service-category',['id' => $itemCateSevice->id]) }}" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></a>
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
        {{ $cateSevice->links() }}
    </div>
</div>
@endsection
