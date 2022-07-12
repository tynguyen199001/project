@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (Session::has('success'))
                <p class="text-success">
                    <i class="fa fa-check" aria-hidden="true"></i>{{ Session::get('success') }}
                </p>
            @endif
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title"></h3>
                    <a href="{{route('roles.create')}}">
                        <button class="text-muted">Danh sách vai trò</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Tên vai trò </th>
                                <th class="border-top-0"> Mô tả vai trò</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($roles) === 0)
                                <tr>
                                    <td colspan="4">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->display_name}}</td>
                                        <td>
                                            <a href="{{ route('roles.edit' , $role->id) }}">
                                                <button style="border-radius:20px "
                                                        class="btn btn-sm btn-icon btn-secondary"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('roles.destroy', $role->id) }}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border-radius:20px "
                                                        class="btn btn-sm btn-icon btn-secondary"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-ms-12">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
