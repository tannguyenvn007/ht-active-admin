@extends('admin.index')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
    <a href="{{route('user')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List User</a>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit</h6>
            <div class="dropdown no-arrow"></div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('post-edit-user',['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{ $user->name }}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="changePass" name="changPassword">
                        <label class="form-check-label" for="exampleCheck1">Change password</label>
                    </div>
                    <div class="form-group row" id="div-password" >
                        <label for="" class="col-sm-2 col-form-label" >New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="" name="password" >
                        </div>
                    </div>
                    <div class="form-group row" id="div-confirm-password" >
                        <label for="" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="confirm-password" placeholder="" name="confirm-password" >
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
        $(document).ready(function(){
            $("#div-password").hide();
            $("#div-confirm-password").hide();
            $("#changePass").change(function(){
                if($(this).is(":checked")){
                    $("#div-password").show();
                    $("#div-confirm-password").show();
                }else{
                    $("#div-password").hide();
                    $("#div-confirm-password").hide();
                }
            })
        })
    </script>
@endsection
@endsection
