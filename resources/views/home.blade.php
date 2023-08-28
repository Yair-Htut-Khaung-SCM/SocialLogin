<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 Custom Login and Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }



    .box {
        min-height: 380px;
        width: 350px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
        padding: 30px 30px;
    }


    .profile-circle {
        margin-top: 2px;
        height: 120px;
        width: 120px;
        border-radius: 10px;
        box-shadow: -3px -3px 7px #ffffff, 3px 3px 5px #ceced1;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    img {
        width: 100px;
        border-radius: 50%;
    }

    .profile-info {
        height: 50px;
        width: 100%;
        margin: 10px 0px;
        line-height: 25px;
    }

    .profile-info p {
        color: #7c8293;
        font-size: 14px;
    }

    .social-icon {
        width: 70%;
        display: flex;
        justify-content: space-between;
    }

    .fb,
    .insta,
    .twitt,
    .uTube {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        box-shadow: -3px -3px 7px #ffffff, 3px 3px 5px #ceced1;
        cursor: pointer;
    }

    .btns {
        padding: 30px;
        display: flex;
        justify-content: center;
        gap: 10px;
        align-items: center;
        height: 80px;
        width: 100%;
    }

    .btns button {
        background: none;
        border: none;
        outline: none;
        height: 35px;
        width: 100%;
        border-radius: 4px;
        box-shadow: -3px -3px 7px #ffffff, 3px 3px 5px #ceced1;
        cursor: pointer;
    }

    .btns button:hover {
        background: none;
        border: none;
        background: #ecf0f3;
        outline: none;
        height: 35px;
        width: 100%;
        border-radius: 4px;
        box-shadow: inset -2px -2px 3px #ffffff, inset 2px 2px 3px #ceced1;
    }

    .extra-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        width: 100%;
        padding: 0px 25px;
        margin-top: 15px;
    }

    .fb,
    .insta,
    .uTube,
    .twitt {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fb:hover,
    .insta:hover,
    .uTube:hover,
    .twitt:hover {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        box-shadow: inset -2px -2px 3px #ffffff, inset 2px 2px 3px #ceced1;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1> Welcome, {{ Auth::user()->name }}</h1>
        <div class="box">



            <div class="profile-circle">
                @if($providerInfo)
                    @if (($providerInfo->provider_user_picture))
                        <img src="{{ $providerInfo->provider_user_picture }}" alt="">
                    @else
                        <img src="https://i.pravatar.cc/100" alt="">
                    @endif
                @else 
                    <img src="https://i.pravatar.cc/100" alt="">
                @endif

            </div>

            <div class="profile-info">
                <h4>{{ Auth::user()->name }}</h4>
                <p> Member of the System with<span style="color:rgb(48, 71, 245);text-weight:bold;"> {{ Auth::user()->provider_name }}</span></p>
            </div>

            <div class="social-icon">

                <div class="fb">
                    <svg color="#1877F2" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                        viewBox="0 0 512 512">
                        <path
                            d="M288 192v-38.1c0-17.2 3.8-25.9 30.5-25.9H352V64h-55.9c-68.5 0-91.1 31.4-91.1 85.3V192h-45v64h45v192h83V256h56.4l7.6-64h-64z"
                            fill="currentColor" />
                    </svg>
                </div>
                <div class="twitt"> <svg color="#1D9BF0" xmlns="http://www.w3.org/2000/svg" width="25"
                        height="25" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M22.46 6c-.77.35-1.6.58-2.46.69c.88-.53 1.56-1.37 1.88-2.38c-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29c0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15c0 1.49.75 2.81 1.91 3.56c-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07a4.28 4.28 0 0 0 4 2.98a8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21C16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56c.84-.6 1.56-1.36 2.14-2.23Z" />
                    </svg></div>
                <div class="insta"><svg color="#FF3129" xmlns="http://www.w3.org/2000/svg" width="25"
                        height="25" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3Z" />
                    </svg></div>
                <div class="uTube"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        viewBox="0 0 256 180">
                        <path fill="red"
                            d="M250.346 28.075A32.18 32.18 0 0 0 227.69 5.418C207.824 0 127.87 0 127.87 0S47.912.164 28.046 5.582A32.18 32.18 0 0 0 5.39 28.24c-6.009 35.298-8.34 89.084.165 122.97a32.18 32.18 0 0 0 22.656 22.657c19.866 5.418 99.822 5.418 99.822 5.418s79.955 0 99.82-5.418a32.18 32.18 0 0 0 22.657-22.657c6.338-35.348 8.291-89.1-.164-123.134Z" />
                        <path fill="#FFF" d="m102.421 128.06l66.328-38.418l-66.328-38.418z" />
                    </svg></div>
            </div>

            <div class="btns">
                <button>Message</button>
                <button>Setting</button>
            </div>
        </div>
</body>

</html>
