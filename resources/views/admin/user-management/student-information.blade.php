@extends('admin.admin-common')
<?php
$id = $the_student['id'];
if ( $id < 10 )
	$id = '00' . $id;
elseif ( $id < 100 )
	$id = '0' . $id;
?>
@php
	$iden_stu = $page_name = $breadcrumb = $the_student['full_name'] . ' (' . $id . ')';
	$title = 'Thông tin tài khoản của ' . $iden_stu;
@endphp
@section('title-page')
	{!! $title !!}
@stop
@section('page-name')
	{!! $page_name !!}
@stop
@section('breadcrumb')
	<li><a href="{!! url('admin/user-management') !!}">Quản trị người dùng</a></li>
	<li class="active">{!! $breadcrumb !!}</li>
@stop
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
<script type="text/javascript">
function startDelete() {
	$('#deleteStudentModal').modal('show');
}
</script>
@endsection
@section('page-content')
<div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"><b>Xác nhận xóa</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Bạn có chắc chắn muốn xóa {!! $iden_stu !!} khỏi hệ thống
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.forms['delete-student-form'].submit()">Xóa ngay</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="white-box">
			<div class="user-bg"> 
				<img width="100%" alt="user" src="{!! asset('public/images/wallpaper.png') !!}">
				<div class="overlay-box">
					<div class="user-content">
						<a href="javascript:void(0)"><img src="{!! asset($the_student['avatar']) !!}" class="thumb-lg img-circle" alt="img"></a>
						<h4 class="text-white">{!! $the_student['full_name'] !!}</h4>
						
						<h5 class="text-white">ID: {!! $id !!}</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12">
		<div class="white-box">
			<form id="student-info-form" class="form-horizontal form-material">
				<div class="form-group">
					<label class="col-md-12">Họ và tên đệm</label>
					<div class="col-md-12">
						<input type="text" name="last-name" class="form-control form-control-line" value="{!! $the_student['last_name'] !!}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="example-email" class="col-md-12">Tên</label>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-line" name="first-name" value="{!! $the_student['first_name'] !!}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Ngày sinh</label>
					@php
						$birthday = date_create( $the_student['birthday'] );
						$birthday = date_format( $birthday, "d-m-Y" );
					@endphp
					<div class="col-md-12">
						<input type="text" value="{!! $birthday !!}" name="birthday" class="form-control form-control-line" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Khối</label>
					<div class="col-md-12">
						<input type="text" value="{!! 'Khối ' .$the_student['grade'] !!}" name="grade" class="form-control form-control-line" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Lớp</label>
					<div class="col-md-12">
						<input type="text" value="{!! 'Lớp ' . $the_student['class'] !!}" name="class" class="form-control form-control-line" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Trường</label>
					<div class="col-md-12">
						<input type="text" value="{!! $the_student['school_name'] !!}" name="school" class="form-control form-control-line" readonly>
					</div>
				</div>
			</form>
			<form id="delete-student-form" class="form-horizontal form-material" method="get" action="{!! url('admin/delete-student-account') !!}">
				<input type="hidden" name="stu-id" value="{!! $the_student['id'] !!}">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="form-group">
					<div class="col-sm-12">
						<button class="btn btn-danger" type="button" onclick="startDelete()">Xóa người dùng</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop