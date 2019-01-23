<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
  <title>{{$sTitles}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="School and College from Bangladesh.">
  <meta name="keywords" content="School, College, University, Education, Result, Class Room, Exam, Notice, Routine, Principal, Chairman, Teacher , Staff">
  <meta name="Desh Universal Private Limited" content="#">
  <meta http-equiv="refresh" content="600">
  <meta name="robots" content="all">
  <meta name="googlebot" content="all">
  <meta name="googlebot-news" content="all">
  <meta name="rating" content="safe for kids">
  <link rel="canonical" href="#">
  
</head>

@include('layouts.header')

<div class="container-fluid body-bg">
    <div class="container margin-top10">
    <div class="row">
        <div class="col-sm-8">
            <div class="row top-head box-shado">
                <h1>{{$sTitles}}</h1>
            </div>

            <?php $i=0;?>
            @foreach($qItems as $qItem)
                @for ($i = 0; $i < 1; $i++)
            <div class="row box-shado down-bg">
                <div class="col-xs-2 col-sm-2 down-pdf" align="center"><a href="{{URL::to('/file-details',['id' => $qItem->id])}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div>
                <div class="col-xs-8 col-sm-9">
                    <h2>{{$qItem->coma_eng_title}}</h2>
                    <span>Date : {{$qItem->created_at}}</span><br>
                    <span>Total Views : 651 views</span>
                </div>
                <div class="col-xs-2 col-sm-1 padding-top10p">
                    <div class="col-sm-12"><a href="{{Storage::disk('s3')->url($qItem->coma_file_path)}}" target="_blank"><i class="fa fa-cloud-download" aria-hidden="true"></i></a></div>
                </div>
            </div>
                @endfor
            @endforeach

            <div class="row">
              {{$qItems->links()}}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="col-xs-12 col-sm-12">
                <div class="row top-head-right box-shado">
                    <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a> / {{$sBreadcrumb}}
                </div>

                <div class="row right-video box-shado">
                    <i class="fa fa-file-video-o" aria-hidden="true"></i> College Video
                </div>
                <div class="row margin-bottom20">
                    <iframe width="360" height="195" src="{{$vItems.$qItem->coma_video_id}}" frameborder="0" allowfullscreen></iframe>
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

</html>