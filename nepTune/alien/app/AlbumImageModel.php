<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumImageModel extends Model
{
  protected $table = 'cms_album_image';

  protected $fillable=['alim_album_cat_id','alim_album_group_id','alim_title','alim_bangla_title','alim_image_path','alim_is_active','alim_user_ip','alim_update_user','remember_token'];

  protected $hidden = ['remember_token'];
}
