@extends('layouts.dashboard-home')
@section('title',' Photo Gallery / Album Group Edit')
@section('content')

  <div class="col-sm-offset-3 col-sm-6">

    <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-sm-7">
                  <h3 class="box-title">Photo Album Group Edit</h3>
                </div>
                <div class="col-sm-5">
                  <a href="{{url('album-group')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-th-list" aria-hidden="true"></i> Album Group List</a>
                </div>
            </div>

            {!!Form::open(['url'=>['album-group', $qItem->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Category Name</label>
                      {{ Form::select('cmbAlbumCategoryID',$qAlbumCategory,['id'=>$qItem->algp_album_cat_id],['class'=>'form-control','placeholder' => 'Album Category ', 'required']) }}
                      @if ($errors->has('cmbAlbumCategoryID'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('cmbAlbumCategoryID') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Group Name</label>
                      {{ Form::text('txtAlbumGroupName',$qItem->algp_name,['class'=>'form-control','placeholder'=>'Album Group Name','id'=>'txtAlbumGroupName', 'required']) }}
                      @if ($errors->has('txtAlbumGroupName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtAlbumGroupName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Group Name (Bangla)</label>
                      {{ Form::text('txtAlbumGroupBanglaName',$qItem->algp_bangla_name,['class'=>'form-control','placeholder'=>'Album Group Bangla Name','id'=>'txtAlbumGroupBanglaName',]) }}
                      @if ($errors->has('txtAlbumGroupBanglaName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtAlbumGroupBanglaName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Active </label>
                      {{ Form::radio('rdoIsActive', 'Y', $qItem->algp_is_active=='Y'?'true':'') }} Yes
                      {{ Form::radio('rdoIsActive', 'N', $qItem->algp_is_active=='N'?'true':'') }} No
                  </div>

                  <div class="form-group">
                      <label class="text-info">Generate HTML </label>
                      {{ Form::radio('rdoGenerateHTML', 'Y') }} Yes
                      {{ Form::radio('rdoGenerateHTML', 'N', true) }} No
                  </div>

                  <div class="form-group">
                    {{ Form::file('fileGroupImage',['id'=>'fileGroupImage','accept'=>'.jpg,.jpeg,.png'])}}
                    {{ Form::hidden('oldImageName', $qItem->algp_image_path) }}

                    @if ($errors->has('fileGroupImage'))
                        <span class="help-block">
                             <strong class="text-danger">{{ $errors->first('fileGroupImage') }}</strong>
                        </span>
                    @endif

                    {{ Form::checkbox('deleteImage',$qItem->algp_image_path)}} <strong class="text-danger">If you want to delete old image check this.</strong>
                  </div>

              </div>

              <div class="box-footer" align="right">
                  <button type="reset" class="btn btn-warning">Refresh</button>
                  <button type="submit" class="btn btn-success">Update</button>
              </div>
            {!! Form::close() !!}
        </div>

  </div>

@endsection
