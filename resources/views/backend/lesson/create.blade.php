@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Slider', 'key' => 'Thêm mới' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Thêm mới' ])
            <div class="card-body" id="bar-parent1">
                <form action="" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $course['title'] }}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Danh mục:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $course->category['title'] }}" readonly/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Thêm mới' ])
            <div class="card-body" id="bar-parent1">
                <form action="{{ route('lesson.add', $course->id) }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="title" data-required="1" class="form-control" value="{{ old('title') }}"/>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Dụng cụ</label>
                            <div class="col-md-6">
                                <textarea type="text" name="tool" class="form-control" id="editor1" cols="30" rows="10">{{ old('tool') }}</textarea>
                                @error('tool')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Mô tả</label>
                            <div class="col-md-6">
                                <textarea type="text" name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ảnh</label>
                            <div class="col-md-6">
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Link video</label>
                            <div class="col-md-6">
                                <input type="text" name="video_link" class="form-control" value="{{ old('video_link') }}"/>
                                @error('video_link')
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
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : ''}}>Hiển thị</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : ''}}>Ẩn</option>
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
                            <a href="{{ route('course.index') }}">
                                <button type="button" class="btn btn-default">Huỷ</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partials.card-head', ['key' => 'Danh sách bài học' ])
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
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Video</th>
                                <th>Người tạo</th>
                                <th>Hiển thị</th>
                                <th>Khởi tạo</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course['lesson'] as $key => $item)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td> <img src="{{ $item->thumbnail }}" class="table-image"> </td>
                                    <td>
                                        <iframe src="{{ $item->video_link }}" class="table-image" style="height: 150px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </td>
                                    <td>{{ $item->admin['name'] }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="toggle" value="{{ $item->id }}" id="flexSwitchCheckChecked" {{ $item->status == 'active' ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>{{ $item->created_at->diffForHumans(); }}</td>
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <a href="{{ route('document.add', $item->id) }}">
                                                <button class="btn btn-primary btn-sm rounded-0">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('lesson.edit', $item->id) }}">
                                                <button class="btn btn-warning btn-sm rounded-0">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('lesson.destroy', $item->id) }}" method="post">
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
        // Change lesson status
        $('input[name="toggle"]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                type:'POST',
                url: '/admin/lesson-status',
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
