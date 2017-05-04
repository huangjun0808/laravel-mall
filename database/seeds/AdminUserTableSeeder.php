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
            'name'=>'超级管理员',
            'email'=>'root@admin.com',
            'password'=>bcrypt('root123'),
            'created_at'=>date('Y-m-d H:i:s',time()),
            'updated_at'=>date('Y-m-d H:i:s',time()),
        ]);
    }
}
