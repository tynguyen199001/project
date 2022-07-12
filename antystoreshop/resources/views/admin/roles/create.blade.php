@extends('admin.layout.app')
@section('title', 'Thêm mới vai trò')
@section('css')
    <link href="{{asset('admins/vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xlg-9 col-md-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('roles.store')}}">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 p-0">Tên vai trò</label>
                                        <div class="col-md-12 border p-0">
                                            <input name='name' type="text" placeholder="Nhập vai trò"
                                                   class="form-control p-0 border-0"
                                                   id="example-email" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Mô tả vai trò</label>
                                        <div class="col-md-12 border ">
                                    <textarea name='display_name' type="text"
                                              class="form-control  " rows="4" value="{{old('display_name')}}">
                                    </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    @foreach($permissions as $permission)
                                    <div  class="card1 border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>   {{$permission->name}}
                                        </div>
                                        <div class="row">
                                           @foreach($permission->sub_permissions as $sub_permission)
                                            <div class="card-body text-primary col-md-3">
                                                <h5 class="card-title">
                                                    <label>
                                                        <input type="checkbox"  name="permission_id[]"
                                                               class="checkbox_sub_permission"
                                                               value="{{ $sub_permission->id }}">
                                                    </label>
                                                    {{ $sub_permission->name}}
                                                </h5>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admins/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>
    <script src="{{asset('admins/role/add/add.js')}}"></script>
@endsection


