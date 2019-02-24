@extends('admin.admin-common')
@section('title-page', 'Quản trị người dùng')
@section('page-name', 'Quản trị người dùng')
@section('breadcrumb')
	<li class="active">Quản trị người dùng</li>
@endsection
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<style>
.pagination { margin: 0; }

.isDisabled {
	cursor: not-allowed;
	opacity: 0.5;
}

.isDisabled > a {
	color: currentColor;
	pointer-events: none;
	text-decoration: none;
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
	<div class="col-sm-12">
		<div class="white-box">
			<div class="pull-right row b-none pagination">
					<code>. {!! $num_student !!} học sinh</code>
					@php
						$prev_hidden = $next_hidden = "";
					@endphp
					@if ( $page == 1 )
						@php
							$prev_hidden = "isDisabled";
						@endphp
					@endif
					@if ( $page == $num_page )
						@php
							$next_hidden = "isDisabled";
						@endphp
					@endif
					<a class="btn btn-secondary {!! $prev_hidden !!}" role="button" href="{!! url('admin/user-management') !!}"><i class="fa fa-long-arrow-left"></i></a>
					<a class="btn btn-secondary {!! $prev_hidden !!}" role="button" href="{!! url('admin/user-management/' . ($page - 1)) !!}"><i class="fa fa-caret-left"></i></a>
					<a class="btn btn-primary" role="button" href="#">{!! $page !!}</a>
					<a class="btn btn-secondary {!! $next_hidden !!}" role="button" href="{!! url('admin/user-management/' . ($page + 1)) !!}"><i class="fa fa-caret-right"></i></a>
					<a class="btn btn-secondary {!! $next_hidden !!}" role="button" href="{!! url('admin/user-management/' . $num_page) !!}"><i class="fa  fa-long-arrow-right"></i></a>
				</div>
			<p class="text-muted">Danh sách người dùng của hệ thống</p>
			<div class="table-responsive" style="width:100%">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Họ và tên</th>
							<th>Ngày sinh</th>
							<th>Lớp</th>
							<th>Trường</th>
							<th>Spam</th>
							<th>Chi tiết</th>
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
						@endphp
						@foreach ( $data as $student )
							@php
								$birthday = date_create( $student['birthday'] );
								$birthday = date_format( $birthday, "d-m-Y" );
								$url = url('admin/student-information/' . $student['id']);
							@endphp
							{!! '<tr><td>' . $i . '</td><td>' . $student['full_name'] . '</td><td>' . $birthday . '</td><td>' . $student['grade'] . '</td><td>' . $student['full_school'] . '</td>' !!}
							@if ( $student['spam'] == 0 )
								{!! '<td>0</td>' !!}
							@elseif ( $student['spam'] == 1 )
								{!! '<td class="text-success">1</td>' !!}
							@elseif ( $student['spam'] == 2 )
								{!! '<td class="text-info">2</td>' !!}
							@elseif ( $student['spam'] == 3 )
								{!! '<td class="text-warning">3</td>' !!} 
							@else
								{!! '<td class="text-danger">4</td>' !!}
							@endif
							{!! '<td><a href="' . $url . '">Chi tiết</a></td></tr>' !!}
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
