
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href='{{ url("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css")}}'>
  <link rel="stylesheet" href='{{ url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css")}}'>
  <link rel="stylesheet" href='{{ url("https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css")}}'>

  <script src={{ 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js' }}></script>
  <script src={{ 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js' }}></script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Admin</b>Login</a>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>


    {!!Form::open(['url'=>route('login'),'method'=>'post'])!!}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  has-feedback">
        {{ Form::email('email',old("email"),['class'=>'form-control','placeholder'=>'Email','id'=>'email','required','autofocus'])}}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        {{ Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Password','required'])}}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          {{Form::checkbox('remember',old('remember') ? 'checked' : '')}} Remember Me
        </div>

        <div class="col-xs-4">
          {{Form::submit('Sign In',['class'=>'btn btn-primary btn-block btn-flat'])}}
        </div>

      </div>

    {!!Form::close()!!}

    <a href="{{ route('password.request') }}"><i class="fa fa-unlock-alt" aria-hidden="true"> I forgot my password</i></a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src='{{ url("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js") }}'></script>
<script src='{{ url("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js") }}'></script>
<script src='{{ url("https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js") }}'></script>
</body>
</html>
