@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Cài đặt', 'key' => 'Cập nhật mật khẩu' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Cập nhật mật khẩu' ])
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
