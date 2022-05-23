@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Học sinh', 'key' => 'Danh sách học sinh' ])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partials.card-head', ['key' => 'Danh sách học sinh' ])
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <div class="btn-group">
                            <a href="{{ route('category.create') }}">
                                <button id="addRow1" class="btn btn-info">
                                    Thêm mới <i class="fa fa-plus"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <div class="btn-group pull-right">
                            <button class="btn deepPink-bgcolor  btn-outline dropdown-toggle" data-bs-toggle="dropdown">Tools
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:;"><i class="fa fa-print"></i> Print </a></li>
                                <li><a href="javascript:;"><i class="fa fa-file-pdf-o"></i> Save as PDF </a></li>
                                <li><a href="javascript:;"><i class="fa fa-file-excel-o"></i> Export to Excel </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="example4">
                        <thead>
                            <tr>
                                <th>
                                    <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
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
                                    <td>
                                        <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
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

@endsection