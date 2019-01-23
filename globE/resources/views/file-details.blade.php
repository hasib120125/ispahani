@include('layouts.header')
<div class="container" style="margin-top: 10px;margin-bottom: 10px;">
  <div class="row mp">
        <div class="col-sm-12 box mar-bottom10">
            <div class="col-sm-1"></div>
            
            <div class="col-sm-3" align="center">Result Date : <?php echo date("F j, Y");?></div>
        </div>
        <div class="col-sm-12 mar-bottom10 box"></div>


        <div class="col-sm-12 box" align="center">
            <?php $i=0;?>
            @foreach($qItems as $qItem)
            @for ($i = 0; $i < 1; $i++)

            <iframe src="{{Storage::disk('s3')->url($qItem->coma_file_path)}}" width="100%" height="800"></iframe> 

            @endfor
            @endforeach   
        </div>
  </div>
                        
</div>
@include('layouts.footer')