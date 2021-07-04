@extends('backend.layouts.master')
@section('content')

<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Danh sách khoá học</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i><a class="parent-item" href="{{route('admin.dashboard')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li></li>
            <li><a class="parent-item" href="#">Khoá học</a><i class="fa fa-angle-right"></i></li>
            <li class="active">Danh sách khoá học</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @include('errors.general_error')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-head">
                <header>Danh sách khoá học</header>
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
                            <a href="{{ route('course.create') }}">
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
                                <th> Tên </th>
                                <th> Ảnh </th>
                                <th> Video </th>
                                <th> Danh mục </th>
                                <th> Hiển thị </th>
                                <th> Tác vụ </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course as $item)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td> {{ $item->id }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> <img src="{{ $item->image }}" class="table-image"> </td>
                                    <td>
                                        <iframe src="{{ $item->video_link }}" class="table-image" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </td>
                                    <td> {{$item->category->name}} </td>
                                    <td>
                                        <input type="checkbox" name="toggle" value="{{ $item->id }}" data-toggle="toggle" data-onstyle="primary" {{ $item->status == 'active' ? 'checked' : ''}}>
                                    </td>
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <a href="{{ route('course.edit', $item->id) }}">
                                                <button class="btn btn-primary btn-sm rounded-0">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('course.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="" data-id="{{ $item->id }}"><button class="dltBtn btn btn-danger btn-sm rounded-0"><i class="fa fa-trash-o"></i></button></a>
                                            </form>
                                        </div>
                                    </td>
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

@section('scripts')
    <script>
        // Change course status
        $('input[name="toggle"]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                type:'POST',
                url: '/admin/course-status',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                    mode:mode,
                    id:id,
                },
                success:function (response) {
                    if(response.status){
                        alert(response.message);
                    } else {
                        alert('Vui lòng thử lại!');
                    }
                }
            })
        });
    </script>
@endsection
