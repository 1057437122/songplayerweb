<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmdlistsCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmdlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',10)->comment('操作类型的为exe_cmd,传文件类型的为load_file')->nullable()->index();
            $table->smallInteger('status')->comment('是否已经执行 1为执行了 0为没有执行')->default(0)->index();
            $table->integer('create_time')->comment('生成命令时间 一般为用户点击某个按钮这样的时间');
            $table->integer('send_time')->comment('下发时间')->nullable();
            $table->integer('exe_time')->comment('执行时间')->nullable();
            $table->string('cmd')->comment('需要执行的命令');
            $table->string('player_code')->comment('设备码')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cmdlists');
    }
}
