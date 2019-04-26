@extends('admin.index')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Blog</h1>
    <a href="{{route('add-blog')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Blog</a>
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
                <table class="table table-bordered table-cus">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th scope="col">Stt</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col" style="width: 50%;">Content</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $key => $blog)
                            <tr>
                                <th class="text-center" scope="row">{{++$key}}</th>
                                <td class="text-center"><img src="{{asset('images').'/'.$blog->image}}" alt="" width="100px" height="100px"></td>
                                <td class="text-center">{{$blog->title}}</td>
                                <td>{!!$blog->content!!}</td>
                                <td class="text-center">{{$blog->user->name}}</td>
                                <td class="text-center">
                                    <a href="{{ route('get-blog-detaitls',['id' => $blog->id]) }}"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('get-edit-blog',['id' => $blog->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('delete-blog',['id' => $blog->id]) }}"  onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></a>
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
        {{ $blogs->links() }}
    </div>
</div>
@endsection
