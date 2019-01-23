<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeModel extends Model
{
  protected $table = 'cms_notice';

  protected $fillable=['noti_cat_id','noti_eng_title','noti_bng_title','noti_eng_details','noti_bng_details','noti_is_download','noti_show_scroll','noti_out_of_notice','noti_url','noti_file_path','noti_total_hits','noti_is_active','noti_user_ip','noti_update_user','remember_token'];

  protected $hidden = ['remember_token'];
}
