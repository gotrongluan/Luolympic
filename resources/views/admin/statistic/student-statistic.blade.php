@extends('admin.admin-common')
@php
	$title = 'Danh sách học sinh tham gia ở ' . $school_name . ', ' . $dist_name . ', ' . $prov_name;
	$page_name = $school_name . ', ' . $dist_name;
@endphp
@section('title-page')
	{!! $title !!}
@endsection
@section('page-name')
	{!! $page_name !!}
@stop
@section('breadcrumb')
	<li><a href="{!! url('admin/statistic/province') !!}">Tất cả tỉnh</a></li>
	<li><a href="{!! url('admin/statistic/province/' . $prov_id) !!}">{!! $prov_name !!}</a></li>
	<li><a href="{!! url('admin/statistic/province/' . $prov_id . '/' . $dist_id) !!}">{!! $dist_name !!}</a></li>
	<li class="active">{!! $school_name !!}</li>
@endsection
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
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
<script src="{!! asset('public/js/custom.min.js') !!}"></script>
@stop
@section('page-content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<p class="text-muted">Danh sách học sinh tham gia <code>.Luolympic</code> ở {!! $school_name!!}, {!! $dist_name !!}, {!! $prov_name !!}</p>
			<!-- <p class="text-muted">Add class <code>.table</code></p> -->
			<div class="table-responsive full-width">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Họ và tên</th>
							<th>Ngày sinh</th>
							<th>Khối</th>
							<th>Lớp</th>
						</tr>
					</thead>
					<tbody>
						@php 
							$i = 1;
						@endphp
						@foreach( $data as $student )
							@php
								$birthday = date_create( $student['birthday'] );
								$birthday = date_format( $birthday, "d-m-Y" );
							@endphp
							{!! '<tr>' !!}
								{!! '<td>' . $i . '</td><td>' . $student['full_name'] . '</td><td>' .$birthday . '</td><td>' . $student['grade'] . '</td><td>' . $student['class'] . '</td>' !!}
							{!! '</tr>' !!}
							@php
								$i++;
							@endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
