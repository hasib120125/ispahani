<?php $i=0;?>
  @foreach($qItems5 as $qItem)
    @for ($i = 0; $i < 1; $i++)
<div class="row notice-border">
  <div class="col-xs-3 col-sm-3">
      <div class="col-sm-12 date-month" align="center"><?php echo date('M');?></div>
      <div class="col-sm-12 date-day" align="center"><?php echo date('Y')?></div>
  </div>
  <div class="col-xs-9 col-sm-9">
     <div class="row">
     <span class="notice-title">{{$qItem->noti_eng_title}} </span><br>
	 <span class="notice-department">Department :</span>XI Class
  </div>
	 <div class="row padding-top5p">
	 <a href="{{Storage::disk('s3')->url($qItem->noti_file_path)}}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:20px"></i></a>
	 <a href="{{Storage::disk('s3')->url($qItem->noti_file_path)}}"><i class="fa fa-download" aria-hidden="true" style="font-size:20px"></i></a>
	 </div>
  </div>
</div>
@endfor
@endforeach

<div class="row">
  <div class="col-xs-4 col-sm-4">
  </div>
  <div class="col-xs-8 col-sm-8 padding-left0" style="margin-top: 31px;text-align: right; padding-bottom: 68px;">
    <a href="{{URL::to('/notice')}}"><button type="button" class="btn btn-primary" style="padding:5px;width: 114px;">View All</button>
    </a>
  </div>
</div>