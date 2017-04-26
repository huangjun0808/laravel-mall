<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('权限名');
            $table->string('label')->comment('权限解释名称');
            $table->string('description')->comment('描述与备注');
            $table->tinyInteger('cid')->comment('级别');
            $table->string('icon')->comment('图标');
            $table->timestamps();
        });

        Schema::create('admin_role_permission', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_role_permission');
        Schema::drop('admin_permission');
    }
}
