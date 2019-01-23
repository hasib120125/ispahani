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
            <div class="col-sm-8">
                <div class="row top-head">
                    <h1>{{$sTitles}}</h1>
                </div>


                <div class="row">
                    <?php $i=0;?>
                    @foreach($qItems as $qItem)
                        @for ($i = 0; $i < 1; $i++)
                    <div class="col-sm-4" style="margin: 0;padding: 0;">

                        <a href="{{URL::to('/gallery-details',$qItem->id)}}">
                            
                        <img src="{{Storage::disk('s3')->url($qItem->algp_image_path)}}" class="img-responsive img-thumbnail" alt="2018 Photo Album Category" title="{{$sTitles}}" width="260">
                            <span><strong class="margin-top10">{{$qItem->algp_name}}</strong>
                            </span>
                         </a>
                    </div>
                        @endfor
                    @endforeach
                </div>

                <div class="row">
                    {{ $qItems->links() }}
                </div>

            </div>

            <aside>
                <div class="col-sm-4 float-right">
                    <div class="col-xs-12 col-sm-12">
                        <div class="row top-head-right">
                            <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a> / {{$sBreadcrumb}}
                        </div>

                        <div class="row right-video">
                            <i class="fa fa-file-video-o" aria-hidden="true"></i> Suggested Video
                        </div>
                        <div class="row margin-bottom20">
                            <iframe width="360" height="195" src="https://www.youtube.com/embed/M5bX4qWgkwU" frameborder="0" allowfullscreen></iframe>
                        </div>

                        <div class="row related-topics box-shado">
                            <a href="{{URL::to('video-gallery')}}"><img src="{{asset('images/videogallery-ico.png')}}" class="img-responsive"></a>
                        </div>

                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>


@include('layouts.footer')

</html>