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
                    <a href="{{route('users.create')}}">
                        <button class="text-muted">Thêm danh sách  nhân viên</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Tên </th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) === 0)
                                <tr>
                                    <td colspan="4">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="{{ route('users.edit' , $user->id) }}">
                                                <button style="border-radius:20px "
                                                        class="btn btn-sm btn-icon btn-secondary"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}"
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
