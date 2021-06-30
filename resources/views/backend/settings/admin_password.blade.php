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
        @include('errors.general_error')
    </div>
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
                <form action="{{ route('update.password') }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Mật khẩu hiện tại
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="password" name="old_password" id="current_pwd" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                                <span id="chkCurrentPwd"></span>
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Mật khẩu mới
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="password" name="password" id="new_pwd" class="form-control" placeholder="Nhập mật khẩu mới">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Xác nhận mật khẩu
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="password" name="password_confirmation" id="confirm_pwd" class="form-control"  placeholder="Xác nhận mật khẩu">
                                @error('password_confirmation')
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
