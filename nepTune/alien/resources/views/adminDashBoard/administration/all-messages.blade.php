@extends('layouts.dashboard-home')
@section('title',' Administration / All Messages')
@section('content')
<div class="col-sm-12">

  <div class="box box-primary">

      <div class="box-header with-border">
        <div class="row">
          {!!Form::open(['url'=>['messages'],'method'=>'get', 'enctype'=>'multipart/form-data'])!!}
              <div class="col-xs-4 col-sm-4 col-lg-4">
                    {{ Form::select('txtMessageCategory',[
                    '' => 'All',
                    'Chairman' => 'Chairman',
                    'Principal' => 'Principal',
                    'VicePrincipal' => 'Vice Principal',
                    ],
                    null, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
              </div>
              <div class="col-xs-2 col-sm-2 col-lg-2">
                  <div class="row">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                  </div>
              </div>
          {!! Form::close() !!}
              <div class="col-sm-6">
                <a href="{{url('messages', 'create')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> New Message Create</a>
              </div>
        </div>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Image</strong></td>
                    <td><strong>Messages English Title</strong></td>
                    <td><strong>Messages Bangla Title</strong></td>
                    <td><strong>Messages Type</strong></td>
                    <td><strong>Last Update</strong></td>
                    <td><strong>Active</strong></td>
                    <td><strong>Action</strong></td>
                </tr>
            </thead>
            @if(!empty('qMessages'))
            @foreach($qMessages as $item)
            <tr>
                <td><strong>{{$item->id}}</strong></td>
                <td>
                  @if(!empty($item->mess_img_path))
                  <img src="{{Storage::disk('s3')->url($item->mess_small_img)}}" class="img-responsive" />
                  @else
                  <img src="{{asset('media/icon/Blank-person.png')}}" class="img-responsive" />
                  @endif
                </td>
                <td><strong>{{$item->mess_eng_title}}</strong></td>
                <td><strong>{{$item->mess_bng_title}}</strong></td>
                <td><strong>{{$item->mess_cat_id}}</strong></td>
                <td><strong>{{$item->updated_at}}</strong></td>
                <td>
                  @if($item->mess_is_active=='Y')
                  <i class="fa fa-check text-success"></i>
                  @else
                  <i class="fa fa fa-times text-danger"></i>
                  @endif
                </td>
                <td><strong><a href="{{url('messages',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a></strong></td>
            </tr>
            @endforeach
            @endif

        </table>
        <!-- Pagination Number -->
        @if(!empty($qMessages))
          {{ $qMessages->links() }}
        @endif
      </div>

  </div>

</div>
@endsection
