@include('layouts.header')

<div class="container" style="margin-top: 10px;margin-bottom: 10px;">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-xs-12 col-sm-12 box mar-top10 mar-bottom10 padding10">
                <iframe width="1090" height="500" src='https://www.youtube.com/embed/{{$sVideoID}}' frameborder="0" allowfullscreen=""></iframe>
            </div>
            
            <!-- <div class="col-xs-12 col-sm-12 box mar-top10 mar-bottom10 padding10">
                <h2 class="head-h1" style="padding-left:30px; padding-bottom:10px;">More Videos of Ispahani Public School & College</h2>
                
                <div class="col-sm-12" style="padding-bottom:10px;">
                    
                    <div class="col-sm-2 mar">
                        
                        <a href="#">
                            <img src=''> Ispahani Public School & College                        
                        </a>
                        
                    </div>
                    
                </div>
            </div> -->  
        </div>
    </div>
</div>

@include('layouts.footer')