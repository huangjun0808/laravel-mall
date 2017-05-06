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
            $table->string('name')->default('')->index()->comment('权限规则');
            $table->string('uri')->default('')->comment('路由地址');
            $table->string('label')->default('')->comment('权限解释名称');
            $table->string('description')->default('')->comment('描述与备注');
            $table->integer('cid')->default(0)->index()->comment('父ID');
            $table->tinyInteger('level')->default(0)->index()->comment('级别');
            $table->tinyInteger('type')->default(0)->index()->comment('0权限（默认） 1左侧菜单 2顶部菜单 3左侧+顶部菜单');
            $table->string('icon')->default('')->comment('图标');
            $table->timestamps();
        });

        Schema::create('admin_role_permission', function (Blueprint $table) {
            $table->integer('role_id')->index();
            $table->integer('permission_id')->index();
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
