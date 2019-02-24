<?php 
	$class_arr = array("home" => "", "start" => "", "statistic" => "", "news" => "", "help" => "", "contact" => "");
	$class_arr[$active_item] = "active";
?>
<nav class="topnav">
	<a href="{!! url('/') !!}" class="{!! $class_arr['home'] !!}">Trang chủ</a>
	<a href="#" class="{!! $class_arr['start'] !!}">Vào thi</a>
	<a href="#" class="{!! $class_arr['statistic'] !!}">Thống kê</a>
	<a href="#about" class="{!! $class_arr['news'] !!}">Tin tức</a>
	<a href="#" class="{!! $class_arr['help'] !!}">Hướng dẫn</a>
	<a href="#" class="{!! $class_arr['contact'] !!}">Liên hệ</a>
	<a href="#"><i class="fa fa-search"></i></a>
</nav>