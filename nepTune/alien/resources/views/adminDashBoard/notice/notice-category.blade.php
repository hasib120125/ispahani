@extends('layouts.dashboard-home')
@section('title',' Institute Notice / Notice Category')
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
                <h3 class="box-title">Notice Category</h3>
            </div>

            {!!Form::open(['url'=>'notice-category','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
                <div class="box-body">

                  <div class="form-group">
                      <label for="exampleInputDesignation">Notice Category Name</label>
                      {{ Form::text('txtCatName',old("txtCatName"),['class'=>'form-control','placeholder'=>'Name','id'=>'txtCatName', 'required']) }}
                      @if ($errors->has('txtName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtName') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="exampleInputDesignation">Notice Category Name (Bangla)</label>
                      {{ Form::text('txtCatBanglaName',old("txtCatBanglaName"),['class'=>'form-control','placeholder'=>'Bangla Name','id'=>'txtBanglaName',]) }}
                      @if ($errors->has('txtBanglaName'))
                          <span class="help-block coral-text">
                               <strong>{{ $errors->first('txtBanglaName') }}</strong>
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

    </div>

    <div class="col-sm-6">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Notice Category List</h3>
                </div>
            </div>
            <div class="box box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td><strong>ID</strong></td>
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
                            <td><strong>{{$qItem->noca_name}}</strong></td>
                            <td><strong>{{$qItem->noca_bangla_name}}</strong></td>
                            <td><strong>
                              @if($qItem->noca_is_active=='Y')
                                <span class="text-success">YES</span>
                              @else
                                <span class="text-danger">NO</span>
                              @endif
                            </strong></td>
                            <td><strong>{{$qItem->updated_at}}</strong></td>
                            <td><strong><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal{{$qItem->id}}"><i class="fa fa-edit"></i> Edit</button></strong></td>
                        </tr>

                        <div id="myModal{{$qItem->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Academic Information</h4>
                              </div>
                              <div class="modal-body">

                                {!!Form::open(['url'=>['notice-category', $qItem->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
                                    <div class="box-body">

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Contents Category Name</label>
                                          {{ Form::text('txtCatName',$qItem->noca_name,['class'=>'form-control','placeholder'=>'Name','id'=>'txtCatName', 'required']) }}
                                          @if ($errors->has('txtName'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('txtName') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Contents Category Name (Bangla)</label>
                                          {{ Form::text('txtCatBanglaName',$qItem->noca_bangla_name,['class'=>'form-control','placeholder'=>'Bangla Name','id'=>'txtBanglaName']) }}
                                          @if ($errors->has('txtBanglaName'))
                                              <span class="help-block coral-text">
                                                   <strong>{{ $errors->first('txtBanglaName') }}</strong>
                                              </span>
                                          @endif
                                      </div>

                                      <div class="form-group">
                                          <label for="exampleInputDesignation">Active</label>
                                          {{ Form::radio('rdoIsActive', 'Y', $qItem->noca_is_active=='Y'?'true':'') }} Yes
                                          {{ Form::radio('rdoIsActive', 'N', $qItem->noca_is_active=='N'?'true':'') }} No
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
            </div>

    </div>

@endsection
