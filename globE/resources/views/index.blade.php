<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="{{asset('media/favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('media/favicon.ico')}}" type="image/x-icon">
  <title>Ispahani Public School and College</title>
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
  <link type="image/x-icon" rel="shortcut icon" href="#">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/animate.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-dropdownhover.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/full-slider.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/full-slider.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/fonts/SolaimanLipi_Bold_100312.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/dupl-style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/jBox.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/youtube-video-gallery.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/youtube-video-gallery.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <style type="text/css">

    .nav-tabs>li{
      float: none !important;
      display: inline-block;
    }

    .nav-tabs{
          display: inline-flex;
    }

    body{font-family:'SolaimanLipi_Bold_100312','PT Sans', sans-serif;}

  </style>

  </head>

  <body>

    <header>
      @include("layouts.header")
    </header>

    <div class="container-fluid ipsc-notice" style="padding-left:0px !important">
        <div class="row">
          <div class="col-sm-12">
            <?php include_once("media/html/latest-notice.htm"); ?>
          </div>
        </div>
    </div>
      
    <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <div class="carousel-inner">
            @include("layouts.home-slide")
        </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>


    <div class="container-fluid padding-left0 padding-right0">
      <div class="col-sm-6 slide-bottom-left" align="center" style="position: static !important;color:#fff;">
        <?php include_once("media/html/home-why-study.htm"); ?>
      </div>

      <div class="col-sm-6 slide-bottom-right" style="position: static !important;float: right;color: #000;background: #003B6E;">
        <?php include_once("media/html/home-dedication.htm"); ?>
      </div>
    </div>


    <div class="container-fluid" style="padding-top: 32px;padding-bottom: 40px;">

      <div class="container">
        <div class="row">
          <div class="col-sm-6 home-about-us">
            <?php include_once("media/html/home-about-us.htm"); ?>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 event-inner-area">
               <?php include_once("media/html/notice.htm"); ?>
          </div>
        </div>
      </div>

    </div>

    <div class="container-fluid msg-bg">
        <div class="container" align="center">
            <div class="row">
                <div class="col-sm-4"></div>
                 <?php include_once("media/html/chief-patron-message.htm"); ?>
                <div class="col-sm-4"></div>
            </div>

            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-1"></div>
                  <?php include_once("media/html/chairman-message.htm"); ?>
                  <?php include_once("media/html/principal-message.htm"); ?>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </div>


    <section class="home-life border-diag-bottom">
      <div class="container-fluid">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <div class="home-life-side-img" style="background-image: url({{asset('media/home_right.jpg')}})"></div>
            </div>

            <div class="col-sm-4 home-glance">

              <?php include_once("media/html/home-at-a-glance.htm");?>

            </div>

            <div class="col-sm-4">
              <div class="home-life-side-img" style="background-image: url({{asset('media/home_left.jpg')}})"></div>
            </div>
          </div>
        </div>
      </div>
    </section>



      <section class="result-bg">
        <div class="container-fluid home-results" style="padding-top: 28px;padding-bottom: 10px;">
           <?php include_once("media/html/home-results.htm");?>
        </div>
      </section>


      <section>
        <div class="container-fluid home-news-events">
          <!-- News and Event Area Start Here -->
        <div class="news-event-area">
            <div class="container">
                <div class="row">
                    
                  <?php include_once("media/html/home-achievements.htm");?>

                  <?php include_once("media/html/home-news-events.htm");?>

                </div>
            </div>
        </div>
        <!-- News and Event Area End Here -->
      </div>
    </section>

    <section>
          <div class="container-fluid contact-bg">

              <div class="row">
                <div class="col-sm-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.5479476790024!2d91.11728921465436!3d23.47676518472499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37547bf45642b5af%3A0x9760ec0d98f2bcdc!2z4KaH4Ka44KeN4Kaq4Ka-4Ka54Ka-4Kao4KeAIOCmquCmvuCmrOCmsuCmv-CmlSDgprjgp43gppXgp4HgprIg4KaP4Kao4KeN4KahIOCmleCmsuCnh-CmnA!5e0!3m2!1sbn!2sbd!4v1522665596358" width="900" height="312" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-4">
                    <div class="well">
                        <h3><i class="fa fa-home fa-1x"></i> Address:</h3>               
                        <p style="font-size: 16px;padding-left: 30px;">Ispahai Public School and College <br> Comilla Cantonment 3501, Comilla</p>
                        <br />
                        <h3><i class="fa fa-phone" aria-hidden="true"></i> Phone :</h3>
                        <p style="font-size: 16px;padding-left: 30px;">081-80114</p>
                        <br />
                        
                        <h3><i class="fa fa-fax" aria-hidden="true"></i> Fax : </h3>
                        <p style="font-size: 16px;padding-left: 30px;">081-80115</p>
                        <br />
                        
                        <h3><i class="fa fa-envelope fa-1x"></i> E-Mail:</h3>
                        <p style="font-size: 16px;padding-left: 30px;">ipsccml@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("layouts.footer")

    <script src="{{asset('js/myjs.js')}}"></script>
    <script>
        $('#myCarousel').carousel({
            interval:   4000
        });
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/plugins/ScrollToPlugin.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/plugins/EaselPlugin.min.js"></script>
  <script src="{{asset('js/animate-scroll.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/animate-scroll.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap-dropdownhover.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/css3-animate-it.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jBox-min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/jquery.youtubevideogallery.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/myjs.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/npm.js')}}"></script>


  <script>
    $(document).foundation();
    $(document).animateScroll();

    var doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);
  </script>
  <!-- Bootstrap Dropdown Hover JS -->

  </body>
</html>
