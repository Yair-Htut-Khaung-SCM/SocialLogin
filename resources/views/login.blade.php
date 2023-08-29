<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<style type="text/css">
.social-media{
  display: flex;
  justify-content: center;
}
.social-media i {
    color: #000000;
}
a{
  display: flex;
  background: #fff;
  height: 45px;
  width: 45px;
  margin: 0 15px;
  border-radius: 8px;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  box-shadow: 6px 6px 10px -1px rgba(0,124,196,0.15),
              -6px -6px 10px -1px rgba(255,255,255,0.7);
  border: 1px solid rgba(0, 124, 196, 0);
  transition: transform 0.5s
}
a i{
  font-size: 50px
  color:#777;
  transition: transform 0.5s;
}

a:hover{
  box-shadow:inset 4px 4px 6px -2px rgba(0,0,0,0.2),
              inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                    -0.5px -0.5px 0px -1px rgba(255,255,255,1),
                    0.5px 0.5px 0px rgba(0,0,0,0.15),
                    0px 12px 10px -10px rgba(0,0,0,0.05);
  border: 1px solid rgba(0, 124, 196, 0.1);
  transform: translateY(2px);
}
a:hover i{
  transform: scale(0.90);
}
a:hover .fa-facebook{
  color: #3b5998;
}
a:hover .fa-twitter{
  color: #00acee;
}
.line:hover {
  fill: #4fce5d;
}
a:hover .fa-github{
  color: #353535;
}
a:hover .fa-google{
  color: #f00;
}
.seperator {
      float: left;
      width: 100%;
      border-top: 1px solid #c8cacc;
      text-align: center;
      margin: 35px 0 0;
}
.seperator b {
    width: 40px;
    height: 40px;
    font-size: 16px;
    text-align: center;
    line-height: 34px;
    background: #fff;
    display: inline-block;
    border: 1px solid #e0e0e0;
    border-radius: 50%;
    position: relative;
    top: -22px;
    z-index: 1;
}
.social-account {
    text-align: center;
}
</style>
<body>
<div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h1 class="card-title">Login</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="seperator"><b>or</b></div>
                    <p class="social-account">Sign in with your social media account</p>
                    <div class="social-media">
                        @foreach(\App\Enums\Provider::values() as $provider)
                        <a
                            href="{{ route('oauth.redirect', ['provider' => $provider]) }}"
                            class="{{ $provider }}"
                        >
                        @if($provider == 'line')
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M311 196.8v81.3c0 2.1-1.6 3.7-3.7 3.7h-13c-1.3 0-2.4-.7-3-1.5l-37.3-50.3v48.2c0 2.1-1.6 3.7-3.7 3.7h-13c-2.1 0-3.7-1.6-3.7-3.7V196.9c0-2.1 1.6-3.7 3.7-3.7h12.9c1.1 0 2.4 .6 3 1.6l37.3 50.3V196.9c0-2.1 1.6-3.7 3.7-3.7h13c2.1-.1 3.8 1.6 3.8 3.5zm-93.7-3.7h-13c-2.1 0-3.7 1.6-3.7 3.7v81.3c0 2.1 1.6 3.7 3.7 3.7h13c2.1 0 3.7-1.6 3.7-3.7V196.8c0-1.9-1.6-3.7-3.7-3.7zm-31.4 68.1H150.3V196.8c0-2.1-1.6-3.7-3.7-3.7h-13c-2.1 0-3.7 1.6-3.7 3.7v81.3c0 1 .3 1.8 1 2.5c.7 .6 1.5 1 2.5 1h52.2c2.1 0 3.7-1.6 3.7-3.7v-13c0-1.9-1.6-3.7-3.5-3.7zm193.7-68.1H327.3c-1.9 0-3.7 1.6-3.7 3.7v81.3c0 1.9 1.6 3.7 3.7 3.7h52.2c2.1 0 3.7-1.6 3.7-3.7V265c0-2.1-1.6-3.7-3.7-3.7H344V247.7h35.5c2.1 0 3.7-1.6 3.7-3.7V230.9c0-2.1-1.6-3.7-3.7-3.7H344V213.5h35.5c2.1 0 3.7-1.6 3.7-3.7v-13c-.1-1.9-1.7-3.7-3.7-3.7zM512 93.4V419.4c-.1 51.2-42.1 92.7-93.4 92.6H92.6C41.4 511.9-.1 469.8 0 418.6V92.6C.1 41.4 42.2-.1 93.4 0H419.4c51.2 .1 92.7 42.1 92.6 93.4zM441.6 233.5c0-83.4-83.7-151.3-186.4-151.3s-186.4 67.9-186.4 151.3c0 74.7 66.3 137.4 155.9 149.3c21.8 4.7 19.3 12.7 14.4 42.1c-.8 4.7-3.8 18.4 16.1 10.1s107.3-63.2 146.5-108.2c27-29.7 39.9-59.8 39.9-93.1z"/></svg>
                        @else 
                        <i class="fa fa-brands fa-{{ $provider }}"></i>
                        @endif
                        </a>
                        @endforeach
                        {{-- <a class="twitter" href="login/twitter"><i class="fa fa-twitter"></i></a>
                        <a class="facebook" href="login/facebook"><i class="fa fa-facebook"></i></a>
                        <a class="google"><i class='fa fa-google'></i></a>
                        <a class="github"><i class='fa fa-github'></i></a>
                        <a class="line"><i class='fa line fa-google'></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
</div>

{{-- <div class="login-form">
    <form>
      <h1 style="padding-bottom:20px;font-weight:bold">MTM Social Login</h1>
      <div class="form-group">
        <input type="email" name="email" placeholder="E-mail Address">
        <span class="input-icon"><i class="fa fa-envelope"></i></span>
      </div>
      <div class="form-group"  style="margin-bottom:30px;">
        <input type="password" name="psw" placeholder="Password">
        <span class="input-icon"><i class="fa fa-lock"></i></span>
      </div>      
      <button class="login-btn">Login</button>      
      <a class="reset-psw" href="#">Forgot your password?</a>
      <div class="seperator"><b>or</b></div>
      <p>Sign in with your social media account</p>
      <!-- Social login buttons -->
      <div class="social-icon">
	  
        <a class="button twitter" href="login/twitter"><i class="fa fa-twitter"></i></a>
        <a class="button facebook" href="login/facebook"><i class="fa fa-facebook"></i></a>
		<a class="button google"><i class='fa fa-google'></i></a>
		<a class="button github"><i class='fa fa-github'></i></a>
        <a class="button line"><i class='fa fa-google'></i></a>
      </div>
    </form>
</div> --}}

</body>
</html>