<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use File;
use Image;
use App\NoticeModel;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Show Notice Category Page Notice Category Information
    public function index(Request $request)
    {

      if(empty($request->cmbNoticeCatID))
      {
        $qNoticeCategory=DB::table('cms_notice_category')->where('noca_is_active', 'Y')->pluck('noca_name', 'id');
        $qAllNotice=DB::table('cms_notice')->orderBy('id', 'desc')->paginate(15);
        return view('adminDashBoard/notice.all-notice', compact('qNoticeCategory','qAllNotice'));
      }
      elseif(!empty($request->cmbNoticeCatID))
      {
        $qNoticeCategory=DB::table('cms_notice_category')->where('noca_is_active', 'Y')->pluck('noca_name', 'id');
        $qAllNotice=DB::table('cms_notice')->where('id', $request->cmbNoticeCatID)->orderBy('id', 'desc')->paginate(15);
        return view('adminDashBoard/notice.all-notice', compact('qNoticeCategory','qAllNotice'));
      }

    }


    public function create(Request $request)
    {
      $qNoticeCategory=DB::table('cms_notice_category')->where('noca_is_active', 'Y')->pluck('noca_name', 'id');
      return view('adminDashBoard/notice.notice-information', compact('qNoticeCategory'));
    }

    public function show(Request $request, $id)
    {
      $qNoticeCategory=DB::table('cms_notice_category')->where('noca_is_active', 'Y')->pluck('noca_name', 'id');
      $qAllNotice=DB::table('cms_notice')->where('id', $id)->first();
      return view('adminDashBoard/notice.notice-information-edit', compact('qNoticeCategory','qAllNotice'));
    }

    //Create Notice Information
    public function store(Request $request)
    {
      $this->validate($request, [
          'filePDF' => 'file|mimes:pdf|max:7168',
          'txtEnglishTitle' => 'required|max:59',
          'txtBanglaTitle' => 'max:59',
          'txtURL' => 'max:255',
      ]);

      //This variable data don't save database it's for checking
      $sDirectory=date('Y');
      $sGeneratHtml=$request->rdoGenerateHTML;

      //Data insert to database
      $item= new NoticeModel;
      $item->noti_cat_id = $request->cmbContentsCatID;
      $item->noti_eng_title = $request->txtEnglishTitle;
      $item->noti_eng_details = $request->txtEnglishDetails;
      $item->noti_bng_title = $request->txtBanglaTitle;
      $item->noti_bng_details = $request->txtBanglaDetails;
      $item->noti_is_download = $request->rdoDownloadItem;
      $item->noti_is_active = $request->rdoIsActive;
      $item->noti_show_scroll = $request->rdoShowScroll;
      $item->noti_out_of_notice = $request->rdoOutOfNotice;
      $item->noti_url = $request->txtURL;
      $item->noti_user_ip = $request->ip();
      $item->noti_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;

      //Contents PDF File Input
      if(!empty($request->file('filePDF')))
      {
        $fFile = $request->file('filePDF');
        $sNewName = time().'-'.$fFile->getClientOriginalName();
        $sDirectoryPath = $sDirectory.'/notice/' . $sNewName;
        Storage::disk('s3')->put($sDirectoryPath, file_get_contents($fFile), 'public');
        $item->noti_file_path =$sDirectoryPath;
      }

      $item-> save();
      //Send to request generate html file
      if($sGeneratHtml== 'Y')
      {
        return redirect()->action('GenerateHTMLController@index', ['id' => $item->id, 'catID'=>'Notice']);
      }
      elseif($sGeneratHtml== 'N')
      {
        $request->session()->flash('alert-success', 'Notice information is successfully added');
        return redirect('notice-information');
      }

    }

    //Update Notice Information
    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'filePDF' => 'file|mimes:pdf|max:7168',
          'txtEnglishTitle' => 'required|max:59',
          'txtBanglaTitle' => 'max:59',
          'txtURL' => 'max:255',
      ]);

      //This variable data don't save database it's for checking
      $sDirectory=date('Y');
      $sGeneratHtml=$request->rdoGenerateHTML;

      //Data insert to database
      $item= NoticeModel::where('id', $id)->first();
      $item->noti_cat_id = $request->cmbContentsCatID;
      $item->noti_eng_title = $request->txtEnglishTitle;
      $item->noti_eng_details = $request->txtEnglishDetails;
      $item->noti_bng_title = $request->txtBanglaTitle;
      $item->noti_bng_details = $request->txtBanglaDetails;
      $item->noti_is_download = $request->rdoDownloadItem;
      $item->noti_is_active = $request->rdoIsActive;
      $item->noti_show_scroll = $request->rdoShowScroll;
      $item->noti_out_of_notice = $request->rdoOutOfNotice;
      $item->noti_url = $request->txtURL;
      $item->noti_user_ip = $request->ip();
      $item->noti_update_user = Auth::user()->id;
      $item->remember_token = $request->_token;

      //Contents PDF File Input
      if(!empty($request->file('filePDF')) && !empty($request->oldFileName))
      {
        Storage::disk('s3')->delete($request->oldFileName);

        $fFile = $request->file('filePDF');
        $sNewName = time().'-'.$fFile->getClientOriginalName();
        $sDirectoryPath = $sDirectory.'/notice/' . $sNewName;
        Storage::disk('s3')->put($sDirectoryPath, file_get_contents($fFile), 'public');
        $item->noti_file_path =$sDirectoryPath;
      }

      $item-> update();
      //Send to request generate html file
      if($sGeneratHtml== 'Y')
      {
        return redirect()->action('GenerateHTMLController@index', ['id' => $item->id, 'catID'=>'Notice']);
      }
      elseif($sGeneratHtml== 'N')
      {
        $request->session()->flash('alert-success', 'Notice information is successfully updated.');
        return redirect('notice-information');
      }

    }

}
