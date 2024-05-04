<?php include('template/cabecera.php'); ?>
                <div class="jumbotron text-center text-light" style="background-color: rgba(0, 0, 0, 0.6);">
                    <h1 class="display-3">Bienvenido <?php echo $nombreUsuario; ?></h1>
                    <p class="lead">Vamos a administrar nuestros libros en el sitio web</p>
                    <hr class="my-2">
                    <p>Más info</p>
                    <p class="lead">
                        <a class="btn btn-secondary btn-lg" href="seccion/productos.php" role="button"><i class="fa-solid fa-address-book"></i> Administrar libros</a>
                    </p>
                </div>
<?php include('template/pie.php'); ?>