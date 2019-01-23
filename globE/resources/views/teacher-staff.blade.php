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
  <meta name="author" content="#">
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
                    <h1> {{$sTitles}}</h1>
                </div>

                <div class="row">
                    <section id="team">
                        <div class="col-sm-12 teacher">
                            <?php $i=0;?>
                            @foreach($qItems as $qItem)
                            @for ($i = 0; $i < 1; $i++)
                            <div class="col-sm-4 teacher">
                                <div class="card">
                                  <img src="{{Storage::disk('s3')->url($qItem->thsf_image_path)}}" alt="" />
                                  <div class="data">
                                    <h4>Name: {{$qItem->thsf_eng_name}}</h4>
                                    <p>Comming Soon..</p>
                                    <a href="#" class="fa fa-facebook"></a>
                                    <a href="#" class="fa fa-twitter"></a>
                                    <a href="#" class="fa fa-behance"></a>
                                    <button type="button" class="btn btn-primary">View More</button>
                                  </div>
                                </div>
                            </div>
                            @endfor
                            @endforeach
                        </div>
                    </section>
                </div>

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
                        <iframe width="360" height="195" src="https://www.youtube.com/embed/M5bX4qWgkwU" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="row right-video box-shado">
                        <i class="fa fa-windows" aria-hidden="true""></i> Department
                    </div>
                    <div class="row box-shado margin-bottom20">
                        @include($sDepartment)
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