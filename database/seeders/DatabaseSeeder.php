<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name'       => 'Quản Trị Viên',
            'email'      => 'truong.nm177022@sis.hust.edu.vn',
            'password'   => bcrypt('123456789'),
            'phone'      => '0327693743',
            'address'    => 'Số 78, đường Quốc lộ 3, thôn Phù Mã, Xã Phù Linh, Huyện Sóc Sơn, TP Hà Nội',
            'created_at' => Carbon::now()
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
