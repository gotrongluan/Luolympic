<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('plugins/images/favicon.png') !!}">
    <title>@yield('title-page')</title>
    @section('stylesheets')
    @show
</head>
<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
        <!-- Navigation bar -->
        @include('common.nav', ['admin_name' => $full_name, 'avatar_url' => $avatar_url])

        <!-- Sidebar -->
        @include('common.sidebar')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">@yield('page-name')</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!-- <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a> -->
                        <ol class="breadcrumb">
                            <li><a href="{!! url('admin/dashboard') !!}">Bảng điều khiển</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @section('page-content')
                @show
            </div>
            <!-- Footer -->
            @include('common.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    @section('scripts')
    @show
</body>

</html>
