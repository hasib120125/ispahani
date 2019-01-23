@extends('layouts.dashboard-home')
@section('title',' Photo Gallery / Album Image Upload')
@section('content')

  <div class="col-sm-offset-3 col-sm-6">

    <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-7">
                <h3 class="box-title"> Album Image Upload</h3>
              </div>
              <div class="col-sm-5">
                <a href="{{url('album-image')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-th-list" aria-hidden="true"></i> Album Image List</a>
              </div>
            </div>

            {!!Form::open(['url'=>'album-image','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Category Name</label>
                      {{ Form::select('cmbAlbumCategoryID',$qAlbumCategory,null,['class'=>'form-control','placeholder' => 'Album Category ']) }}
                      @if ($errors->has('cmbAlbumCategoryID'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('cmbAlbumCategoryID') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Group Name</label>
                      {{ Form::select('cmbAlbumGroupID',[''=>'--- Select Album Group ---'],null,['class'=>'form-control','required']) }}
                      @if ($errors->has('cmbAlbumGroupID'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('cmbAlbumGroupID') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Image English Title</label>
                      {{ Form::text('txtAlbumImageEnglishTitle',null,['class'=>'form-control','placeholder'=>'Image English Title','id'=>'txtAlbumImageEnglishTitle',]) }}
                      @if ($errors->has('txtAlbumImageEnglishTitle'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtAlbumImageEnglishTitle') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Image Bangla Title</label>
                      {{ Form::text('txtAlbumImageBanglaTitle',null,['class'=>'form-control','placeholder'=>'Image Bangla Title','id'=>'txtAlbumImageBanglaTitle',]) }}
                      @if ($errors->has('txtAlbumImageBanglaTitle'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtAlbumImageBanglaTitle') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="exampleInputDesignation">Active </label>
                        {{ Form::radio('rdoIsActive', 'Y', true) }} Yes
                        {{ Form::radio('rdoIsActive', 'N') }} No
                      </div>
                      <div class="col-sm-2">{{Form::checkbox('chkRatio', 'Y', true)}} Aspect Ratio</div>
                      <div class="col-sm-1">Width</div>
                      <div class="col-sm-2">{{ Form::text('txtBigW',600,['class'=>'form-control','required']) }}</div>
                      <div class="col-sm-1">Height</div>
                      <div class="col-sm-2">{{ Form::text('txtBigH',360,['class'=>'form-control','required']) }}</div>
                    </div>
                  </div>

                  <div class="form-group">
                    {{ Form::file('fileImage',['id'=>'fileImage','accept'=>'.jpg,.jpeg,.png'])}}

                    @if ($errors->has('fileImage'))
                        <span class="help-block">
                             <strong class="text-danger">{{ $errors->first('fileGroupImage') }}</strong>
                        </span>
                    @endif
                  </div>

              </div>

              <div class="box-footer" align="right">
                  <button type="reset" class="btn btn-warning">Refresh</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            {!! Form::close() !!}
        </div>

  </div>
<!-- Cascading dropdown -->
  <script type="text/javascript">
    $("select[name='cmbAlbumCategoryID']").change(function(){
        var cmbAlbumCategoryID = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('select-image-group') ?>",
            method: 'POST',
            data: {cmbAlbumCategoryID:cmbAlbumCategoryID, _token:token},
            success: function(data) {
              $("select[name='cmbAlbumGroupID'").html('');
              $("select[name='cmbAlbumGroupID'").html(data.options);
            }
        });
    });
  </script>

@endsection
