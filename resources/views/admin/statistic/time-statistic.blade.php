@extends('admin.admin-common')
@section('title-page')
	Thống kê số lượng học sinh tham gia năm {!! $year !!}
@stop
@section('page-name')
	Thống kê năm {!! $year !!}
@stop
@section('breadcrumb')
	<li class="active">Thống kê năm {!! $year !!}</li>
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
function changeYear() {
	var selectedYear = document.getElementById("year-select").value;
	window.location.href = selectedYear;
}
</script>
@stop
@section('page-content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<div class="col-md-3 col-sm-4 col-xs-6 pull-right">
				<select id="table-type-select" class="form-control pull-right row b-none" onchange="changeTableOption()">
					<option value="{!! url('admin/statistic/province') !!}" >Theo tỉnh</option>
					<option value="{!! url('admin/statistic/time' . '/' . date('Y')) !!}" selected>Theo thời gian</option>
					<option value="{!! url('admin/statistic/grade') !!}">Theo khối lớp</option>
				</select>
			</div>
			<p class="text-muted pull-left">Số lượng học sinh tham gia <code>.Luolympic</code> năm 
				<select id="year-select" class="form-control row b-none pull-left" onchange="changeYear()">
					@php
						$cur_year = (int)date("Y");
					@endphp
					@for ( $i = $cur_year; $i >= 2016; --$i )
						@php
							$selected = ($i == $year) ? "selected" : "";
							$url = url('admin/statistic/time/' . $i);
						@endphp
						{!! '<option value="' . $url . '" ' . $selected . '>' . $i . '</option>' !!}
					@endfor
				</select>
			</p>
			<!-- <p class="text-muted">Add class <code>.table</code></p> -->
			<div class="table-responsive full-width">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Tháng</th>
							<th>Năm</th>
							<th>Số lượng</th>
						</tr>
					</thead>
					<tbody>
						@php
							$cur_month = (int)date("m");
						@endphp
						@if ( $year < $cur_year )
							@php
								$cur_month = 12;
							@endphp
						@endif
						@php
							$i = 1;
						@endphp
						@for ( $j = $cur_month; $j >= 1; --$j )
							{!! '<tr><td>' . $i . '</td><td>Tháng ' . $j . '</td><td>' . $year . '</td><td>' . $data[$j] . '</td></tr>' !!}
							@php
								$i++;
							@endphp
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection