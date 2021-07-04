@extends('backend.layouts.master')
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Danh sách học sinh</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i><a class="parent-item" href="{{route('admin.dashboard')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li></li>
            <li><a class="parent-item" href="#">Học sinh</a>&nbsp;<i class="fa fa-angle-right"></i></li>
            <li class="active">Danh sách học sinh</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line">
            <ul class="nav customtab nav-tabs" role="tablist">
                <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">List View</a></li>
                <li class="nav-item"><a href="#tab2" class="nav-link" data-bs-toggle="tab">Grid View</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Danh sách học sinh</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <div class="btn-group">
                                                <a href="add_professor.html" id="addRow" class="btn btn-info">
                                                    Add New <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <div class="btn-group pull-right">
                                                <a class="btn deepPink-bgcolor  btn-outline dropdown-toggle" data-bs-toggle="dropdown">Tools
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="javascript:;"><i class="fa fa-print"></i> Print </a></li>
                                                    <li><a href="javascript:;"><i class="fa fa-file-pdf-o"></i> Save as PDF </a></li>
                                                    <li><a href="javascript:;"><i class="fa fa-file-excel-o"></i> Export to Excel </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
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
                                                    <th> Ngày tham gia </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $item)
                                                    <tr class="odd gradeX">
                                                        <td> {{ $item->id }} </td>
                                                        <td class="patient-img">
                                                            <img src="{{ $item->image }}" alt="">
                                                        </td>
                                                        <td> {{ $item->name }} </td>
                                                        <td> {{ $item->grade }} </td>
                                                        <td> {{ $item->dateOfBirth->format('d-m-Y') }} </td>
                                                        <td><a href="tel:{{ $item->phone }}"> {{ $item->phone }} </a></td>
                                                        <td><a href="mailto:{{ $item->email }}"> {{ $item->email }} </a></td>
                                                        <td> {{ $item->address }} </td>
                                                        <td> {{ $item->created_at }} </td>
                                                        {{-- <td class="valigntop">
                                                            <div class="btn-group">
                                                                <a href="{{ route('user.edit', $item->id) }}">
                                                                    <button class="btn btn-primary btn-sm rounded-0">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                                <form action="{{ route('user.destroy', $item->id) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <a href="" data-id="{{ $item->id }}"><button class="dltBtn btn btn-danger btn-sm rounded-0"><i class="fa fa-trash-o"></i></button></a>
                                                                </form>
                                                            </div>
                                                        </td> --}}
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
                <div class="tab-pane" id="tab2">
                    <div class="row">
                        @foreach ($user as $item)
                            <div class="col-md-4">
                                <div class="card card-box">
                                    <div class="card-body no-padding ">
                                        <div class="doctor-profile">
                                            <img src="{{ $item->image }}" class="doctor-pic" alt="">
                                            <div class="profile-usertitle">
                                                <div class="doctor-name"> {{ $item->name }} </div>
                                                <div class="name-center"> Lớp {{ $item->grade }} </div>
                                            </div>
                                            <p>{{ $item->address }}</p>
                                            <div>
                                                <p><i class="fa fa-phone"></i><a href="tel:{{ $item->phone }}"> {{ $item->phone }}</a></p>
                                            </div>
                                            <div>
                                                <p><i class="fa fa-envelope"></i><a href="mailto:{{ $item->email }}"> {{ $item->email }}</a></p>
                                            </div>
                                            <div class="profile-userbuttons">
                                                <a href="" class="btn btn-circle deepPink-bgcolor btn-sm">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
