<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsContentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contents_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coma_cat_id', 7);
            $table->string('coma_eng_title', 99);
            $table->string('coma_bng_title', 99)->nullable();
            $table->string('coma_eng_brief', 199)->nullable();
            $table->string('coma_bng_brief', 199)->nullable();
            $table->text('coma_eng_details');
            $table->text('coma_bng_details')->nullable();
            $table->string('coma_img_path', 199)->nullable();
            $table->string('coma_small_img', 199)->nullable();
            $table->string('coma_video_id', 69)->nullable();
            $table->string('coma_file_path', 99)->nullable();
            $table->string('coma_total_hits', 11)->nullable();
            $table->string('coma_is_download',2)->default('Y');
            $table->string('coma_is_active',2)->default('Y');
            $table->string('coma_user_ip',29);
            $table->string('coma_update_user',5);
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
        Schema::dropIfExists('cms_contents_master');
    }
}
