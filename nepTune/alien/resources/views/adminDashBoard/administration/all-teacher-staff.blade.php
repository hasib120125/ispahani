@extends('layouts.dashboard-home')
@section('title',' Administration / All Teacher and Staff List')
@section('content')
<div class="col-sm-12">

  <div class="box box-primary">

      <div class="box-header with-border">
        <div class="row">
          {!!Form::open(['url'=>['teacher-staff'],'method'=>'get', 'enctype'=>'multipart/form-data'])!!}
              <div class="col-xs-3 col-sm-3 col-lg-3">
                {{ Form::select('cmbSearch',[
                '' => 'All',
                'teacher' => 'Teacher',
                'staff' => 'Staff',
                'mlss' => 'MLSS',
                ],
                null, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
              </div>
              <div class="col-xs-3 col-sm-3 col-lg-3">
                {{ Form::select('cmbBloodGroup',$qBloodGroup,null,['class'=>'form-control','placeholder' => 'Blood Group ']) }}
              </div>
              <div class="col-xs-2 col-sm-2 col-lg-2">
                  <div class="row">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                  </div>
              </div>
          {!! Form::close() !!}
              <div class="col-sm-4">
                <a href="{{url('teacher-staff', 'create')}}" class="btn btn-md btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Create New Teacher & Staff Info</a>
              </div>
        </div>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Image</strong></td>
                    <td><strong>Personal Information</strong></td>
                    <td><strong>Official Information</strong></td>
                    <td><strong>Type</strong></td>
                    <td><strong>Active</strong></td>
                    <td><strong>Action</strong></td>
                </tr>
            </thead>
            @if(!empty($qItems))
            @foreach($qItems as $item)
            <tr>
                <td><strong>{{$item->id}}</strong></td>
                <td>
                  @if(!empty($item->thsf_image_path))
                  <img src="{{Storage::disk('s3')->url($item->thsf_image_path)}}" class="img-responsive" height="150" width="120"/>
                  <!--img src="{{'http://www.ipsc.edu.bd/media/teacherStaff/'.$item->thsf_image_path}}" class="img-responsive" height="150" width="120"/-->
                  @else
                  <img src="{{ asset('media/icon/Blank-person.png')}}" class="img-responsive" />
                  <!--img src="{{ 'http://www.ipsc.edu.bd/media/icon/Blank-person.png'}}" class="img-responsive" /-->
                  @endif
                </td>
                <td>
                  <strong>Name -</strong> {{$item->thsf_eng_name}} <br />
                  <strong>Mobile -</strong> {{$item->thsf_mobile_no}} <br />
                  <strong>Emergency Mobile -</strong> {{$item->thsf_emergency_mobile}} <br />
                  <strong>Email -</strong> {{$item->thsf_email_id}} <br />
                  <strong>Blood Group -</strong> (<b class="text-info">{{$item->bdgp_name}}</b> )
                </td>
                <td>
                  <strong>Seniority -</strong> <b class="text-danger">{{$item->thsf_seniority_id}}</b> <br />
                  <strong>Join Date -</strong> {{$item->thsf_joining_date}} <br />
                  <strong>Designation -</strong> {{$item->desi_name}} <br />
                  <strong>Employee Department -</strong> {{$item->sfdp_name}} <br />
                  <strong>Techer Department -</strong> {{$item->subj_name}}
                </td>
                <td>
                  @if($item->thsf_cat_id=='T')
                  <span class="text-success">Teacher</span>
                  @else
                  <span class="text-primary">Staff</span>
                  @endif
                </td>
                <td>
                  @if($item->thsf_is_active=='Y')
                  <i class="fa fa-check text-success"></i>
                  @else
                  <i class="fa fa fa-times text-danger"></i>
                  @endif
                </td>
                <td><strong><a href="{{url('teacher-staff',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"> Edit</i></a></strong></td>
            </tr>
            @endforeach
            @endif

        </table>
        <!-- Pagination Number -->
        @if(!empty($qItems))
          {{ $qItems->links() }}
        @endif
      </div>

  </div>

</div>
@endsection
