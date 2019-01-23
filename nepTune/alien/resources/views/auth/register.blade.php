@extends('layouts.dashboard-home')
@section('title',' Account Setting / Create User')
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
                <h3 class="box-title">Create New User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!!Form::open(['url'=>'user-registration','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="exampleInputName">User Name</label>
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user"> </i></div>
                          {{ Form::text('name',old("name"),['class'=>'form-control','placeholder'=>'User Name','id'=>'name','required','autofocus'])}}
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block coral-text">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputDesignation">Designation</label>
                        {{ Form::text('text_designation',old("text_designation"),['class'=>'form-control','placeholder'=>'Designation','id'=>'text_designation'])}}
                        @if ($errors->has('text_designation'))
                            <span class="help-block coral-text">
                                 <strong>{{ $errors->first('text_designation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputMobile">Mobile No</label>
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"> <strong>+88</strong></i></div>
                            {{ Form::number('text_mobile',old("text_mobile"),['class'=>'form-control','id'=>'text_mobile'])}}
                        </div>
                        @if ($errors->has('text_mobile'))
                            <span class="help-block coral-text">
                                 <strong>{{ $errors->first('text_mobile') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="exampleInputEmail1">Email address</label>
                        {{ Form::email('email',old("email"),['class'=>'form-control','placeholder'=>'Email','id'=>'email','required'])}}
                        @if ($errors->has('email'))
                            <span class="help-block coral-text">
                                 <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Password</label>
                        {{ Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Password','required'])}}
                        @if ($errors->has('password'))
                            <span class="help-block coral-text">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        {{ Form::password('password_confirmation',['class'=>'form-control','id'=>'password-confirm','placeholder'=>'Password Confirmation','required'])}}

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                 <strong class="coral-text">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{ Form::hidden('cmb_institute_id',$value=0)}}

                    <div class="form-group">
                        <label for="exampleInputFile"> Active</label><br />
                        Yes {{ Form::radio('rdo_is_active', 'Y', true) }}
                        No {{ Form::radio('rdo_is_active', 'N') }}
                    </div>
                </div>
                <!-- /.box-body -->

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
                <h3 class="box-title">User List</h3>
            </div>
        </div>
            <div class="box box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Mobile</td>
                            <td>Active</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    @foreach($rDuplUserInformation as $rDuplUserInfo)
                        <tr>
                          <td>{{ $rDuplUserInfo->id }}</td>
                          <td>{{ $rDuplUserInfo->name }}</td>
                          <td>{{ $rDuplUserInfo->email }}</td>
                          <td>{{ '+88 '.$rDuplUserInfo->mobile }}</td>
                          <td>{{ $rDuplUserInfo->is_active=='Y' ? 'Yes' : 'No' }}</td>
                          <td>
                            <a data-toggle="modal" data-target="#myModal{{ $rDuplUserInfo->id }}"><i class="fa fa-pencil-square-o btn btn-success" aria-hidden="true"></i></button>
                            <a data-toggle="modal" data-target="#deleteModal{{ $rDuplUserInfo->id }}"><i class="fa fa-trash-o btn btn-danger" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                        <!-- User Information Edit Modal -->
                        <div id="myModal{{ $rDuplUserInfo->id }}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Dupl User Information</h4>
                              </div>
                              <div class="modal-body">

                                  {!!Form::open(['url'=>['user-registration',$rDuplUserInfo->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
                                  <div class="box-body">
                                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                          <label for="exampleInputName">User Name</label>
                                          <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"> </i></div>
                                            {{ Form::text('name',$rDuplUserInfo->name,['class'=>'form-control','placeholder'=>'User Name','id'=>'name','required','autofocus'])}}
                                          </div>
                                          @if ($errors->has('name'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Designation</label>
                                          {{ Form::text('text_designation',$rDuplUserInfo->designation,['class'=>'form-control','placeholder'=>'Designation','id'=>'text_designation'])}}
                                          @if ($errors->has('text_designation'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('text_designation') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputMobile">Mobile No</label>
                                          <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"> <strong>+88</strong></i></div>
                                              {{ Form::number('text_mobile',$rDuplUserInfo->mobile,['class'=>'form-control','id'=>'text_mobile'])}}
                                          </div>
                                          @if ($errors->has('text_mobile'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('text_mobile') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputFile"> Active</label><br />
                                          Yes {{ Form::radio('rdo_is_active', 'Y', $rDuplUserInfo->is_active=='Y' ? 'true' : '') }}
                                          No {{ Form::radio('rdo_is_active', 'N', $rDuplUserInfo->is_active=='N' ? 'true' : '') }}
                                      </div>
                                  </div>

                              </div>

                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                              {!! Form::close() !!}
                            </div>
                          </div>
                          <!-- Model Close -->

                        </div>
                        <!-- End Model -->

                        <!-- User Information Delete Model -->
                        <div id="deleteModal{{ $rDuplUserInfo->id }}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-question-circle text-info" aria-hidden="true"> Are you sure you want to delete this user.</i> </h4>
                              </div>
                              <div class="modal-body">
                                {!!Form::open(['url'=>['user-registration',$rDuplUserInfo->id],'method'=>'DELETE', 'enctype'=>'multipart/form-data'])!!}
                                  <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-ban" aria-hidden="true"></i> Yes i want to delete this user.</button>
                                {!! Form::close() !!}
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                          <!-- Model Close -->

                        </div>
                        <!-- End Model -->

                   @endforeach
                </table>
            </div>

    </div>


@endsection
