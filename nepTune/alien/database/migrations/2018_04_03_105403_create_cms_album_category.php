<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsAlbumCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_album_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alct_name', 69);
            $table->string('alct_bangla_name', 69)->nullable();
            $table->string('alct_image_path',99)->nullable();
            $table->string('alct_is_active',2)->default('Y');
            $table->string('alct_user_ip',29);
            $table->string('alct_update_user',5);
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
        Schema::dropIfExists('cms_album_category');
    }
}
