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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.1/css/bootcards-desktop.min.css">

  <style type="text/css">

    .btn{ padding: 6px !important;
          border-radius: 0px !important;
          width: 100px !important;
        }

    .form-control{
      height: 40px !important;
    }
  </style>
  
</head>

@include('layouts.header')

<div class="container-fluid body-bg">
    <div class="container margin-top10">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="row" style="margin: 0;padding-bottom: 12px;">
                    <div class="col-sm-12 box nhead">

                      <div class="col-sm-5">
                        <h2>{{$sTitles}}</h2>
                      </div>

                        {!! Form::open(['url' => '/notice','method' => 'get','name' => 'notice','enctype'=>'multipart/form-data']) !!}

                        <div class="col-xs-4 col-sm-4 form-group">

                          {!! Form::select('cmdNoticeCategory',$qNoticeCategory,null,['class'=>'form-control','placeholder' => 'All Notice']) !!}
                          
                        </div>

                        <div class="col-xs-3 col-sm-3">
                          {!! Form::submit('Search',['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

                <?php $i=0;?>
                @foreach($qItems as $qItem)
                @for ($i = 0; $i < 1; $i++)

                <div class="row">
                  <div class="col-md-offset-3 col-md-12">
                    <div class="panel panel-default bootcards-file">
                      <div class="list-group">
                        <div class="list-group-item">
                          <a href="{{URL::to('/notice-details',$qItem->id)}}" target="_blank">
                            <i class="icon-file-pdf" style="font-size: 90px;"></i>
                          </a>
                          <h3 class="list-group-item-heading">
                            <a href="{{URL::to('/notice-details',$qItem->id)}}" target="_blank">
                              {{$qItem->noti_eng_title}}
                            </a>
                            </h3>
                          <p class="list-group-item-text"><strong>Date: <?php echo date('F Y');?></strong></p>
                          <p class="list-group-item-text">Total Views: 120</p>
                          <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=small&mobile_iframe=false&width=88&height=20&appId" width="88" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                      </div>
                      <div class="panel-footer">
                        <div class="btn-group btn-group-justified">
                          <div class="btn-group">
                            <button class="btn btn-default"><a href="{{URL::to('/notice-details',$qItem->id)}}" target="_blank"><i class="fa fa-star"></i>
                              View</a>
                            </button>
                          </div>
                          <div class="btn-group">
                            <button class="btn btn-default"><a href="{{Storage::disk('s3')->url($qItem->noti_file_path)}}" target="_blank"><i class="fa fa-arrow-down"></i>
                              Download</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @endfor
                @endforeach

                <div class="row">
                  {{$qItems->links()}}
                </div>

                <div class="row" style="margin-top: 5px; color: #736AFF;font-weight: bold;margin: 0;">
                    <div class="col-sm-12 box">
                    Total Views : 2369 views
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="col-xs-12 col-sm-12">
                    <div class="row top-head-right box-shado">
                        <a href="{{URL::to('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a> / {{$sBreadcrumb}}
                    </div>

                    <div class="row right-video box-shado">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i> Suggested Video
                    </div>
                    <div class="row margin-bottom20">
                        <iframe width="360" height="195" src="https://www.youtube.com/embed/M5bX4qWgkwU" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="row related-topics box-shado">
                        <i class="fa fa-windows" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="row margin-bottom20 rTopics">
                        @include($sAside)
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.1/js/bootcards.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

@include('layouts.footer')

</html>