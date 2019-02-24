@extends('admin.admin-common')
@section('title-page', 'Quản trị vòng thi')
@section('page-name', 'Quản trị vòng thi')
@section('breadcrumb')
	<li class="active">Quản trị vòng thi</li>
@stop
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<style>
.btn-unie { 
	margin-bottom: 15px;
	border-left: 2px solid black;
	border-radius: none;
	text-align: left;
}

.btn-unie:hover {
	background-color: #ddd;
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
			@foreach ( $cur_rounds as $class => $cur_round )
				<a role="button" href="{!! url('admin/competition-management/' . $class) !!}" class=" btn btn-unie btn-lg btn-block">Khối {!! $class !!} <span class="badge badge-success pull-right">cur: {!! $cur_round !!}</span></a>
			@endforeach
		</div>
	</div>
</div>
@stop
