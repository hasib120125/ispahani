<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsDesignationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_designation', function (Blueprint $table) {
          $table->increments('id');
          $table->string('desi_name', 39);
          $table->string('desi_bangla_name', 49);
          $table->string('desi_is_active',2)->default('Y');
          $table->string('desi_user_ip',29);
          $table->string('desi_update_user',5);
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
        Schema::dropIfExists('cms_designation');
    }
}
