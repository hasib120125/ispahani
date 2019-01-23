<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_shift', function (Blueprint $table) {
          $table->increments('id');
          $table->string('shif_name', 39);
          $table->string('shif_bangla_name', 49);
          $table->string('shif_is_active',2)->default('Y');
          $table->string('shif_user_ip',29);
          $table->string('shif_update_user',5);
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
        Schema::dropIfExists('cms_shift');
    }
}
