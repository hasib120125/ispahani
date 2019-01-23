<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsOtherImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_other_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('otim_image_path',99)->nullable();
            $table->string('otim_is_slide',2)->default('Y');
            $table->string('otim_show_slide',2)->default('N');
            $table->string('otim_user_ip',29);
            $table->string('otim_update_user',5);
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
        Schema::dropIfExists('cms_other_image');
    }
}
