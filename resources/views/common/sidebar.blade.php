<?php ?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">navigation</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li style="padding: 70px 0 0;">
                <a href="{!! url('admin/dashboard') !!}" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Bảng điều khiển</a>
            </li>
            <li>
                <a href="{!! url('admin/user-management') !!}" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Quản trị người dùng</a>
            </li>
            <li>
                <a href="{!! url('admin/statistic/province') !!}" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Thống kê</a>
            </li>
            <li>
                <a href="{!! url('admin/account-management') !!}" class="waves-effect"><i class="fa fa-puzzle-piece fa-fw" aria-hidden="true"></i>Thông tin tài khoản</a>
            </li>
            <li>
                <a href="{!! url('admin/competition-management') !!}" class="waves-effect"><i class="fa fa-mortar-board fa-fw" aria-hidden="true"></i>Quản trị vòng thi</a>
            </li>
            <li>
                <a href="{!! url('admin/comment-management') !!}" class="waves-effect"><i class="fa fa-cubes fa-fw" aria-hidden="true"></i>Góp ý người dùng</a>
            </li>
            <li>
                <a href="{!! url('admin/news-management') !!}" class="waves-effect"><i class="fa fa-send fa-fw" aria-hidden="true"></i>Quản trị tin tức</a>
            </li>
            <!-- <li>
                <a href="404.php" class="waves-effect"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>error 404</a>
            </li> -->
        </ul>
        <div class="center p-20">
           <a href="{!! url('login') !!}" class="btn btn-danger btn-block waves-effect waves-light">Đăng xuất</a>
       </div>
   </div>
</div>