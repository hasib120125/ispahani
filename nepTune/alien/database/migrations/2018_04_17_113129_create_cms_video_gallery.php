<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsVideoGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_video_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('vigl_video_cat_id');
            $table->string('vigl_name', 69);
            $table->string('vigl_bangla_name', 69)->nullable();
            $table->string('vigl_video_id',69);
            $table->string('vigl_is_active',2)->default('Y');
            $table->string('vigl_user_ip',29);
            $table->string('vigl_update_user',5);
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
        Schema::dropIfExists('cms_video_gallery');
    }
}
