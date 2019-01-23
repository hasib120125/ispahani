<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsVideoCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_video_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vict_name', 69);
            $table->string('vict_bangla_name', 69)->nullable();
            $table->string('vict_is_active',2)->default('Y');
            $table->string('vict_user_ip',29);
            $table->string('vict_update_user',5);
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
        Schema::dropIfExists('cms_video_category');
    }
}
