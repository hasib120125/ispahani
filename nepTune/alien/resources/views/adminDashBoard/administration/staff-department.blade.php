@extends('layouts.dashboard-home')
@section('title',' Teacher and Staff Information / Teacher and Staff Department')
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
                <h3 class="box-title">Teacher and Staff Department</h3>
            </div>

            {!!Form::open(['url'=>'staff-department','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">

                  <div class="form-group">
                      <label for="exampleInputDesignation">Department Name</label>
                      {{ Form::text('txtDepartmentName',null,['class'=>'form-control','placeholder'=>'Name','id'=>'txtDepartmentName', 'required']) }}
                      @if ($errors->has('txtDepartmentName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtDepartmentName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Department Name (Bangla)</label>
                      {{ Form::text('txtDepartmentBanglaName',null,['class'=>'form-control','placeholder'=>'Bangla Name','id'=>'txtDepartmentBanglaName',]) }}
                      @if ($errors->has('txtDepartmentBanglaName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtDepartmentBanglaName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation" class="text-danger">Is Teacher </label>
                      {{ Form::select('cmbIsTeacher',[
                      'teacher' => 'Teacher',
                      'staff' => 'Staff',
                      'mlss' => 'MLSS',
                      ],
                      null, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
                  </div>
                  @if ($errors->has('rdoIsTeacher'))
                      <span class="help-block coral-text">
                           <strong class="text-warning">{{ $errors->first('rdoIsTeacher') }}</strong>
                      </span>
                  @endif

                  <div class="form-group">
                      <label for="exampleInputDesignation">Active </label>
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

    </div>

    <div class="col-sm-6">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-sm-3">
                      <h3 class="box-title">Department List</h3>
                    </div>
                    {!!Form::open(['url'=>'staff-department','method'=>'get', 'enctype'=>'multipart/form-data'])!!}
                    <div class="col-sm-7">
                      {{ Form::select('cmbIsTeacher',[
                      '' => 'All',
                      'teacher' => 'Teacher',
                      'staff' => 'Staff',
                      'mlss' => 'MLSS',
                      ],
                      null, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
                    </div>
                    <div class="col-sm-2">
                      <div class="row">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                      </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>Department Name</strong></td>
                            <td><strong>Department Name Bangla</strong></td>
                            <td><strong>Is Teacher</strong></td>
                            <td><strong>Active</strong></td>
                            <td><strong>Last Update</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </thead>
                    @if(!empty($qItems))
                    @foreach($qItems as $qItem)
                        <tr>
                            <td><strong>{{$qItem->id}}</strong></td>
                            <td><strong>{{$qItem->sfdp_name}}</strong></td>
                            <td><strong>{{$qItem->sfdp_bangla_name}}</strong></td>
                            <td><strong>
                              @if($qItem->sfdp_is_teacher=='Y')
                                <span class="text-success">Teacher</span>
                              @elseif($qItem->sfdp_is_teacher=='N')
                                <span class="text-muted">Staff</span>
                              @elseif($qItem->sfdp_is_teacher=='S')
                                <span class="text-info">MLSS</span>
                              @endif
                            </strong></td>
                            <td><strong>
                              @if($qItem->sfdp_is_active=='Y')
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
                                <h4 class="modal-title">Edit Staff Department Information</h4>
                              </div>
                              <div class="modal-body">

                                {!!Form::open(['url'=>['staff-department', $qItem->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
                                    <div class="box-body">

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Contents Category Name</label>
                                          {{ Form::text('txtDepartmentName',$qItem->sfdp_name,['class'=>'form-control','placeholder'=>'Name','id'=>'txtDepartmentName', 'required']) }}
                                          @if ($errors->has('txtDepartmentName'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('txtDepartmentName') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Contents Category Name (Bangla)</label>
                                          {{ Form::text('txtDepartmentBanglaName',$qItem->sfdp_bangla_name,['class'=>'form-control','placeholder'=>'Bangla Name','id'=>'txtDepartmentBanglaName']) }}
                                          @if ($errors->has('txtDepartmentBanglaName'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('txtDepartmentBanglaName') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation" class="text-danger">Is Teacher </label>
                                          {{ Form::select('cmbIsTeacher',[
                                          'teacher' => 'Teacher',
                                          'staff' => 'Staff',
                                          'mlss' => 'MLSS',
                                          ],
                                          $qItem->sfdp_is_teacher, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Active</label>
                                          {{ Form::radio('rdoIsActive', 'Y', $qItem->sfdp_is_active=='Y'?'true':'') }} Yes
                                          {{ Form::radio('rdoIsActive', 'N', $qItem->sfdp_is_active=='N'?'true':'') }} No
                                      </div>

                                  </div>

                                  <div class="box-footer" align="right">
                                      <button type="reset" class="btn btn-warning">Refresh</button>
                                      <button type="submit" class="btn btn-primary">Update</button>
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
