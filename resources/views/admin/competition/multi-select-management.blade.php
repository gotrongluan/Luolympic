@extends('admin.admin-common')
@php
	$title = $page_name = 'Câu nhiều lựa chọn cho vòng ' . $round_val . ', lớp ' . $class;
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
	@if ( $unie == 1 )
		<li><a href="{!! url('admin/custom-current-new-round/' . $class) !!}">Vòng thi {!! $round_val !!}</a></li>
	@else
		<li><a href="{!! url('/admin/round-management/' . $class . '/' . $round_val) !!}">Vòng thi {!! $round_val !!}</a></li>
	@endif
	<li class="active">Câu nhiều lựa chọn</li>
@stop
@section('stylesheets')
<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
<link rel="stylesheet" href="{!! asset('public/css/sites.css') !!}" type="text/css">
<link rel="stylesheet" href="{!! asset('public/css/richtext.min.css') !!}" type="text/css">
<style>
.edit-selected {
	opacity: 0.5;
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="{!! asset('public/js/jquery.richtext.js') !!}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script>
    $(document).ready(function() {
        $('.content').richText();
    });
</script>
<script src="{!! asset('public/js/new-multi-choice-management.js') !!}"></script>
@stop
@section('page-content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<!-- <div class="pull-right row b-none">
				
			</div> -->
			<p class="text-muted"><code>. Câu hỏi nhiều lựa chọn cho vòng {!! $round_val !!}, lớp {!! $class !!}</code></p>
			<form id="multi-choice-form" class="form-horizontal form-material" method="post" action="{!! url('admin/process-new-multi-select') !!}">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<input type="hidden" name="class" value="{!! $class !!}">
				<input type="hidden" name="round" value="{!! $round_val !!}">
				<input type="hidden" name="unie" value="{!! $unie !!}">
				<textarea class="hidden" id="the_question" name="the-question"></textarea>
				<textarea class="hidden" id="answer_a" name="answer-a"></textarea>
				<textarea class="hidden" id="answer_b" name="answer-b"></textarea>
				<textarea class="hidden" id="answer_c" name="answer-c"></textarea>
				<textarea class="hidden" id="answer_d" name="answer-d"></textarea>
				<div class="form-group edit-selected">
					<label class="col-xs-12"><button type="button" class="btn btn-primary btn-sm pull-left my-love-btn">Câu hỏi</button></label>
					<div id="question-container" class="col-xs-12 the-container">
						{!! isset( $ques_cont ) ? $ques_cont : "" !!}
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-xs-12"><button type="button" class="btn btn-success btn-sm pull-left my-love-btn">Đáp án A</button></label>
					<div id="answer-a-container" class="col-xs-12 the-container">
						{!! isset( $answer_a ) ? $answer_a : "" !!}
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-xs-12"><button type="button" class="btn btn-warning btn-sm pull-left my-love-btn">Đáp án B</button></label>
					<div id="answer-b-container" class="col-xs-12 the-container">
						{!! isset( $answer_b ) ? $answer_b : "" !!}
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-xs-12"><button type="button" class="btn btn-info btn-sm pull-left my-love-btn">Đáp án C</button></label>
					<div id="answer-c-container" class="col-xs-12 the-container">
						{!! isset( $answer_c ) ? $answer_c : "" !!}
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-xs-12"><button type="button" class="btn btn-danger btn-sm pull-left my-love-btn">Đáp án D</button></label>
					<div id="answer-d-container" class="col-xs-12 the-container">
						{!! isset( $answer_d ) ? $answer_d : "" !!}
					</div>
				</div>
				<div class="form-group">
					<div class="page-wrapper box-content">
						<textarea id="luantnguyen" class="content" name="question-content">{!! isset( $ques_cont ) ? $ques_cont : "" !!}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12">Mức độ</label>
					<div class="col-md-3 col-xs-12">
						@php
							$selection = ['1' => "", '2' => "", '3' => "", '4' => "", '5' => "", '6' => "", '7' => ""];
							if ( isset( $ques_level ) )
								$selection[$ques_level] = "selected";
						@endphp
						<select name="level" class="form-control form-control-line">
							<option value="1" {!! $selection['1'] !!}>Mức 1 (10 điểm)</option>
							<option value="2" {!! $selection['2'] !!}>Mức 2 (10 điểm)</option>
							<option value="3" {!! $selection['3'] !!}>Mức 3 (10 điểm)</option>
							<option value="4" {!! $selection['4'] !!}>Mức 4 (20 điểm)</option>
							<option value="5" {!! $selection['5'] !!}>Mức 5 (20 điểm)</option>
							<option value="6" {!! $selection['6'] !!}>Mức 6 (30 điểm)</option>
							<option value="7" {!! $selection['7'] !!}>Mức 7 (30 điểm)</option>
						</select>
					</div>
				</div>
				<p class="text-danger" id="err-mess"></p>
				<div class="form-group">
					<label class="col-md-12">Đáp án</label>
					<div class="col-md-3 col-md-12">
						@php
							$answering = ['A' => "", 'B' => "", 'C' => "", 'D' => ""];
							if ( isset( $answers ) )
							{
								for ( $i = 0; $i < count($answers); ++$i )
									$answering[$answers[$i]] = "selected";
							}
						@endphp
						<select name="answers[]" class="form-control form-control-line" multiple>
							<option value="A" {!! $answering['A'] !!}>Đáp án A</option>
							<option value="B" {!! $answering['B'] !!}>Đáp án B</option>
							<option value="C" {!! $answering['C'] !!}>Đáp án C</option>
							<option value="D" {!! $answering['D'] !!}>Đáp án D</option>
						</select>
					</div>
				</div>
				@if ( !isset( $ques_cont ) )
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-info" type="button" onclick="createMultiChoice()">Tạo</button>
							<button class="btn btn-danger" type="button" onclick="resetQuestion()">Làm lại</button>
						</div>
					</div>
				@endif
			</form>
			@if ( isset( $ques_cont ) )
				<form class="form-horizontal form-material" method="get" action="{!! url('admin/delete-question') !!}">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<input type="hidden" name="question-id" value="{!! $ques_id !!}">
					<input type="hidden" name="unie" value="{!! $unie !!}">
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-danger" type="submit">Xóa câu hỏi</button>
						</div>
					</div>
				</form>
			@endif
		</div>
	</div>
</div>
@stop
