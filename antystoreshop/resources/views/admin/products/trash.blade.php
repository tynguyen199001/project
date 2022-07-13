@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
                <table class="table">
                    <thead>
                    <br>
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{session::get('success')}}</div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{session::get('error')}}</div>
                    @endif
                    <br>
                    <tr>
                        <th class="border-top-0">#</th>
                        <th class="border-top-0">Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Hinh Anh</th>
                        <th>Danh muc san pham</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td><img src="{{$product->image_path}}" height="100" width="100"></td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->status}}</td>
                            <td>
                                <a href="{{route('products.restore',$product->id)}}">
                                    <button style="border-radius:20px "
                                            class="btn btn-sm btn-icon btn-secondary">khoi phuc
                                    </button>
                                </a>
                                <form action="{{route('products.forceDelete',$product->id)}}"
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
                    </tbody>
                </table>
                <a href="{{route('products.index')}}">Tro Lai</a>
            </div>


    </div>
    </div>
@endsection
