<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTeacherStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_teacher_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('thsf_cat_id', 11);
            $table->tinyInteger('thsf_department_id')->nullable();
            $table->tinyInteger('thsf_shift_id')->nullable();
            $table->string('thsf_employee_id', 19)->nullable();
            $table->string('thsf_employee_type', 17)->nullable();
            $table->tinyInteger('thsf_designation_id')->nullable();
            $table->string('thsf_joining_date', 15)->nullable();
            $table->tinyInteger('thsf_seniority_id')->nullable();
            $table->string('thsf_mobile_no', 13)->nullable();
            $table->string('thsf_emergency_mobile', 13)->nullable();
            $table->string('thsf_email_id', 49)->nullable();
            $table->string('thsf_fb_id', 169)->nullable();
            $table->string('thsf_twitter_id', 69)->nullable();
            $table->string('thsf_skype_id', 69)->nullable();
            $table->string('thsf_google_id', 69)->nullable();
            $table->string('thsf_linkedin_id', 69)->nullable();
            $table->string('thsf_eng_name', 99);
            $table->string('thsf_bng_name', 99)->nullable();
            $table->string('thsf_father_name', 99)->nullable();
            $table->string('thsf_mother_name', 99)->nullable();
            $table->string('thsf_spouse_name', 99)->nullable();
            $table->string('thsf_present_address', 249)->nullable();
            $table->string('thsf_permanent_address', 249)->nullable();
            $table->string('thsf_university_name', 129)->nullable();
            $table->tinyInteger('thsf_subject_id')->nullable();
            $table->tinyInteger('thsf_religion_id')->nullable();
            $table->string('thsf_gender_id',2)->nullable();
            $table->string('thsf_married_status',9)->nullable();
            $table->tinyInteger('thsf_blood_group')->nullable();
            $table->string('thsf_image_path',169)->nullable();
            $table->string('thsf_is_active',2)->default('Y');
            $table->string('thsf_user_ip',29);
            $table->string('thsf_update_user',5);
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
        Schema::dropIfExists('cms_teacher_staff');
    }
}
