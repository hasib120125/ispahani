<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\MessagesModel;
use Auth;
use DB;
use File;
use Image;

class AdministrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      if(empty($request->txtMessageCategory))
      {
        $qMessages=MessagesModel::orderBy('id', 'desc')->paginate(7);
        return view('adminDashBoard/administration.all-messages', compact('qMessages'));
      }
      if(!empty($request->txtMessageCategory))
      {
        $id=$request->txtMessageCategory;
        $qMessages=MessagesModel::where('mess_cat_id', $id)->orderBy('id', 'desc')->paginate(7);
        return view('adminDashBoard/administration.all-messages', compact('qMessages'));
      }

    }

    public function create(Request $request)
    {
      return view('adminDashBoard/administration.messages-create');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
          'fileMessageImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
          'filePDF' => 'file|mimes:pdf|max:1024',
          'txtMessageCategory' => 'required',
          'txtMessageEngTitle' => 'required|max:99',
          'txtMessageBngTitle' => 'max:99',
          'txtMessageEngBrief' => 'max:199',
          'txtMessageBngBrief' => 'max:199',
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
      $item= new MessagesModel;
      $item->mess_cat_id = $request->txtMessageCategory;
      $item->mess_is_active = $request->rdoIsActive;
      $item->mess_eng_title = $request->txtMessageEngTitle;
      $item->mess_eng_brief = $request->txtMessageEngBrief;
      $item->mess_eng_details = $request->txtMessageEngDetails;
      $item->mess_bng_title = $request->txtMessageBngTitle;
      $item->mess_bng_brief = $request->txtMessageBngBrief;
      $item->mess_bng_details = $request->txtBanglaDetails;
      $item->mess_video_id = $request->txtVideoID;
      $item->mess_user_ip = $request->ip();
      $item->mess_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;
      //Image uploding section
      if(!empty($request->file('fileMessageImage')))
      {
        $fFile = request()->file('fileMessageImage');
        $sImageName = time().$fFile->getClientOriginalName();
        //Big Image
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImgBig = Image::make($fFile)->resize(null, $iBigImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImgBig = Image::make($fFile)->resize($iBigImageWidth, $iBigImageHeight);
        }
        $sResource = $sImgBig->stream()->detach();
        $sDirectoryBigPath=$sDirectory.'/staff/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryBigPath, $sResource, 'public');
        $item->mess_img_path=$sDirectoryBigPath;

        //Small Image
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImgSmall = Image::make($fFile)->resize(null, $iSmallImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImgSmall = Image::make($fFile)->resize($iSmallImageWidth, $iSmallImageHeight);
        }
        $sResource = $sImgSmall->stream()->detach();
        $sDirectorySmallPath=$sDirectory.'/staff/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectorySmallPath, $sResource, 'public');
        $item->mess_small_img=$sDirectorySmallPath;
      }
      //Contents PDF File Input
      if(!empty($request->file('filePDF')))
      {
        $fFile = $request->file('filePDF');
        $sNewName = time().'-'.$fFile->getClientOriginalName();
        $sDirectoryPath = $sDirectory.'/download/' . $sNewName;
        Storage::disk('s3')->put($sDirectoryPath, file_get_contents($fFile), 'public');
        $item->mess_file_path =$sDirectoryPath;
      }
      $item->save();
      //Send to request generate html file
      if($sGeneratHtml== 'Y')
      {
        return redirect()->action('GenerateHTMLController@index', ['iContentsID' => $item->id, 'iCategoryID'=>$request->txtMessageCategory]);
      }
      elseif($sGeneratHtml== 'N')
      {
        $request->session()->flash('alert-success', 'Message information is successfully added');
        return redirect('messages');
      }
    }

    public function show($id)
    {
      $qMessages=MessagesModel::where('id', $id)->first();
      return view('adminDashBoard/administration.messages-edit', compact('qMessages'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'fileMessageImage' => 'image|mimes:jpeg,png,jpg,gif,svg',
          'filePDF' => 'file|mimes:pdf|max:1024',
          'txtMessageCategory' => 'required',
          'txtMessageEngTitle' => 'required|max:99',
          'txtMessageBngTitle' => 'max:99',
          'txtMessageEngBrief' => 'max:199',
          'txtMessageBngBrief' => 'max:199',
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
      $item= MessagesModel::where('id', $id)->first();
      $item->mess_cat_id = $request->txtMessageCategory;
      $item->mess_is_active = $request->rdoIsActive;
      $item->mess_eng_title = $request->txtMessageEngTitle;
      $item->mess_eng_brief = $request->txtMessageEngBrief;
      $item->mess_eng_details = $request->txtMessageEngDetails;
      $item->mess_bng_title = $request->txtMessageBngTitle;
      $item->mess_bng_brief = $request->txtMessageBngBrief;
      $item->mess_bng_details = $request->txtMessageBngDetails;
      $item->mess_video_id = $request->txtVideoID;
      $item->mess_user_ip = $request->ip();
      $item->mess_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;
      //Image uploding section
      if(!empty($request->file('fileMessageImage')) && $request->deleteImage != null)
      {
        Storage::disk('s3')->delete($request->oldBigImage);
        Storage::disk('s3')->delete($request->oldSmallImage);

        $fFile = request()->file('fileMessageImage');
        $sImageName = time().$fFile->getClientOriginalName();
        //Big Image
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImgBig = Image::make($fFile)->resize(null, $iBigImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImgBig = Image::make($fFile)->resize($iBigImageWidth, $iBigImageHeight);
        }
        $sResource = $sImgBig->stream()->detach();
        $sDirectoryBigPath=$sDirectory.'/staff/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectoryBigPath, $sResource, 'public');
        $item->mess_img_path=$sDirectoryBigPath;

        //Small Image
        if(!empty($iAspectRatio) && $iAspectRatio=='Y')
        {
          $sImgSmall = Image::make($fFile)->resize(null, $iSmallImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
        }
        else
        {
          $sImgSmall = Image::make($fFile)->resize($iSmallImageWidth, $iSmallImageHeight);
        }
        $sResource = $sImgSmall->stream()->detach();
        $sDirectorySmallPath=$sDirectory.'/staff/'.$sImageName;
        $sPath = Storage::disk('s3')->put($sDirectorySmallPath, $sResource, 'public');
        $item->mess_small_img=$sDirectorySmallPath;
      }

      //Contents PDF File Input
      if(!empty($request->file('filePDF')) && $request->deletePDF != null)
      {
        Storage::disk('s3')->delete($deleteItem->oldFilePDF);
        
        $fFile = $request->file('filePDF');
        $sNewName = time().'-'.$fFile->getClientOriginalName();
        $sDirectoryPath = $sDirectory.'/download/' . $sNewName;
        Storage::disk('s3')->put($sDirectoryPath, file_get_contents($fFile), 'public');
        $item->mess_file_path =$sDirectoryPath;
      }
      $item->save();
      //Send to request generate html file
      if($sGeneratHtml== 'Y')
      {
        return redirect()->action('GenerateHTMLController@index', ['iContentsID' => $item->id, 'iCategoryID'=>$request->txtMessageCategory]);
      }
      elseif($sGeneratHtml== 'N')
      {
        $request->session()->flash('alert-success', 'Message information is successfully updated');
        return redirect('messages');
      }
    }

}
