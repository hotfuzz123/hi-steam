@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Slider', 'key' => 'Thêm mới' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Thêm mới' ])
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
                                <input type="text" name="title" data-required="1" class="form-control" value="{{ $lesson->title }}"/>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Dụng cụ</label>
                            <div class="col-md-6">
                                <textarea type="text" name="tool" class="form-control" id="editor1" cols="30" rows="10">{{ $lesson->tool }}</textarea>
                                @error('tool')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh</label>
                            <div class="col-md-6">
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                @if(!empty($lesson->thumbnail))
                                <a href="{{ $lesson->thumbnail }}" target="_blank">Xem hình ảnh</a>
                                <input type="hidden" name="thumbnail" value="{{ $lesson->thumbnail }}">
                                @endif
                                @error('thumbnail')
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
