<html lang="en">

<head>

    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modasof</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body {
            font-family: "Afterglow Regular", sans-serif;
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-image: url("./fondo.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        input,
        textarea {
            background-color: #f3e5f5;
            border-radius: 50px !important;
            padding: 12px 15px 12px 15px !important;
            width: 100%;
            box-sizing: border-box;
            border: none !important;
            border: 1px solid #f3e5f5 !important;
            font-size: 16px !important;
            color: #000 !important;
            font-weight: 400;
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #e739ff !important;
            outline-width: 0;
            font-weight: 400;
        }
        .password-container {
            position: relative;
            width: 100%;
        }

        .password-icon {
            position: absolute;
            top: 70%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0;
        }

        .card {
            border-radius: 0;
            border: none;
        }

        .card1 {
            width: 50%;
            padding: 40px 30px 10px 30px;
        }

        .card2 {
            width: 50%;
            background-image: linear-gradient(to right, #88beff, #e739ff);
        }

        #logo {
            width: 200px;
            height: 120px;
        }

        .heading {
            margin-bottom: 60px !important;
        }

        ::placeholder {
            color: #666;
            opacity: 1;
        }

        :-ms-input-placeholder {
            color: #000 !important;
        }

        ::-ms-input-placeholder {
            color: #000 !important;
        }

        .form-control-label {
            font-size: 12px;
            margin-left: 15px;
        }

        .msg-info {
            padding-left: 15px;
            margin-bottom: 30px;
        }

        .btn-color {
            border-radius: 50px;
            color: #fff;
            background-image: linear-gradient(to right, #88beff, #e739ff);
            padding: 15px;
            cursor: pointer;
            border: none !important;
            margin-top: 40px;
        }

        .btn-color:hover {
            color: #fff;
            background-image: linear-gradient(to right, #e739ff, #88beff);
        }

        .btn-white {
            border-radius: 50px;
            color: #e739ff;
            background-color: #fff;
            padding: 8px 40px;
            cursor: pointer;
            border: 2px solid #e739ff !important;
        }

        .btn-white:hover {
            color: #fff;
            background-image: linear-gradient(to right, #88beff, #e739ff);
        }

        a {
            color: #000;
        }

        a:hover {
            color: #000;
        }

        .bottom {
            width: 100%;
            margin-top: 50px !important;
        }

        .sm-text {
            font-size: 15px;
        }

        @media screen and (max-width: 992px) {
            .card1 {
                width: 100%;
                padding: 40px 30px 10px 30px;
            }

            .card2 {
                width: 100%;
            }

            .right {
                margin-top: 100px !important;
                margin-bottom: 100px !important;
            }
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 10px !important;
            }

            .card2 {
                padding: 50px;
            }

            .right {
                margin-top: 50px !important;
                margin-bottom: 50px !important;
            }
        }
    </style>
</head>

<body class="snippet-body">
    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <!-- Sección card2 -->
                <div class="card card2">
                    <div class="my-auto mx-md-5 px-md-5 right">
                        <h3 class="text-white">Somos más que una empresa</h3>
                        <small class="text-white">Creemos en el saber y la importancia del calzado hecho a mano,
                            El lujo de llevar un artículo personalizado, elaborado
                            artesanalmente apoyando las tradiciones.</small><br /><br />
                        <small class="text-white">Nos llena de satisfacción, al saber que hacemos un único par
                            para una mujer especial que confía en nosotros.</small>
                    </div>
                </div>

                <div class="card card1" id="login-card">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-10 my-5">
                            <div class="row justify-content-center px-3 mb-3">
                                <img id="logo" src="./negro.png" />
                            </div>
                            <br />

                            <h4 class="msg-info"><b>Inicie sesión en su cuenta</b></h4>

                            <form action="login.php" method="post" id="login-form">
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Nombre de usuario</label>
                                    <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de usuario" class="form-control" />
                                </div>

                                <div class="form-group position-relative password-container">
                            <label class="form-control-label text-muted">Contraseña</label>
                            <input type="password" name="TxtPass" id="TxtPass" placeholder="Contraseña" class="form-control" />
                            <span class="password-icon" id="show-password">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Error:</strong> Los datos ingresados son incorrectos. Por favor, verifica tu nombre de usuario y contraseña.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <button type="submit" id="submit-btn" class="btn-block btn-color">
                            Iniciar sesión en Modasof
                        </button>

                        </form>

                        <div class="row justify-content-center my-2">
                            <a href="#" id="forgot-password-link"><small class="text-muted">¿Olvidaste tu
                                    contraseña?</small></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card1" id="recovery-card" style="display: none;">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <!-- Agrega aquí el formulario de recuperación de contraseña -->
                        <h4 class="msg-info"><b>Recuperar Contraseña</b></h4>
                        <form action="recovery.php" method="post">
                            <div class="form-group">
                                <label class="form-control-label text-muted">Ingresar Email</label>
                                <input type="email" name="txtEmail" placeholder="Correo electrónico" class="form-control" required />
                            </div>

                            <!-- Agregamos el botón para enviar el formulario -->
                            <div class="row justify-content-center my-3 px-3">
                                <button type="submit" class="btn-block btn-color">
                                    Enviar
                                </button>
                            </div>
                        </form>

                        <!-- Agregamos el enlace para volver al formulario de inicio de sesión -->
                        <div class="row justify-content-center my-2">
                            <a href="#" id="return-to-login-link"><small class="text-muted">Volver al inicio de sesión</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar el clic en el enlace de recuperación de contraseña
            $("#forgot-password-link").click(function() {
                // Ocultar el formulario de inicio de sesión
                $("#login-card").hide();
                // Mostrar el formulario de recuperación de contraseña
                $("#recovery-card").show();
            });

            // Manejar el clic en el enlace para volver al inicio de sesión
            $("#return-to-login-link").click(function() {
                // Ocultar el formulario de recuperación de contraseña
                $("#recovery-card").hide();
                // Mostrar el formulario de inicio de sesión
                $("#login-card").show();
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar clic en el ícono del ojo para mostrar/ocultar contraseña
            $("#show-password").click(function() {
                var passwordInput = $("#TxtPass");

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                } else {
                    passwordInput.attr("type", "password");
                }
            });

            // Resto del código...
        });
    </script>

</body>

</html>