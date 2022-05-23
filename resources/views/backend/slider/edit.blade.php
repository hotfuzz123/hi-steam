@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Slider', 'key' => 'Cập nhật' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Cập nhật' ])
            <div class="card-body" id="bar-parent1">
                <form action="{{ route('slider.update', $slider->id) }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh<span class="required"> * </span></label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if(!empty($slider->image))
                                <a href="{{ $slider->image }}" target="_blank">Xem hình ảnh</a>
                                <input type="hidden" name="image" value="{{ $slider->image }}">
                                @endif
                                @error('image')
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
                                    <option value="active" {{ $slider->status == 'active' ? 'selected' : ''}}>Hiển thị</option>
                                    <option value="inactive" {{ $slider->status == 'inactive' ? 'selected' : ''}}>Ẩn</option>
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
                            <a href="{{ route('slider.index') }}">
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
