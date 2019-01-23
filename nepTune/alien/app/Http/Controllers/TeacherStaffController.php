<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use DB;
use Image;

class TeacherStaffController extends Controller
{

    public function index(Request $request)
    {

      if(!empty($request->cmbSearch) || !empty($request->cmbBloodGroup))
      {
        $sCatID=!empty($request->cmbSearch)?$request->cmbSearch:'';
        $sBloodGroup=!empty($request->cmbBloodGroup)?$request->cmbBloodGroup:'';

        $qBloodGroup=DB::table('cms_blood_group')->where('bdgp_is_active', 'Y')->pluck('bdgp_name', 'id');

        $aItems=DB::table('cms_teacher_staff as thsf')
        ->join('cms_designation as desi', 'desi.id', '=', 'thsf.thsf_designation_id')
        ->join('cms_staff_department as sfdp', 'sfdp.id', '=', 'thsf.thsf_department_id')
        ->join('cms_subject as subj', 'subj.id', '=', 'thsf.thsf_subject_id')
        ->join('cms_blood_group as bdgp', 'bdgp.id', '=', 'thsf.thsf_blood_group')
        ->select('bdgp.bdgp_name','thsf.id','thsf.thsf_cat_id','thsf.thsf_is_active','thsf.thsf_eng_name','thsf.thsf_mobile_no','thsf.thsf_emergency_mobile','thsf.thsf_email_id','thsf.thsf_blood_group','thsf.thsf_seniority_id','thsf.thsf_joining_date','thsf.thsf_image_path','desi.desi_name','sfdp.sfdp_name','subj.subj_name');

        if($sCatID){$aItems->where('thsf.thsf_cat_id', '=', "$sCatID");}
        if($sBloodGroup){$aItems->where('thsf.thsf_blood_group', '=', "$sBloodGroup");}
        $qItems=$aItems->orderBy('id', 'desc')->paginate(10);

        return view('adminDashBoard/administration.all-teacher-staff', compact('qItems','qBloodGroup'));
      }
      else
      {
        $qBloodGroup=DB::table('cms_blood_group')->where('bdgp_is_active', 'Y')->pluck('bdgp_name', 'id');
        $qItems=DB::table('cms_teacher_staff as thsf')
        ->join('cms_designation as desi', 'desi.id', '=', 'thsf.thsf_designation_id')
        ->join('cms_staff_department as sfdp', 'sfdp.id', '=', 'thsf.thsf_department_id')
        ->join('cms_subject as subj', 'subj.id', '=', 'thsf.thsf_subject_id')
        ->join('cms_blood_group as bdgp', 'bdgp.id', '=', 'thsf.thsf_blood_group')
        ->select('bdgp.bdgp_name','thsf.id','thsf.thsf_cat_id','thsf.thsf_is_active','thsf.thsf_eng_name','thsf.thsf_mobile_no','thsf.thsf_emergency_mobile','thsf.thsf_email_id','thsf.thsf_blood_group','thsf.thsf_seniority_id','thsf.thsf_joining_date','thsf.thsf_image_path','desi.desi_name','sfdp.sfdp_name','subj.subj_name')->orderBy('id', 'desc')->paginate(10);
        return view('adminDashBoard/administration.all-teacher-staff', compact('qItems','qBloodGroup'));
      }

    }


    public function create()
    {
      $qReligion=DB::table('cms_religion')->where('reli_is_active', 'Y')->pluck('reli_name', 'id');
      $qDesignation=DB::table('cms_designation')->where('desi_is_active', 'Y')->pluck('desi_name', 'id');
      $qDepartment=DB::table('cms_staff_department')->where('sfdp_is_active', 'Y')->where('sfdp_is_teacher', 'N')->pluck('sfdp_name', 'id');
      $qSubject=DB::table('cms_subject')->where('subj_is_active', 'Y')->pluck('subj_name', 'id');
      $qShift=DB::table('cms_shift')->where('shif_is_active', 'Y')->pluck('shif_name', 'id');
      $qBloodGroup=DB::table('cms_blood_group')->where('bdgp_is_active', 'Y')->pluck('bdgp_name', 'id');
      return view('adminDashBoard/administration.teacher-staff-information', compact('qReligion','qDesignation','qDepartment','qSubject','qShift','qBloodGroup'));
    }


    public function store(Request $request)
    {

        $sDirectory=date('Y');
        $iImageWidth=$request->txtBigW;
        $iImageHeight=$request->txtBigH;
        $iAspectRatio=$request->chkRatio;
        //Image uploding section
        if(!empty($request->file('fileImage')))
        {
          $fFile = request()->file('fileImage');
          $sImageName = time().$fFile->getClientOriginalName();
          if(!empty($iAspectRatio) && $iAspectRatio=='Y')
          {
            $sImg = Image::make($fFile)->resize(null, $iImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
          }
          else
          {
            $sImg = Image::make($fFile)->resize($iImageWidth, $iImageHeight);
          }
          $sResource = $sImg->stream()->detach();
          $sDirectoryPath=$sDirectory.'/staff/'.$sImageName;
          $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');

        }

        $iDepartmentID=!empty($request->cmbDepartmentID)?$request->cmbDepartmentID:0;
        $iShiftID=!empty($request->cmbShiftID)?$request->cmbShiftID:0;
        $iSubjectID=!empty($request->cmbSubjectID)?$request->cmbSubjectID:0;
        $iReligionID=!empty($request->cmbReligionID)?$request->cmbReligionID:0;
        $iBloodGroup=!empty($request->cmbBloodGroup)?$request->cmbBloodGroup:0;

        DB::table('cms_teacher_staff')->insert([
          'thsf_cat_id' => $request->cmbEmployeeCategory,
          'thsf_department_id' => $iDepartmentID,
          'thsf_shift_id' => $iShiftID,
          'thsf_employee_id' => $request->txtEmployeeID,
          'thsf_employee_type' => $request->cmbEmployeeType,
          'thsf_designation_id' => $request->cmbDesignationID,
          'thsf_joining_date' => $request->txtJoiningDate,
          'thsf_seniority_id' => $request->txtSeniorityID,
          'thsf_mobile_no' => $request->txtMobileNo,
          'thsf_emergency_mobile' => $request->txtEmergencyMobile,
          'thsf_email_id' => $request->txtEmail,
          'thsf_fb_id' => $request->txtFbID,
          'thsf_twitter_id' => $request->txtTwitterID,
          'thsf_skype_id' => $request->txtSkypeID,
          'thsf_google_id' => $request->txtGoogleID,
          'thsf_linkedin_id' => $request->txtLinkedinID,
          'thsf_eng_name' => $request->txtEnglishName,
          'thsf_bng_name' => $request->txtBanglaName,
          'thsf_father_name' => $request->txtFatherName,
          'thsf_mother_name' => $request->txtMotherName,
          'thsf_spouse_name' => $request->txtSpouseName,
          'thsf_present_address' => $request->txtPresentAddress,
          'thsf_permanent_address' => $request->txtPermanentAddress,
          'thsf_university_name' => $request->txtUniversityName,
          'thsf_subject_id' => $iSubjectID,
          'thsf_religion_id' => $iReligionID,
          'thsf_gender_id' => $request->rdoGender,
          'thsf_married_status' => $request->rdoMarriedStatus,
          'thsf_blood_group' => $iBloodGroup,
          'thsf_image_path' => $sDirectoryPath,
          'thsf_is_active' => $request->rdoIsActive,
          'thsf_user_ip' => $request->ip(),
          'thsf_update_user' => Auth::user()->id,
          'remember_token' => $request->_token,
          'created_at' =>  date('Y-m-d H:i:s'),
          'updated_at' =>  date('Y-m-d H:i:s')
        ]);

        $request->session()->flash('alert-success', 'Teacher and Staff information is successfully added.');
        return redirect('teacher-staff');

    }


    public function show($id)
    {
      $qReligion=DB::table('cms_religion')->where('reli_is_active', 'Y')->pluck('reli_name', 'id');
      $qDesignation=DB::table('cms_designation')->where('desi_is_active', 'Y')->pluck('desi_name', 'id');
      $qDepartment=DB::table('cms_staff_department')->where('sfdp_is_active', 'Y')->pluck('sfdp_name', 'id');
      $qSubject=DB::table('cms_subject')->where('subj_is_active', 'Y')->pluck('subj_name', 'id');
      $qShift=DB::table('cms_shift')->where('shif_is_active', 'Y')->pluck('shif_name', 'id');
      $qBloodGroup=DB::table('cms_blood_group')->where('bdgp_is_active', 'Y')->pluck('bdgp_name', 'id');

      $qItems=DB::table('cms_teacher_staff as thsf')->where('id', $id)->first();

      return view('adminDashBoard/administration.teacher-staff-information-edit', compact('qReligion','qDesignation','qDepartment','qSubject','qShift','qItems','qBloodGroup'));
    }


    public function update(Request $request, $id)
    {
      $sDirectory=date('Y');
      $iImageWidth=$request->txtBigW;
      $iImageHeight=$request->txtBigH;
      $iAspectRatio=$request->chkRatio;
      $sDirectoryPath=$request->oldImageName;
      //Image uploding section
      if(!empty($request->file('fileImage')))
      {
        //Delete Old Image
        if($request->deleteImage=='Y'){
          $sDirectoryPath="";
          //Delete Image Then Upload New Image
          Storage::disk('s3')->delete($request->$sDirectoryPath);

          $fFile = request()->file('fileImage');
          $sImageName = time().$fFile->getClientOriginalName();
          if(!empty($iAspectRatio) && $iAspectRatio=='Y')
          {
            $sImg = Image::make($fFile)->resize(null, $iImageHeight, function ($sConstraint) {$sConstraint->aspectRatio();});
          }
          else
          {
            $sImg = Image::make($fFile)->resize($iImageWidth, $iImageHeight);
          }
          $sResource = $sImg->stream()->detach();
          $sDirectoryPath=$sDirectory.'/staff/'.$sImageName;
          $sPath = Storage::disk('s3')->put($sDirectoryPath, $sResource, 'public');
        }

      }

      DB::table('cms_teacher_staff')->where('id', $id)->update([
        'thsf_cat_id' => $request->cmbEmployeeCategory,
        'thsf_department_id' => $request->cmbDepartmentID,
        'thsf_shift_id' => $request->cmbShiftID,
        'thsf_employee_id' => $request->txtEmployeeID,
        'thsf_employee_type' => $request->cmbEmployeeType,
        'thsf_designation_id' => $request->cmbDesignationID,
        'thsf_joining_date' => $request->txtJoiningDate,
        'thsf_seniority_id' => $request->txtSeniorityID,
        'thsf_mobile_no' => $request->txtMobileNo,
        'thsf_emergency_mobile' => $request->txtEmergencyMobile,
        'thsf_email_id' => $request->txtEmail,
        'thsf_fb_id' => $request->txtFbID,
        'thsf_twitter_id' => $request->txtTwitterID,
        'thsf_skype_id' => $request->txtSkypeID,
        'thsf_google_id' => $request->txtGoogleID,
        'thsf_linkedin_id' => $request->txtLinkedinID,
        'thsf_eng_name' => $request->txtEnglishName,
        'thsf_bng_name' => $request->txtBanglaName,
        'thsf_father_name' => $request->txtFatherName,
        'thsf_mother_name' => $request->txtMotherName,
        'thsf_spouse_name' => $request->txtSpouseName,
        'thsf_present_address' => $request->txtPresentAddress,
        'thsf_permanent_address' => $request->txtPermanentAddress,
        'thsf_university_name' => $request->txtUniversityName,
        'thsf_subject_id' => $request->cmbSubjectID,
        'thsf_religion_id' => $request->cmbReligionID,
        'thsf_gender_id' => $request->rdoGender,
        'thsf_married_status' => $request->rdoMarriedStatus,
        'thsf_blood_group' => $request->cmbBloodGroup,
        'thsf_image_path' => $sDirectoryPath,
        'thsf_is_active' => $request->rdoIsActive,
        'thsf_user_ip' => $request->ip(),
        'thsf_update_user' => Auth::user()->id,
        'remember_token' => $request->_token,
        'created_at' =>  date('Y-m-d H:i:s'),
        'updated_at' =>  date('Y-m-d H:i:s')
      ]);

      $request->session()->flash('alert-success', 'Teacher and Staff information is successfully updated.');
      return redirect('teacher-staff');
    }

}
