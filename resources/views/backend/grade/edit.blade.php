@extends('backend.layouts.master')
@section('content')

@include('backend.partials.page-bar', ['name' => 'Chấm điểm', 'key' => 'Thêm mới' ])

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card card-box">
            @include('backend.partials.card-head', ['key' => 'Thêm mới' ])
            <div class="card-body" id="bar-parent1">
                <form action="{{ route('grade.update', $grade->id) }}" method="POST" id="form_sample_1" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Điểm
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="score" data-required="1" class="form-control" value="{{ $grade->score }}"/>
                                @error('score')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Bình luận</label>
                            <div class="col-md-6">
                                <input type="text" name="comment" data-required="1" class="form-control" value="{{ $grade->comment }}"/>
                                @error('comment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tên bài tập</label>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{ $grade->homework->name }}" readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">File bài tập</label>
                            <div class="col-md-6">
                                <iframe src="{{ $grade->homework->file }}" height=500px frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="offset-md-3 col-md-9">
                            <button type="submit" class="btn btn-info m-r-20">Lưu</button>
                            <a href="{{ route('grade.index') }}">
                                <button type="button" class="btn btn-default">Huỷ</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
