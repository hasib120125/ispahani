<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class VideoController extends Controller
{

    public function index(Request $request)
    {
      if(!empty($request->cmbSearch))
      {
        $qVideoCategory=DB::table('cms_video_category')->where('vict_is_active', 'Y')->pluck('vict_name', 'id');
        $qItems=DB::table('cms_video_gallery')->where('id', $request->cmbSearch)->orderBy('id', 'desc')->paginate(10);
        return view('adminDashBoard/gallery.video-gallery', compact('qItems','qVideoCategory'));
      }
      else
      {
        $qVideoCategory=DB::table('cms_video_category')->where('vict_is_active', 'Y')->pluck('vict_name', 'id');
        $qItems=DB::table('cms_video_gallery')->orderBy('id', 'desc')->paginate(10);
        return view('adminDashBoard/gallery.video-gallery', compact('qItems','qVideoCategory'));
      }

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
      $this->validate($request, [
          'cmbVideoCategoryID' => 'required',
          'txtVideoID' => 'required',
      ]);

      DB::table('cms_video_gallery')->insert([
          'vigl_video_cat_id' => $request->cmbVideoCategoryID,
          'vigl_name' => $request->txtName,
          'vigl_bangla_name' => $request->txtBanglaName,
          'vigl_video_id' => $request->txtVideoID,
          'vigl_is_active' => $request->rdoIsActive,
          'vigl_user_ip' => $request->ip(),
          'vigl_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      return redirect(url('video-gallery'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'cmbVideoCategoryID' => 'required',
          'txtVideoID' => 'required',
      ]);

      DB::table('cms_video_gallery')->where('id', $id)->update([
          'vigl_video_cat_id' => $request->cmbVideoCategoryID,
          'vigl_name' => $request->txtName,
          'vigl_bangla_name' => $request->txtBanglaName,
          'vigl_video_id' => $request->txtVideoID,
          'vigl_is_active' => $request->rdoIsActive,
          'vigl_user_ip' => $request->ip(),
          'vigl_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      return redirect(url('video-gallery'));
    }


    public function destroy($id)
    {
        //
    }
}
