@extends('layouts.dashboard-home')
@section('title',' Photo Gallery / Album Group')
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

                    {!!Form::open(['url'=>['album-group'],'method'=>'get', 'enctype'=>'multipart/form-data'])!!}
                        <div class="col-xs-3 col-sm-2 col-lg-3">
                            <h3 class="box-title">Photo Album Group List</h3>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-lg-3">
                          {{ Form::select('cmbAlbumCategoryID',$qAlbumCategory,null,['class'=>'form-control','placeholder' => 'All Album Category ']) }}
                        </div>
                        <div class="col-xs-1 col-sm-1 col-lg-1">
                            <div class="row">
                              <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                        <div class="col-sm-5">
                          <a href="{{url('album-group', 'create')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> New Album Group Create</a>
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
                              @if(!empty($qItem->algp_image_path))
                              <img src="{{Storage::disk('s3')->url($qItem->algp_image_path)}}" class="img-responsive" height="100" width="80"/>
                              <!--img src="{{'http://www.ipsc.edu.bd/media/gallery/'.$qItem->algp_image_path}}" class="img-responsive" height="100" width="80"/-->
                              @else
                              <img src="{{asset('media/icon/image-icon.png')}}" class="img-responsive" />
                              <!--img src="{{ 'http://www.ipsc.edu.bd/media/icon/Blank-person.png'}}" class="img-responsive" /-->
                              @endif
                            </td>
                            <td><strong>{{$qItem->algp_name}}</strong></td>
                            <td><strong>{{$qItem->algp_bangla_name}}</strong></td>
                            <td><strong>
                              @if($qItem->algp_is_active=='Y')
                                <span class="text-success"><i class="fa fa-check text-success"></i></span>
                              @else
                                <span class="text-danger"><i class="fa fa fa-times text-danger"></i></span>
                              @endif
                            </strong></td>
                            <td><strong>{{$qItem->updated_at}}</strong></td>
                            <td><strong><a href="{{url('album-group', $qItem->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a></strong></td>
                        </tr>
                    @endforeach
                    @endif

                </table>

                @if(!empty($qItems))
                  {{ $qItems->links() }}
                @endif

            </div>

    </div>

@endsection
