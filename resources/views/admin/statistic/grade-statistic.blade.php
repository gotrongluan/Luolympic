@extends('admin.admin-common')
@section('title-page', 'Thống kê số lượng học sinh tham gia theo khối')
@section('page-name', 'Thống kê theo khối')
@section('breadcrumb')
	<li class="active">Thống kê theo khối</li>
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
					<option value="{!! url('admin/statistic/province') !!}">Theo tỉnh</option>
					<option value="{!! url('admin/statistic/time' . '/' . date('Y')) !!}">Theo thời gian</option>
					<option value="{!! url('admin/statistic/grade') !!}" selected>Theo khối lớp</option>
				</select>
			</div>
			<p class="text-muted">Số lượng học sinh tham gia <code>.Luolympic</code> theo từng khối</p>
			<!-- <p class="text-muted">Add class <code>.table</code></p> -->
			<div class="table-responsive full-width">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Khối lớp</th>
							<th>Số lượng học sinh</th>
						</tr>
					</thead>
					<tbody>
						@php 
							$j = count( $data ) - 1;
						@endphp
						@for ( $i = 12; $i >= 1; --$i )
							{!! '<tr><td>' . (13 - $i) . '</td>' !!}
							@if ( $j >= 0 )
								@if ( $i > $data[$j]->grade )
									{!! '<td>Khối ' . $i . '</td><td>0</td>' !!}
								@else
									{!! '<td>Khối ' . $i . '</td><td>' . $data[$j]->nums . '</td>' !!}
									@php
										$j--;
									@endphp
								@endif
							@else
								{!! '<td>Khối ' . $i . '</td><td>0</td>'!!}
							@endif
							{!! '</tr>' !!}
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection