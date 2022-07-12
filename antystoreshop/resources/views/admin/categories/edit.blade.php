@extends('admin.layout.app')
@section('title', 'Cập nhật danh mục')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-xlg-3 col-md-12">
        </div>
        <div class="col-lg-6 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('categories.update',$categories->id)}}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-4">
                            <label for="example" class="col-md-12 p-0">Tên danh mục</label>
                            <div class="col-md-12 border p-0">
                                <input name='name' type="text" placeholder="Tên danh mục"
                                       class="form-control p-0 border-0" name="example-email"
                                       id="example-email" value="{{$categories->name}}">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12">Chọn danh muc cha</label>
                            <div class="col-sm-12 border">
                                <select name='parent_id'
                                        class="form-select shadow-none p-0 border-0 form-control-line">
                                    <option value="">chọn một</option>
                                    {!! $data !!}
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example" class="col-md-12 p-0">Slug</label>
                            <div class="col-md-12 border p-0">
                                <input name='slug' type="text" placeholder="slug"
                                       class="form-control p-1 border-0" name="example-email"
                                       id="example-email"value="{{$categories->slug}}">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12">Status</label>
                            <div class="col-sm-12 border">
                                <select name='status'
                                        class="form-select shadow-none p-0 border-0 form-control-line">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
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
        <!-- Column -->
    </div>
    <div class="col-lg-3 col-xlg-3 col-md-12">
    </div>
@endsection
