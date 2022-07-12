@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
         
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title"></h3>

                    <a href="{{route('categories.create')}}">
                        <button class="text-muted">Thêm danh mục</button>
                    </a>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Tên danh mục</th>
                             
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) === 0)
                                <tr>
                                    <td colspan="4">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>              
                                        <td>
                                            <a href="{{ route('categories.edit' , $category->id) }}">
                                                <button style="border-radius:20px "
                                                        class="btn btn-sm btn-icon btn-secondary"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
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
                        {{ $paginate->appends(request()->query()) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
