<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use File;
use Image;

class AlbumGroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      if(!empty($request->cmbAlbumCategoryID))
      {
        $qItems=DB::table('cms_album_group')->where('algp_album_cat_id', $request->cmbAlbumCategoryID)->orderBy('id', 'desc')->paginate(10);
      }
      else
      {
        $qItems=DB::table('cms_album_group')->orderBy('id', 'desc')->paginate(10);
      }

      $qAlbumCategory=DB::table('cms_album_category')->where('alct_is_active', 'Y')->orderBy('id', 'desc')->pluck('alct_name', 'id');
      return view('adminDashBoard/gallery.all-album-group-list', compact('qItems','qAlbumCategory'));
    }

    public function create()
    {
      $qAlbumCategory=DB::table('cms_album_category')->where('alct_is_active', 'Y')->orderBy('id', 'desc')->pluck('alct_name', 'id');
      return view('adminDashBoard/gallery.album-group', compact('qAlbumCategory'));
    }

    public function store(Request $request)
    {
      $sDirectory=date('Y');
      $vGeneralHTML=$request->rdoGenerateHTML;
      //Image uploding section
      if(!empty($request->file('fileGroupImage')))
      {
        $fFile = request()->file('fileGroupImage');
        $sImageName = time().$fFile->getClientOriginalName();
        $sImg = Image::make($fFile)->resize(120, 90);
        $sResource = $sImg->stream()->detach();
        $sDirectoryPath=$sDirectory.'/gallery/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');

      }

      DB::table('cms_album_group')->insert([
          'algp_album_cat_id' => $request->cmbAlbumCategoryID,
          'algp_name' => $request->txtAlbumGroupName,
          'algp_bangla_name' => $request->txtAlbumGroupBanglaName,
          'algp_image_path' => $sDirectoryPath,
          'algp_is_active' => $request->rdoIsActive,
          'algp_user_ip' => $request->ip(),
          'algp_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Album Group information is successfully added.');
      $qItems=DB::table('cms_album_group')->orderBy('id', 'desc')->paginate(10);
      $qAlbumCategory=DB::table('cms_album_category')->where('alct_is_active', 'Y')->pluck('alct_name', 'id');

      return view('adminDashBoard/gallery.all-album-group-list', compact('qItems','qAlbumCategory'));
    }


    public function show($id)
    {
      $qItem=DB::table('cms_album_group')->where('id', $id)->first();
      $qAlbumCategory=DB::table('cms_album_category')->where('alct_is_active', 'Y')->pluck('alct_name', 'id');

      return view('adminDashBoard/gallery.album-group-edit', compact('qItem','qAlbumCategory'));
    }


    public function update(Request $request, $id)
    {
      $sDirectory=date('Y');
      $sDirectoryPath=$request->oldImageName;
      $vGeneralHTML=$request->rdoGenerateHTML;
      //Image uploding section
      if(!empty($request->file('fileGroupImage')))
      {
        $sDirectoryPath="";
        //Delete Old Image
        if(!empty($request->deleteImage) && !empty($request->oldImageName))
        {
          Storage::disk('s3')->delete($request->oldImageName);
        
          $fFile = request()->file('fileGroupImage');
          $sImageName = time().$fFile->getClientOriginalName();
          $sImg = Image::make($fFile)->resize(120, 90);
          $sResource = $sImg->stream()->detach();
          $sDirectoryPath=$sDirectory.'/gallery/'.$sImageName;
          $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');
        }

      }

      DB::table('cms_album_group')->where('id', $id)->update([
          'algp_album_cat_id' => $request->cmbAlbumCategoryID,
          'algp_name' => $request->txtAlbumGroupName,
          'algp_bangla_name' => $request->txtAlbumGroupBanglaName,
          'algp_image_path' => $sDirectoryPath,
          'algp_is_active' => $request->rdoIsActive,
          'algp_user_ip' => $request->ip(),
          'algp_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Album Group information is successfully update.');
      return redirect('album-group');
    }


    public function selectGroup(Request $request)
    {
      if($request->ajax()){
        $qItem=DB::table('cms_album_group')->where('algp_album_cat_id', $request->cmbAlbumCategoryID)->where('algp_is_active', 'Y')->orderBy('id', 'desc')->pluck('algp_name', 'id')->all();
        $data = view('adminDashBoard.ajax-select',compact('qItem'))->render();
        return response()->json(['options'=>$data]);
      }
    }
}
