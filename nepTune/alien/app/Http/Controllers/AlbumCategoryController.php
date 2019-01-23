<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use File;
use Image;

class AlbumCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $qItems=DB::table('cms_album_category')->orderBy('id', 'desc')->paginate(10);
      return view('adminDashBoard/gallery.album-category', compact('qItems'));
    }



    public function store(Request $request)
    {
      $sDirectory=date('Y');
      //Image uploding section
      if(!empty($request->file('fileCategoryImage')))
      {
        $fFile = request()->file('fileCategoryImage');
        $sImageName = time().$fFile->getClientOriginalName();
        $sImg = Image::make($fFile)->resize(120, 90);
        $sResource = $sImg->stream()->detach();
        $sDirectoryPath=$sDirectory.'/gallery/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');

      }

      DB::table('cms_album_category')->insert([
          'alct_name' => $request->txtAlbumCategoryName,
          'alct_bangla_name' => $request->txtAlbumCategoryBanglaName,
          'alct_image_path' => $sDirectoryPath,
          'alct_is_active' => $request->rdoIsActive,
          'alct_user_ip' => $request->ip(),
          'alct_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Album Category information is successfully added.');
      return redirect('album-category');
    }


    public function update(Request $request, $id)
    {
      $sDirectory=date('Y');
      $sDirectoryPath=$request->oldImageName;
      //Image uploding section
      if(!empty($request->file('fileCategoryImage')))
      {
        $sDirectoryPath="";
        //Delete Old Image
        if(!empty($request->deleteImage) && !empty($request->oldImageName))
        {
          Storage::disk('s3')->delete($request->oldImageName);

          $fFile = request()->file('fileCategoryImage');
          $sImageName = time().$fFile->getClientOriginalName();
          $sImg = Image::make($fFile)->resize(120, 90);
          $sResource = $sImg->stream()->detach();
          $sDirectoryPath=$sDirectory.'/gallery/'.$sImageName;
          $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');
        }

      }

      DB::table('cms_album_category')->where('id', $id)->update([
          'alct_name' => $request->txtAlbumCategoryName,
          'alct_bangla_name' => $request->txtAlbumCategoryBanglaName,
          'alct_image_path' => $sDirectoryPath,
          'alct_is_active' => $request->rdoIsActive,
          'alct_user_ip' => $request->ip(),
          'alct_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Album Category information is successfully updated.');
      return redirect('album-category');
    }

}
