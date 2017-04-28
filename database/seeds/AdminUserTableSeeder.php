<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_user')->insert([
            'name'=>'管理员',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('admin123456'),
            'created_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
}
