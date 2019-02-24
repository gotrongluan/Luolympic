@extends('admin.admin-common')
@section('title-page', 'Thông tin tài khoản')
@section('page-name', 'Thông tin tài khoản')
@section('breadcrumb')
	<li class="active">Thông tin tài khoản</li>
@stop
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<link href="{!! asset('public/css/account-management.css') !!}" type="text/css" rel="stylesheet">
@stop
@section('scripts')
<script src="{!! asset('plugins/bower_components/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('public/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') !!}"></script>
<script src="{!! asset('public/js/jquery.slimscroll.js') !!}"></script>
<script src="{!! asset('public/js/waves.js') !!}"></script>
<script src="{!! asset('public/js/custom.min.js') !!}"></script>
<script src="{!! asset('public/js/account-management.js') !!}"></script>
@if ( isset( $code ) )
<script type="text/javascript">
	$(window).load(function(){        
		$('#updateInfoModal').modal('show');
	});
</script>
@endif
@endsection
@section('page-content')
<?php $modal_update_info_title = "" ?>
@if ( isset( $code ) )
	@if ( $code == 200 )
		<?php $modal_update_info_title = "Cập nhật thành công" ?>
	@elseif ( $code == 201 )
		<?php $modal_update_info_title = "Đổi mật khẩu thành công" ?>
	@elseif ( $code == 300 )
		<?php $modal_update_info_title = "Cập nhật thất bại"; ?>
	@else
		<?php $modal_update_info_title = "Đổi mật khẩu thất bại"; ?>
	@endif
@endif
<div class="modal fade" id="updateInfoModal" tabindex="-1" role="dialog" aria-labelledby="updateInfoModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{!! $modal_update_info_title !!}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@if ( isset( $code ) )
					@if ( $code == 200 )
						{!! 'Thông tin của bạn đã được cập nhật' !!}
					@elseif ( $code == 201 )
						{!! 'Mật khẩu của bạn đã được đổi' !!}
					@else
						@if ( count($errors) > 0 )
							<span>{!! ($code == 300) ? 'Thông tin cập nhật không hợp lệ' : 'Mật khẩu mới không hợp lệ' !!}</span>
							<ul>
								@foreach( $errors->all() as $error )
									<li>{!! $error !!}</li>
								@endforeach
							</ul>
						@endif
					@endif
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Đã hiểu</button>
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
						<a href="javascript:void(0)"><img src="{!! asset($the_admin['avatar']) !!}" class="thumb-lg img-circle" alt="img"></a>
						<h4 class="text-white">{!! $the_admin['username'] !!}</h4>
						<h5 class="text-white">{!! $the_admin['email'] !!}</h5>
					</div>
				</div>
			</div>
			<div class="user-btm-box">
				<div class="col-md-12 col-sm-12 text-center">
					<?php
						$id = $the_admin['id'];
						if ( $id < 10 )
							$id = '00' . $id;
						elseif ( $id < 100 )
							$id = '0' . $id;
					?>
					<h3>ID: {!! $id !!}</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-xs-12">
		<div class="white-box">
			<form id="admin-info-form" class="form-horizontal form-material" method="post" action="{!! url('update-admin-info') !!}">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="form-group">
					<label class="col-md-12">Họ và tên đệm</label>
					<div class="col-md-12">
						<input type="text" name="last-name" class="form-control form-control-line admin-info" value="{!! $the_admin['last_name'] !!}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="example-email" class="col-md-12">Tên</label>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-line admin-info" name="first-name" value="{!! $the_admin['first_name'] !!}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Số điện thoại</label>
					<div class="col-md-12">
						<input type="text" value="{!! $the_admin['phone'] !!}" name="phone-number" class="form-control form-control-line admin-info" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Địa chỉ</label>
					<div class="col-md-12">
						<input type="text" value="{!! $the_admin['address'] !!}" name="address" class="form-control form-control-line admin-info" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Email</label>
					<div class="col-md-12">
						<input type="email" value="{!! $the_admin['email'] !!}" name="email" class="form-control form-control-line admin-info" readonly>
					</div>
				</div>
				<p id="err-message" class="text-danger"></p>
				<div class="form-group">
					<div id="update-btns" class="col-sm-12">
						<button id="update-btn" class="btn btn-success" onclick="startUpdate()" type="button">Cập nhật</button>
						<button id="change-pass-btn" class="btn btn-warning" type="button" onclick="startChangePassword()">Đổi mật khẩu</button>
					</div>
					<div id="when-update-btns" class="col-sm-12">
						<button class="btn btn-info" type="button" onclick="saveUpdate()">Lưu thay đổi</button>
						<button class="btn btn-danger" type="button" onclick="stopUpdate()">Thoát</button>
					</div>
				</div>
			</form>
			<br />
			<form id="change-password-form" class="form-horizontal form-material" method="post" action="{!! url('change-admin-password') !!}">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="form-group">
					<label class="col-md-12">Mật khẩu cũ</label>
					<div class="col-md-12">
						<input type="password" name="old-password" class="form-control form-control-line admin-password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Mật khẩu mới</label>
					<div class="col-md-12">
						<input type="password" name="new-password" class="form-control form-control-line admin-password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12">Nhập lại mật khẩu mới</label>
					<div class="col-md-12">
						<input type="password" name="new-password_confirmation" class="form-control form-control-line admin-password">
					</div>
				</div>
				<p id="err-message-change-password" class="text-danger"></p>
				<div class="form-group">
					<div id="update-btns" class="col-sm-12">
						<button class="btn btn-info" type="button" onclick="saveChangePassword()">Lưu thay đổi</button>
						<button class="btn btn-danger" type="button" onclick="stopChangePassword()">Thoát</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop