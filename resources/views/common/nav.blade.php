
<nav class="navbar navbar-default navbar-static-top m-b-0">
	<div class="navbar-header">
		<div class="top-left-part">
			<!-- Logo -->
			<a class="logo" href="{!! url('admin/dashboard') !!}">
				<b>
					<img src="{!! asset('plugins/images/admin-logo.png') !!}" alt="home" class="dark-logo" />
					<img src="{!! asset('plugins/images/admin-logo-dark.png') !!}" alt="home" class="light-logo" />
				</b>
				<span class="hidden-xs">
					<img src="{!! asset('plugins/images/admin-text.png') !!}" alt="home" class="dark-logo" />
					<img src="{!! asset('plugins/images/admin-text-dark.png') !!}" alt="home" class="light-logo" />
				</span>
			</a>
		</div>
		<!-- /Logo -->
		<ul class="nav navbar-top-links navbar-right pull-right">
			<li>
				<form role="search" class="app-search hidden-sm hidden-xs m-r-10">
					<input type="text" placeholder="Tìm kiếm..." class="form-control">
					<a href=""><i class="fa fa-search"></i></a>
				</form>
			</li>
			<li>
				<a class="profile-pic" href="#"> <img src="{!! asset($avatar_url) !!}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{!! $admin_name !!}</b></a>
			</li>
		</ul>
	</div>
	<!-- /.navbar-header -->
	<!-- /.navbar-top-links -->
	<!-- /.navbar-static-side -->
</nav>