@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Đánh giá', 'key' => 'Danh sách đánh giá' ])

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @include('backend.partials.card-head', ['key' => 'Danh sách đánh giá' ])
            <div class="card-body">
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
                                <th>Thông tin</th>
                                <th>Nội dung</th>
                                <th>Số Sao</th>
                                <th>Khoá học</th>
                                <th>Khởi tạo</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $key => $item)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>{{ $key + 1  }}</td>
                                    <td>
                                        Họ tên: {{ $item->user->name  }}
                                        <br>
                                        Email: {{ $item->user->email  }}
                                    </td>
                                    <td>{{ $item->content }}</td>
                                    <td>
                                        @while($item->star > 0)
                                            @if($item->star > 0.5)
                                                <span class="fa fa-star star-checked"></span>
                                            @else
                                                <span class="fa fa-star-half"></span>
                                            @endif
                                            @php $item->star--; @endphp
                                        @endwhile
                                    </td>
                                    <td>{{ $item->lesson->title }}</td>
                                    <td>{{ $item->created_at->diffForHumans(); }}</td>
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <a href="{{ route('review.create') }}">
                                                <button class="btn btn-primary btn-sm rounded-0">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="post">
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
@include('backend.review.modal.create')
@endsection