@extends('backend.layouts.master')
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Dashboard</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin.dashboard') }}">Trang chủ</a>&nbsp;<i class="fa fa-angle-right"></i></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
</div>
<!-- start widget -->
<div class="state-overview">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="overview-panel purple">
                <div class="symbol">
                    <i class="fa fa-book usr-clr"></i>
                </div>
                <div class="value white">
                    <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $courseTotal }}">{{ $courseTotal }}</p>
                    <p>TỔNG SỐ KHOÁ HỌC</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="overview-panel deepPink-bgcolor">
                <div class="symbol">
                    <i class="fa fa-video"></i>
                </div>
                <div class="value white">
                    <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $lessonTotal }}">{{ $lessonTotal }}</p>
                    <p>TỔNG SỐ BÀI HỌC</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="overview-panel orange">
                <div class="symbol">
                    <i class="fa fa-users"></i>
                </div>
                <div class="value white">
                    <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $userTotal }}">{{ $userTotal }}</p>
                    <p>TỔNG SỐ HỌC SINH</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="overview-panel blue-bgcolor">
                <div class="symbol">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <div class="value white">
                    <p class="sbold addr-font-h1" data-counter="counterup" data-value="{{ $postTotal }}">{{ $postTotal }}</p>
                    <p>TỔNG SỐ BÀI VIẾT</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end widget -->
<!-- chart start -->
<div class="row">
    <div class="col-sm-6">
        <div class="card card-box">
            <div class="card-head">
                <header>University Survey</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body">
                <div class="recent-report__chart">
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-box">
            <div class="card-head">
                <header>University Survey</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body">
                <div class="recent-report__chart">
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Chart end -->
<!-- start new student list -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card  card-box">
            <div class="card-head">
                <header>Danh sách học sinh mới</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Ảnh </th>
                                    <th> Tên </th>
                                    <th> Lớp </th>
                                    <th> Ngày sinh </th>
                                    <th> Số điện thoại </th>
                                    <th> Email </th>
                                    <th> Địa chỉ </th>
                                    <th> Khởi tạo </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $item)
                                    <tr class="odd gradeX">
                                        <td> {{ $key + 1 }} </td>
                                        <td class="patient-img">
                                            <img src="{{ $item->avatar }}" alt="">
                                        </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->grade }} </td>
                                        <td> {{ Carbon\Carbon::parse($item->dateOfBirth)->format('d-m-Y') }} </td>
                                        <td><a href="tel:{{ $item->phone }}"> {{ $item->phone }} </a></td>
                                        <td><a href="mailto:{{ $item->email }}"> {{ $item->email }} </a></td>
                                        <td> {{ $item->address }} </td>
                                        <td> {{ $item->created_at->diffForHumans(); }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end new student list -->

@endsection
