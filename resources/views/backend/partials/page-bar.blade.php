<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">{{ $key }}</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i><a class="parent-item" href="{{route('admin.dashboard')}}">Trang chủ</a><i class="fa fa-angle-right"></i></li></li>
            <li><a class="parent-item" href="#">{{ $name }}</a><i class="fa fa-angle-right"></i></li>
            <li class="active">{{ $key }}</li>
        </ol>
    </div>
</div>