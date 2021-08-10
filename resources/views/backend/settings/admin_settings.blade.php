@extends('backend.layouts.master')
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Cập nhật thông tin</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i><a class="parent-item" href="{{route('admin.dashboard')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li></li>
            <li><a class="parent-item" href="#">Cài đặt</a><i class="fa fa-angle-right"></i></li>
            <li class="active">Cập nhật thông tin</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            <div class="card-head">
                <header>Cập nhật thông tin</header>
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
                <form action="{{ route('admin.settings') }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="name" data-required="1" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Nhập Tên Admin"/>
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
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" placeholder="Nhập Email Admin">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Chức vụ
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" data-required="1" class="form-control" value="{{ Auth::guard('admin')->user()->type }}" placeholder="Nhập Chức vụ Admin"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Số điện thoại
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="mobile" data-required="1" class="form-control" value="{{ Auth::guard('admin')->user()->phone }}" placeholder="Nhập SĐT"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh đại diện<span class="required"> * </span></label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <a href="{{ Auth::guard('admin')->user()->image }}" target="_blank">Xem hình ảnh</a>
                                <input type="hidden" name="image" value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
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
