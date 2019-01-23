@extends('layouts.dashboard-home')
@section('title',' Administration / Message Edit')
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
        {!!Form::open(['url'=>['messages',$qMessages->id],'method'=>'put', 'enctype'=>'multipart/form-data'])!!}
        <table class="table">
          <tr>
            <td><strong>Category</strong></td>
            <td>
              {{ Form::select('txtMessageCategory',[
              'Chairman' => 'Chairman',
              'Principal' => 'Principal',
              'chiefPatron' => 'Chief Patron',
              ],
              $qMessages->mess_cat_id, ['class'=>'form-control','placeholder' => 'Select Item...', 'required']) }}
            </td>
            <td><strong>Active</strong></td>
            <td>
              {{ Form::radio('rdoIsActive', 'Y', $qMessages->mess_is_active=='Y'?'true':'') }} Yes
              {{ Form::radio('rdoIsActive', 'N', $qMessages->mess_is_active=='N'?'true':'') }} No
            </td>
            <td><strong>Generate Html</strong></td>
            <td>
              {{ Form::radio('rdoGenerateHTML', 'Y') }} Yes
              {{ Form::radio('rdoGenerateHTML', 'N', true) }} No
            </td>
            <td><strong>Video ID</strong></td>
            <td>
              {{ Form::text('txtVideoID',$qMessages->mess_video_id,['class'=>'form-control','placeholder'=>'Youtube Video ID']) }}
            </td>
            <td>
              <a href="{{url('messages')}}" class="btn btn-md btn-info"><i class="fa fa-th-list" aria-hidden="true"></i> Show All Message</a>
            </td>
          </tr>
        </table>
      </div>
  </div>
</div>

<div class="col-sm-6">

  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">English Message</h3>
      </div>

          <div class="box-body">

            <div class="form-group">
                <label for="exampleInputDesignation">Message English Title</label>
                {{ Form::text('txtMessageEngTitle',$qMessages->mess_eng_title,['class'=>'form-control','placeholder'=>'Message English Title', 'required']) }}
                @if ($errors->has('txtMessageEngTitle'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtMessageEngTitle') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputDesignation">Message English Brief</label>
                {{ Form::textarea('txtMessageEngBrief',$qMessages->mess_eng_brief,['class'=>'form-control','placeholder'=>'Message English Brief','id'=>'txtMessageEngBrief',]) }}
                @if ($errors->has('txtMessageEngBrief'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtMessageEngBrief') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputDesignation">Message English Details</label>
                {{ Form::textarea('txtMessageEngDetails',$qMessages->mess_eng_details,['class'=>'form-control','placeholder'=>'Message Details...','id'=>'txtMessageEngDetails','rows'=>'3','required'])}}
                @if ($errors->has('txtMessageEngDetails'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtMessageEngDetails') }}</strong>
                    </span>
                @endif
            </div>

        </div>

        <div class="col-sm-12">{{Form::checkbox('chkRatio', 'Y', true)}} <span class="text-danger">Auto resize by aspect ratio</span></div>

        <div class="box-footer" align="right">

            <div class="col-sm-12">
              <div class="col-sm-1">Big Width</div>
              <div class="col-sm-2">{{ Form::text('txtBigW',400,['class'=>'form-control','required']) }}</div>
              <div class="col-sm-1">Big Height</div>
              <div class="col-sm-2">{{ Form::text('txtBigH',330,['class'=>'form-control','required']) }}</div>
              <div class="col-sm-1">Small Width</div>
              <div class="col-sm-2">{{ Form::text('txtSmallW',200,['class'=>'form-control','required']) }}</div>
              <div class="col-sm-1">Small Height</div>
              <div class="col-sm-2">{{ Form::text('txtSmallH',160,['class'=>'form-control','required']) }}</div>
            </div>

        </div>
  </div>
</div>

<div class="col-sm-6">
  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Bangla Message</h3>
      </div>

      <div class="box-body">

        <div class="form-group">
            <label for="exampleInputDesignation">Message Bangla Title</label>
            {{ Form::text('txtMessageBngTitle',$qMessages->mess_bng_title,['class'=>'form-control','placeholder'=>'Message Bangla Title']) }}
            @if ($errors->has('txtMessageBngTitle'))
                <span class="help-block coral-text">
                     <strong>{{ $errors->first('txtMessageBngTitle') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputDesignation">Message Bangla Brief</label>
            {{ Form::textarea('txtMessageBngBrief',$qMessages->mess_bng_brief,['class'=>'form-control','placeholder'=>'Message Bangla Brief','id'=>'txtMessageBngBrief',]) }}
            @if ($errors->has('txtMessageBngBrief'))
                <span class="help-block coral-text">
                     <strong>{{ $errors->first('txtMessageBngBrief') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputDesignation">Message Bangla Details</label>
            {{ Form::textarea('txtMessageBngDetails',$qMessages->mess_bng_details,['class'=>'form-control','placeholder'=>'Message Contents Details...','id'=>'txtMessageBngDetails','rows'=>'3'])}}
            @if ($errors->has('txtMessageBngDetails'))
                <span class="help-block coral-text">
                     <strong>{{ $errors->first('txtMessageBngDetails') }}</strong>
                </span>
            @endif
        </div>

      </div>

      <div class="box-footer" align="right">

        <div class="col-sm-10">
          <div class="col-sm-1"><strong>{{ Form::label('file-Message-image', 'Image') }}</strong> </div>
          <div class="col-sm-5">

            {{ Form::file('fileMessageImage',['id'=>'fileMessageImage','accept'=>'.jpg,.jpeg,.png'])}}
            {{ Form::hidden('oldBigImage',$qMessages->mess_img_path)}}
            {{ Form::hidden('oldSmallImage',$qMessages->mess_small_img)}}

            @if ($errors->has('fileMessageImage'))
                <span class="help-block">
                     <strong class="coral-text">{{ $errors->first('fileMessageImage') }}</strong>
                </span>
            @endif

          </div>

          <div class="col-sm-1"><strong>{{ Form::label('pdf', 'PDF') }}</strong> </div>
          <div class="col-sm-5">
            {{ Form::file('filePDF',['id'=>'filePDF','accept'=>'.pdf'])}}
            {{ Form::hidden('oldFilePDF',$qMessages->mess_file_path)}}

            @if ($errors->has('filePDF'))
                <span class="help-block">
                     <strong class="coral-text">{{ $errors->first('filePDF') }}</strong>
                </span>
            @endif
          </div>

        </div>

        <div class="col-sm-2">
          <button type="submit" class="btn btn-primary btn-block">Update</button>
        </div>

        <div class="col-sm-12">
          <div class="col-sm-6">
            {{ Form::checkbox('deleteImage','Y')}} <strong class="text-danger">If you want to delete old image check this.</strong>
          </div>
          <div class="col-sm-6">
            {{ Form::checkbox('deletePDF','Y')}} <strong class="text-danger">If you want to delete old pdf check this.</strong>
          </div>
        </div>

      </div>
      {!! Form::close() !!}
  </div>
</div>


<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'txtMessageEngBrief' );
    CKEDITOR.replace( 'txtMessageEngDetails' );
    CKEDITOR.replace( 'txtMessageBngBrief' );
    CKEDITOR.replace( 'txtMessageBngDetails' );
</script>

@endsection
