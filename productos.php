<?php include("template/cabecera2.php"); ?>

<?php
    include("administrador/config/bd.php");
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaLibros as $libro){ ?>
    <div class="col-md-3 mb-4">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" style="height: 16rem;">
            <div class="card-body text-center">
                <h4 class="card-title"><?php echo $libro['nombre']; ?></h4>
                <div class="d-flex align-items-center justify-content-center">
                    <a class="btn btn-info" href="includes/descargar.php?id= <?php echo $libro['id'] ;?>" role="button">Descargar</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include("template/pie.php"); ?>