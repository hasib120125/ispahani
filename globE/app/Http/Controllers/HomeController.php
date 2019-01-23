<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
       
    {
    	$qDedication=DB::table('cms_contents_master')->where('coma_cat_id',35)->first();

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',2)->first();

        $qItems2=DB::table('cms_contents_master')->where('coma_cat_id',1)->first();

        $qItems3=DB::table('cms_contents_master')->where('coma_cat_id',5)->take(5)->get();
        
        $qItems4=DB::table('cms_contents_master')->where('coma_cat_id',6)->take(5)->get();
    

        $qItems5=DB::table('cms_notice')->where('noti_is_download','Y')->where('noti_is_active','Y')->take(5)->get();

        return view('index',compact('qItems','qItems2','qItems3','qItems4','qItems5','qDedication'));
    }

    public function atAglance()
    {
        $sTitles="IPSC At a Glance";

        $sBreadcrumb='About Us/At-a-Glance';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',1)->first();

        $users = DB::table('cms_contents_master')
                     ->select(DB::raw('count(*) as coma_total_hits'))->where('id',$qItems->id)->get();



        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems','users'));
    }

    public function whyStudyIpsc()
    {
        $sTitles="Why Study at IPSC";

        $sBreadcrumb='About Us/At-a-Glance';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',2)->first();

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function history()
    {
        $sTitles="History of IPSC";

        $sBreadcrumb='About Us/History';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',3)->first();

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function infrastructure()
    {
        $sTitles="Infrastructure of IPSC";

        $sBreadcrumb='About Us/Infrastructure';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',4)->first();

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function achievement()
    {
        $sTitles="Achievements of IPSC";

        $sBreadcrumb='About Us/Achievements';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',5)->paginate(10);

        return view('achievement-news',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function newsEvents()
    {
        $sTitles="News and Events of IPSC";

        $sBreadcrumb='About Us/Achievements';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',6)->paginate(10);

        return view('achievement-news',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function details($id)
    {
        $sTitles="Details Page";

        $sBreadcrumb='About Us/Achievements';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.about-us-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',$id)->first();
        
         //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

      return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }


    public function governingBody()
    {

        return view('governing-body');
    }

    public function messageChairman()
    {
        $sTitles="IPSC Message Chairman";

        $sBreadcrumb='Adminstration /Message Chairman';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.administration-aside";

        $qItems=DB::table('cms_messages')->where('id',2)->latest()->first();

        return view('messages',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function messagePrinciple()
    {
        $sTitles="IPSC Message Principle";

        $sBreadcrumb='Adminstration /Message Principle';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.administration-aside";

        $qItems=DB::table('cms_messages')->where('id',1)->latest()->first();

        return view('messages',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function teacher(Request $request)
    {
        $sTitles="IPSC Teacher";

        $sBreadcrumb='Adminstration /Teacher';

        $sAside="aside.administration-aside";

        $sDepartment="aside.teacher-aside";

        $qItems = DB::table('cms_teacher_staff')->where('thsf_employee_type','')
            ->where('thsf_is_active','Y')->orderBy('id','desc')->paginate(10);


        if(empty($request->qItems))

        {
            $qDepartment = DB::table('cms_staff_department')->orderBy('id')->get();
        }

        elseif (!empty($request->qItems))

        {

            $qDepartment = DB::table('cms_staff_department')->where('sfdp_name',$request->qItems)->get();
        }

        return view('teacher-staff',compact('qItems','sTitles','sBreadcrumb','sAside','sDepartment','qDepartment'));
    }

    public function staff(Request $request)
    {
        $sTitles="IPSC Staff";

        $sBreadcrumb='Adminstration /Staff';

        $sAside="aside.administration-aside";

        $sDepartment="aside.staff-aside";

        $qItems = DB::table('cms_teacher_staff as cts')
            ->join('cms_designation as cd', 'cd.id', '=', 'cts.thsf_designation_id')
            ->join('cms_staff_department as csd', 'csd.id', '=', 'cts.thsf_department_id')
            ->select('cts.*', 'cd.desi_name', 'csd.sfdp_name')->orderBy('id','desc')->paginate(10);

        if(empty($request->qItems))

        {
            $qDepartment = DB::table('cms_staff_department')->orderBy('id')->get();
        }

        elseif (!empty($request->qItems))

        {

            $qDepartment = DB::table('cms_staff_department')->where('sfdp_name',$request->qItems)->get();
        }

        return view('teacher-staff',compact('qItems','sTitles','sBreadcrumb','sAside','sDepartment','qDepartment'));
    }

    public function academicCalendar()
    {
        $sTitles="Academic Calender";

        $sBreadcrumb='Academic/Academic Calender';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',23)->where('coma_is_download','Y')->where('coma_is_active','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sTitles','sBreadcrumb','vItems','sAside'));
    }

    public function holidayCalendar()
    {
        $sTitles="Holiday Calender";

        $sBreadcrumb='Academic /Holiday Calender';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',24)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type', compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));

    }

     public function classRoutine()
     {
        $sTitles="Class Routine";

        $sBreadcrumb='Academic /Class Routine';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',25)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));

    }

    public function syllabus()
    {
        $sTitles="Syllabus";

        $sBreadcrumb='Academic /Syllabus';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',26)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));

    }

    public function examRoutine()
    {
        $sTitles="Exam Routine";

        $sBreadcrumb='Academic/Exam Routine';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',27)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));

    }

    public function publicExamresult()
    {
        $sTitles="Public Exam Result";

        $sBreadcrumb='Academic/Public Exam Result';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',28)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));

    }

    public function internalExamresult()
    {
        $sTitles="Internal Exam Result";

        $sBreadcrumb='Academic/Internal Exam Result';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.academic-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',29)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));

    }

    public function notice(Request $request)
    {
        $sTitles="IPSC Notice";

        $sBreadcrumb='Academic/ Notice';

        $sAside="aside.academic-aside";

        $qNoticeCategory=DB::table('cms_notice_category')->orderBy('id', 'desc')->pluck('noca_name', 'id');

        if(empty($request->cmdNoticeCategory))
        {
            $qItems=DB::table('cms_notice')->where('noti_out_of_notice','N')->where('noti_is_active','Y')->orderBy('id','desc')->paginate(4);
        }
        elseif (!empty($request->cmdNoticeCategory)) 
        {
           $qItems=DB::table('cms_notice')->where('noti_out_of_notice','N')->where('noti_is_active','Y')->where('noti_cat_id',$request->cmdNoticeCategory)->orderBy('id','desc')->paginate(4);
        }


        return view('notice',compact('qItems','sBreadcrumb','sAside','sTitles','qNoticeCategory'));
    }

    public function noticeDetails($id)
    {

        $qItems=DB::table('cms_notice')->where('id',$id)->get();

        return view('notice-details', compact('qItems'));
    }

    public function admissionCircular()
    {
        $sTitles="Admission Circular";

        $sBreadcrumb='Admission/Admission Circular';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.admission-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',31)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sTitle','sBreadcrumb','vItems','sAside','sTitles'));
    }

    public function prospectus()
    {
        $sTitles="Prospectus";

        $sBreadcrumb='Admission/Admission Prospectus';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.admission-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',32)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));
    }

    public function admissionResult()
    {
        $sTitles="Admission Result";

        $sBreadcrumb='Admission/Admission Result';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.admission-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',33)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));
    }

     public function waitingList()
     {
        $sTitles="Waiting List";

        $sBreadcrumb='Admission/Waiting List';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.admission-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_cat_id',34)->where('coma_is_download','Y')->orderBy('id','desc')->paginate(6);

        return view('file-type',compact('qItems','sBreadcrumb','vItems','sAside','sTitles'));
    }

    public function fileDetails($id)
    {

        $qItems=DB::table('cms_contents_master')->where('id',$id)->get();

        return view('file-details', compact('qItems'));
    }

    public function studentHostel()
    {
        $sTitles="Student Hostel Facilities of IPSC";

        $sBreadcrumb='Facilities/Student Hostel';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.facilities-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',7)->latest()->first();

        //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function transport()
    {
        $sTitles="Transport Facilities of IPSC";

        $sBreadcrumb='Facilities/Transport';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.facilities-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',8)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function staffQuarter()
    {
        $sTitles="Staff Quarter of IPSC";

        $sBreadcrumb='Facilities/Staff Quarter';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.facilities-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',9)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function sports()
    {
        $sTitles="Sports of IPSC";

        $sBreadcrumb='Co-Curricular/ Sports';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.co-curriculler-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',10)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function tours()
    {
        $sTitles="Tours of IPSC";

        $sBreadcrumb='Co-Curricular/ Tours';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.co-curriculler-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',11)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }


    public function physicalActivities()
    {
        $sTitles="Physical Activities of IPSC";

        $sBreadcrumb='Co-Curricular/ Physical Activities';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.co-curriculler-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',12)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function intAchievement()
    {
        $sTitles="International Achievements of IPSC";

        $sBreadcrumb='Co-Curricular/ Int. Achievements';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.co-curriculler-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',19)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function debatingClub()
    {
        $sTitles="Debating Club of IPSC";

        $sBreadcrumb='Co-Curricular/ Debating Club';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.club-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',13)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function scienceClub()
    {
        $sTitles="Science Club of IPSC";

        $sBreadcrumb='Co-Curricular/ Science Club';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.club-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',14)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function ictClub()
    {
        $sTitles="ICT Club of IPSC";

        $sBreadcrumb='Co-Curricular/ ICT Club';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.club-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',15)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function artClub()
    {
        $sTitles="Art Club of IPSC";

        $sBreadcrumb='Co-Curricular/ Art Club';

        $vItems="https://www.youtube.com/embed/";

        $sAside="aside.club-aside";

        $qItems=DB::table('cms_contents_master')->where('coma_is_active', 'Y')->where('coma_cat_id',16)->latest()->first();
      //DB::table('cms_contents_master')->where('id',$qItem)->update(['coma_total_hits'=> COALESCE(total_hits,0)+1]);

        return view('details',compact('qItems','sTitles','sBreadcrumb','sAside','vItems'));
    }

    public function albumCategory()
    {
        $sTitles="Ispahani Public School and College Photo Album Category";

        $sBreadcrumb='Gallery / Gallery Category';

        $qItems=DB::table('cms_album_category')->where('alct_is_active', 'Y')->paginate(6);

        return view('gallery', compact('qItems','sTitles','sBreadcrumb'));
    }

    public function albumGroup($id)
    {
        $sTitles="Ispahani Public School and College Photo Album";

        $sBreadcrumb='Gallery / Photo Album';

        $qItems=DB::table('cms_album_group')->where('algp_is_active', 'Y')->where('algp_album_cat_id',$id)->paginate(6);

        return view('album',compact('qItems','sTitles','sBreadcrumb'));
    }

    public function photoDetails()
    {
        $sTitles="Ispahani Public School and College Photo Album Details";

        $sBreadcrumb='Gallery / Gallery Photos';

        $qItems=DB::table('cms_album_image')->where('alim_is_active', 'Y')->get();

        return view('gallery-details', compact('qItems','sTitles','sBreadcrumb','vItems'));
    }

    public function videoGallery()
    {
        $sTitles="Ispahani Public School and College Video Gallery";

        $vItems='http://img.youtube.com/vi/';
        
        $vExt='/0.jpg';

        $qItems=DB::table('cms_video_gallery')->where('vigl_is_active', 'Y')->get();

        return view('video-gallery',compact('qItems','sTitles','vItems','vExt'));
    }

    public function videoDetails($id, $sVideoID)
    {

        $sTitles="Ispahani Public School and College Video Details";

        $qItems=DB::table('cms_video_gallery')->where('vigl_is_active', 'Y')->where('vigl_video_cat_id',$id)->get();

        return view('video-details', compact('qItems','sTitles','sVideoID'));
    }

}
