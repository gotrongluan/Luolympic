<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\User;
use App\Option;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call( 'OptionSeeder' );
    }
}

class OptionSeeder extends Seeder {
    public function run() {
        Option::create(['option_name' => 'time_new_round_1', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_2', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_3', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_4', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_5', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_6', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_7', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_8', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_9', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_10', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_11', 'option_value' => '0']);
        Option::create(['option_name' => 'time_new_round_12', 'option_value' => '0']);
    }
}

class AdminSeeder extends Seeder {
    public function run() {
        // DB::table('admins')->insert([
        //     ['username'=>'uyentran', 'password'=>'1234', 'last_name'=>'Trần Duy', 'first_name'=>'Uyên', 'phone'=>'052884232'],
        //     ['username'=>'luantnguyen', 'password'=>'1611', 'last_name'=>'Nguyễn Trọng', 'first_name'=>'Luân', 'phone'=>'0358684926']
        // ]);
        Admin::create(['username'=>'thuyunie', 'password'=>'1234', 'last_name'=>'Nguyễn Thị', 'first_name'=>'Thúy', 'phone'=>'0438796999']);
        Admin::create(['username'=>'kmsmkt', 'password'=>'1611', 'last_name'=>'Đỗ Thị Thu', 'first_name'=>'Hà', 'phone'=>'0905062239']);
    }
}

class StudentSeeder extends Seeder {
    public function run() {
        // DB::table('users')->insert(array(
        //     ['username' => 'boycr', 'password' => '1234', 'last_name' => 'Huỳnh Thị Oanh', 'first_name' => 'Trinh', 'birthday' => '1999-11-11', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 3, 'class' => '3/1', 'school_id' => 111]
        // ));
        User::create(['username' => 'boycr', 'password' => '1234', 'last_name' => 'Huỳnh Thị Oanh', 'first_name' => 'Trinh', 'birthday' => '1999-11-11', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 3, 'class' => '3/1', 'school_id' => 111]);
        User::create(['username' => 'khangcr', 'password' => '1234', 'last_name' => 'Nguyễn An', 'first_name' => 'Khang', 'birthday' => '1998-03-28', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 11, 'class' => '11 Toán', 'school_id' => 14]);
        User::create(['username' => 'hungnt', 'password' => '1234', 'last_name' => 'Nguyễn Việt', 'first_name' => 'Hưng', 'birthday' => '1998-12-03', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 11, 'class' => '11 Lý', 'school_id' => 14]);
        User::create(['username' => 'catluong', 'password' => '1234', 'last_name' => 'Nguyễn Cát', 'first_name' => 'Lượng', 'birthday' => '1997-10-28', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 12, 'class' => '12 Hóa', 'school_id' => 14]);
        User::create(['username' => 'truyen', 'password' => '1234', 'last_name' => 'Lê Đức', 'first_name' => 'Truyền', 'birthday' => '1997-07-01', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 12, 'class' => '12A1', 'school_id' => 1]);
        User::create(['username' => 'minhcr1998', 'password' => '1234', 'last_name' => 'Trần Quang', 'first_name' => 'Minh', 'birthday' => '1998-11-10', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 11, 'class' => '11A1', 'school_id' => 1]);
        User::create(['username' => 'huycr', 'password' => '1234', 'last_name' => 'Hồ Quang', 'first_name' => 'Huy', 'birthday' => '1999-08-25', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 10, 'class' => '10A2', 'school_id' => 1]);
        User::create(['username' => 'thien', 'password' => '1234', 'last_name' => 'Nguyễn Quyết', 'first_name' => 'Thiện', 'birthday' => '1999-08-15', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 10, 'class' => '10A1', 'school_id' => 1]);
       User::create(['username' => 'tinthebest', 'password' => '1234', 'last_name' => 'Nguyễn Trung', 'first_name' => 'Tín', 'birthday' => '1999-03-26', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 10, 'class' => '10A1', 'school_id' => 1]);
        User::create(['username' => 'hello', 'password' => '1234', 'last_name' => 'Đặng Thị Thảo', 'first_name' => 'Soan', 'birthday' => '1998-11-20', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 12, 'class' => '12C9', 'school_id' => 111]);
        User::create(['username' => 'helloword', 'password' => '1234', 'last_name' => 'Nguyễn Trần Thiên', 'first_name' => 'Trà', 'birthday' => '1999-10-22', 'avatar' => 'public/images/default_user_photo.jpg', 'grade' => 12, 'class' => '12C9', 'school_id' => 111]);
    }
}
class ProvinceSeeder extends Seeder {
    public function run() {
        DB::table('provinces')->insert([
            ['prov_name' => 'Hà Nội'],
            ['prov_name' => 'Đà Nẵng'],
            ['prov_name' => 'Huế'],
            ['prov_name' => 'Quảng Nam'],
            ['prov_name' => 'Phú Yên'],
            ['prov_name' => 'Gia Lai'],
            ['prov_name' => 'Bình Định'],
            ['prov_name' => 'Vũng Tàu'],
            ['prov_name' => 'Kon Tum'],
            ['prov_name' => 'Hải Phòng'],
            ['prov_name' => 'Thái Bình'],
            ['prov_name' => 'Hà Tĩnh']
        ]);
    }
}

class DistrictSeeder extends Seeder {
    public function run() {
        DB::table('districts')->insert([
            ['dist_name' => 'Cam Ranh', 'prov_id' => 1],
            ['dist_name' => 'Nha Trang', 'prov_id' => 1],
            ['dist_name' => 'Cam Lâm', 'prov_id' => 1],
            ['dist_name' => 'Ninh Hòa', 'prov_id' => 1],
            ['dist_name' => 'Vạn Ninh', 'prov_id' => 1],
            ['dist_name' => 'Diên Khánh', 'prov_id' => 1],
            ['dist_name' => 'Quận 1', 'prov_id' => 2],
            ['dist_name' => 'Quận 3', 'prov_id' => 2],
            ['dist_name' => 'Quận 5', 'prov_id' => 2],
            ['dist_name' => 'Quận 7', 'prov_id' => 2],
            ['dist_name' => 'Quận 10', 'prov_id' => 2],
            ['dist_name' => 'Tân Bình', 'prov_id' => 2],
            ['dist_name' => 'Bình Thạnh', 'prov_id' => 2],
            ['dist_name' => 'Phú Nhuận', 'prov_id' => 2],
            ['dist_name' => 'Thủ Đức', 'prov_id' => 2],
            ['dist_name' => 'Đống Đa', 'prov_id' => 3],
            ['dist_name' => 'Cầu Giấy', 'prov_id' => 3],
            ['dist_name' => 'Ba Đình', 'prov_id' => 3],
            ['dist_name' => 'Tây Hồ', 'prov_id' => 3],
            ['dist_name' => 'Tuy Hòa', 'prov_id' => 7],
            ['dist_name' => 'Quy Nhơn', 'prov_id' => 9],
            ['dist_name' => 'Phù Cát', 'prov_id' => 9],
            ['dist_name' => 'Hoài Nhơn', 'prov_id' => 9],
            ['dist_name' => 'An Nhơn', 'prov_id' => 9],
            ['dist_name' => 'Phú Mỹ', 'prov_id' => 9],
            ['dist_name' => 'An Lão', 'prov_id' => 9]
        ]);
    }
}

class SchoolSeeder extends Seeder {
    public function run() {
        DB::table('schools')->insert([
            ['school_name' => 'TH An Nhơn 1', 'type' => 1, 'dist_id' => 24],
            ['school_name' => 'TH Thánh Gióng', 'type' => 1, 'dist_id' => 24]
        ]);
    }
}