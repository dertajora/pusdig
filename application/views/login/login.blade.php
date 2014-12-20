
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>&middot;Pusdig Bina Tunas &middot;</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
 <!--   {{ Asset::container('todc')->styles(); }}
	{{ Asset::container('todc')->scripts(); }}
   HTML::style('css/common.css'); -->
   
   
   
    {{ HTML::style('todc/css/bootstrap.css'); }}
    {{ HTML::style('todc/css/bootstrap-responsive.css'); }}
    {{ HTML::style('todc/css/todc-bootstrap.css'); }}
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/todc-bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body { padding-top: 40px; padding-bottom: 40px;  background: #f1f1f1;}
      a { color: #15c; text-decoration: none; }
      a:hover { color: #15c; text-decoration: underline; }
      form,
      label,
      input[type=text],
      input[type=checkbox],
      input[type=password] {
        margin: 0;
      }

      .signin {
        width: 375px;
        margin: 0 auto;
        margin-top: 60px;
      }
      .signin-box {
        padding: 20px 25px 15px;
        background: #ffffff;
        border: 1px solid #e5e5e5;
      }
      .signin-box h2 {
        font-size: 16px;
        font-weight: normal;
        line-height: 17px;
        height: 16px;
        margin: 0 0 19px;
        color:#767687;
        color:#00AACC;
        font-family: Century Gothic;
      }

      .signin-box input[type=checkbox] {
        vertical-align: bottom;
      }
      .signin-box input[type=text],
      .signin-box input[type=password] {
        width: 100%;
        font-size: 15px;
        color: black;
        line-height: normal;
        height: 26px;
        margin: 0 0 10px;

        box-sizing: border-box;
      }
      .signin-box input[type=submit] {
        margin: 10 0 15 10px;
      }

      .signin-box label {
        color: #222;
        margin: 0 0 5px;
        display: block;
        font-weight: bold;
        font-size: 13px;
        color:#33bafe;
        font-family: Century Gothic;
      }

      .signin-box label.remember {
        display: inline-block;
        vertical-align: top;
        margin: 9px 0 0;
        line-height: 1;
        font-size: 13px;
      }

      .signin-box .remember-label {
        font-weight: normal;
        color: #666;
        line-height: 0;
        padding: 0 0 0 5px;
      }

      .signin-box ul {
        list-style: none;
        line-height: 17px;
        margin: 0;
        padding: 0;
      }

      input.parsley-success
            {
              color: #468847 !important;
              background-color: #DFF0D8 !important;
              border: 2px solid #D6E9C6 !important;
            }
            input.parsley-error
            {
              color: #B94A48 !important;
              background-color: #F2DEDE !important;
              border: 2px solid #EED3D7 !important;
            }
 
           
 
            ul.parsley-error-list
            {
                font-size:12px;
                margin: 2px;
                list-style-type:none;
            }
 
            ul.parsley-error-list li
            {
                line-height: 12px;
            }
 
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
   
  </head>

  <body>

    <div class="container">

      <div class="signin">
        <div class="signin-box">
        	<center>
            <h2 class="form-signin-heading">Perpustakaan Digital Bina Tunas</h2>

            <img src="{{ URL::to_asset('logo.png') }}" alt=""></img>
            <h2 class="form-signin-heading"><b>SMA N 3 Pemalang</b></h2>
             <hr>
            </center>
            @if(Session::has('login_message'))
            <div class="alert alert-error">
            <center><b>Username atau password tidak valid</b></center>
            </div>
            @endif
          {{Form::open('login','POST',array('data-validate' => 'parsley'))}}
            <fieldset>
              <label for="username">Username</label>
              <input type="text" class="input-block-level" name="username" id="username" data-required="true">
              <label for="passwd">Password</label>
              <input type="password" class="input-block-level" name="password" id="passwd" data-required="true">
              <hr>
              <input type="submit" class="btn btn-primary btn-large btn-block" value="Login">
             
            </fieldset>
          {{Form::close()}}

          
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     {{ HTML::script('js/jquery.js'); }}
     {{ HTML::script('js/parsley.js'); }}
  </body>
</html>
