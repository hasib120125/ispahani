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
                <div class="row top-head">
                    <h1>Ispahani Public School & College </h1>
                </div>

                <?php $i=0;?>
                    @foreach($qItems as $qItem)
                        @for ($i = 0; $i < 1; $i++)
                <div class="row acnews">
                    
                    <article>
                        <div class="col-xs-3 col-sm-3 padding-left0"><img src="{{Storage::disk('s3')->url($qItem->coma_small_img)}}" class="img-responsive margin-bottom2P" alt="" title="{{$sTitles}}"></div>
                        <div class="col-xs-9 col-sm-9 padding-left0">
                            <h3><?php echo $qItem->coma_eng_brief ?></h3>
                             <a href="{{URL::to('details',$qItem->id)}}">Read more...</a>
                        </div>
                    </article>
                      
                </div>
                        @endfor
                    @endforeach

                <div class="row">
                    {{ $qItems->links() }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-xs-12 col-sm-12">
                    <div class="row top-head-right">
                        <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a> / <a href="#">About / News & Events</a>
                    </div>

                    <div class="row right-video">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i> Suggested Video
                    </div>
                    <div class="row margin-bottom20">
                        <iframe width="360" height="195" src="https://www.youtube.com/embed/" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="row related-topics box-shado">
                        <i class="fa fa-windows" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="row margin-bottom20">
                        @include("aside/about-us-aside")
                    </div>
                </div>
            </div>
    </div>
</div>


@include('layouts.footer')