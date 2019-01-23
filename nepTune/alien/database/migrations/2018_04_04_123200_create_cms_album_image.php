<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsAlbumImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_album_image', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('alim_album_cat_id');
            $table->tinyInteger('alim_album_group_id');
            $table->string('alim_english_title', 99);
            $table->string('alim_bangla_title', 99);
            $table->string('alim_image_path',99)->nullable();
            $table->string('alim_is_active',2)->default('Y');
            $table->string('alim_user_ip',29);
            $table->string('alim_update_user',5);
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
        Schema::dropIfExists('cms_album_image');
    }
}
