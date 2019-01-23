<div class="container-fluid">
    <div class="row footer-row-one div-hid">
        <div class="container">
            <div class="col-sm-4 padding-top5p quick_link">
                <h3 style="border-bottom: 1px solid #ddd;color: #fff;">Quick Link</h3>
                <ul class="list-unstyled margin-bottom11">
                    <li><a href="http://www.educationboard.gov.bd/" target="_blank"><i class="fa fa-anchor" aria-hidden="true"></i> Education Board</a></li>
                    <li><a href="http://www.educationboard.gov.bd/" target="_blank"><i class="fa fa-anchor" aria-hidden="true"></i> Dhaka Education Board</a></li>
                    <li><a href="http://www.moedu.gov.bd/" target="_blank"><i class="fa fa-anchor" aria-hidden="true"></i> Ministry of Education</a></li>
                    <li><a href="http://www.ipsc.edu.bd" target="_blank"><i class="fa fa-anchor" aria-hidden="true"></i> Ispahani Public School & College</a></li>
                    <li><a href="http://www.dshe.gov.bd/" target="_blank"><i class="fa fa-anchor" aria-hidden="true"></i> Directorate of Secondary & Higher Education</a></li>
                </ul>
            </div>

            <div class="col-sm-4 footer-center" align="center" style="">
                <img src="{{asset('media/logo.png')}}" class="img-responsive">
                <span style="font-size: 29px;font-weight: bold;">Ispahani<br> Public School & College</span>
            </div>

            <div class="col-sm-4 padding-top5p home-gallery">
                <h3 style="border-bottom: 1px solid #ddd">Latest Photo Album</h3>
                <ul>
                    <li>
                        <a href="{{URL::to('/photo-gallery')}}">
                            <img src="{{asset('media/school-image2.jpg')}}" height="60" width="80">
                        </a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="{{URL::to('/photo-gallery')}}">
                            <img src="{{asset('media/school-image2.jpg')}}" height="60" width="80">
                        </a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="{{URL::to('/photo-gallery')}}">
                            <img src="{{asset('media/school-image2.jpg')}}" height="60" width="80">
                        </a>
                    </li>
                </ul>

                <div style="display: inline-block;padding-top: 10px;padding-bottom: 10px;">
                     <h3 style="border-bottom: 1px solid #ddd"><i class="fa fa-line-chart" aria-hidden="true"></i> Visitor Statistics</h3>
                    @include('layouts.counter')
                </div>

            </div>

        </div>
    </div>

    <div class="row footer-bottom-left hidden">
        <div class="col-xs-12 col-sm-6">
        </div>
    </div>

    <div class="row footer-bottom"><div class="container" align="center" style="color: #fff">&copy; <?php echo date("Y");?> - Ispahani Public School & College All Rights Reserved. Developed by <a href="http://deshuniversal.com/" target="blank" style="color:#fdbe0c;">Desh Universal (Pvt.) Limited.</a> <a href="https://www.facebook.com/deshuniversal/" target="_blank" ><span style="color:#f7ac23;">Like us on Facebook</span></a></div></div>
</div>
