<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    <title>Authentication</title>

    <!-- Bootstrap -->
    <link href="{{asset('template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('template/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('template/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('template/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{route('login.check')}}" method="POST">
              @csrf
              <h1>Login Form</h1>
                @if ($msg = Session::get('error'))
                    <div class="text-center mt-3">
                        <div class="alert bg-danger">
                            <p class="text-light">{{$msg}}</p>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="text-center mt-3">
                        <div class="alert bg-danger">
                            <p class="text-light">{{$errors->first()}}</p>
                        </div>
                    </div>
                @endif
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required />
              </div>
              <div class="d-flex justify-content-center">
                {!! htmlFormSnippet() !!}
              </div>
              <div class="clearfix"></div>
              <div>
                <button class="btn btn-default submit">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-pencil"></i>CMS-MTR</h1>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
