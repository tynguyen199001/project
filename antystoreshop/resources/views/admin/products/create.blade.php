@extends('admin.layout.app')
@section('title', 'Thêm mới sản phẩm')
@section('css')
    <link href="{{asset('admins/vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xlg-9 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 col-xlg-9 col-md-12">
                                <div class="col-lg-12 col-xlg-9 col-md-12">
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Tên sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='name' type="text" placeholder="Tên sản phẩm"
                                                   class="form-control  border-0"
                                                   id="example-email" value="{{old('name')}}">
                                        </div>
                                        @error('name')
                                        <p style="color: red">{{($message)}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Giá sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='price' type="text" placeholder="Giá sản phẩm"
                                                   class="form-control  border-0" name="example-email"
                                                   id="example-email" value="{{old('price')}}">
                                        </div>
                                        @error('price')
                                        <p style="color: red">{{($message)}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Hình ảnh sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='image_path' type="file" placeholder="Hình ảnh sản phẩm"
                                                   class="form-control ">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example" class="col-md-12 ">Hình chi tiết sản phẩm</label>
                                        <div class="col-md-12 border ">
                                            <input name='image_path_detail[]' type="file"
                                                   placeholder="Hình ảnh sản phẩm"
                                                   class="form-control " multiple>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="col-sm-12">Chọn danh muc cha</label>
                                        <div class="col-sm-12 border">
                                            <select name='category_id'
                                                    class="form-select shadow-none p-0 border-0 form-control-line">
                                                <option value="">chọn một</option>
                                                {!! $categories !!}
                                            </select>
                                        </div>
                                        @error('category_id')
                                        <p style="color: red">{{($message)}}</p>
                                        @enderror
                                    </div>
                                


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
                                              class="form-control  tinymce-editor" rows="8">{{old('description')}}
                                    </textarea>
                                    </div>
                                </div>
                                @error('description')
                                <p style="color: red">{{($message)}}</p>
                                @enderror
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

