@extends('backend.layouts.master')
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Cập nhật</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i><a class="parent-item" href="{{route('admin.dashboard')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li></li>
            <li><a class="parent-item" href="#">Danh mục</a><i class="fa fa-angle-right"></i></li>
            <li class="active">Cập nhật</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            <div class="card-head">
                <header>Cập nhật</header>
                <button id="panel-button1" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                    <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="panel-button1">
                    <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                    <li class="mdl-menu__item"><i class="material-icons">print</i>Another action</li>
                    <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
                </ul>
            </div>
            <div class="card-body" id="bar-parent1">
                <form action="{{ route('category.update', $category->id) }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="name" data-required="1" class="form-control" value="{{ $category->name }}"/>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Icon
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="icon" data-required="1" class="form-control" value="{{ $category->icon }}"/>
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Mô tả</label>
                            <div class="col-md-6">
                                <textarea type="text" name="description" class="form-control" cols="30" rows="10">{{ $category->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Hiển thị
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-select" name="status">
                                    <option value="">-- Chọn --</option>
                                    <option value="active" {{ $category->status == 'active' ? 'selected' : ''}}>Hiển thị</option>
                                    <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : ''}}>Ẩn</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="offset-md-3 col-md-9">
                            <button type="submit" class="btn btn-info m-r-20">Lưu</button>
                            <button type="button" class="btn btn-default">Huỷ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
