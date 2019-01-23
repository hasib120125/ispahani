<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsStaffDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_staff_department', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sfdp_name', 69);
            $table->string('sfdp_bangla_name', 69)->nullable();
            $table->string('sfdp_is_teacher',11);
            $table->string('sfdp_is_active',2)->default('Y');
            $table->string('sfdp_user_ip',29);
            $table->string('sfdp_update_user',5);
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
        Schema::dropIfExists('cms_staff_department');
    }
}
