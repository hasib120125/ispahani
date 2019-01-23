<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentsMasterModel extends Model
{
  protected $table = 'cms_contents_master';

  protected $fillable=['coma_cat_id','coma_eng_title','coma_bng_title','coma_eng_brief','coma_bng_brief','coma_eng_details','coma_bng_details','coma_img_path','coma_video_id','coma_file_path','coma_contents_type','coma_total_hits','coma_is_download','coma_is_active','coma_user_ip','coma_update_user','remember_token'];

  protected $hidden = ['remember_token'];
}
