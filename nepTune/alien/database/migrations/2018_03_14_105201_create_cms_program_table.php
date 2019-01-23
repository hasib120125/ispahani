<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_program', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prog_name', 39);
            $table->string('prog_bangla_name', 49);
            $table->string('prog_is_active',2)->default('Y');
            $table->string('prog_user_ip',29);
            $table->string('prog_update_user',5);
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
        Schema::dropIfExists('cms_program');
    }
}
