@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Cài đặt', 'key' => 'Cập nhật thông tin' ])

<form action="{{ route('admin.profile') }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-5 col-sm-5">
            <div class="card card-box">
                @include('backend.partials.card-head', ['key' => 'Cập nhật thông tin' ])
                <div class="card-body" id="bar-parent1">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh xem trước<span class="required"> * </span></label>
                            <div class="col-md-6">
                                <img style="width: 66%;" src="{{ Auth::guard('admin')->user()->avatar }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="file" name="avatar" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-7">
            <div class="card card-box">
                <div class="card-head">
                    <header>Cập nhật thông tin</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body" id="bar-parent1">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Nhập Tên"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" placeholder="Nhập Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nghề nghiệp
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->job }}" placeholder="Nhập nghề nghiệp"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Số điện thoại
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="mobile" class="form-control" value="{{ Auth::guard('admin')->user()->phone }}" placeholder="Nhập SĐT"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="offset-md-3 col-md-9">
                            <button type="submit" class="btn btn-info m-r-20">Lưu</button>
                            <button type="button" class="btn btn-default">Huỷ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
