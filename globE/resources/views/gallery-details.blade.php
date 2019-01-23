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
  <link rel="stylesheet" href="css/jBox.css" />
</head>

@include('layouts.header')

<div class="container-fluid" style="background-color:#EFEFEF;">
       
       <div class="container margin-top10">
           <div class="row">
               <div class="col-sm-8">
                  <div class="row top-head">
                      <h1>Photo Gallery</h1>
                  </div>

                  <div class="row" >
                    <?php $i=0;?>
                    @foreach($qItems as $qItem)
                    @for ($i = 0; $i < 1; $i++)
                      <div class="col-sm-4 album-image-box" style="max-height:250px;padding: 0;">
                        <div class="img-thumbnail content-display-box">
                          <img class="jbox-img img-gallery ih-item" style="width:100%; height: 180px !important;" src="{{Storage::disk('s3')->url($qItem->alim_image_path)}}" alt="{{$qItem->alim_english_title}}" title="{{$qItem->alim_english_title}}"/>
                        </div>
                      </div>
                      @endfor
                      @endforeach
                  </div>

                  <div class="jbox-container">
                    <div class="img-alt-text"></div>
                    <img src="" />
                    <svg version="1.1" class="jbox-prev" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 306 306" xml:space="preserve">
                        <g>
                            <g id="chevron-right">
                                <polygon points="211.7,306 247.4,270.3 130.1,153 247.4,35.7 211.7,0 58.7,153" />
                            </g>
                        </g>
                    </svg>
                    <svg version="1.1" class="jbox-next" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 306 306" xml:space="preserve">
                        <g>
                            <g id="chevron-right">
                                <polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153" />
                            </g>
                        </g>
                    </svg>
                    <svg version="1.1" class="jbox-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                        <path d="M512,51.75L460.25,0L256,204.25L51.75,0L0,51.75L204.25,256L0,460.25L51.75,512L256,307.75L460.25,512L512,460.25
              L307.75,256L512,51.75z" />
                    </svg>
                </div>
               </div>
               <div class="col-sm-4 float-right">
                    <div class="col-xs-12 col-sm-12">
                        <div class="row top-head-right">
                            <a href="{{URL::to('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a> / {{$sBreadcrumb}}
                        </div>

                        <div class="row right-video">
                            <i class="fa fa-file-video-o" aria-hidden="true"></i> Suggested Video
                        </div>
                        <div class="row margin-bottom20">
                            <iframe width="360" height="195" src="https://www.youtube.com/embed/M5bX4qWgkwU" frameborder="0" allowfullscreen></iframe>
                        </div>

                         <div class="row related-topics box-shado margin-bottom12p">
                            <a href="{{URL::to('/video-gallery')}}"><img src="{{asset('media/videogallery-ico.png')}}" class="img-responsive"></a>
                        </div>

                    </div>
                </div>
           </div>
       </div>  
    </div>


@include('layouts.footer')

<script src="js/jBox-min.js"></script>
<script>
    var gallery = new jBox();
</script>

</html>