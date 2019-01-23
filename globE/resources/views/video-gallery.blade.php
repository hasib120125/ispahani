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

<div class="container-fluid" style="background-color:#EFEFEF;">
        <div class="container">
            <div class="row margin-bottom20" >
                <div class="col-sm-12 top-head margin-bottom20 margin-top5" style="padding: 2% !important">
                    <h1>Video Gallery of Ispahani Public School & College</h1>
                </div>

                <div class="col-sm-12" style="padding: 0">
                    <div class="row video-body">
                        <?php $i=0;?>
                          @foreach($qItems as $qItem)
                            @for ($i = 0; $i < 1; $i++)
                        <div class="col-sm-3">

                            <a href="{{URL::to('/video-details',['id'=>$qItem->id,'sVideoID'=>$qItem->vigl_video_id])}}">
                                
                            <img src='{{$vItems.$qItem->vigl_video_id.$vExt}}' class="img-responsive" alt="2018 Photo Album Category" title="{{$sTitles}}" width="260">
                                <span><strong class="margin-top10">{{$qItem->vigl_name}}</strong>
                                </span>
                             </a>
                        </div>
                            @endfor
                          @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')

</html>