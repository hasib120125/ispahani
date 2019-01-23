@extends('layouts.dashboard-home')
@section('title',' Teacher and Staff Information / Teacher and Staff Edit')
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
            {!!Form::open(['url'=>['teacher-staff',$qItems->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
            <table class="table">
              <tr>
                <td>
                  {{ Form::select('cmbEmployeeCategory',[
                  'teacher' => 'Teacher',
                  'staff' => 'Staff',
                  'mlss' => 'MLSS',
                  ],
                  $qItems->thsf_cat_id, ['class'=>'form-control','placeholder' => 'Select Employee Category...', 'required']) }}
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
              {{ Form::text('txtSeniorityID',$qItems->thsf_seniority_id,['class'=>'form-control','placeholder'=>'Seniority ID','id'=>'txtSeniorityID']) }}
            </div>

            <div class="form-group has-success">
                {{ Form::text('txtEnglishName',$qItems->thsf_eng_name,['class'=>'form-control','placeholder'=>'Name in English','id'=>'txtEnglishName', 'required']) }}
                @if ($errors->has('txtEnglishName'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtEnglishName') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                {{ Form::text('txtBanglaName',$qItems->thsf_bng_name,['class'=>'form-control','placeholder'=>'Name in Bangla','id'=>'txtBanglaName']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtFatherName',$qItems->thsf_father_name,['class'=>'form-control','placeholder'=>"Father's Name",'id'=>'txtFatherName']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtMotherName',$qItems->thsf_mother_name,['class'=>'form-control','placeholder'=>"Mothers's Name",'id'=>'txtMotherName']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtSpouseName',$qItems->thsf_spouse_name,['class'=>'form-control','placeholder'=>"Spouse Name",'id'=>'txtSpouseName']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtPresentAddress',$qItems->thsf_present_address,['class'=>'form-control','placeholder'=>'Present Address','id'=>'txtPresentAddress']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtPermanentAddress',$qItems->thsf_permanent_address,['class'=>'form-control','placeholder'=>'Permanent Address','id'=>'txtPermanentAddress']) }}
            </div>

            <div class="form-group">
                {{ Form::select('cmbReligionID',$qReligion,['id'=>$qItems->thsf_religion_id],['class'=>'form-control','placeholder' => 'Religion ']) }}
            </div>

            <div class="form-group">
                {{ Form::select('cmbDesignationID',$qDesignation,['id'=>$qItems->thsf_designation_id],['class'=>'form-control','placeholder' => 'Designation ']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtEmployeeID',$qItems->thsf_employee_id,['class'=>'form-control','placeholder'=>'Employee ID','id'=>'txtEmployeeID']) }}
            </div>

            <div class="form-group">
                {{ Form::text('txtUniversityName',$qItems->thsf_university_name,['class'=>'form-control','placeholder'=>'University Name','id'=>'txtUniversityName']) }}
            </div>

            <div class="form-group">

              <div class="row">
                <div class="col-sm-4">
                  <fieldset style="border: solid 1px #DDD !important;border-bottom: none;padding-left:10px;">
                    <legend style="width: auto !important;border: none;font-size: 15px;margin-bottom: 5px;"> Gender </legend>
                    {{ Form::radio('rdoGender', 'M', $qItems->thsf_gender_id=='M'?'true':'') }} Male
                    {{ Form::radio('rdoGender', 'F', $qItems->thsf_gender_id=='F'?'true':'') }} Female
                  </fieldset>
                </div>

                <div class="col-sm-4">
                  <fieldset style="border: solid 1px #DDD !important;border-bottom: none;padding-left:10px;">
                    <legend style="width: auto !important;border: none;font-size: 15px;margin-bottom: 5px;"> Married Status </legend>
                    {{ Form::radio('rdoMarriedStatus', 'Y', $qItems->thsf_married_status=='Y'?'true':'') }} Married
                    {{ Form::radio('rdoMarriedStatus', 'N', $qItems->thsf_married_status=='N'?'true':'') }} Single
                  </fieldset>
                </div>

                <div class="col-sm-4">
                  <fieldset style="border: solid 1px #DDD !important;border-bottom: none;padding-left:10px;">
                    <legend style="width: auto !important;border: none;font-size: 15px;margin-bottom: 5px;"> Active </legend>
                    {{ Form::radio('rdoIsActive', 'Y', $qItems->thsf_is_active=='Y'?'true':'') }} Yes
                    {{ Form::radio('rdoIsActive', 'N', $qItems->thsf_is_active=='N'?'true':'') }} No
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
              {{ Form::select('cmbDepartmentID',$qDepartment,['id'=>$qItems->thsf_department_id],['class'=>'form-control','placeholder' => 'Staff Department ']) }}
            </div>

            <div class="form-group">
              {{ Form::select('cmbSubjectID',$qSubject,['id'=>$qItems->thsf_subject_id],['class'=>'form-control','placeholder' => 'Teacher Department ']) }}
            </div>

            <div class="form-group">
              {{ Form::select('cmbShiftID',$qShift,['id'=>$qItems->thsf_shift_id],['class'=>'form-control','placeholder' => 'Teacher Shift ']) }}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"> </i></span>
              {{ Form::text('txtJoiningDate',$qItems->thsf_joining_date,['class'=>'form-control','placeholder'=>'01-01-2000','id'=>'txtJoiningDate'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-mobile"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtMobileNo',$qItems->thsf_mobile_no,['class'=>'form-control','placeholder'=>'Mobile Number','id'=>'txtMobileNo','pattern'=>'[0-9]{11}','maxlength'=>'11'])}}
                @if ($errors->has('txtMobileNo'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtMobileNo') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-mobile"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtEmergencyMobile',$qItems->thsf_emergency_mobile,['class'=>'form-control','placeholder'=>'Emergency Mobile Number','id'=>'txtEmergencyMobile','pattern'=>'[0-9]{11}','maxlength'=>'11'])}}
                @if ($errors->has('txtEmergencyMobile'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtEmergencyMobile') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"> </i> </span>
              {{ Form::text('txtEmail',$qItems->thsf_email_id,['class'=>'form-control','placeholder'=>'Email','id'=>'txtEmail','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-facebook text-primary"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtFbID',$qItems->thsf_fb_id,['class'=>'form-control','placeholder'=>'Facebook ID','id'=>'txtFbID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-twitter text-info"> </i>&nbsp; </span>
              {{ Form::text('txtTwitterID',$qItems->thsf_twitter_id,['class'=>'form-control','placeholder'=>'Twiter ID','id'=>'txtTwiterID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-skype text-info"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtSkypeID',$qItems->thsf_skype_id,['class'=>'form-control','placeholder'=>'Skype ID','id'=>'txtSkypeID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-google-plus text-danger"> </i> </span>
              {{ Form::text('txtGoogleID',$qItems->thsf_google_id,['class'=>'form-control','placeholder'=>'Google ID','id'=>'txtGoogleID'])}}
            </div>

            <div class="form-group input-group">
              <span class="input-group-addon"><i class="fa fa-linkedin text-info"> </i>&nbsp;&nbsp; </span>
              {{ Form::text('txtLinkedinID',$qItems->thsf_linkedin_id,['class'=>'form-control','placeholder'=>'Linkedin ID','id'=>'txtLinkedinID'])}}
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  {{ Form::select('cmbBloodGroup',$qBloodGroup,['id'=>$qItems->thsf_blood_group],['class'=>'form-control','placeholder' => 'Blood Group ']) }}
                </div>

                <div class="col-sm-6">
                  {{ Form::file('fileImage',['id'=>'fileImage','accept'=>'.jpg,.jpeg,.png'])}}
                  {{ Form::hidden('oldImageName', $qItems->thsf_image_path) }}
                  @if ($errors->has('fileImage'))
                      <span class="help-block">
                           <strong class="text-danger">{{ $errors->first('fileImage') }}</strong>
                      </span>
                  @endif

                  {{ Form::checkbox('deleteImage','Y')}} <strong class="text-danger">If you want to delete old image check this.</strong>
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::submit('Update', ['class'=>'pull-right btn btn-success btn-md']) }}
            </div>

          </div>

      </div>

    </div>
    {!! Form::close() !!}

@endsection
