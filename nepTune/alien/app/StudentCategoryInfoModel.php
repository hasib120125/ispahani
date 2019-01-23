<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCategoryInfoModel extends Model
{
      protected $table = 'std_student_category';

      protected $fillable=['student_cat_code','student_cat_name','is_defense','institute_id','eims_id','create_user_id','update_user_id','create_user_ip_address','update_user_ip_address','is_active','remember_token'];

      protected $hidden = ['remember_token'];
}
