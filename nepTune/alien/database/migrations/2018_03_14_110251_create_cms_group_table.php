<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grou_name', 39);
            $table->string('grou_bangla_name', 49);
            $table->string('grou_is_active',2)->default('Y');
            $table->string('grou_user_ip',29);
            $table->string('grou_update_user',5);
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
        Schema::dropIfExists('cms_group');
    }
}
