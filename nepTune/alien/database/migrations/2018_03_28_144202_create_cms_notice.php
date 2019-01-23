<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsNotice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noti_cat_id', 19);
            $table->string('noti_eng_title', 99);
            $table->string('noti_bng_title', 99)->nullable();
            $table->text('noti_eng_details')->nullable();
            $table->text('noti_bng_details')->nullable();
            $table->string('noti_is_download', 2);
            $table->string('noti_show_scroll', 2);
            $table->string('noti_out_of_notice', 2);
            $table->string('noti_url', 255)->nullable();
            $table->string('noti_file_path', 99)->nullable();
            $table->string('noti_total_hits', 11)->nullable();
            $table->string('noti_is_active',2)->default('Y');
            $table->string('noti_user_ip',29);
            $table->string('noti_update_user',5);
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
        Schema::dropIfExists('cms_notice');
    }
}
