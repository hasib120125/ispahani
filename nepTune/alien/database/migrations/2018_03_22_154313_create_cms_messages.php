<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mess_cat_id', 19);
            $table->string('mess_eng_title', 99);
            $table->string('mess_bng_title', 99)->nullable();
            $table->string('mess_eng_brief', 199)->nullable();
            $table->string('mess_bng_brief', 199)->nullable();
            $table->text('mess_eng_details')->nullable();
            $table->text('mess_bng_details')->nullable();
            $table->string('mess_img_path', 199)->nullable();
            $table->string('mess_small_img', 199)->nullable();
            $table->string('mess_video_id', 69)->nullable();
            $table->string('mess_file_path', 99)->nullable();
            $table->string('mess_total_hits', 11)->nullable();
            $table->string('mess_is_active',2)->default('Y');
            $table->string('mess_user_ip',29);
            $table->string('mess_update_user',5);
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
        Schema::dropIfExists('cms_messages');
    }
}
