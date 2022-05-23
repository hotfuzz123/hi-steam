@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Bài viết', 'key' => 'Cập nhật' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Cập nhật' ])
            <div class="card-body" id="bar-parent1">
                <form action="{{ route('post.update', $post->id) }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="name" data-required="1" class="form-control" value="{{ $post->name }}"/>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nội dung</label>
                            <div class="col-md-6">
                                <textarea type="text" name="content" class="form-control" id="editor1" cols="30" rows="10">{{ $post->content }}</textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh</label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if(!empty($post->image))
                                <a href="{{ $post->image }}" target="_blank">Xem hình ảnh</a>
                                <input type="hidden" name="image" value="{{ $post->image }}">
                                @endif
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Mô tả ngắn</label>
                            <div class="col-md-6">
                                <textarea type="text" name="description" class="form-control" cols="30" rows="10">{{ $post->description }}</textarea>
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
                                    <option value="public" {{ $post->status == 'public' ? 'selected' : ''}}>Công khai</option>
                                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : ''}}>Nháp</option>
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
                            <a href="{{ route('post.index') }}">
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
