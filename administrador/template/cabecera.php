<?php
  session_start();
  if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
  } else {
    if($_SESSION['usuario']=='ok'){
      $nombreUsuario = $_SESSION['nombreUsuario'];
    }
  }
?>

<!doctype html>
<html lang="es">
  <head>
    <!--Título de página-->
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Estilo CSS-->
    <link rel="stylesheet" href="../css/estilo.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
  <body class="banner_2">
    <?php $url="http://".$_SERVER['HTTP_HOST']."/SitioWeb_PHP"?>

    <nav class="nav-administrador navbar navbar-expand navbar-dark bg-dark">
        <div class="nav navbar-nav text-light">
            <a class="nav-item nav-link active text-light" href="#"><i class="fa-solid fa-user-tie"></i> Administrador<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php"><i class="fa-solid fa-house"></i> Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/productos.php"><i class="fa-solid fa-book"></i> Libros</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php"><i class="fa-solid fa-rectangle-xmark"></i> Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>"><i class="fa-solid fa-window-restore"></i> Ver sitio web</a>
        </div>
    </nav>

    <div class="container">
        <br>
        <div class="row">
          <div class="col-md-12">