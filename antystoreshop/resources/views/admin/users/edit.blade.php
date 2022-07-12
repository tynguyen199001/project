@extends('admin.layout.app')
@section('title', 'Cập nhật nhân sự')
@section('css')
    <link href="{{asset('admins/vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->

            <div class="col-lg-12 col-xlg-9 col-md-12">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('users.update',$users->id)}}">
                                @csrf
                                @method('put')
                                <div class="form-group mb-4">
                                    <label for="example" class="col-md-12 p-0">Tên nhân viên</label>
                                    <div class="col-md-12 border p-0">
                                        <input name='name' type="text" placeholder="Nhập tên nhân viên"
                                               class="form-control p-0 border-0"
                                               id="example-email" value="{{$users->name}}">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="example" class="col-md-12 p-0">Email</label>
                                    <div class="col-md-12 border p-0">
                                        <input name='email' type="text" placeholder="Nhập nhân viên"
                                               class="form-control p-0 border-0"
                                               id="example-email"value="{{$users->email}}">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="example" class="col-md-12 p-0">Password</label>
                                    <div class="col-md-12 border p-0">
                                        <input name='password' type="text" placeholder="Nhập password"
                                               class="form-control p-0 border-0"
                                               id="example-email" >
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="col-sm-12">Chọn quyền sử dụng</label>
                                    <div class="col-sm-12 border">
                                        <select name='role_id[]'
                                                class="form-select  tags_select_choose"   multiple="multiple">
                                            @foreach($roles as $role)
                                                <option
                                                    {{ $rolesOfUser->contains('id', $role->id) ? 'selected' : '' }}
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">submit</button>
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

@endsection

