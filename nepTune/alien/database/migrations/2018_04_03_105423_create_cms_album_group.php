<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsAlbumGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_album_group', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('algp_album_cat_id');
            $table->string('algp_name', 69);
            $table->string('algp_bangla_name', 69);
            $table->string('algp_image_path',99)->nullable();
            $table->string('algp_is_active',2)->default('Y');
            $table->string('algp_user_ip',29);
            $table->string('algp_update_user',5);
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
        Schema::dropIfExists('cms_album_group');
    }
}
