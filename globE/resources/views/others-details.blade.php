<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
  <title>Ispahani</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="School and College from Bangladesh.">
  <meta name="keywords" content="School, College, University, Education, Result, Class Room, Exam, Notice, Routine, Principal, Chairman, Teacher , Staff">
  <meta name="author" content="#">
  <meta http-equiv="refresh" content="600">
  <meta name="robots" content="all">
  <meta name="googlebot" content="all">
  <meta name="googlebot-news" content="all">
  <meta name="rating" content="safe for kids">
  <link rel="canonical" href="#">
  

@include('layouts.header')

<div class="container-fluid body-bg">
    <div class="container margin-top10">
        <div class="row">
            <div class="col-sm-8">
                <div class="row top-head">
                    <h1>{{$iItem->coma_eng_title}}</h1>
                </div>

                <div class="row body-container">
                    <img src="{{Storage::disk('s3')->url($iItem->coma_img_path)}}" class="img-responsive margin-bottom2P" alt="IPSC  At a Glance" title="IPSC  At a Glance">
                    

                    <?php echo "$iItem->coma_eng_details";?>

                  

                </div>

                <div class="row">
                    <div class="col-sm-12" style="padding: 0;margin: 0">
                    Total Visitor : 1400
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="col-xs-12 col-sm-12">
                    <div class="row top-head-right">
                        <a href="{{URL::to('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a> / <a href="#">  At-a-Glance</a>
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
                        @include("aside.about-us-aside")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
