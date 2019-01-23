<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsNoticeCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_notice_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noca_name', 69);
            $table->string('noca_bangla_name', 69)->nullable();
            $table->string('noca_is_active',2)->default('Y');
            $table->string('noca_user_ip',29);
            $table->string('noca_update_user',5);
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
        Schema::dropIfExists('cms_notice_category');
    }
}
