<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_subject', function (Blueprint $table) {
          $table->increments('id');
          $table->string('subj_name', 39);
          $table->string('subj_bangla_name', 49);
          $table->string('subj_is_active',2)->default('Y');
          $table->string('subj_user_ip',29);
          $table->string('subj_update_user',5);
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
        Schema::dropIfExists('cms_subject');
    }
}
