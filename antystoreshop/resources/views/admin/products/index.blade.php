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
                    <a href="{{route('products.create')}}">
                        <button class="text-muted">Thêm sản phẩm</button>
                    </a>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Tên sản phẩm</th>
                                <th class="border-top-0">Giá sản phẩm</th>
                                <th class="border-top-0">Hình ảnh sản phẩm</th>
                                <th class="border-top-0">Danh mục sản phẩm</th>
                                <th class="border-top-0">Trạng thái</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products) === 0)
                                <tr>
                                    <td colspan="4">Không có dữ liệu</td>
                                </tr>
                            @else
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td><img src="{{$product->image_path}}" height="100"width="100"></td>
                                        <td>{{optional($product->category)->name}}</td>
                                        @if($product->status === 0)
                                            <td><a href="{{ route('products.unactive' , $product->id) }}"><i
                                                        class='far fa-eye-slash'></i></a></td>
                                        @else
                                            <td><a href="{{ route('products.active' , $product->id) }}"><i
                                                        class='far  fas fa-eye'></i></a></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('products.edit' , $product->id) }}">
                                                <button style="border-radius:20px "
                                                        class="btn btn-sm btn-icon btn-secondary"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}"
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
                        {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
