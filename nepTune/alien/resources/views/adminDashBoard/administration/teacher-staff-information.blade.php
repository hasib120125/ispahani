@extends('layouts.dashboard-home')
@section('title',' Teacher and Staff Information / Teacher and Staff Create')
@section('content')

    <div class="col-sm-12 flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <h3 class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></h3>
            @endif
        @endforeach
    </div>

    <div class="col-sm-12">
      <div class="box box-primary">
          <div class="box-body with-border table-responsive">
            {!!Form::open(['url'=>'teacher-staff','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
            <table class="table">
              <tr>
                <td>
                  {{ Form::select('cmbEmployeeCategory',[
                  'teacher' => 'Teacher',
                  'staff' => 'Staff',
                  'mlss' => 'MLSS',
                  ],
                  null, ['class'=>'form-control','placeholder' => 'Select Employee Category...', 'required']) }}
                </td>

                <td>
                  {{ Form::select('cmbEmployeeType',[
                  'Permanent' => 'Permanent',
                  'Temporary' => 'Temporary',
                  'Contract Basis' => 'Contract Basis',
                  ],
                  null, ['class'=>'form-control','placeholder' => 'Select Employee Type...']) }}
                </td>
                <td>
                  <a href="{{url('teacher-staff')}}" class="btn btn-md btn-info"><i class="fa fa-th-list" aria-hidden="true"></i> Show All Teacher & Staff</a>
                </td>
              </tr>
            </table>
          </div>
      </div>
    </div>


    <div class="col-sm-6">

      <div class="box box-primary">

        <div class="box-body">

            <div class="form-group has-success">
              {{ Form::text('txtSeniorityID',old("txtSeniorityID"),['class'=>'form-control','placeholder'=>'Seniority ID','id'=>'txtSeniorityID']) }}
            </div>

            <div class="form-group has-success">
                {{ Form::text('txtEnglishName',old("txtEnglishName"),['class'=>'form-control','placeholder'=>'Name in English','id'=>'txtEnglishName', 'required']) }}
                @if ($errors->has('txtEnglishName'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtEnglishName') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtBanglaName',old("txtBanglaName"),['class'=>'form-control','placeholder'=>'Name in Bangla','id'=>'txtBanglaName']) }}
                @if ($errors->has('txtBanglaName'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtBanglaName') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtFatherName',old("txtFatherName"),['class'=>'form-control','placeholder'=>"Father's Name",'id'=>'txtFatherName']) }}
                @if ($errors->has('txtFatherName'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtFatherName') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtMotherName',old("txtMotherName"),['class'=>'form-control','placeholder'=>"Mothers's Name",'id'=>'txtMotherName']) }}
                @if ($errors->has('txtMotherName'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtMotherName') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtSpouseName',old("txtSpouseName"),['class'=>'form-control','placeholder'=>"Spouse Name",'id'=>'txtSpouseName']) }}
                @if ($errors->has('txtSpouseName'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtSpouseName') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtPresentAddress',old("txtPresentAddress"),['class'=>'form-control','placeholder'=>'Present Address','id'=>'txtPresentAddress']) }}
                @if ($errors->has('txtPresentAddress'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtPresentAddress') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtPermanentAddress',old("txtPresentAddress"),['class'=>'form-control','placeholder'=>'Permanent Address','id'=>'txtPermanentAddress']) }}
                @if ($errors->has('txtPermanentAddress'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtPermanentAddress') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::select('cmbReligionID',$qReligion,null,['class'=>'form-control','placeholder' => 'Religion ']) }}
            </div>

            <div class="form-group">
                {{ Form::select('cmbDesignationID',$qDesignation,null,['class'=>'form-control','placeholder' => 'Designation ']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtEmployeeID',old("txtEmployeeID"),['class'=>'form-control','placeholder'=>'Employee ID','id'=>'txtEmployeeID']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtUniversityName',old("txtUniversityName"),['class'=>'form-control','placeholder'=>'University Name','id'=>'txtUniversityName']) }}
            </div>

            <div class="form-group">

              <div class="row">
                <div class="col-sm-4">
                  <fieldset style="border: solid 1px #DDD !important;border-bottom: none;padding-left:10px;">
                    <legend style="width: auto !important;border: none;font-size: 15px;margin-bottom: 5px;"> Gender </legend>
                    {{ Form::radio('rdoGender', 'M', true) }} Male
                    {{ Form::radio('rdoGender', 'F') }} Female
                  </fieldset>
                </div>

                <div class="col-sm-4">
                  <fieldset style="border: solid 1px #DDD !important;border-bottom: none;padding-left:10px;">
                    <legend style="width: auto !important;border: none;font-size: 15px;margin-bottom: 5px;"> Married Status </legend>
                    {{ Form::radio('rdoMarriedStatus', 'Y') }} Married
                    {{ Form::radio('rdoMarriedStatus', 'N', true) }} Single
                  </fieldset>
                </div>

                <div class="col-sm-4">
                  <fieldset style="border: solid 1px #DDD !important;border-bottom: none;padding-left:10px;">
                    <legend style="width: auto !important;border: none;font-size: 15px;margin-bottom: 5px;"> Active </legend>
                    {{ Form::radio('rdoIsActive', 'Y', true) }} Yes
                    {{ Form::radio('rdoIsActive', 'N') }} No
                  </fieldset>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">{{Form::checkbox('chkRatio', 'Y', true)}} <span class="text-danger">Auto resize by aspect ratio</span></div>
                  <div class="col-sm-2">Image Width</div>
                  <div class="col-sm-2">{{ Form::text('txtBigW',300,['class'=>'form-control','required']) }}</div>
                  <div class="col-sm-2">Image Height</div>
                  <div class="col-sm-2">{{ Form::text('txtBigH',250,['class'=>'form-control','required']) }}</div>
                </div>
              </div>

            </div>


          </div>

      </div>

    </div>

    <div class="col-sm-6">
      <div class="box box-primary">

        <div class="box-body">

          <div class="form-group">

            <div class="form-group">
              {{ Form::select('cmbDepartmentID',$qDepartment,null,['class'=>'form-control','placeholder' => 'Staff Department ']) }}
            </div>

            <div class="form-group">
              {{ Form::select('cmbSubjectID',$qSubject,null,['class'=>'form-control','placeholder' => 'Teacher Department ']) }}
            </div>

            <div class="form-group">
              {{ Form::select('cmbShiftID',$qShift,null,['class'=>'form-control','placeholder' => 'Teacher Shift ']) }}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"> </i></span>
              {{ Form::text('txtJoiningDate',old("txtJoiningDate"),['class'=>'form-control','placeholder'=>'01-01-2000','id'=>'txtJoiningDate'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-mobile"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtMobileNo',old("txtMobileNo"),['class'=>'form-control','placeholder'=>'Mobile Number','id'=>'txtMobileNo','pattern'=>'[0-9]{11}','maxlength'=>'11'])}}
                @if ($errors->has('txtMobileNo'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtMobileNo') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-mobile"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtEmergencyMobile',old("txtEmergencyMobile"),['class'=>'form-control','placeholder'=>'Emergency Mobile Number','id'=>'txtEmergencyMobile','pattern'=>'[0-9]{11}','maxlength'=>'11'])}}
                @if ($errors->has('txtEmergencyMobile'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtEmergencyMobile') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"> </i> </span>
              {{ Form::text('txtEmail',old("txtEmail"),['class'=>'form-control','placeholder'=>'Email','id'=>'txtEmail','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-facebook text-primary"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtFbID',old("txtFbID"),['class'=>'form-control','placeholder'=>'Facebook ID','id'=>'txtFbID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-twitter text-info"> </i>&nbsp; </span>
              {{ Form::text('txtTwitterID',old("txtTwitterID"),['class'=>'form-control','placeholder'=>'Twiter ID','id'=>'txtTwiterID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-skype text-info"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtSkypeID',old("txtSkypeID"),['class'=>'form-control','placeholder'=>'Skype ID','id'=>'txtSkypeID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-google-plus text-danger"> </i> </span>
              {{ Form::text('txtGoogleID',old("txtGoogleID"),['class'=>'form-control','placeholder'=>'Google ID','id'=>'txtGoogleID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-linkedin text-info"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtLinkedinID',old("txtLinkedinID"),['class'=>'form-control','placeholder'=>'Linkedin ID','id'=>'txtLinkedinID'])}}
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('cmbBloodGroup',$qBloodGroup,null,['class'=>'form-control','placeholder' => 'Blood Group ']) }}
                </div>

                <div class="col-sm-6">
                  {{ Form::file('fileImage',['id'=>'fileImage','accept'=>'.jpg,.jpeg,.png'])}}

                  @if ($errors->has('fileImage'))
                      <span class="help-block">
                           <strong class="text-danger">{{ $errors->first('fileImage') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::submit('Submit', ['class'=>'pull-right btn btn-primary btn-md']) }}
            </div>

          </div>

      </div>

    </div>
    {!! Form::close() !!}

@endsection
