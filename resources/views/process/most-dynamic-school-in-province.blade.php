<?php $i = 1; ?>
@foreach ( $top_schools_arr as $top_school_info )
	{!! '<tr><td>' . $i . '</td><td>' . $top_school_info['school_name'] . '</td><td>Cấp ' . $top_school_info['school_type'] . '</td><td>' . $top_school_info['district'] . '</td><td>' . $top_school_info['num_students'] . '</td></tr>' !!}
	<?php $i++; ?>
@endforeach