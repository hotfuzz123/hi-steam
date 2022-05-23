@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Slider', 'key' => 'Cập nhật' ])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partials.card-head', ['key' => 'Cập nhật' ])
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <div class="btn-group">
                            <a href="{{ route('slider.create') }}">
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
                                <th>Ảnh</th>
                                <th>Hiển thị</th>
                                <th>Khởi tạo</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slider as $key => $item)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td> <img src="{{ $item->image }}" class="table-image"> </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="toggle" value="{{ $item->id }}" id="flexSwitchCheckChecked" {{ $item->status == 'active' ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>{{ $item->created_at->diffForHumans(); }}</td>
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <a href="{{ route('slider.edit', $item->id) }}">
                                                <button class="btn btn-primary btn-sm rounded-0">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('slider.destroy', $item->id) }}" method="post">
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
        // Change slider status
        $('input[name="toggle"]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                type:'POST',
                url: '/admin/slider-status',
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
