@extends('layouts.dashboard-home')
@section('title',' Content Create & Edit / Content Information')
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
            {!!Form::open(['url'=>'contents-information','method'=>'post', 'enctype'=>'multipart/form-data'])!!}
            <table class="table">
              <tr>
                <td><strong>Category</strong></td>
                <td>{{ Form::select('cmbContentsCatID',$qContentsCategory,null,['class'=>'form-control','placeholder' => 'Contents Category','required']) }}</td>
                <td><strong>Is Download Item</strong></td>
                <td>
                  {{ Form::radio('rdoDownloadItem', 'Y') }} Yes
                  {{ Form::radio('rdoDownloadItem', 'N', true) }} No
                </td>
                <td><strong>Active</strong></td>
                <td>
                  {{ Form::radio('rdoIsActive', 'Y', true) }} Yes
                  {{ Form::radio('rdoIsActive', 'N') }} No
                </td>
                <td><strong>Generate Html</strong></td>
                <td>
                  {{ Form::radio('rdoGenerateHTML', 'Y') }} Yes
                  {{ Form::radio('rdoGenerateHTML', 'N', true) }} No
                </td>
                <td><strong>Video ID</strong></td>
                <td>
                  {{ Form::text('txtVideoID',old("txtVideoID"),['class'=>'form-control','placeholder'=>'Youtube Video ID']) }}
                </td>
                <td>
                  <a href="{{url('contents-information')}}" class="btn btn-md btn-info"><i class="fa fa-th-list" aria-hidden="true"></i> Show All Contents</a>
                </td>
              </tr>
            </table>
          </div>
      </div>
    </div>

    <div class="col-sm-6">

      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">English Contents</h3>
          </div>

              <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputDesignation">Contents English Title</label>
                    {{ Form::text('txtEnglishTitle',old("txtEnglishTitle"),['class'=>'form-control','placeholder'=>'English Title','id'=>'txtEnglishTitle', 'required']) }}
                    @if ($errors->has('txtEnglishTitle'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtEnglishTitle') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Contents English Brief</label>
                    {{ Form::textarea('txtEnglishBrief',old("txtEnglishBrief"),['class'=>'form-control','placeholder'=>'English Brief','id'=>'txtEnglishBrief',]) }}
                    @if ($errors->has('txtEnglishBrief'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtEnglishBrief') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputDesignation">Contents English Details</label>
                    {{ Form::textarea('txtEnglishDetails',old("txtEnglishDetails"),['class'=>'form-control','placeholder'=>'Contents Details...','id'=>'txtEnglishDetails','rows'=>'3','required'])}}
                    @if ($errors->has('txtEnglishDetails'))
                        <span class="help-block coral-text">
                             <strong>{{ $errors->first('txtEnglishDetails') }}</strong>
                        </span>
                    @endif
                </div>

            </div>

            <div class="col-sm-12">{{Form::checkbox('chkRatio', 'Y')}} <span class="text-danger">Auto resize by aspect ratio</span></div>

            <div class="box-footer" align="right">

                <div class="col-sm-12">
                  <div class="col-sm-1">Big Width</div>
                  <div class="col-sm-2">{{ Form::text('txtBigW',780,['class'=>'form-control','required']) }}</div>
                  <div class="col-sm-1">Big Height</div>
                  <div class="col-sm-2">{{ Form::text('txtBigH',380,['class'=>'form-control','required']) }}</div>
                  <div class="col-sm-1">Small Width</div>
                  <div class="col-sm-2">{{ Form::text('txtSmallW',250,['class'=>'form-control','required']) }}</div>
                  <div class="col-sm-1">Small Height</div>
                  <div class="col-sm-2">{{ Form::text('txtSmallH',150,['class'=>'form-control','required']) }}</div>
                </div>

            </div>

      </div>
    </div>

    <div class="col-sm-6">
      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">Bangla Contents</h3>
          </div>

          <div class="box-body">

            <div class="form-group">
                <label for="exampleInputDesignation">Contents Bangla Title</label>
                {{ Form::text('txtBanglaTitle',old("txtBanglaTitle"),['class'=>'form-control','placeholder'=>'Bangla Title','id'=>'txtBanglaTitle']) }}
                @if ($errors->has('txtBanglaTitle'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtBanglaTitle') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputDesignation">Contents Bangla Brief</label>
                {{ Form::textarea('txtBanglaBrief',old("txtBanglaBrief"),['class'=>'form-control','placeholder'=>'Bangla Brief','id'=>'txtBanglaBrief',]) }}
                @if ($errors->has('txtBanglaBrief'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtBanglaBrief') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputDesignation">Contents Bangla Details</label>
                {{ Form::textarea('txtBanglaDetails',old("txtBanglaDetails"),['class'=>'form-control','placeholder'=>'Contents Details...','id'=>'txtBanglaDetails','rows'=>'3'])}}
                @if ($errors->has('txtBanglaDetails'))
                    <span class="help-block coral-text">
                         <strong>{{ $errors->first('txtBanglaDetails') }}</strong>
                    </span>
                @endif
            </div>

          </div>

          <div class="box-footer" align="right">

            <div class="col-sm-10">
              <div class="col-sm-1"><strong>{{ Form::label('file-big-image', 'Image') }}</strong> </div>
              <div class="col-sm-5">

                {{ Form::file('fileBigImage',['id'=>'fileBigImage','accept'=>'.jpg,.jpeg,.png'])}}

                @if ($errors->has('fileBigImage'))
                    <span class="help-block">
                         <strong class="coral-text">{{ $errors->first('fileBigImage') }}</strong>
                    </span>
                @endif

              </div>

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
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </div>
          {!! Form::close() !!}
      </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'txtEnglishBrief' );
        CKEDITOR.replace( 'txtEnglishDetails' );
        CKEDITOR.replace( 'txtBanglaBrief' );
        CKEDITOR.replace( 'txtBanglaDetails' );
    </script>

@endsection
