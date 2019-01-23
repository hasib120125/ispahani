@extends('layouts.dashboard-home')
@section('title',' Academic Setting / Program Information')
@section('content')

    <div class="col-sm-6">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <h3 class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></h3>
                @endif
            @endforeach
        </div> <!-- end .flash-message -->

        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Video Gallery</h3>
            </div>
            <!-- form start -->
            {!!Form::open(['url'=>'video-gallery','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
              <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputDesignation">Category</label>
                    {{ Form::select('cmbVideoCategoryID',$qVideoCategory,null,['class'=>'form-control','placeholder' => 'Select Video Category','required']) }}
                    @if ($errors->has('cmbVideoCategoryID'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('cmbVideoCategoryID') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Name</label>
                    {{ Form::text('txtName',old("txtName"),['class'=>'form-control','placeholder'=>'Name','id'=>'txtName', 'required']) }}
                    @if ($errors->has('txtName'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtName') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Bangla Name</label>
                    {{ Form::text('txtBanglaName',old("txtBanglaName"),['class'=>'form-control','placeholder'=>'Name','id'=>'txtBanglaName',]) }}
                    @if ($errors->has('txtBanglaName'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtBanglaName') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Video ID</label>
                    {{ Form::text('txtVideoID',old("txtVideoID"),['class'=>'form-control','placeholder'=>'Youtube Video ID','id'=>'txtVideoID',]) }}
                    @if ($errors->has('txtVideoID'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtVideoID') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Active</label>
                    {{ Form::radio('rdoIsActive', 'Y', true) }} Yes
                    {{ Form::radio('rdoIsActive', 'N') }} No
                </div>

              </div>

              <div class="box-footer" align="right">
                  <button type="reset" class="btn btn-warning">Refresh</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>

    <div class="col-sm-6">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="row">
                      {!!Form::open(['url'=>'video-gallery','method'=>'get', 'enctype'=>'multipart/form-data'])!!}
                          <div class="col-xs-10 col-sm-10 col-lg-10">
                                {{ Form::select('cmbSearch',$qVideoCategory,null,['class'=>'form-control','placeholder' => 'Select Video Category','required']) }}
                                @if ($errors->has('cmbSearch'))
                                    <span class="help-block coral-text">
                                         <strong>{{ $errors->first('cmbSearch') }}</strong>
                                    </span>
                                @endif
                          </div>
                          <div class="col-xs-2 col-sm-2 col-lg-2">
                              <button type="submit" class="btn btn-info">Search</button>
                          </div>
                      {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="box box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>Title</strong></td>
                            <td><strong>Bangla Title</strong></td>
                            <td><strong>Video ID</strong></td>
                            <td><strong>Active</strong></td>
                            <td><strong>Last Update</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </thead>

                    @if(!empty($qItems))
                    @foreach($qItems as $qItem)
                        <tr>
                            <td><strong>{{$qItem->id}}</strong></td>
                            <td><strong>{{$qItem->vigl_name}}</strong></td>
                            <td><strong>{{$qItem->vigl_bangla_name}}</strong></td>
                            <td><strong>
                              @if($qItem->vigl_is_active=='Y')
                                <span class="text-success">YES</span>
                              @else
                                <span class="text-danger">NO</span>
                              @endif
                            </strong></td>
                            <td><strong>{{$qItem->updated_at}}</strong></td>
                            <td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal{{$qItem->id}}"><i class="fa fa-edit"></i> Edit</button></td>
                        </tr>

                        <!-- Modal -->
                        <div id="myModal{{$qItem->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Video Information</h4>
                              </div>
                              <div class="modal-body">
                                {!!Form::open(['url'=>['video-gallery', $qItem->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
                                  <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputDesignation">Category</label>
                                        {{ Form::select('cmbVideoCategoryID',$qVideoCategory,['vigl_video_cat_id'=>$qItem->vigl_video_cat_id],['class'=>'form-control','placeholder' => 'Select Video Category','required']) }}
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputDesignation">Name</label>
                                        {{ Form::text('txtName',$qItem->vigl_name,['class'=>'form-control','placeholder'=>'Name','id'=>'txtName', 'required']) }}
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputDesignation">Bangla Name</label>
                                        {{ Form::text('txtBanglaName',$qItem->vigl_bangla_name,['class'=>'form-control','placeholder'=>'Name','id'=>'txtBanglaName',]) }}

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputDesignation">Video ID</label>
                                        {{ Form::text('txtVideoID',$qItem->vigl_video_id,['class'=>'form-control','placeholder'=>'Youtube Video ID','id'=>'txtVideoID',]) }}

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputDesignation">Active</label>
                                        {{ Form::radio('rdoIsActive', 'Y', $qItem->vigl_is_active=='Y'?'true':'') }} Yes
                                        {{ Form::radio('rdoIsActive', 'N', $qItem->vigl_is_active=='N'?'true':'') }} No
                                    </div>

                                  </div>

                                  <div class="box-footer" align="right">
                                      <button type="submit" class="btn btn-success">Update</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
