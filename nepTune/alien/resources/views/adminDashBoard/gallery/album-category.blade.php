@extends('layouts.dashboard-home')
@section('title',' Photo Gallery / Album Category')
@section('content')

    <div class="col-sm-6">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <h3 class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></h3>
                @endif
            @endforeach
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Photo Album Category</h3>
            </div>

            {!!Form::open(['url'=>'album-category','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Category Name</label>
                      {{ Form::text('txtAlbumCategoryName',null,['class'=>'form-control','placeholder'=>'Album Category Name','id'=>'txtAlbumCategoryName', 'required']) }}
                      @if ($errors->has('txtAlbumCategoryName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtAlbumCategoryName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Album Category Name (Bangla)</label>
                      {{ Form::text('txtAlbumCategoryBanglaName',null,['class'=>'form-control','placeholder'=>'Album Category Bangla Name','id'=>'txtAlbumCategoryBanglaName',]) }}
                      @if ($errors->has('txtAlbumCategoryBanglaName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtAlbumCategoryBanglaName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Active </label>
                      {{ Form::radio('rdoIsActive', 'Y', true) }} Yes
                      {{ Form::radio('rdoIsActive', 'N') }} No
                  </div>

                  <div class="form-group">
                    {{ Form::file('fileCategoryImage',['id'=>'fileCategoryImage','accept'=>'.jpg,.jpeg,.png'])}}

                    @if ($errors->has('fileCategoryImage'))
                        <span class="help-block">
                             <strong class="text-danger">{{ $errors->first('fileCategoryImage') }}</strong>
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

    <div class="col-sm-6">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-sm-7">
                      <h3 class="box-title">Photo Album Category List</h3>
                    </div>
                </div>
            </div>
            <div class="box box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>Image</strong></td>
                            <td><strong>Category Name</strong></td>
                            <td><strong>Category Name Bangla</strong></td>
                            <td><strong>Active</strong></td>
                            <td><strong>Last Update</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </thead>
                    @if(!empty($qItems))
                    @foreach($qItems as $qItem)
                        <tr>
                            <td><strong>{{$qItem->id}}</strong></td>
                            <td>
                              @if(!empty($qItem->alct_image_path))
                              <img src="{{Storage::disk('s3')->url($qItem->alct_image_path)}}" class="img-responsive"/>
                              @else
                              <img src="{{ asset('media/icon/image-icon.png')}}" class="img-responsive" />
                              @endif
                            </td>
                            <td><strong>{{$qItem->alct_name}}</strong></td>
                            <td><strong>{{$qItem->alct_bangla_name}}</strong></td>
                            <td><strong>
                              @if($qItem->alct_is_active=='Y')
                                <span class="text-success"><i class="fa fa-check text-success"></i></span>
                              @else
                                <span class="text-danger"><i class="fa fa fa-times text-danger"></i></span>
                              @endif
                            </strong></td>
                            <td><strong>{{$qItem->updated_at}}</strong></td>
                            <td><strong><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal{{$qItem->id}}"><i class="fa fa-edit"></i> Edit</button></strong></td>
                        </tr>


                        <!-- Modal -->
                        <div id="myModal{{$qItem->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Photo Album Category Information</h4>
                              </div>
                              <div class="modal-body">

                                {!!Form::open(['url'=>['album-category', $qItem->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
                                    <div class="box-body">

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Contents Category Name</label>
                                          {{ Form::text('txtAlbumCategoryName',$qItem->alct_name,['class'=>'form-control','placeholder'=>'Name','id'=>'txtAlbumCategoryName', 'required']) }}
                                          @if ($errors->has('txtAlbumCategoryName'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('txtAlbumCategoryName') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Contents Category Name (Bangla)</label>
                                          {{ Form::text('txtAlbumCategoryBanglaName',$qItem->alct_bangla_name,['class'=>'form-control','placeholder'=>'Bangla Name','id'=>'txtAlbumCategoryBanglaName']) }}
                                          @if ($errors->has('txtAlbumCategoryBanglaName'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('txtAlbumCategoryBanglaName') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Active</label>
                                          {{ Form::radio('rdoIsActive', 'Y', $qItem->alct_is_active=='Y'?'true':'') }} Yes
                                          {{ Form::radio('rdoIsActive', 'N', $qItem->alct_is_active=='N'?'true':'') }} No
                                      </div>

                                      <div class="form-group">
                                        {{ Form::file('fileCategoryImage',['id'=>'fileCategoryImage','accept'=>'.jpg,.jpeg,.png'])}}
                                        {{ Form::hidden('oldImageName', $qItem->alct_image_path) }}

                                        @if ($errors->has('fileCategoryImage'))
                                            <span class="help-block">
                                                 <strong class="text-danger">{{ $errors->first('fileCategoryImage') }}</strong>
                                            </span>
                                        @endif

                                        {{ Form::checkbox('deleteImage',$qItem->alct_image_path)}} <strong class="text-danger">If you want to delete old image check this.</strong>
                                      </div>

                                  </div>

                                  <div class="box-footer" align="right">
                                      <button type="reset" class="btn btn-warning">Refresh</button>
                                      <button type="submit" class="btn btn-success">Update</button>
                                  </div>
                                {!! Form::close() !!}

                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                    @endif

                </table>

                @if(!empty($qItems))
                  {{ $qItems->links() }}
                @endif

            </div>

    </div>

@endsection
