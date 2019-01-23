@extends('layouts.dashboard-home')
@section('title',' Photo Gallery / Album Image List')
@section('content')

    <div class="col-sm-12">
      <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
                  <h3 class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></h3>
              @endif
          @endforeach
      </div>
    </div>

    <div class="col-sm-12">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row">

                    {!!Form::open(['url'=>['album-image'],'method'=>'get', 'enctype'=>'multipart/form-data'])!!}
                        <div class="col-xs-3 col-sm-2 col-lg-3">
                            <h3 class="box-title">Photo Album Image List</h3>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-lg-3">
                          {{ Form::select('cmbAlbumGroupID',$qAlbumGroup,null,['class'=>'form-control','placeholder' => 'All Album Group ']) }}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-lg-1">
                            <div class="row">
                              <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                        <div class="col-sm-5">
                          <a href="{{url('album-image', 'create')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> New Album Image Upload</a>
                        </div>
                  </div>
                </div>
            </div>
            <div class="box box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>Image</strong></td>
                            <td><strong>Image English Title</strong></td>
                            <td><strong>Image Bangla Title</strong></td>
                            <td><strong>Image URL</strong></td>
                            <td><strong>Last Update</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </thead>
                    @if(!empty($qItems))
                    @foreach($qItems as $qItem)
                        <tr>
                            <td><strong>{{$qItem->id}}</strong></td>
                            <td>
                              @if(!empty($qItem->alim_image_path))
                              <img src="{{Storage::disk('s3')->url($qItem->alim_image_path)}}" class="img-responsive" height="120" width="90"/>
                              <!--img src="{{'http://www.ipsc.edu.bd/media/gallery/'.$qItem->alim_image_path}}" class="img-responsive" height="120" width="90"/-->
                              @else
                              <img src="{{asset('media/icon/image-icon.png')}}" class="img-responsive" height="120" width="90"/>
                              <!--img src="{{ 'http://www.ipsc.edu.bd/media/icon/Blank-person.png'}}" class="img-responsive" height="120" width="90"/-->
                              @endif
                            </td>
                            <td><strong>{{$qItem->alim_english_title}}</strong></td>
                            <td><strong>{{$qItem->alim_bangla_title}}</strong></td>
                            <td>
                              {{'https://ipsc-test.s3.us-east-2.amazonaws.com/'.$qItem->alim_image_path}}
                            </td>
                            <td><strong>{{$qItem->updated_at}}</strong></td>
                            <td>
                              <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$qItem->id}}"><i class="fa fa-trash-o"></i> Delete</button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div id="myModal{{$qItem->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"> Are you sure you want to delete this image?</h4>
                              </div>
                              <div class="modal-body">
                                {!!Form::open(['url'=>['album-image',$qItem->id],'method'=>'DELETE', 'enctype'=>'multipart/form-data'])!!}
                                <button type="submit" class="btn btn-block btn-danger"><i class="fa fa-trash"></i> Delete Now</a>
                                {!! Form::close() !!}
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
