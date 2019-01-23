@foreach($qItems4 as $qItem)
<div class="row margin-top5P">
    <div class="col-xs-4 col-sm-4 padding-left0 padding-right0" style="padding-right: 25px;">
      <img src="{{Storage::disk('s3')->url($qItem->coma_small_img)}}" class='img-responsive img-thumbnail img-height'     width: 116px;>
    </div>
    <div class="col-xs-8 col-sm-8 padding-left0">
      <div class="row events-date">{{$qItem->created_at}}</div>
      <div class="row"><h2 class="events-title"><?php echo $qItem->coma_eng_brief ?></h2></div>
      <div class="row events-brif">
         <a class='a-coral' href="{{URL::to('/news-events')}}"> Read more...</a>
      </div>
  </div>
</div>
@endforeach

<div class="row">
  <div class="col-xs-4 col-sm-4">
  </div>
  <div class="col-xs-8 col-sm-8 padding-left0" style="text-align: right;padding-bottom: 2px;">
    <a href="{{URL::to('/news-events')}}"><button type="button" class="btn btn-primary" style="padding:5px;width: 114px;">View All</button>
  </div>
</div>
