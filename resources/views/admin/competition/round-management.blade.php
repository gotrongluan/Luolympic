@extends('admin.admin-common')
@php
	$title = $page_name = 'Quản trị vòng thi ' . $round_val . ', lớp ' . $class;
@endphp
@section('title-page')
	{!! $title !!}
@stop
@section('page-name')
	{!! $page_name !!}
@stop
@section('breadcrumb')
	<li><a href="{!! url('admin/competition-management') !!}">Quản trị vòng thi</a></li>
	<li><a href="{!! url('admin/competition-management/' . $class) !!}">Lớp {!! $class !!}</a></li>
	<li class="active">Vòng thi {!! $round_val !!}</li>
@stop
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<style>
.text-truncate {
	white-space: nowrap;
  	overflow: hidden;
  	text-overflow: ellipsis;
  	max-width: 560px;
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
			<!-- <div class="pull-right row b-none">
				
			</div> -->
			<p class="text-muted"><code>. Danh sách các câu hỏi vòng {!! $round_val !!}</code></p>
			@if ( $new_round )
				<p>
					<button type="button" class="btn btn-success btn-sm" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Phát hành</button>
				</p>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<form class="form-horizontal form-material" method="post" action="{!! url('admin/process-new-round') !!}">
							<input type="hidden" name="_token" value="{!! csrf_token() !!}">
							<input type="hidden" name="class" value="{!! $class !!}">
							<div class="form-group">
								<label class="col-md-12">Chọn ngày</label>
								<div class="col-md-12">
									<input type="date" name="date-publish" class="form-control form-control-line">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-warning" type="submit">Phát hành ngay</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			@endif
			@if ( $new_round )
				@php
					$unie = 1;
				@endphp
			@else
				@php
					$unie = 0;
				@endphp
			@endif
			<div class="table-responsive" style="width:100%">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Nội dung</th>
							<th>Loại</th>
							<th>Mức độ</th>
							<th>Chi tiết</th>
						</tr>
					</thead>
					<tbody>
						@php
							$i = 1;
						@endphp
						@foreach ( $many_ques as $the_question )
							{!! '<tr><td>' . $i . '</td>' !!}
							@php
								$type = ( $the_question->type == 1 ) ? 'Trắc nghiệm' : (( $the_question->type == 2 ) ? 'Chọn' : 'Tự luận');
								$url = url('admin/detail-question/' . $the_question->id . '/' . $unie);
								$content = str_replace("<div>", "", $the_question->content);
								$content = str_replace("</div>", " ", $content);
							@endphp
							{!! '<td class="text-truncate">' . $content . '</td><td>' . $type . '</td><td>' . $the_question->level . '</td><td><a href="' . $url . '">Chi tiết</a></td>' !!}
							{!! '</tr>' !!}
							@php
								$i++;
							@endphp
						@endforeach

						
						<tr><td colspan="5"><a href="{!! url('admin/add-new-question/' . $unie . '/3/' . $class . '/' . $round_val)!!}"><i class="fa fa-plus"></i>&nbsp;Thêm câu hỏi <b>tự luận</b></a></td></tr>
						<tr><td colspan="5"><a href="{!! url('admin/add-new-question/' . $unie . '/2/' . $class . '/' . $round_val)!!}"><i class="fa fa-plus"></i>&nbsp;Thêm câu hỏi <b>nhiều lựa chọn</b></a></td></tr>
						<tr><td colspan="5"><a href="{!! url('admin/add-new-question/' . $unie . '/1/' . $class . '/' . $round_val)!!}"><i class="fa fa-plus"></i>&nbsp;Thêm câu hỏi <b>trắc nghiệm</b></a></td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
