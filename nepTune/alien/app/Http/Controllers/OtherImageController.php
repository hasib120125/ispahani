<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use File;
use Image;

class OtherImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      if(!empty($request->rdoIsSlideImage))
      {
        $qItems=DB::table('cms_other_image')->where('otim_is_slide', $request->rdoIsSlideImage)->orderBy('id', 'desc')->paginate(10);
      }
      elseif(empty($request->cmbAlbumGroupID))
      {
        $qItems=DB::table('cms_other_image')->orderBy('id', 'desc')->orderBy('id', 'desc')->paginate(10);
      }

      return view('adminDashBoard/gallery.all-other-image-list', compact('qItems'));
    }

    public function create()
    {
      return view('adminDashBoard/gallery.other-image');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'file' => 'image|mimes:jpeg,png,jpg,gif',
          'rdoIsSlideImage' => 'required',
      ]);

      $sDirectory=date('Y');
      $iBigImageWidth=$request->txtBigW;
      $iBigImageHeight=$request->txtBigH;
      $iAspectRatio=$request->chkRatio;

      //Image uploding section
      if(!empty($request->file('fileImage')))
      {
        $fFile = request()->file('fileImage');
        $sImageName = time().$fFile->getClientOriginalName();
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImg = Image::make($fFile)->resize(null, $iBigImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImg = Image::make($fFile)->resize($iBigImageWidth, $iBigImageHeight);
        }
        $sResource = $sImg->stream()->detach();
        $sDirectoryPath=$sDirectory.'/other-image/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');

      }

      DB::table('cms_other_image')->insert([
        'otim_image_path' => $sDirectoryPath,
        'otim_is_slide' => $request->rdoIsSlideImage,
        'otim_show_slide' => $request->rdoShowSlide,
        'otim_user_ip' => $request->ip(),
        'otim_update_user' => Auth::user()->id,
        'remember_token' => $request->_token,
        'created_at' =>  date('Y-m-d H:i:s'),
        'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Image is successfully added.');
      return back();
    }


    public function destroy($id)
    {
      $qItem=DB::table('cms_other_image')->where('id',$id)->first();
      Storage::disk('s3')->delete($qItem->otim_image_path);
      DB::table('cms_other_image')->where('id',$id)->delete();
      return back();
    }
}
