<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Storage;

class GenerateHTMLController extends Controller
{

    public function index($iContentsID,$iCategoryID)
    {
      /*Home About Us*/

      if($iCategoryID==3)
      {
        $qItems=DB::table('cms_contents_master')->select('id','coma_eng_title','coma_eng_brief')->where('id',$iContentsID)->where('coma_is_active','Y')->latest()->first();


        $myFile ='/home/ipscedu/public_html/media/html/'."home-about-us.htm";
        $fh = fopen($myFile, "w");
        $sData = "";

        $sData .='<div class="row text-justify home-about-text">
                    <h3 style="">About Us</h3>
                    <p>'.$qItems->coma_eng_brief.'</p>
                    <div class="home-notice-btn">
                        <a href="history" class="home_about_button">Read More</a>
                      </div>
                  </div>';

        fwrite($fh, $sData);fclose($fh);
        
        return redirect('contents-information');
      }

      /*Home Notice*/

      if($iCategoryID=='Notice')
      {
        $qItems=DB::table('cms_notice')->where('noti_is_active','Y')->first();

        //dd($qItems);

        $myFile = '/www/ispahani/media/html/'. "notice.htm";
        $fh = fopen($myFile, "w");

        $sData = "";

        $sData .= '<h2 class="home-notice-title">Latest Notice</h2>
                    <ul class="event-wrapper">
                        <li class="home-notice-calendar" data-wow-duration="2s" data-wow-delay=".1s">
                            <div class="home-notice-link">
                                <div class="event-calender-holder">
                                    <h3>'.date('d').'</h3>
                                    <p>'.date('M').'</p>
                                    <span>'.date('Y').'</span>
                                </div>
                            </div>
                            <div class="event-content-holder">
                                <h3><a href="'.Storage::disk('s3')->url($qItems->noti_file_path).'">'.$qItems->noti_eng_title.'</a></h3>
                                <p style="padding-right: 4px !important;border-right: 1px solid #000;"><a href="'.Storage::disk('s3')->url($qItems->noti_file_path).'" class="badge badge-success view-notice">View</a></p>

                                <p><a href=https://ipsc-edu-bd.s3.us-east-2.amazonaws.com/'.$qItems->noti_file_path.' class="badge badge-success download-notice">Download</a></p>
                            </div>
                        </li>
                    </ul>
                    <div class="home-notice-btn">
                        <a href="notice" class="home_about_button">View All Notice</a>
                    </div>';
      
        fwrite($fh, $sData);fclose($fh);
        return redirect()->action('NoticeController@index',['id' => 'all']);
      }

      /* Home Scroll Notice*/
      if($iCategoryID=='Notice')
      {
        $qItems=DB::table('cms_notice')->where('noti_cat_id',4)->where('noti_is_active','Y')->first();

        //dd($qItems);

        $myFile = '/home/ipscedu/public_html/media/html/'. "latest-notice.htm";
        $fh = fopen($myFile, "w");

        $sData = "";

        $sData .= '<div class="row">
                    <div class="col-sm-12">
                      <div class="onoffswitch3">
                        <input type="checkbox" name="onoffswitch3" class="onoffswitch3-checkbox" id="myonoffswitch3" checked>
                        <label class="onoffswitch3-label" for="myonoffswitch3">
                            <span class="onoffswitch3-inner">
                                <span class="onoffswitch3-active">
                                    <marquee class="scroll-text">'.$qItems->noti_eng_details.'</marquee>
                                    <span class="onoffswitch3-switch">Latest Notice <i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                </span>
                                <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch">SHOW Latest Notice</span></span>
                            </span>
                        </label>
                    </div>
                    </div>
                  </div>';
      
        fwrite($fh, $sData);fclose($fh);
        return redirect()->action('NoticeController@index',['id' => 'all']);
      }

       /*Message Chairman*/

      if($iCategoryID=='Chairman')
      {
        $qItems=DB::table('cms_messages')->select('mess_eng_title','mess_eng_brief','mess_eng_details','mess_img_path')->where('id',2)->where('mess_is_active','Y')->latest()->first();

        $myFile = '/home/ipscedu/public_html/media/html/'."chairman-message.htm";
        $fh = fopen($myFile, "w");
        $sData = "";

        $sData .= '<div class="col-sm-5">
                    <span class="msg-text" style="text-align:center">'.$qItems->mess_eng_title.'</span>
                    <img src=https://ipsc-edu-bd.s3.us-east-2.amazonaws.com/'.$qItems->mess_img_path.' class="img-responsive" style="text-align:center">
                    '.$qItems->mess_eng_brief.'
                    <a href="message-chairman" class="home_button" style="text-align:center">Read Message</a>
                  </div>';

        fwrite($fh, $sData);fclose($fh);
        return redirect()->action('AdministrationController@index',['id' => 'all']);
      }

      /*Message Principle*/

      if($iCategoryID=='Principal')
      {
        $qItems=DB::table('cms_messages')->select('mess_eng_title','mess_eng_brief','mess_eng_details','mess_img_path')->where('id',1)->where('mess_is_active','Y')->latest()->first();

        $myFile = '/home/ipscedu/public_html/media/html/'."principal-message.htm";
        $fh = fopen($myFile, "w");

        $sData = "";

        $sData .= '<div class="col-sm-4">
                      <span class="msg-text" style="text-align:center">'.$qItems->mess_eng_title.'</span>
                      <img src=https://ipsc-edu-bd.s3.us-east-2.amazonaws.com/'.$qItems->mess_img_path.' class="img-responsive" style="text-align:center">
                     '.$qItems->mess_eng_brief.'
                      <a href="message-principle" class="home_button" style="text-align:center">Read Message</a>
                  </div>';

        fwrite($fh, $sData);fclose($fh);
        return redirect()->action('AdministrationController@index',['id' => 'all']);
      }

      /*Chief Patron Message*/

      if($iCategoryID=='chiefPatron')
      {
        $qItems=DB::table('cms_messages')->select('mess_eng_title','mess_eng_brief','mess_eng_details','mess_img_path')->where('id',3)->where('mess_is_active','Y')->latest()->first();

        $myFile = '/home/ipscedu/public_html/media/html/'."chief-patron-message.htm";
        $fh = fopen($myFile, "w");

        $sData = "";

        $sData .= '<div class="col-sm-4">
                      <span class="msg-text" style="text-align:center">'.$qItems->mess_eng_title.'</span>
                      <img src=https://ipsc-edu-bd.s3.us-east-2.amazonaws.com/'.$qItems->mess_img_path.' class="img-responsive" style="text-align:center">
                      <p style="text-align:center">'.$qItems->mess_eng_brief.'</p>
                      <a href="#" class="home_button" style="text-align:center">Read Message</a>
                  </div>';

        fwrite($fh, $sData);fclose($fh);
        return redirect()->action('AdministrationController@index',['id' => 'all']);
      }

      /*Home At a Glance*/

      if($iCategoryID==1)
      {
        $qItems=DB::table('cms_contents_master')->select('coma_eng_title','coma_eng_brief')->where('coma_cat_id',1)->where('coma_is_active','Y')->first();

        $myFile ='/home/ipscedu/public_html/media/html/'."home-at-a-glance.htm";
        $fh = fopen($myFile, "w");

        $sData = "";

        $sData .='<div class="row" style="padding-top: 125px;text-align: center;">
                  <span class="about-text">At a Glance</span>
                   <p style="margin-bottom:5px;">'.$qItems->coma_eng_brief.'</p>
                   <a href="at-a-glance" class="home_about_button">Read More</a>
                  </div>';

        fwrite($fh, $sData);fclose($fh);
        
        
        return redirect('contents-information');
      }

      /*Home Results*/

      if($iCategoryID==29)
      {
        $qItems=DB::table('cms_contents_master')->select('coma_eng_title')->where('coma_cat_id',29)->where('coma_is_active','Y')->first();

        $myFile ='/home/ipscedu/public_html/media/html/'."home-results.htm";
        $fh = fopen($myFile, "w");

        $sData = "";

        $sData .='<div class="container" style="text-align:center">
            <h4 class="result-head">'.$qItems->coma_eng_title.'</h4>
            <div class="row">
              <div class="col-sm-12">
                <div class="container " style="text-align: center">
                      <ul class="nav nav-tabs margin-top10">
                           <li><a data-toggle="tab" href="#menu1" style="background-color: #fff; color: #000 !important">PSC</a></li>
                           <li><a data-toggle="tab" href="#menu2" style="background-color: #fff; color: #000 !important">JSC</a></li>
                           <li><a data-toggle="tab" href="#menu3" style="background-color: #fff; color: #000 !important">SSC</a></li>
                           <li><a data-toggle="tab" href="#menu4" style="background-color: #fff; color: #000 !important">HSC</a></li>
                      </ul>

                       <div class="tab-content">

                           <div id="menu1" class="tab-pane fade">
                               <h3>PSC Result</h3>
                               <h4>IPSC</h4>
                               <br>
                               <a href="internal-exam-result" class="btn btn-info" target="_blank">Read More</a>
                           </div>

                           <div id="menu2" class="tab-pane fade">
                               <h3>JSC Result</h3>
                               <h4>IPSC</h4>
                               <br>
                               <a href="internal-exam-result" class="btn btn-info" target="_blank">Read More</a>
                           </div>

                           <div id="menu3" class="tab-pane fade">
                               <h3>SSC Result</h3>

                               <h4>IPSC</h4>
                               <br>
                               <a href="internal-exam-result" class="btn btn-info" target="_blank">Read More</a>
                           </div>

                           <div id="menu4" class="tab-pane fade">
                               <h3>HSC Result</h3>

                               <h4>IPSC</h4>
                               <br>
                               <a href="internal-exam-result" class="btn btn-info" target="_blank">Read More</a>
                           </div>
                       </div>
                   </div>
                </div>
              </div>
           </div>';

        fwrite($fh, $sData);fclose($fh);
        
        
        return redirect('contents-information');
      }

      /*Home Achievements*/

      if($iCategoryID==5)
      {

         $myFile ='/home/ipscedu/public_html/media/html/'."home-achievements.htm";

         $fh = fopen($myFile, "w");

         $qItems=DB::table('cms_contents_master')->select('coma_eng_title','coma_eng_details','coma_small_img','coma_eng_brief')->where('coma_cat_id',5)->where('coma_is_active','Y')->get();

        foreach($qItems as $qItem)
        {
        for($i=0; $i<=1; $i++)
          {

        $sData = "";

        $sData .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 news-inner-area">
                        <h2 class="title-default-left">Achievements</h2>
                        <ul class="news-wrapper">
                            <li>
                                <div class="news-img-holder">
                                    <a href="achievement"><img src=https://ipsc-edu-bd.s3.us-east-2.amazonaws.com/'.$qItem->coma_small_img.' class="img-responsive" alt="news"></a>
                                </div>
                                <div class="news-content-holder" style="padding-left: 25px;">
                                    <h3><a href="achievement">'.$qItem->coma_eng_brief.'</a></h3>
                                    <div class="post-date">June 15, 2017</div>
                                    <p>'.$qItem->coma_eng_brief.'</p>
                                </div>
                            </li> 
                        </ul>
                        <div class="news-btn-holder">
                            <a href="achievement" class="view-all-accent-btn">View All</a>
                        </div>
                    </div>';
            }
          }
            
        fwrite($fh, $sData);fclose($fh);
        
        
        return redirect('contents-information');
      }

      /*Home News and Events*/

      if($iCategoryID==6)
      {
        $qItems=DB::table('cms_contents_master')->select('coma_eng_title','coma_eng_details','created_at','coma_small_img','coma_eng_brief')->where('coma_cat_id',6)->where('coma_is_active','Y')->take(5)->get();

        $myFile ='/home/ipscedu/public_html/media/html/'."home-news-events.htm";

        $fh = fopen($myFile, "w");

        $i=0;
        foreach($qItems as $qItem)
        {
        for($i=0; $i<=1; $i++)
          {

        $sData = "";

        $sData .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 event-inner-area">
                        <h2 class="title-default-left">News & Events</h2>
                        <ul class="event-wrapper">
                            <li class="wow bounceInUp" data-wow-duration="2s" data-wow-delay=".1s">
                                <div class="event-calender-wrapper">
                                    <div class="event-calender-holder">
                                        <h3>'.date("d").'</h3>
                                        <p>'.date("M").'</p>
                                        <span>'.date("Y").'</span>
                                    </div>
                                </div>
                                <div class="event-content-holder">
                                    <h3><a href="news-events">'.$qItem->coma_eng_title.'</a></h3>
                                    <p>'.$qItem->coma_eng_brief.'</p>
                                </div>
                            </li>
                        </ul>
                        <div class="event-btn-holder">
                            <a href="news-events" class="view-all-primary-btn">View All</a>
                        </div>
                    </div>';
          }
        }
            
        fwrite($fh, $sData);fclose($fh);
        
        
        return redirect('contents-information');
      }

      
    }


}