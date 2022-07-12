@extends('admin.layout.app')
@section('title', 'Sửa sản phẩm')
@section('css')
    <link href="{{asset('admins/vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xlg-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('products.update',$products->id)}}" enctype="multipart/form-data" method="post" >
                            @csrf
                            @method('put')
                            <div class="col-lg-6 col-xlg-9 col-md-12">
                                <div class="col-lg-12 col-xlg-9 col-md-12">
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Tên sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='name' type="text" placeholder="Tên sản phẩm"
                                                   class="form-control  border-0"
                                                   id="example-email" value="{{$products->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Giá sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='price' type="text" placeholder="Giá sản phẩm"
                                                   class="form-control  border-0" name="example-email"
                                                   id="example-email" value="{{$products->price}}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Hình ảnh sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='image_path' type="file" placeholder="Hình ảnh sản phẩm"
                                                   class="form-control ">
                                        </div>
                                        <br>
                                        <div class="col-md-4 ">
                                            <div class="row">
                                                <img class="feature_image" src="{{ $products->image_path }}" alt="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Hình chi tiết sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='image_path_detail[]' type="file"
                                                   placeholder="Hình ảnh sản phẩm"
                                                   class="form-control " multiple>
                                        </div>
                                        <br>
                                        <div class="row ">
                                            @foreach($products->productImage as $producImageItem)
                                                <div class="col-md-3">
                                                    <img class="image_detail_product"
                                                         src="{{ $producImageItem->image_path }}" alt="">
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Chọn danh mục</label>
                                        <div class="col-sm-12 border">
                                            <select name='category_id'
                                                    class="form-select shadow-none p-0 border-0 form-control-line">
                                                <option value="">Chọn danh mục --</option>
                                                {!! $categories !!}
                                            </select>
                                        </div>
                                    </div>
                                    {{--                            <div class="form-group mb-4">--}}
                                    {{--                                <label class="col-sm-12">Thương hiệu</label>--}}
                                    {{--                                <div class="col-sm-12 border">--}}
                                    {{--                                    <select name='brand_id'--}}
                                    {{--                                            class="form-select shadow-none  border-0 form-control-line">--}}
                                    {{--                                        @foreach($brands as $key=>$brand)--}}
                                    {{--                                            <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
                                    {{--                                        @endforeach--}}

                                    {{--                                    </select>--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}

                                

                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Status</label>
                                        <div class="col-sm-12 border">
                                            <select name='status'
                                                    class="form-select shadow-none  border-0 form-control-line">
                                                <option value="0">Ẩn</option>
                                                <option value="1">Hiện</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xlg-9 col-md-12"></div>
                            <div class="col-lg-12 col-xlg-9 col-md-12">
                                <div class="form-group mb-4">
                                    <label for="example" class="col-md-12 ">Mô tả sản phẩm</label>
                                    <div class="col-md-12 border ">
                                    <textarea name='description' type="text" placeholder="Mô tả sản phẩm"
                                              class="form-control  tinymce-editor" rows="8">
                                        {{$products->description}}
                                    </textarea>
                                    </div>
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
            <!-- Column -->
        </div>

        @endsection
        @section('js')
            <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <script src="{{asset('admins/vendor/select2/dist/js/select2.min.js')}}"></script>
            <script src="{{asset('admins/product/add/add.js')}}"></script>

@endsection

