@extends('admin.admin-common')
@section('title-page', 'Quản trị tin tức')
@section('page-name', 'Quản trị tin tức')
@section('breadcrumb')
	<li class="active">Quản trị tin tức</li>
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
<script>
	function deleteSubject( id ) {
		document.getElementById("subject").value = id;
		$("#deleteSubjectModal").modal("show");
	}
	function editSubject( id ) {
		document.getElementById("sub-id").value = id;
		$("#editSubjectModal").modal("show");
	}
</script>
@stop
@section('page-content')
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLabel">Bạn có chắc chắn muốn xóa chủ đề tin tức này không?</span>>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Nếu xóa chủ đề này, tất cả tin tức có chủ đề này sẽ bị xóa theo
      </div>
      <div class="modal-footer">
      	<form method="get" action="{!! url('admin/delete-news-subject') !!}">
      		<input type="hidden" name="news-subject-id" value="" id="subject">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
        	<button type="submit" class="btn btn-primary">Xóa ngay</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="{!! url('admin/edit-news-subject') !!}">
      	<input type="hidden" name="new-sub-id" value="" id="sub-id">
      	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
      	<div class="modal-header">
      		<span class="modal-title" id="exampleModalLabel">Thay đổi tên chủ đề</span>
      		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      			<span aria-hidden="true">&times;</span>
      		</button>
      	</div>
      	<div class="modal-body">
			<input type="text" name="new-sub-name" placeholder="Tên mới" class="form-control form-control-line">
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
      		<button type="submit" class="btn btn-primary">Lưu</button>
      	</div>
  	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="{!! url('admin/add-news-subject') !!}">
      	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
      	<div class="modal-header">
      		<span class="modal-title" id="exampleModalLabel">Thêm chủ đề mới</span>
      		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      			<span aria-hidden="true">&times;</span>
      		</button>
      	</div>
      	<div class="modal-body">
			<input type="text" name="the-name" placeholder="Tên chủ đề mới" class="form-control form-control-line">
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
      		<button type="submit" class="btn btn-primary">Lưu</button>
      	</div>
  	  </form>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<p class="text-muted"><code>. Danh sách các chủ đề tin tức</code></p>
			<div class="table-responsive" style="width:100%">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Tên chủ đề</th>
							<th>Chi tiết</th>
							<th>Chỉnh sửa</th>
							<th>Xóa</th>
						</tr>
						@php
							$i = 1;
						@endphp
						@foreach ( $news_subjects as $news_subject )
							{!! '<tr><td>' . $i . '</td>' !!}
								{!! '<td>' . $news_subject->name . '</td>' !!}
								{!! '<td><a href="' . url('admin/detail-news-subject/' . $news_subject->id) . '">Chi tiết</a></td>' !!}
								{!! '<td><a href="#" onclick="deleteSubject(' . $news_subject->id . '); return false;">Xóa</a></td>' !!}
								{!! '<td><a href="www.facebook.com" onclick="editSubject(' . $news_subject->id . '); return false;">Sửa</a></td>' !!}
							{!! '</tr>' !!}
							@php
								$i++;
							@endphp
						@endforeach
					</thead>
					<tbody>
						<tr><td colspan="3"><a href="#" data-toggle="modal" data-target="#addSubjectModal"><i class="fa fa-plus"></i>&nbsp;Thêm chủ đề mới</a></td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
