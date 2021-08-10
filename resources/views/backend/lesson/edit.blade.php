@extends('backend.layouts.master')
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Cập nhật</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i><a class="parent-item" href="{{route('admin.dashboard')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li></li>
            <li><a class="parent-item" href="#">Khoá học</a><i class="fa fa-angle-right"></i></li>
            <li><a class="parent-item" href="#">Bài học</a><i class="fa fa-angle-right"></i></li>
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
                <form action="{{ route('lesson.update', $lesson->id) }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="name" data-required="1" class="form-control" value="{{ $lesson->name }}"/>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Dụng cụ</label>
                            <div class="col-md-6">
                                <textarea type="text" name="material" class="form-control" id="editor1" cols="30" rows="10">{{ $lesson->material }}</textarea>
                                @error('material')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh</label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if(!empty($lesson->image))
                                <a href="{{ $lesson->image }}" target="_blank">Xem hình ảnh</a>
                                <input type="hidden" name="image" value="{{ $lesson->image }}">
                                @endif
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Link video</label>
                            <div class="col-md-6">
                                <input type="text" name="video_link" class="form-control" value="{{ $lesson->video_link }}"/>
                                @if(!empty($lesson->video_link))
                                <a href="{{ $lesson->video_link }}" target="_blank">Xem video</a>
                                <input type="hidden" name="video_link" value="{{ $lesson->video_link }}">
                                @endif
                                @error('video_link')
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
                                    <option value="active" {{ $lesson->status == 'active' ? 'selected' : ''}}>Hiển thị</option>
                                    <option value="inactive" {{ $lesson->status == 'inactive' ? 'selected' : ''}}>Ẩn</option>
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
                            <a href="{{ route('course.index') }}">
                                <button type="button" class="btn btn-default">Huỷ</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
