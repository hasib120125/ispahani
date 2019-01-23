@extends('layouts.dashboard-home')
@section('title',' Institute Notice / Notice Information')
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
            {!!Form::open(['url'=>'notice-information','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
            <table class="table">
              <tr>
                <td><strong>Category</strong></td>
                <td>{{ Form::select('cmbContentsCatID',$qNoticeCategory,null,['class'=>'form-control','placeholder' => 'Notice Category','required']) }}</td>
                <td><strong class="text-info">Is Download Item</strong></td>
                <td>
                  {{ Form::radio('rdoDownloadItem', 'Y', true) }} Yes
                  {{ Form::radio('rdoDownloadItem', 'N') }} No
                </td>
                <td><strong class="text-danger">Active</strong></td>
                <td>
                  {{ Form::radio('rdoIsActive', 'Y', true) }} Yes
                  {{ Form::radio('rdoIsActive', 'N') }} No
                </td>
                <td><strong class="text-muted">Generate Html</strong></td>
                <td>
                  {{ Form::radio('rdoGenerateHTML', 'Y') }} Yes
                  {{ Form::radio('rdoGenerateHTML', 'N', true) }} No
                </td>
                <td><strong class="text-primary">Show Scroll</strong></td>
                <td>
                  {{ Form::radio('rdoShowScroll', 'Y') }} Yes
                  {{ Form::radio('rdoShowScroll', 'N', true) }} No
                </td>
                <td><strong class="text-success">Out of Notice</strong></td>
                <td>
                  {{ Form::radio('rdoOutOfNotice', 'Y') }} Yes
                  {{ Form::radio('rdoOutOfNotice', 'N', true) }} No
                </td>
                <td>
                  <a href="{{url('notice-information')}}" class="btn btn-md btn-info"><i class="fa fa-th-list" aria-hidden="true"></i> Show All Notice</a>
                </td>
              </tr>
            </table>
          </div>
      </div>
    </div>

    <div class="col-sm-6">

      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">English Notice</h3>
          </div>

              <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputDesignation">Notice English Title</label>
                    {{ Form::text('txtEnglishTitle',old("txtEnglishTitle"),['class'=>'form-control','placeholder'=>'English Title','id'=>'txtEnglishTitle', 'required']) }}
                    @if ($errors->has('txtEnglishTitle'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtEnglishTitle') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Notice English Details</label>
                    {{ Form::textarea('txtEnglishDetails',old("txtEnglishDetails"),['class'=>'form-control','placeholder'=>'Contents Details...','id'=>'txtEnglishDetails','rows'=>'3','required'])}}
                    @if ($errors->has('txtEnglishDetails'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtEnglishDetails') }}</strong>
                        </span>
                    @endif
                </div>

            </div>

            <div class="box-footer" align="right">

                <div class="row">
                  <div class="col-sm-1">URL</div>
                  <div class="col-sm-11">{{ Form::text('txtURL',old("txtURL"),['class'=>'form-control','placeholder'=>'Web URL']) }}</div>
                </div>

            </div>
      </div>

    </div>

    <div class="col-sm-6">

      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Bangla Notice</h3>
          </div>

          <div class="box-body">

            <div class="form-group">
                <label for="exampleInputDesignation">Notice Bangla Title</label>
                {{ Form::text('txtBanglaTitle',old("txtBanglaTitle"),['class'=>'form-control','placeholder'=>'Bangla Title','id'=>'txtBanglaTitle']) }}
                @if ($errors->has('txtBanglaTitle'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtBanglaTitle') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputDesignation">Notice Bangla Details</label>
                {{ Form::textarea('txtBanglaDetails',old("txtBanglaDetails"),['class'=>'form-control','placeholder'=>'Contents Details...','id'=>'txtBanglaDetails','rows'=>'3'])}}
                @if ($errors->has('txtBanglaDetails'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtEnglishDetails') }}</strong>
                    </span>
                @endif
            </div>

          </div>

          <div class="box-footer" align="right">

            <div class="col-sm-10">

              <div class="col-sm-1"><strong>{{ Form::label('pdf', 'PDF') }}</strong> </div>
              <div class="col-sm-5">
                {{ Form::file('filePDF',['id'=>'filePDF','accept'=>'.pdf'])}}

                @if ($errors->has('filePDF'))
                    <span class="help-block">
                         <strong class="coral-text">{{ $errors->first('filePDF') }}</strong>
                    </span>
                @endif
              </div>

            </div>

            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary btn-md">Submit</button>
            </div>
          </div>
          {!! Form::close() !!}
      </div>

    </div>

    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'txtEnglishDetails' );
        CKEDITOR.replace( 'txtBanglaDetails' );
    </script>

@endsection
