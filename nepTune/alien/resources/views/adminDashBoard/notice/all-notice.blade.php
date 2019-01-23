@extends('layouts.dashboard-home')
@section('title',' Institute Notice / All Notice')
@section('content')
<div class="col-sm-12">

  <div class="box box-primary">

      <div class="box-header with-border">
        <div class="row">
          {!!Form::open(['url'=>['notice-information'],'method'=>'get', 'enctype'=>'multipart/form-data'])!!}
              <div class="col-xs-4 col-sm-4 col-lg-4">
                  {{ Form::select('cmbNoticeCatID',$qNoticeCategory,null,['class'=>'form-control','placeholder' => 'Notice Category','required']) }}
              </div>
              <div class="col-xs-2 col-sm-2 col-lg-2">
                  <div class="row">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                  </div>
              </div>
          {!! Form::close() !!}
              <div class="col-sm-6">
                <a href="{{url('notice-information', 'create')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Create New Notice</a>
              </div>
        </div>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Notice English Title</strong></td>
                    <td><strong>Notice Bangla Title</strong></td>
                    <td><strong>Show Scroll</strong></td>
                    <td><strong>Out of Notice</strong></td>
                    <td><strong>Last Update</strong></td>
                    <td><strong>Active</strong></td>
                    <td><strong>Action</strong></td>
                </tr>
            </thead>
            @if(!empty('$qAllNotice'))
            @foreach($qAllNotice as $item)
            <tr>
                <td><strong>{{$item->id}}</strong></td>
                <td><strong>{{$item->noti_eng_title}}</strong></td>
                <td><strong>{{$item->noti_bng_title}}</strong></td>
                <td><strong>{{$item->noti_show_scroll=='Y'?'Yes':'No'}}</strong></td>
                <td><strong>{{$item->noti_out_of_notice=='Y'?'Yes':'No'}}</strong></td>
                <td><strong>{{$item->updated_at}}</strong></td>
                <td>
                  @if($item->noti_is_active=='Y')
                  <i class="fa fa-check text-success"></i>
                  @else
                  <i class="fa fa fa-times text-danger"></i>
                  @endif
                </td>
                <td><strong><a href="{{url('notice-information',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a></strong></td>
            </tr>
            @endforeach
            @endif

        </table>
        <!-- Pagination Number -->
        @if(!empty($qAllNotice))
          {{ $qAllNotice->links() }}
        @endif
      </div>

  </div>

</div>
@endsection
