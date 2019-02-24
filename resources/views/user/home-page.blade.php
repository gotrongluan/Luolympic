<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="{!! asset('plugins/images/favicon.png') !!}">
	<title>Trang chủ</title>
	<link href="{!! asset('public/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link rel="stylesheet" href="{!! asset('public/css/home-page.css') !!}">
	<link href="{!! asset('public/css/animate.css') !!}" rel="stylesheet">
	<link href="{!! asset('public/css/style.css') !!}" rel="stylesheet">
	<link href="{!! asset('public/css/colors/default.css') !!}" id="theme" rel="stylesheet">
</head>
<body>
	<div class="super">
		<div class="super-container">
			<div class="container">
				@include('common.header')
				@include('common.user-nav', ['active_item' => 'home'])
				<div class="introduction">
					<div class="intro-containers">
						<div class="intro-container"  style="{!! 'background:url(' . asset('public/images/bg/bg.jpg') . ');background-size:100% auto'!!}">
							<div class="intro-content">Luolympic là một cuộc thi về kiến thức công nghệ thông tin, hình thức online do ông trùm Trọng Luân làm chủ tịch</div>
						</div>
						<div class="intro-container" style="{!! 'background:url(' . asset('public/images/bg/bg-07.jpg') . ')'!!}">
							<div class="intro-content">Luolympic được đại học Bách Khoa tài trợ, những thí sinh có thành tích vượt trội ở sân chơi này sẽ được trúng tuyển vào ĐHBK</div>
						</div>
						<div class="intro-container" style="{!! 'background:url(' . asset('public/images/bg/bg-08.jpg') . ')'!!}">
							<div class="intro-content">Luolympic hứa hẹn sẽ đem lại sân chơi bổ ích cho học sinh từ lớp 1 đến lớp 12</div>
						</div>
					</div>
					<div class="intro-navigation flex-intro-container">
						<span><i class="fa fa-angle-double-left"></i></span>
						<span id="count">1/3</span>
						<span><i class="fa fa-angle-double-right"></i></span>
					</div>
				</div>
				<div></div>
				<div class="statistic">
					<div class="best-students best-col">
						<div class="sta-title">
							<span><img alt="icon" style="width:18%" src="{!! asset('public/images/565fab9e.svg') !!}"></span>
							<span>ĐIỂM CAO NHẤT QUỐC GIA</span>
						</div>
						<div class="selections" style="color:black">
							<select class="classes" name="classes" size="5"></select>
						</div>
						<div class="sta-content">
							<div class="best-student"></div>
							<div class="four-students"></div>
						</div>
					</div>
					<div class="best-students-local best-col">
						<div class="sta-title">
							<span><img alt="icon" style="width:18%" src="{!! asset('public/images/565fab9e.svg') !!}"></span>
							<span>ĐIỂM CAO NHẤT ĐỊA PHƯƠNG</span>
						</div>
						<div class="selections">
							
						</div>
						<div class="sta-content">
							<div class="best-student"></div>
							<div class="four-students"></div>
						</div>
					</div>
				</div>
				<div></div>
			</div>
		</div>
		<!--footer-->
		<script src="{!! asset('public/js/home-page-script.js') !!}"></script>
	</div>
</body>
</html>