@extends('admin.admin-common')
@php
	$title = $page_name = 'Quản trị vòng thi lớp ' . $class;
@endphp
@section('title-page')
	{!! $title !!}
@stop
@section('page-name')
	{!! $page_name !!}
@stop
@section('breadcrumb')
	<li><a href="{!! url('admin/competition-management') !!}">Quản trị vòng thi</a></li>
	<li class="active">Lớp {!! $class !!}</li>
@stop
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<style>
.round {
	margin-top: 12px;
}
</style>
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
	<div class="col-md-12">
		<div class="white-box">
			@if ( $have_next_round_val == 1 )
				<a class="btn btn-success" role="button" href="{!! url('admin/custom-current-new-round/' . $class) !!}">Chỉnh sửa vòng thi mới (vòng {!! $cur_round_val + 1 !!})</a>
			@else
				@if ( $time_new_round_val == '0' || date_create(date("Y-m-d")) >= date_create( $time_new_round_val ) )
					<a class="btn btn-warning" role="button" href="{!! url('admin/custom-current-new-round/' . $class . '/1') !!}">Thêm vòng thi mới (vòng {!! $cur_round_val + 1 !!})</a>
				@else
					<p class="text-muted">Vòng thi {!! $cur_round_val !!} đang chờ được ra mắt</p>
				@endif
			@endif
			<h4>Các vòng thi đã tạo</h4>
			@if ( $cur_round_val == 0) 
				<p class="text-muted">Chưa có vòng thi nào được tạo</p>
			@else
				@for ( $i = 1; $i <= $cur_round_val; ++$i )
					@if ( $i % 11 == 1 )
						<div class="btn-group" role="group" aria-label="Các vòng thi đã tạo">
					@endif
						<a href="{!! url('admin/round-management/' . $class . '/' . $i) !!}" role="button" class="btn btn-info round">Vòng {!! $i !!}</a>
					@if ( $i % 11 == 0 )
						</div>
					@endif
				@endfor
				@if ( ($cur_round_val % 11) != 0 )
					</div>
				@endif
			@endif	
		</div>
	</div>
</div>
@stop
