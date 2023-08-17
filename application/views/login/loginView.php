<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Inicia sesión en tu cuenta</h4>
                                    <form action="<?php echo site_url('login/auth'); ?>" method="POST">
                                        <div class="form-group">
                                            <label><strong>Correo electrónico</strong></label>
                                            <input type="email" class="form-control"  name="username" value="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Contraseña</strong></label>
                                            <input type="password" class="form-control" name="password" value="Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Acuérdate de mí</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">¿Has olvidado tu contraseña?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>¿No tienes una cuenta? <a class="text-primary" href="<?php echo base_url(); ?>assets/page-register.html">Registrarse</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?php echo base_url(); ?>assets/vendor/global/global.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/quixnav-init.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>

</body>

</html>