<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mystyle.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/keyboard.js"></script>
  
    <title>TOTEM</title>
</head>
<body>
  <main>
    <div class="container">
    <h1 class="stroke" align="center">INGRESE SU RUT</h1>
       <br>
      </div>
    <form method="post" action="<?php echo site_url('inicio/auth'); ?>" >
      <div align="center">
      <input type="text" id="write" name="write" class="form-control input-lg inputgrande" minlength="9" maxlength="10"placeholder="Rut" required autofocus />
      <p class="text-info" id="msgerror"></p>
      <br>
      <h5 class="form-signin-heading"></h5>
      <br>
            <ul id="keyboard" class="container" align="center">
                  <li class="uno btn btn-primary btn-circle btn-xl-1"></li>&nbsp;
                  <li class="dos btn btn-primary btn-circle btn-xl-2"></li>&nbsp;
                  <li class="tres btn btn-primary btn-circle btn-xl-3"></li><br><br>
                  <li class="cuatro btn btn-primary btn-circle btn-xl-4"></li>&nbsp;
                  <li class="cinco btn btn-primary btn-circle btn-xl-5"></li>&nbsp;
                  <li class="seis btn btn-primary btn-circle btn-xl-6"></li><br><br>
                  <li class="siete btn btn-primary btn-circle btn-xl-7"></li>&nbsp;
                  <li class="ocho btn btn-primary btn-circle btn-xl-8"></li>&nbsp;
                  <li class="nueve btn btn-primary btn-circle btn-xl-9"></li><br><br>
                  <li class="cero btn btn-primary btn-circle btn-xl-0"></li>&nbsp;
                  <li class="key btn btn-primary btn-circle btn-xl-k"></li>&nbsp;
                  <li class="delete lastitem btn btn-primary btn-circle btn-xl-del"></li><br>
            </ul>

      <div class="container" >
    <br>
    <!-- <div align="center"><input type="button" class="btn btn-primary btn-circle btn-xl-der" type="submit" name="" width="140px" height="140px"><br><br><br></div> -->
    <button class="tn btn-primary btn-circle btn-xl-der" type="submit" name="Buscar"> 
                                        
                                    </button>
    </div>
</div>
</form>
</main>
  <br>
        <p class="copyright" align="center"><img src="<?php echo base_url(); ?>assets/images/vicsasafety.jpg" width="200" height="80"> </a></p><br>
        <p align="center">&copy; 2023 Eduardo Bastias - VICSA SAFETY COMERCIAL LTDA.
        </div>
</body>
</html>