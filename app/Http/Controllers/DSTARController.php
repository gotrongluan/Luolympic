<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User;
use App\Province;
use App\Comment;
use App\School;
use App\District;

class DSTARController extends Controller
{
	public function changeProvince( Request $request ) {
		$prov_id = $request->input('prov_id');
		$school_ids_of_prov = array();
		$dists = Province::find( $prov_id )->districts;
		foreach ( $dists as $dist ) {
			$schools_of_dist = $dist->schools;
			foreach ( $schools_of_dist as $school ) {
				$school_id = $school->id;
				$school_ids_of_prov[] = $school_id;
			}
		}
		$top_schools = DB::table('users')->selectRaw('school_id, count(*) as num_students')->whereIn('school_id', $school_ids_of_prov)->groupBy('school_id')->orderBy('num_students', 'desc')->limit(5)->get()->toArray();
		if ( count($top_schools) == 0 )
			return view('process.no-participating-school-in-province');
		$top_schools_arr = array();
		foreach ( $top_schools as $top_school ) {
			$top_school_info = array();
			$the_id = $top_school->school_id;
			$the_school = School::find( $the_id );
			$top_school_info['school_name'] = $the_school->school_name;
			$top_school_info['school_type'] = $the_school->type;
			$top_school_info['district'] = $the_school->district->dist_name;
			$top_school_info['num_students'] = $top_school->num_students;
			$top_schools_arr[] = $top_school_info;
		}
		return view('process.most-dynamic-school-in-province')->with('top_schools_arr', $top_schools_arr);
	}

    public function accessLoginPage( Request $request ) {
    	$session = $request->session();
    	$notify = "";
    	if ( $session->has('login') ) {
    		$session->flush();
    	}
    	elseif ( $session->has('notify') ) {
    		$notify = $session->get('notify');
    	}
    	return view('common.login')->with('notify', $notify);
    }

    public function processLogin( Request $request ) {
    	$session = $request->session();
    	$username = $request->input('username');
    	$password = $request->input('password');
    	$admin = Admin::where('username', $username)->first();
        $notify = "";
    	if ( $admin != null ) {
    		if ( $admin->password == $password ) {
    			$session->put('id', $admin->id);
    			$session->put('full-name', $admin->full_name);
    			$session->put('type', 'admin');
    			return redirect('admin/dashboard');
    		}
    	}
    	else {
    		$user = User::where('username', $username)->first();
    		if ( $user != null) {
    			if ( $user->password == $password ) {
    				$session->put('id', $user->id);
    				$session->put('full-name', $user->full_name);
    				$session->put('type', 'student');
    				return redirect('home-page');
    			}
    		}
    	}
    	$session->flash('notify', 'Tên đăng nhập hoặc mật khẩu không đúng');
    	return redirect('login');
    }

    public function accessAdminDashboardPage( Request $request ) {
    	$session = $request->session();
    	if ( $session->has('type') && $session->get('type') == 'admin' ) {
    		$id = $session->get('id');
	    	$admin = Admin::find( $id );

	    	//navigation bar
	    	$avatar_url = $admin->avatar;
	    	$full_name = $admin->full_name;

	    	//three num participants
	    	$num_participants = array();
	    	$num_student = User::count();
	    	$num_participants['num_student'] = $num_student;
	    	$num_participants['num_school'] = DB::table('users')->select('school_id')->distinct()->count('school_id');
	    	$schools = DB::table('users')->select('school_id')->distinct()->get()->toArray();
	    	$school_ids = array();
	    	foreach ( $schools as $school ) {
	    		$school_id = $school->school_id;
	    		$school_ids[] = $school_id;
	    	}
	    	$districts = DB::table('schools')->select('dist_id')->whereIn('id', $school_ids)->distinct()->get()->toArray();
	    	$dist_ids = array();
	    	foreach ( $districts as $district ){
	    		$dist_id = $district->dist_id;
	    		$dist_ids[] = $dist_id;
	    	}
	    	$num_participants['num_province'] = DB::table('districts')->select('prov_id')->whereIn('id', $dist_ids)->distinct()->count('prov_id');

	    	//list provinces
	    	$provs = Province::get(['id', 'prov_name'])->toArray();

	    	//list comments
	    	$cmts = Comment::orderBy('created_at', 'DESC')->take(4)->get()->toArray();
	    	
	    	foreach( $cmts as &$cmt ){
	    		$stu_id = $cmt['stu_id'];
	    		$the_stu = User::find( $stu_id );
	    		$the_time = date_create( $cmt['created_at'] );
	    		$cmt['created_at'] = date_format( $the_time, "Y-m-d h:i a");
	    		$cmt['stu_name'] = $the_stu->full_name;
	    		$cmt['stu_avatar'] = $the_stu->avatar;
	    	}

	    	//chat list
	    	$friends = Admin::where('id', '<>', $id)->get()->toArray();
	    	return view('admin.dashboard', compact('avatar_url', 'full_name', 'num_participants', 'provs', 'cmts', 'friends'));
    	}
    	return redirect('login');
    }

    public function accessAdminAccountManagementPage( Request $request ) {
    	$session = $request->session();
    	if ( $session->has('type') && $session->get('type') == 'admin' ) {
    		$id = $session->get('id');
    		$the_admin = Admin::find( $id )->toArray();
    		
    		//navigation bar
	    	$avatar_url = $the_admin['avatar'];
	    	$full_name = $the_admin['full_name'];

	    	if ( $session->has('code') )
	    	{
	    		$code = $session->get('code');
	    		return view('admin.account-management', compact('full_name', 'avatar_url', 'the_admin', 'code'));
	    	}
    		return view('admin.account-management', compact('full_name', 'avatar_url', 'the_admin'));
    	}
    	return redirect('login');
    }

    public function getAdminPassword( Request $request ) {
    	$id = $request->session()->get('id');
    	$cur_password = Admin::find( $id )->password;
    	return $cur_password;
    }

    public function accessAdminStatisticProvincePage( Request $request, $prov_id = null, $dist_id = null, $school_id = null) {
    	$session = $request->session();
    	if ( $session->has('type') && $session->get('type') == 'admin' )
    	{
    		$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		if ( $prov_id === null )
    		{
    			//prov
    			$data = DB::table('users')->join('schools', 'schools.id', '=', 'school_id')->join('districts', 'districts.id', '=', 'dist_id')->rightJoin('provinces', 'provinces.id', '=', 'prov_id')->selectRaw('provinces.id, prov_name, count(prov_id) as nums')->groupBy('provinces.id', 'prov_name')->get()->toArray();

    			return view('admin.statistic.province-statistic', compact('full_name', 'avatar_url', 'data'));
    		}
    		elseif ( $dist_id === null )
    		{
    			//$prov_id
    			$prov_name = Province::find( $prov_id )->prov_name;
    			$dist_in_prov = DB::table('districts')->select('id', 'dist_name')->where('prov_id', (int)$prov_id);
    			$data = DB::table('users')->join('schools', 'schools.id', '=', 'school_id')->rightJoinSub( $dist_in_prov, 'dist_in_prov', function ( $join ) {
    					$join->on('dist_in_prov.id', '=', 'dist_id');
    			})->selectRaw('dist_in_prov.id, dist_name, count(dist_id) as nums')->groupBy('dist_in_prov.id', 'dist_name')->get()->toArray();
    			return view('admin.statistic.district-statistic', compact('full_name', 'avatar_url', 'data', 'prov_name', 'prov_id'));
    		}
    		elseif ( $school_id === null )
    		{
    			$dist_name = District::find( $dist_id )->dist_name;
    			$prov_name = Province::find( $prov_id )->prov_name;
    			$schools_in_dist = DB::table('schools')->select('id', 'school_name')->where('dist_id', $dist_id);
    			$data = DB::table('users')->rightJoinSub($schools_in_dist, 'schools_in_dist', function ( $join ) {
    				$join->on('school_id', '=', 'schools_in_dist.id');
    			})->selectRaw('schools_in_dist.id, school_name, count(school_id) as nums')->groupBy('schools_in_dist.id', 'school_name')->get()->toArray();
    			return view('admin.statistic.school-statistic', compact('full_name', 'avatar_url', 'data', 'dist_name', 'prov_name', 'prov_id', 'dist_id'));
    		}
    		else {
    			$data = User::where('school_id', $school_id)->orderBy('grade', 'DESC')->get()->toArray();
    			$school_name = School::find( $school_id )->school_name;
    			$dist_name = District::find( $dist_id )->dist_name;
    			$prov_name = Province::find( $prov_id )->prov_name;
    			return view('admin.statistic.student-statistic', compact('full_name', 'avatar_url', 'data', 'school_name', 'dist_name', 'prov_name', 'prov_id', 'dist_id'));
    		}
    	}
    	return redirect('login');
    }
}
