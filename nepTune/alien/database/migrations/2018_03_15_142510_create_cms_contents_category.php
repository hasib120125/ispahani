<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsContentsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_contents_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coca_name', 39);
            $table->string('coca_bangla_name', 49);
            $table->string('coca_is_active',2)->default('Y');
            $table->string('coca_user_ip',29);
            $table->string('coca_update_user',5);
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
        Schema::dropIfExists('cms_contents_category');
    }
}
