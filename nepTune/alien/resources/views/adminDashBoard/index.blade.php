@extends('layouts.dashboard-home')
@section('title',' Dashboard / Home')
@section('content')
<div class="col-sm-12">

  <div class="box box-primary">

      <div class="box-header with-border">
        <div class="row">
          {!!Form::open(['url'=>['contents-information'],'method'=>'get', 'enctype'=>'multipart/form-data'])!!}
              <div class="col-xs-4 col-sm-4 col-lg-4">
                    {{ Form::select('cmbContentsCategory', $qContentsCategory,
                    null, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
              </div>
              <div class="col-xs-2 col-sm-2 col-lg-2">
                  <div class="row">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                  </div>
              </div>
          {!! Form::close() !!}
              <div class="col-sm-6">
                <a href="{{url('contents-information','create')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> New Contents Create</a>
              </div>
        </div>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Image</strong></td>
                    <td><strong>Title English</strong></td>
                    <td><strong>Title Bangla</strong></td>
                    <td><strong>Type</strong></td>
                    <td><strong>Last Update</strong></td>
                    <td><strong>Active</strong></td>
                    <td><strong>Action</strong></td>
                </tr>
            </thead>
            @if(!empty($qContentsMaster))
            @foreach($qContentsMaster as $item)
            <tr>
                <td><strong>{{$item->id}}</strong></td>
                <td>
                  @if(!empty($item->coma_img_path))
                  <img src="{{Storage::disk('s3')->url($item->coma_small_img)}}" class="img-responsive" />
                  <!--img src="{{'http://www.ipsc.edu.bd/smallImages/'.$item->coma_img_path}}" class="img-responsive" /-->
                  @else
                    @if($item->coma_is_download=='Y')
                    <img src="{{ asset('media/icon/Download-icon.jpg')}}" class="img-responsive" />
                    @else
                    <img src="{{ asset('media/icon/image-icon.png')}}" class="img-responsive" />
                    @endif
                  <!--img src="{{ 'http://www.ipsc.edu.bd/media/icon/Download-icon.jpg'}}" class="img-responsive" /-->
                  @endif
                </td>
                <td><strong>{{$item->coma_eng_title}}</strong></td>
                <td><strong>{{$item->coma_bng_title}}</strong></td>
                <td>
                  <strong>{{$item->coma_is_download=='Y'?'Download':'Contents'}}</strong>
                </td>
                <td><strong>{{$item->updated_at}}</strong></td>
                <td>
                  @if($item->coma_is_active=='Y')
                  <i class="fa fa-check text-success"></i>
                  @else
                  <i class="fa fa fa-times text-danger"></i>
                  @endif
                </td>
                <td><strong><a href="{{url('contents-information',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a></strong></td>
            </tr>
            @endforeach
            @endif
        </table>
        <!-- Pagination Number -->
        @if(!empty($qContentsMaster))
          {{ $qContentsMaster->links() }}
        @endif
      </div>

  </div>

</div>
@endsection
