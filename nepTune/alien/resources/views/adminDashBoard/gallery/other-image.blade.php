@extends('layouts.dashboard-home')
@section('title',' Photo Gallery / Other Image Upload')
@section('content')
  <div class="col-sm-offset-3 col-sm-6">
    <div class="flash-message text-center">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <h3 class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></h3>
            @endif
        @endforeach
    </div>
  </div>

  <div class="col-sm-offset-3 col-sm-6">

    <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-7">
                <h3 class="box-title"> Other Image Upload</h3>
              </div>
              <div class="col-sm-5">
                <a href="{{url('others-image')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-th-list" aria-hidden="true"></i> Other Image List</a>
              </div>
            </div>

            {!!Form::open(['url'=>'others-image','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">

                  <div class="form-group">
                      <div class="col-sm-4">
                        <label for="exampleInputDesignation">Is Slide Image</label>
                        {{ Form::radio('rdoIsSlideImage', 'Y') }} Yes
                        {{ Form::radio('rdoIsSlideImage', 'N', true) }} No
                      </div>

                      <div class="col-sm-4">
                        <label for="exampleInputDesignation">Show in Slide </label>
                        {{ Form::radio('rdoShowSlide', 'Y') }} Yes
                        {{ Form::radio('rdoShowSlide', 'N', true) }} No
                      </div>
                      <div class="col-sm-4">
                        <label for="exampleInputDesignation">Generate Html </label>
                        {{ Form::radio('rdoGenerateHTML', 'Y') }} Yes
                        {{ Form::radio('rdoGenerateHTML', 'N', true) }} No
                      </div>
                  </div>
                  <br /><br />
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4">
                        {{ Form::file('fileImage',['id'=>'fileImage','accept'=>'.jpg,.jpeg,.png'])}}

                        @if ($errors->has('fileImage'))
                            <span class="help-block">
                                 <strong class="text-danger">{{ $errors->first('fileGroupImage') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="col-sm-2">{{Form::checkbox('chkRatio', 'Y', true)}} Aspect Ratio</div>
                      <div class="col-sm-1">Width</div>
                      <div class="col-sm-2">{{ Form::text('txtBigW',600,['class'=>'form-control','required']) }}</div>
                      <div class="col-sm-1">Height</div>
                      <div class="col-sm-2">{{ Form::text('txtBigH',360,['class'=>'form-control','required']) }}</div>
                    </div>
                  </div>


              </div>

              <div class="box-footer" align="right">
                  <button type="reset" class="btn btn-warning">Refresh</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            {!! Form::close() !!}
        </div>

  </div>

@endsection
