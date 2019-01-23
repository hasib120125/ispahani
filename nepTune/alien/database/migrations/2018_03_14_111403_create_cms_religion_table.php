<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsReligionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_religion', function (Blueprint $table) {
          $table->increments('id');
          $table->string('reli_name', 39);
          $table->string('reli_bangla_name', 49);
          $table->string('reli_is_active',2)->default('Y');
          $table->string('reli_user_ip',29);
          $table->string('reli_update_user',5);
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
        Schema::dropIfExists('cms_religion');
    }
}
