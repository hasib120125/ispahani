<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagesModel extends Model
{
  protected $table = 'cms_messages';

  protected $fillable=['mess_cat_id','mess_eng_title','mess_bng_title','mess_eng_brief','mess_bng_brief','mess_eng_details','mess_bng_details','mess_img_path','mess_video_id','mess_file_path','mess_contents_type','mess_total_hits','mess_is_download','mess_is_active','mess_user_ip','mess_update_user','remember_token'];

  protected $hidden = ['remember_token'];
}
