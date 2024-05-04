<?php
    session_start();
    if($_POST){
        if(($_POST['usuario']=='administrador') && ($_POST['contrasenia']=='sistema')){
            $_SESSION['usuario'] = 'ok';
            $_SESSION['nombreUsuario']="Administrador";
            header('Location: inicio.php');
        } else {
            $mensaje = "ERROR: El usuario y/o contraseña son incorrectos";
        }
    }
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Administrador del Sitio Web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Estilo CSS-->
    <link rel="stylesheet" href="../css/estilo.css">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="body">

    <div class="container">
        <br><br><br><br><br>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>ADMINISTRADOR</h4>
                        <div class="mt-2">
                            <img src="../img/logo.jpg" width="70">
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        <form method="POST">
                            <div class = "form-group">
                                <label><i class="fa-solid fa-user-tie"></i> Usuario:</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario">
                            </div>
                            <div class="form-group">
                                <label><i class="fa-solid fa-key"></i> Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu contraseña">
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--Bootstrap-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>