<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title>{{$sTitles}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="Ispahani Public School and College">
  <meta name="keywords" content="School, College, University, Education, Result, Class Room, Exam, Notice, Routine, Principal, Chairman, Teacher , Staff">
  <meta name="Desh Universal Private Limited" content="#">
  <meta http-equiv="refresh" content="600">
  <meta name="robots" content="all">
  <meta name="googlebot" content="all">
  <meta name="googlebot-news" content="all">
  <meta name="rating" content="safe for kids">
  <link rel="canonical" href="#">
  <link type="image/x-icon" rel="shortcut icon" href="#">
  <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
</head>

@include('layouts.header')

<div class="container-fluid body-bg">
    <div class="container margin-top10">
        <div class="row">
            <div class="col-sm-8" style="margin-bottom: 10px;">
                <div class="row top-head" style="margin-left: 0px;">
                    <h1>{{$sTitles}}</h1>
                </div>

                <div class="row">
                    <div class="col-sm-12 body-message">
                        <img src="{{Storage::disk('s3')->url($qItems->mess_img_path)}}" class="img-responsive margin-bottom2P margin-right10" alt="" title="" align="left">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" style="font-size: 16px;text-align: justify;">
                        <?php echo $qItems->mess_eng_details; ?>
                    </div>
                </div>

            </div>

            <div class="col-sm-4">
                <div class="col-xs-12 col-sm-12">
                    <div class="row top-head-right">
                        <a href="{{URL::to('/')}}"><i class="fa fa-home" aria-hidden="true"></i>/ {{$sBreadcrumb}}
                    </div>

                    <div class="row right-video">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i> Suggested Video
                    </div>
                    <div class="row margin-bottom20">
                        <iframe width="360" height="195" src="
                        {{$vItems.$qItems->mess_video_id}}" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="row related-topics box-shado">
                        <i class="fa fa-windows" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="row margin-bottom20">
                        @include($sAside)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@include('layouts.footer')