@extends('admin.admin-common')
@section('title-page', 'Trang chủ')
@section('page-name', 'Bảng điều khiển')
@section('breadcrumb')
	<li class="active">Bảng điều khiển</li>
@stop
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/toast-master/css/jquery.toast.css') !!}" rel="stylesheet">

<link href="{!! asset('plugins/bower_components/morrisjs/morris.css') !!}" rel="stylesheet">

<link href="{!! asset('plugins/bower_components/chartist-js/dist/chartist.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
@stop
@section('scripts')
<script src="{!! asset('plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('public/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}"></script>
<script src="{!! asset('public/js/jquery.slimscroll.js') !!}"></script>
<script src="{!! asset('public/js/waves.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/counterup/jquery.counterup.min.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/chartist-js/dist/chartist.min.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') !!}"></script>
<script src="{!! asset('public/js/custom.min.js') !!}"></script>
<script src="{!! asset('public/js/dashboard1.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/toast-master/js/jquery.toast.js') !!}"></script>
<script src="{!! asset('public/js/change-province-dashboard.js') !!}"></script>
@stop
@section('page-content')
<div class="row">
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Số học sinh tham gia</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">
					{!! $num_participants['num_student'] !!}
				</span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Số trường tham gia</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash2"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">
					{!! $num_participants['num_school'] !!}
				</span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-4 col-sm-6 col-xs-12">
		<div class="white-box analytics-info">
			<h3 class="box-title">Số tỉnh tham gia</h3>
			<ul class="list-inline two-part">
				<li>
					<div id="sparklinedash3"></div>
				</li>
				<li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">
					{!! $num_participants['num_province'] !!}
				</span></li>
			</ul>
		</div>
	</div>
</div>
<!--/.row -->
<!--row -->
<!-- /.row -->
<!-- <div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
		<div class="white-box">
			<h3 class="box-title">Số lượng học sinh tham gia hàng tháng</h3>
			<ul class="list-inline text-right">
				<li>
					<h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5>
				</li>
				<li>
					<h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5>
				</li>
			</ul>
			<div id="ct-visits" style="height: 405px;"></div>
		</div>
	</div>
</div> -->
<!-- ============================================================== -->
<!-- table -->
<!-- ============================================================== -->
<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="white-box">
			<div class="col-md-3 col-sm-4 col-xs-6 pull-right">
				<select id="prov-select" class="form-control pull-right row b-none" onchange="changeProvince(this)">
					<?php $selected = "selected"; ?>
					@foreach( $provs as $prov )
						{!! '<option value="' . $prov['id'] . '" ' . $selected . '>' . $prov['prov_name'] . '</option>' !!}
						<?php $selected = ""; ?>
					@endforeach
				</select>
			</div>
			<h3 class="box-title">Trường nhiều học sinh tham gia nhất</h3>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>TRƯỜNG</th>
							<th>CẤP</th>
							<th>HUYỆN, QUẬN</th>
							<th>SỐ HỌC SINH</th>
						</tr>
					</thead>
					<tbody id="my-table"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- chat-listing & recent comments -->
<!-- ============================================================== -->
<div class="row">
	<!-- .col -->
	<div class="col-md-12 col-lg-8 col-sm-12">
		<div class="white-box">
			<h3 class="box-title">Góp ý gần đây</h3>
			<div class="comment-center p-t-10">
				@foreach ( $cmts as $cmt )
					@include('components.recent-comment-item', ['cmt_subject' => $cmt['subject'], 'cmt_content' => $cmt['content'], 'stu_name' => $cmt['stu_name'], 'time' => $cmt['created_at'], 'stu_avatar' => $cmt['stu_avatar']])
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12">
		<div class="panel">
			<div class="sk-chat-widgets">
				<div class="panel panel-default">
					<div class="panel-heading">
						DANH SÁCH CHAT
					</div>
					<div class="panel-body">
						<ul class="chatonline">
							@foreach ( $friends as $friend )
								<li>
									@include('components.chat-item', ['friend_name' => $friend['full_name'], 'friend_avatar' => $friend['avatar']])
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.col -->
</div>
@stop
