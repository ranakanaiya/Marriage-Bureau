<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rana Marriage Bureau | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{asset('/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('/assets/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Rana Marriage</b>Bureau</a>
                </div><!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{route('admin.login')}}" method="post">
                        @csrf
                        <div class="form-group has-feedback">
                            <input type="text" name="email" class="form-control" placeholder="Email"/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    {{-- <label>
                                        <input type="checkbox"> Remember Me
                                    </label> --}}
                                </div>
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                            </div><!-- /.col -->
                        </div>
                    </form>
                </div><!-- /.login-box-body -->
            </div><!-- /.login-box -->
        <!-- jQuery 2.1.3 -->
        <script src="{{asset('/assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
        @if(Session::Has('message'))
            <script>
                var message = '{{Session::get('message')}}';
                var type = '{{Session::get('status')}}';
                if(type == 'success')
                    toastr.success(message);
                  else
                    toastr.error(message);
            </script>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <script>
                var message = '{{$error}}';
                toastr.error(message);
            </script>
            @endforeach
        @endif
    </body>
</html>