@extends('admin.admin-common')
@section('title-page', 'Thống kê số lượng học sinh tham gia ở các tỉnh')
@section('page-name', 'Tất cả tỉnh')
@section('breadcrumb')
	<li class="active">Tất cả tỉnh</li>
@endsection
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<link href="{!! asset('public/css/statistic-province.css') !!}">
@endsection
@section('scripts')
<script src="{!! asset('plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('public/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}"></script>
<script src="{!! asset('public/js/jquery.slimscroll.js') !!}"></script>
<script src="{!! asset('public/js/waves.js') !!}"></script>
<script src="{!! asset('public/js/custom.min.js') !!}"></script>
<script type="text/javascript">
function changeTableOption() {
	var tableType = document.getElementById("table-type-select").value;
	window.location.href = tableType;
}
</script>
@stop
@section('page-content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="col-md-3 col-sm-4 col-xs-6 pull-right">
				<select id="table-type-select" class="form-control pull-right row b-none" onchange="changeTableOption()">
					<option value="{!! url('admin/statistic/province') !!}" selected>Theo tỉnh</option>
					<option value="{!! url('admin/statistic/time' . '/' . date('Y')) !!}">Theo thời gian</option>
					<option value="{!! url('admin/statistic/grade') !!}">Theo khối lớp</option>
				</select>
			</div>
			<p class="text-muted">Số lượng học sinh tham gia <code>.Luolympic</code> ở các tỉnh</p>
			<!-- <p class="text-muted">Add class <code>.table</code></p> -->
			<div class="table-responsive full-width">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Tỉnh</th>
							<th>Số lượng</th>
							<th>Chi tiết</th>
						</tr>
					</thead>
					<tbody>
						@php 
							$i = 1;
						@endphp
						@foreach( $data as $prov )
							@php 
								$route = 'admin/statistic/province/' . $prov->id;
								$url = url($route);
							@endphp
							{!! '<tr>' !!}
								{!! '<td>' . $i . '</td><td>' . $prov->prov_name . '</td><td>' . $prov->nums . '</td><td><a href="' . $url . '">Chi tiết</a></td>' !!}
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
@endsection