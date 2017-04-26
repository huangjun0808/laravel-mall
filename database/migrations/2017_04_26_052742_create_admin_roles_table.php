<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('角色名称');
            $table->string('description')->comment('备注');
            $table->timestamps();
        });

        Schema::create('admin_user_role', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('role_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_user_role');
        Schema::drop('admin_role');
    }
}
