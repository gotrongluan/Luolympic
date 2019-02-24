<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\Admin;
use App\User;
use App\School;
use App\District;
use App\Province;

class BachKhoaController extends Controller
{
	public function updateAdminInfo( Request $request ) {
		$session = $request->session();
		$the_id = $session->get('id');
		$messages = [
			'required' => 'Trường :attribute bắt buộc nhập',
			'alpha' => 'Trường :attribute chỉ gồm các ký tự chữ',
			'string' => 'Trường :attribute chỉ được gồm các ký tự chữ và số',
			'phone-number.digits' => 'Số điện thoại phải có đúng :digits ký tự',
			'email' => 'Email bạn nhập phải là email hợp lệ (có dạng abc@example.com)',
			'numeric' => 'Trường :attribute chỉ được gồm các ký tự số',
			'max' => 'Trường :attribute chỉ được tối đa :max ký tự'
		];
		$inputs = $request->all();
		$validator = Validator::make($inputs, [
			'last-name' => 'required|string',
			'first-name' => 'required|alpha|max:7',
			'phone-number' => 'required|numeric|digits:10',
			'email' => 'required|email',
			'address' => 'required|string|max:60'
		], $messages);
		if ( $validator->fails() )
		{
			$session->flash('code', 300);
			return redirect('admin/account-management')->withErrors( $validator )->withInput();
		}
		$session->flash('code', 200);
		$the_admin = Admin::find( $the_id );
		$the_admin->last_name = $inputs['last-name'];
		$the_admin->first_name = $inputs['first-name'];
		$the_admin->phone = $inputs['phone-number'];
		$the_admin->address = $inputs['address'];
		$the_admin->email = $inputs['email'];
		$the_admin->save();
		return redirect('admin/account-management');
	}

	public function changeAdminPassword( Request $request ) {
		$session = $request->session();
		$messages = [
			'required' => 'Trường :attribute là bắt buộc',
			'between' => 'Trường :attribute phải có độ dài từ :min đến :max',
			'confirmed' => 'Mật khẩu không khớp',
			'alpha_num' => 'Mật khẩu chỉ được phép gồm ký tự và số'
		];
		$validator = Validator::make($request->all(), [
			'new-password' => 'required|alpha_num|between:4,30|confirmed'
		], $messages);
		if ( $validator->fails() )
		{
			$session->flash('code', 301);
			return redirect('admin/account-management')->withErrors( $validator )->withInput();
		}
		$new_password = $request->input('new-password');
		$the_admin = Admin::find( $session->get('id') );
		$the_admin->password = $new_password;
		$the_admin->save();
		$session->flash('code', 201);
		return redirect('admin/account-management');
	}

	public function accessAdminStatisticTimePage( Request $request, $year ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' && $year <= date("Y") && $year >= 2016 ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		$start_date = $year . '-01-01';
    		$end_date = ($year + 1) . '-01-01';
			$creates = DB::table('users')->select('created_at')->where('created_at', '>=', $start_date)->where('created_at', '<', $end_date)->get()->toArray();
			$data = array();
			for ($i = 1; $i <= 12; ++$i)
				$data[$i] = 0;
			foreach ( $creates as $unie )
			{
				$thuy = $unie->created_at;
				$the_time = date_create( $thuy );
				$the_month = date_format( $the_time, "m" );
				$data[(int)$the_month]++;
			}
			return view('admin.statistic.time-statistic', compact('full_name', 'avatar_url', 'data', 'year'));
		}
		return redirect('login');
	}

	public function accessAdminStatisticGradePage( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
			$data = DB::table('users')->selectRaw('grade, count(*) as nums')->groupBy('grade')->orderBy('grade', 'ASC')->get()->toArray();
			return view('admin.statistic.grade-statistic', compact('full_name', 'avatar_url', 'data'));
		}
		return redirect('login');
	}

	public function accessAdminUserManagementPage( Request $request, $page = 1 ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		$per_page = DB::table('options')->where('option_name', 'user_mana_per_page')->first()->option_value;
			$data = User::get()->splice(($page - 1) * $per_page, $per_page)->toArray();
			$num_student = User::count();
			$num_page = ceil( $num_student / $per_page );
			foreach ( $data as &$stu ) {
				$school_id = $stu['school_id'];
				$the_school = School::find( $school_id );
				$school_name = $the_school->school_name;
				$dist_name = $the_school->district->dist_name;
				$prov_name = $the_school->district->province->prov_name;
				$stu['full_school'] = $school_name . ', ' . $dist_name . ', ' . $prov_name;
			}
			return view('admin.user-management.user-management', compact('full_name', 'avatar_url', 'data', 'num_student', 'num_page', 'page'));
		}
		return redirect('login');
	}

	public function accessStudentInformationPage( Request $request, $stu_id ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
			$the_student = User::find( $stu_id )->toArray();
			$school_id = $the_student['school_id'];
			$the_school = School::find( $school_id );
			$school_name = $the_school->school_name;
			$dist_name = $the_school->district->dist_name;
			$prov_name = $the_school->district->province->prov_name;
			$the_student['school_name'] = $school_name . ', ' . $dist_name . ', ' . $prov_name;
			return view('admin.user-management.student-information', compact('full_name', 'avatar_url', 'the_student'));
		}
		return redirect('login');
	}

	public function deleteStudentAccount( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			User::destroy( $request->input('stu-id') );
			return redirect('admin/user-management');
		}
		return redirect('login');
	}

	public function accessAdminCompetitionManagementPage( Request $request, $class = null ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		if ( $class === null ) {
    			$cur_rounds = array();
    			for( $i = 1; $i <= 12; ++$i ) {
    				$option_name = 'cur_round_' . $i;
    				$cur_round_val = DB::table('options')->where('option_name', $option_name)->first()->option_value;
    				$cur_rounds[$i] = $cur_round_val;
    			}
    			return view('admin.competition.competition-management', compact('full_name', 'avatar_url', 'cur_rounds'));
    		}
    		else {
    			$option_name = 'cur_round_' . $class;
    			$cur_round_val = DB::table('options')->where('option_name', $option_name)->first()->option_value;
    			$option_name = 'have_next_round_' . $class;
    			$have_next_round_val = DB::table('options')->where('option_name', $option_name)->first()->option_value;
    			$option_name = 'time_new_round_' . $class;
    			$time_new_round_val = DB::table('options')->where('option_name', $option_name)->first()->option_value;
    			return view('admin.competition.class-competition-management', compact('full_name', 'avatar_url', 'cur_round_val', 'have_next_round_val', 'time_new_round_val', 'class'));
    		}	
		}
		return redirect('login');
	}

	public function customCurrentNewRound( Request $request, $class, $is_new = 0 ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		if ( $is_new == 1 ) {
    			$option_name = 'have_next_round_' . $class;
				DB::table('options')->where('option_name', $option_name)->update(['option_value' => 1]);
    		} 
			$option_name = 'cur_round_' . $class;
			$cur_round_val = DB::table('options')->where('option_name', $option_name)->first()->option_value;
			$round_val = $cur_round_val + 1;
			$new_round = true;
			$questions_table = 'questions_grade_' . $class;
			$ques_id_objs = DB::table($questions_table)->select('ques_id')->distinct()->get()->toArray();
			$ques_id = array();
			foreach ( $ques_id_objs as $ques_id_obj ) {
				$ques_id[] = $ques_id_obj->ques_id;
			}
			//questions, round = round_val, id in
			$many_ques = DB::table('questions')->whereIn('id', $ques_id)->where('round', '=', $round_val)->get()->toArray();
			return view('admin.competition.round-management', compact('full_name', 'avatar_url', 'round_val', 'class', 'new_round', 'many_ques'));
		}
		return redirect('login');
	}

	public function detailQuestion( Request $request, $ques_id, $unie ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		$the_question = DB::table('questions')->where('id', $ques_id)->first();
    		$the_type = $the_question->type;
    		$class = $the_question->class;
    		$table_name = 'questions_grade_' . $class;
    		$round_val = $the_question->round;
    		$ques_cont = $the_question->content;
    		$ques_level = $the_question->level;
    		if ( $the_type == '1' ) {
    			$answer_a = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_a')->first()->value;
    			$answer_b = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_b')->first()->value;
    			$answer_c = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_c')->first()->value;
    			$answer_d = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_d')->first()->value;
    			$answer = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer')->first()->value;
    			return view('admin.competition.multi-choice-management', compact('full_name', 'avatar_url', 'class', 'round_val', 'unie', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'answer', 'ques_cont', 'ques_level', 'ques_id'));
    		}
    		elseif ( $the_type == '2' ) {
    			$answer_a = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_a')->first()->value;
    			$answer_b = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_b')->first()->value;
    			$answer_c = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_c')->first()->value;
    			$answer_d = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer_d')->first()->value;
    			$num_answer = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'num_answer')->first()->value;
    			$answers = array();
    			for ( $i = 1; $i <= $num_answer; ++$i ) {
    				$answers[] = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'the_answer_' . $i)->first()->value;
    			}
    			return view('admin.competition.multi-select-management', compact('full_name', 'avatar_url', 'class', 'round_val', 'unie', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'answers', 'ques_cont', 'ques_level', 'ques_id'));
    		}
    		else {
    			$answer = DB::table($table_name)->where('ques_id', $ques_id)->where('option', 'answer')->first()->value;
    			return view('admin.competition.essay-management', compact('full_name', 'avatar_url', 'class', 'round_val', 'unie', 'answer', 'ques_cont', 'ques_level', 'ques_id'));
    		}
    	}
    	return redirect('login');
	}

	public function addNewQuestion( Request $request, $unie, $type, $class, $round_val ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		if ( $type == 3 )
    			return view('admin.competition.essay-management', compact('full_name', 'avatar_url', 'class', 'round_val', 'unie'));
    		elseif ( $type == 2 )
    			return view('admin.competition.multi-select-management', compact('full_name', 'avatar_url', 'class', 'round_val', 'unie'));
    		else
    			return view('admin.competition.multi-choice-management', compact('full_name', 'avatar_url', 'class', 'round_val', 'unie'));
    	}
    	return redirect('login');
	}

	public function adminProcessNewEssay( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$class = $request->input('class');
			$round = $request->input('round');
			$ques_id = DB::table('questions')->insertGetId(['content' => $request->input('question-content'), 'class' => $class, 'round' => $round, 'level' => $request->input('level'), 'type' => '3']);
			$table_name = 'questions_grade_' . $class;
			DB::table( $table_name )->insert(['ques_id' => $ques_id, 'option' => 'answer', 'value' => $request->input('answer')]);
			if ( $request->input('unie') == '1' )
				return redirect('admin/custom-current-new-round/' . $class);
			return redirect('/admin/round-management/' . $class . '/' . $round);
    	}
    	return redirect('login');
	}

	public function adminProcessNewMultiChoice( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$class = $request->input('class');
			$round = $request->input('round');
			$ques_id = DB::table('questions')->insertGetId(['content' => $request->input('the-question'), 'class' => $class, 'round' => $round, 'level' => $request->input('level'), 'type' => '1']);
			$table_name = 'questions_grade_' . $class;
			DB::table( $table_name )->insert([
				['ques_id' => $ques_id, 'option' => 'answer_a', 'value' => $request->input('answer-a')],
				['ques_id' => $ques_id, 'option' => 'answer_b', 'value' => $request->input('answer-b')],
				['ques_id' => $ques_id, 'option' => 'answer_c', 'value' => $request->input('answer-c')],
				['ques_id' => $ques_id, 'option' => 'answer_d', 'value' => $request->input('answer-d')],
				['ques_id' => $ques_id, 'option' => 'answer', 'value' => $request->input('answer')]
			]);
			if ( $request->input('unie') == '1' )
				return redirect('admin/custom-current-new-round/' . $class);
			return redirect('/admin/round-management/' . $class . '/' . $round);
    	}
    	return redirect('login');
	}

	public function adminProcessNewMultiSelect( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$class = $request->input('class');
			$round = $request->input('round');
			$ques_id = DB::table('questions')->insertGetId(['content' => $request->input('the-question'), 'class' => $class, 'round' => $round, 'level' => $request->input('level'), 'type' => '2']);
			$table_name = 'questions_grade_' . $class;
			DB::table( $table_name )->insert([
				['ques_id' => $ques_id, 'option' => 'answer_a', 'value' => $request->input('answer-a')],
				['ques_id' => $ques_id, 'option' => 'answer_b', 'value' => $request->input('answer-b')],
				['ques_id' => $ques_id, 'option' => 'answer_c', 'value' => $request->input('answer-c')],
				['ques_id' => $ques_id, 'option' => 'answer_d', 'value' => $request->input('answer-d')],
			]);
			$answers = $request->input('answers');
			DB::table($table_name)->insert(
				['ques_id' => $ques_id, 'option' => 'num_answer', 'value' => count( $answers )]
			);
			$answers_array = array();
			for ( $i = 1; $i <= count( $answers ); ++$i ) {
				$opt = ['ques_id' => $ques_id, 'option' => ('the_answer_' . $i), 'value' => $answers[$i - 1]];
				$answers_array[] = $opt;
			}
			DB::table( $table_name )->insert( $answers_array );
			if ( $request->input('unie') == '1' )
				return redirect('admin/custom-current-new-round/' . $class);
			return redirect('/admin/round-management/' . $class . '/' . $round);
    	}
    	return redirect('login');
	}

	public function deleteQuestion( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$ques_id = $request->input('question-id');
			$the_question = DB::table('questions')->where('id', $ques_id)->first();
			$class = $the_question->class;
			$round = $the_question->round;
			$table_name = 'questions_grade_' . $class;
			DB::table($table_name)->where('ques_id', $ques_id)->delete();
			DB::table('questions')->where('id', $ques_id)->delete();
			$unie = $request->input('unie');
			if ( $unie == '1' )
				return redirect('admin/custom-current-new-round/' . $class);
			return redirect('/admin/round-management/' . $class . '/' . $round);
    	}
    	return redirect('login');
	}

	public function processNewRound( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$class = $request->input('class');
			$date_publish = $request->input('date-publish');
			$date_publish = date_format( date_create( $date_publish ), "Y-m-d" );
			$option_name = 'cur_round_' . $class;
			$cur_round_val = DB::table('options')->where('option_name', $option_name)->first()->option_value;
			$cur_round_val++;
			DB::table('options')->where('option_name', $option_name)->update(['option_value' => $cur_round_val]);
			$option_name = 'have_next_round_' . $class;
			DB::table('options')->where('option_name', $option_name)->update(['option_value' => 0]);
			$option_name = 'time_new_round_' . $class;
			DB::table('options')->where('option_name', $option_name)->update(['option_value' => $date_publish]);
			return redirect('admin/competition-management/' . $class);
    	}
    	return redirect('login');
	}

	public function adminRoundManagement( Request $request, $class, $round_val ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;
    		
			$new_round = false;
			$questions_table = 'questions_grade_' . $class;
			$ques_id_objs = DB::table($questions_table)->select('ques_id')->distinct()->get()->toArray();
			$ques_id = array();
			foreach ( $ques_id_objs as $ques_id_obj ) {
				$ques_id[] = $ques_id_obj->ques_id;
			}
			//questions, round = round_val, id in
			$many_ques = DB::table('questions')->whereIn('id', $ques_id)->where('round', '=', $round_val)->get()->toArray();
			return view('admin.competition.round-management', compact('full_name', 'avatar_url', 'round_val', 'class', 'new_round', 'many_ques'));
		}
		return redirect('login');
	}

	public function adminNewsManagement( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;

			$news_subjects = DB::table('news-subjects')->select('id', 'name')->get()->toArray();
			return view('admin.news.all-news-types', compact('full_name', 'avatar_url', 'news_subjects'));
		}
		return redirect('login');
	}

	public function deleteNewsSubject( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$news_subject_id = $request->input('news-subject-id');
			DB::table('news-subjects')->where('id', '=', $news_subject_id)->delete();
			return redirect('admin/news-management');
		}
		return redirect('login');
	}

	public function editNewsSubject( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$new_subject_name = $request->input('new-sub-name');
			$new_subject_id = $request->input('new-sub-id');
			DB::table('news-subjects')->where('id', $new_subject_id)->update(['name' => $new_subject_name]);
			return redirect('admin/news-management');
		}
		return redirect('login');
	}

	public function adminDetailNewsSubject( Request $request, $subject_id ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$id = $session->get('id');
    		$admin = Admin::find( $id );
    		$full_name = $admin->full_name;
    		$avatar_url = $admin->avatar;

    		$news = DB::table('news')->where('subject', $subject_id)->get()->toArray();
    		return;
		}
		return redirect('login');
	}

	public function addNewsSubject( Request $request ) {
		$session = $request->session();
		if ( $session->has('type') && $session->get('type') == 'admin' ) {
			$the_name = $request->input('the-name');
			DB::table('news-subjects')->insert(['name' => $the_name]);
			return redirect('admin/news-management');
		}
		return redirect('login');
	}
}

