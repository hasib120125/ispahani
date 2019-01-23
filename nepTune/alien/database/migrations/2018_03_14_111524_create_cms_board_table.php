<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_board', function (Blueprint $table) {
          $table->increments('id');
          $table->string('boar_name', 39);
          $table->string('boar_bangla_name', 49);
          $table->string('boar_is_active',2)->default('Y');
          $table->string('boar_user_ip',29);
          $table->string('boar_update_user',5);
          $table->rememberToken();
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
        Schema::dropIfExists('cms_board');
    }
}
