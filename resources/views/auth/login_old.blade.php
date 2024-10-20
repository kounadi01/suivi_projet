<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link href="https://www.dgbfip.com/public/img/favicon.png" rel="icon">
    <link href="https://www.dgbfip.com/public/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="w1rD1jmfQ8ilPJPkIsMpA1E1neMsKuBhsdHZsPcC">
    <title>DGBFIP</title>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://www.dgbfip.com/public/login-template/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.dgbfip.com/public/login-template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.dgbfip.com/public/login-template/css/util.css">
    <link rel="stylesheet" type="text/css" href="https://www.dgbfip.com/public/login-template/css/main.css">
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=VQ-sD4eypAOuHkvGTbQqUYoOXylldzbCTnX3nhFL1nA7mq1G06S1dUOpD6AsPSXK" charset="UTF-8"></script>
</head>

<body class="larasnap login">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <a href=https://www.dgbfip.com><img src="https://www.dgbfip.com/public/img/logo-dgbfip.png" alt="IMG"></a>
                </div>
                <form class="login100-form validate-form login-form" method="POST" action="{{ route('login') }}">
                    <input type="hidden" name="_token" value="w1rD1jmfQ8ilPJPkIsMpA1E1neMsKuBhsdHZsPcC"> <span class="login100-form-title">
                        Connexion
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email" value="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Mot de Passe">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Se connecter
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://www.dgbfip.com/public/login-template/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://www.dgbfip.com/public/login-template/vendor/bootstrap/js/popper.js"></script>
    <script src="https://www.dgbfip.com/public/login-template/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://www.dgbfip.com/public/login-template/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="https://www.dgbfip.com/public/login-template/js/main.js"></script>
</body>

</html>