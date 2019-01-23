@foreach($qItems3 as $qItem)
<div class="row margin-top5P" >
  <div class="col-xs-4 col-sm-4" style="padding-right: 25px;padding-left: 0px">
    <img src="{{Storage::disk('s3')->url($qItem->coma_small_img)}}" class='img-responsive img-thumbnail img-height'>
  </div>
  <div class="col-xs-8 col-sm-8 padding-left0">
    <div class="row achivement-date"></div>
    <div class="row"><h2 class="achivement-title"><?php echo $qItem->coma_eng_brief ?></h2></div>
    <div class="row achivement-brif">
       <a href="{{URL::to('/achievement')}}"> Read more...</a>
    </div>
  </div>
</div>
@endforeach

<div class="row" style="padding-top: 13px;">
  <div class="col-xs-4 col-sm-4">
  </div>
  <div class="col-xs-8 col-sm-8 padding-left0" style="text-align: right;padding-bottom: 2px;">
    <a href="{{URL::to('/achievement')}}"><button type="button" class="btn btn-primary" style="padding:5px;width: 114px;">View All</button>
    </a>
  </div>
</div>
