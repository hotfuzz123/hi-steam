<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ Auth::guard('admin')->user()->avatar }}" class="img-circle user-img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::guard('admin')->user()->name }}</p>
                            <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline">Online</span></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item start active open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">person</i>
                        <span class="title">Admin</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.create') }}" class="nav-link ">
                                <span class="title">Thêm admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link ">
                                <span class="title">Danh sách admin</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">assignment_ind</i>
                        <span class="title">Chấm điểm</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('grade.index') }}" class="nav-link ">
                                <span class="title">Danh sách bài tập</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
                        <span class="title">Học sinh</span><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link ">
                                <span class="title">Danh sách học sinh</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">list</i>
                        <span class="title">Danh mục</span><span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link ">
                                <span class="title">Thêm danh mục</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link ">
                                <span class="title">Danh sách danh mục</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">school</i>
                        <span class="title">Khoá học</span><span class="arrow"></span>
                        {{-- <span class="label label-rouded label-menu label-success">new</span> --}}
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('course.create') }}" class="nav-link ">
                                <span class="title">Thêm khoá học</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('course.index') }}" class="nav-link ">
                                <span class="title">Danh sách khoá học</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('review.index') }}" class="nav-link nav-toggle"> <i class="material-icons">list</i>
                        <span class="title">Đánh giá</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">linear_scale</i>
                        <span class="title">Slider</span><span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('slider.create') }}" class="nav-link ">
                                <span class="title">Thêm Slider</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('slider.index') }}" class="nav-link ">
                                <span class="title">Danh sách Slider</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">wb_incandescent</i>
                        <span class="title">Mẹo</span><span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('tip.create') }}" class="nav-link ">
                                <span class="title">Thêm mẹo</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tip.index') }}" class="nav-link ">
                                <span class="title">Danh sách mẹo</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">description</i>
                        <span class="title">Tin tức</span><span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}" class="nav-link ">
                                <span class="title">Thêm tin tức</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link ">
                                <span class="title">Danh sách tin tức</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i class="material-icons">settings</i>
                        <span class="title">Cài đặt</span><span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.profile') }}" class="nav-link ">
                                <span class="title">Tài khoản</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.password') }}" class="nav-link ">
                                <span class="title">Đổi mật khẩu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.logout') }}" class="nav-link ">
                                <span class="title">Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
