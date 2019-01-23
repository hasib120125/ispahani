<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use File;
use Image;
use App\AlbumImageModel;

class AlbumImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      if(!empty($request->cmbAlbumGroupID))
      {
        $qItems=AlbumImageModel::where('alim_album_group_id', $request->cmbAlbumGroupID)->orderBy('id', 'desc')->paginate(13);
      }
      elseif(empty($request->cmbAlbumGroupID))
      {
        $qItems=AlbumImageModel::orderBy('id', 'desc')->orderBy('id', 'desc')->paginate(13);
      }

      $qAlbumGroup=DB::table('cms_album_group')->where('algp_is_active', 'Y')->orderBy('id', 'desc')->pluck('algp_name', 'id');
      return view('adminDashBoard/gallery.all-album-image-list', compact('qItems','qAlbumGroup'));
    }

    public function create()
    {
      $qAlbumCategory=DB::table('cms_album_category')->where('alct_is_active', 'Y')->orderBy('id', 'desc')->pluck('alct_name', 'id');
      $qAlbumGroup=DB::table('cms_album_group')->where('algp_is_active', 'Y')->orderBy('id', 'desc')->pluck('algp_name', 'id');
      return view('adminDashBoard/gallery.album-image', compact('qAlbumCategory','qAlbumGroup'));
    }



    public function store(Request $request)
    {
      $this->validate($request, [
          'file' => 'image|mimes:jpeg,png,jpg,gif',
          'cmbAlbumCategoryID' => 'required',
          'cmbAlbumGroupID' => 'required',
      ]);

      $sDirectory=date('Y');
      $iBigImageWidth=$request->txtBigW;
      $iBigImageHeight=$request->txtBigH;

      $item=new AlbumImageModel;
      $item->alim_album_cat_id = $request->cmbAlbumCategoryID;
      $item->alim_album_group_id = $request->cmbAlbumGroupID;
      $item->alim_english_title = $request->txtAlbumImageEnglishTitle;
      $item->alim_bangla_title = $request->txtAlbumImageBanglaTitle;
      $item->alim_is_active = $request->rdoIsActive;
      $item->alim_user_ip = $request->ip();
      $item->alim_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;
      //Image Upload
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
        $sDirectoryPath=$sDirectory.'/gallery/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');
      }
      $item->alim_image_path=$sDirectoryPath;
      $item->save();

      return back();
    }

    public function destroy($id)
    {
      $deleteItem= AlbumImageModel::findOrFail($id);
      Storage::disk('s3')->delete($deleteItem->alim_image_path);
      $deleteItem->delete();
      return back();
    }
}
