@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Danh mục', 'key' => 'Cập nhật' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Cập nhật' ])
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
                                <input type="text" name="title" data-required="1" class="form-control" value="{{ $category->title }}"/>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh</label>
                            <div class="col-md-6">
                                <input type="file" name="icon" class="form-control" accept="image/*">
                                @if(!empty($category->icon))
                                <a href="{{ $category->icon }}" target="_blank">Xem hình ảnh</a>
                                <input type="hidden" name="icon" value="{{ $category->icon }}">
                                @endif
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="offset-md-3 col-md-9">
                            <button type="submit" class="btn btn-info m-r-20">Lưu</button>
                            <a href="{{ route('category.index') }}">
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
