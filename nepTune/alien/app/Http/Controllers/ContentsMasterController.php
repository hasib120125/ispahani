<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use File;
use Image;
use App\ContentsMasterModel;

class ContentsMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

      if(!empty($request->cmbContentsCategory))
      {
        $qContentsCategory=DB::table('cms_contents_category')->where('coca_is_active', 'Y')->pluck('coca_name', 'id');
        $qContentsMaster=DB::table('cms_contents_master')->where('coma_cat_id', $request->cmbContentsCategory)->orderBy('id', 'desc')->paginate(10);
        return view('adminDashBoard/index', compact('qContentsCategory','qContentsMaster'));
      }
      if(empty($request->cmbContentsCategory))
      {
        $qContentsCategory=DB::table('cms_contents_category')->where('coca_is_active', 'Y')->pluck('coca_name', 'id');
        $qContentsMaster=DB::table('cms_contents_master')->orderBy('id', 'desc')->paginate(10);
        return view('adminDashBoard/index', compact('qContentsCategory','qContentsMaster'));
      }

    }

    public function create(Request $request)
    {
      $qContentsCategory=DB::table('cms_contents_category')->where('coca_is_active', 'Y')->pluck('coca_name', 'id');
      return view('adminDashBoard/page-contents.contents-master', compact('qContentsCategory'));
    }

    //Create Conference Category
    public function store(Request $request)
    {
      $this->validate($request, [
          'fileBigImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
          'filePDF' => 'file|mimes:pdf|max:7168',
          'txtEnglishTitle' => 'required|max:99',
          'txtBanglaTitle' => 'max:99',
          'txtEnglishBrief' => 'max:199',
          'txtBanglaBrief' => 'max:199',
          'txtVideoID' => 'max:69',
      ]);

      //This variable data don't save database it's for checking
      $sDirectory=date('Y');
      $iBigImageWidth=$request->txtBigW;
      $iBigImageHeight=$request->txtBigH;
      $iSmallImageWidth=$request->txtSmallW;
      $iSmallImageHeight=$request->txtSmallH;
      $sGeneratHtml=$request->rdoGenerateHTML;
      $iAspectRatio=$request->chkRatio;
      //Data insert to database
      $item= new ContentsMasterModel;
      $item->coma_cat_id = $request->cmbContentsCatID;
      $item->coma_is_active = $request->rdoIsActive;
      $item->coma_is_download = $request->rdoDownloadItem;
      $item->coma_eng_title = $request->txtEnglishTitle;
      $item->coma_eng_brief = $request->txtEnglishBrief;
      $item->coma_eng_details = $request->txtEnglishDetails;
      $item->coma_bng_title = $request->txtBanglaTitle;
      $item->coma_bng_brief = $request->txtBanglaBrief;
      $item->coma_bng_details = $request->txtBanglaDetails;
      $item->coma_video_id = $request->txtVideoID;
      $item->coma_user_ip = $request->ip();
      $item->coma_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;
      //Image uploding section
      if(!empty($request->file('fileBigImage')))
      {
        $fFile = request()->file('fileBigImage');
        $sImageName = time().$fFile->getClientOriginalName();
        //Big Image
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImg = Image::make($fFile)->resize(null, $iBigImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImg = Image::make($fFile)->resize($iBigImageWidth, $iBigImageHeight);
        }
        $sResource = $sImg->stream()->detach();
        $sDirectoryBigPath=$sDirectory.'/big-image/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryBigPath, $sResource, 'public');
        $item->coma_img_path=$sDirectoryBigPath;

        //Small Image
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImgSm = Image::make($fFile)->resize(null, $iSmallImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImgSm = Image::make($fFile)->resize($iSmallImageWidth, $iSmallImageHeight);
        }
        $sResource = $sImgSm->stream()->detach();
        $sDirectorySmallPath=$sDirectory.'/small-image/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectorySmallPath, $sResource, 'public');
        $item->coma_small_img=$sDirectorySmallPath;
      }
      //Contents PDF File Input
      if(!empty($request->file('filePDF')))
      {
      	$fFile = $request->file('filePDF');
        $sNewName = time().'-'.$fFile->getClientOriginalName();
        $sDirectoryPath = $sDirectory.'/download/' . $sNewName;
        Storage::disk('s3')->put($sDirectoryPath, file_get_contents($fFile), 'public');
                
        $item->coma_file_path =$sDirectoryPath;
      }

      $item-> save();
      //Send to request generate html file
      if($sGeneratHtml== 'Y')
      {
        return redirect()->action('GenerateHTMLController@index', ['id' => $item->id, 'catID'=>$request->cmbContentsCatID]);
      }
      elseif($sGeneratHtml== 'N')
      {
        $request->session()->flash('alert-success', 'Contents information is successfully added');
        return redirect('contents-information');
      }
    }


    public function show($id)
    {
      $qContentsCategory=DB::table('cms_contents_category')->where('coca_is_active', 'Y')->pluck('coca_name', 'id');
      $qContentsMaster=DB::table('cms_contents_master')->where('id', $id)->first();
      return view('adminDashBoard/page-contents.contents-master-edit', compact('qContentsMaster','qContentsCategory'));
    }

    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'fileBigImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
        'filePDF' => 'file|mimes:pdf|max:7168',
        'txtEnglishTitle' => 'required|max:54',
        'txtBanglaTitle' => 'max:54',
        'txtEnglishBrief' => 'max:151',
        'txtBanglaBrief' => 'max:151',
        'txtVideoID' => 'max:69',
      ]);
      //This variable data don't save database it's for checking
      $sDirectory=date('Y');
      $iBigImageWidth=$request->txtBigW;
      $iBigImageHeight=$request->txtBigH;
      $iSmallImageWidth=$request->txtSmallW;
      $iSmallImageHeight=$request->txtSmallH;
      $sGeneratHtml=$request->rdoGenerateHTML;
      $iAspectRatio=$request->chkRatio;
      //Data insert to database
      $item= ContentsMasterModel::where('id', $id)->first();
      $item->coma_cat_id = $request->cmbContentsCatID;
      $item->coma_is_active = $request->rdoIsActive;
      $item->coma_is_download = $request->rdoDownloadItem;
      $item->coma_eng_title = $request->txtEnglishTitle;
      $item->coma_eng_brief = $request->txtEnglishBrief;
      $item->coma_eng_details = $request->txtEnglishDetails;
      $item->coma_bng_title = $request->txtBanglaTitle;
      $item->coma_bng_brief = $request->txtBanglaBrief;
      $item->coma_bng_details = $request->txtBanglaDetails;
      $item->coma_video_id = $request->txtVideoID;
      $item->coma_user_ip = $request->ip();
      $item->coma_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;
      //Image uploding section
      if(!empty($request->file('fileBigImage')))
      {
        //Delete Old Image
        if($request->deleteImage=='Y' && !empty($request->oldBigImage) && !empty($request->oldSmallImage)){
          Storage::disk('s3')->delete($request->oldBigImage);
          Storage::disk('s3')->delete($request->oldSmallImage);

          $fFile = request()->file('fileBigImage');
          $sImageName = time().$fFile->getClientOriginalName();
          //Big Image
          if(!empty($iAspectRatio) && $iAspectRatio=='Y')
          {
            $sImg = Image::make($fFile)->resize(null, $iBigImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
          }
          else
          {
            $sImg = Image::make($fFile)->resize($iBigImageWidth, $iBigImageHeight);
          }
          $sResource = $sImg->stream()->detach();
          $sDirectoryBigPath=$sDirectory.'/big-image/'.$sImageName;
          $sPath = Storage::disk('s3')->put($sDirectoryBigPath, $sResource, 'public');
          $item->coma_img_path=$sDirectoryBigPath;

          //Small Image
          if(!empty($iAspectRatio) && $iAspectRatio=='Y')
          {
            $sImgSm = Image::make($fFile)->resize(null, $iSmallImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
          }
          else
          {
            $sImgSm = Image::make($fFile)->resize($iSmallImageWidth, $iSmallImageHeight);
          }
          $sResource = $sImgSm->stream()->detach();
          $sDirectorySmallPath=$sDirectory.'/small-image/'.$sImageName;
          $sPath = Storage::disk('s3')->put($sDirectorySmallPath, $sResource, 'public');
          $item->coma_small_img=$sDirectorySmallPath;

        }

      }

      //Contents PDF File Input
      if(!empty($request->file('filePDF')))
      {
        //Delete Old PDF
        if($request->deletePDF != null){
          Storage::disk('s3')->delete($request->deletePDF);

          $fFile = $request->file('filePDF');
          $sNewName = time().'-'.$fFile->getClientOriginalName();
          $sDirectoryPath = $sDirectory.'/download/' . $sNewName;
          Storage::disk('s3')->put($sDirectoryPath, file_get_contents($fFile), 'public');
          $item->coma_file_path =$sDirectoryPath;
        }
      }

      $item-> update();
      //Send to request generate html file
      if($sGeneratHtml== 'Y')
      {
        return redirect()->action('GenerateHTMLController@index', ['id' => $item->id, 'catID'=>$request->cmbContentsCatID]);
      }
      elseif($sGeneratHtml== 'N')
      {
        $qContentsCategory=DB::table('cms_contents_category')->where('coca_is_active', 'Y')->pluck('coca_name', 'id');
        $qContentsMaster=DB::table('cms_contents_master')->where('coma_cat_id', $request->cmbContentsCatID)->orderBy('id', 'desc')->paginate(10);

        $request->session()->flash('alert-success', 'Contents information is successfully updated');

        return redirect('contents-information');

      }
    }

}
