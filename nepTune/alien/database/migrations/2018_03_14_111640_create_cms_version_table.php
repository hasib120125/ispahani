<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_version', function (Blueprint $table) {
          $table->increments('id');
          $table->string('vers_name', 39);
          $table->string('vers_bangla_name', 49);
          $table->string('vers_is_active',2)->default('Y');
          $table->string('vers_user_ip',29);
          $table->string('vers_update_user',5);
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
        Schema::dropIfExists('cms_version');
    }
}
