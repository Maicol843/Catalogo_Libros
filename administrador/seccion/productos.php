<?php include("../template/cabecera.php"); ?>
<?php
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    $txtManual=(isset($_FILES['txtManual']['name']))?$_FILES['txtManual']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include("../config/bd.php");

    switch($accion){

        case "Agregar":
            $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen, libros) VALUES (:nombre, :imagen, :libros);");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $nombreArchivo2 = ($txtManual != "")?$fecha->getTimestamp()."_".$_FILES["txtManual"]["name"]:"manual.pdf";

            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            $tmpManual = $_FILES["txtManual"]["tmp_name"];

            if($tmpImagen != ""){
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            }

            if($tmpManual != ""){
                move_uploaded_file($tmpManual,"../../includes/doc/".$nombreArchivo2);
            }

            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':libros', $nombreArchivo2);
            $sentenciaSQL->execute();

            header("Location:productos.php");
            break;
        case "Modificar":
            $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();

            if($txtImagen != ""){
                $fecha = new DateTime();
                $nombreArchivo = ($txtImagen != "")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
                $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

                $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
                $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){
                    if(file_exists("../../img/".$libro["imagen"])){
                        unlink("../../img/".$libro["imagen"]);
                    }
                }

                $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
                $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute(); 
            }

            if($txtManual != ""){
                $fecha = new DateTime();
                $nombreArchivo2 = ($txtManual != "")?$fecha->getTimestamp()."_".$_FILES["txtManual"]["name"]:"manual.pdf";
                $tmpManual = $_FILES["txtManual"]["tmp_name"];

                move_uploaded_file($tmpManual,"../../includes/doc/".$nombreArchivo2);

                $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
                $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

                if(isset($libro["libros"]) && ($libro["libros"]!="manual.pdf")){
                    if(file_exists("../../doc/".$libro["libros"])){
                        unlink("../../doc/".$libro["libros"]);
                    }
                }

                $sentenciaSQL = $conexion->prepare("UPDATE libros SET libros=:libros WHERE id=:id");
                $sentenciaSQL->bindParam(':libros', $nombreArchivo2);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute(); 
            }

            header("Location:productos.php");
            break;
        case "Cancelar":
            header("Location:productos.php");
            break;
        case "Seleccionar":
            $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre = $libro['nombre'];
            $txtImagen = $libro['imagen'];
            $txtManual = $libro['libros'];
            break;
        case "Borrar":

            $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){
                if(file_exists("../../img/".$libro["imagen"])){
                    unlink("../../img/".$libro["imagen"]);
                }
            }

            if(isset($libro["libros"]) && ($libro["libros"]!="manual.pdf")){
                if(file_exists("../../includes/doc/".$libro["libros"])){
                    unlink("../../includes/doc/".$libro["libros"]);
                }
            }
            
            $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();

            header("Location:productos.php");
            break;
    }

    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <b>Datos del libro</b>
            </div>
            <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="txtID">ID:</label>
                            <input type="text" required readonly class="form-control" id="txtID" name="txtID" value="<?php echo $txtID; ?>" placeholder="ID">
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre:</label>
                            <input type="text" required class="form-control" id="txtNombre" name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="Nombre del libro">
                        </div>
                        <div class="form-group">
                            <label for="txtImagen">Imagen:</label>
                            <br/>
                            <?php if($txtImagen != ""){ ?>
                                <img class="img-thumbnail rounded mb-2" src="../../img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">
                            <?php } ?>
                                    
                            <input type="file" class="form-control" id="txtImagen" name="txtImagen">
                        </div>
                        <div class="form-group">
                            <label for="txtManual">Libro:</label>
                            <br/>
                                    
                            <input type="file" class="form-control" id="txtManual" name="txtManual">
                        </div>
                        <div class="btn-group d-flex justify-content-center align-items-center" role="group" aria-label="">
                            <button type="submit" class="btn btn-success" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar">Agregar</button>
                            <button type="submit" class="btn btn-warning" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar">Modificar</button>
                            <button type="submit" class="btn btn-danger" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar">Cancelar</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <table class="table table-bordered text-center">
            <thead>
                <tr class="table-active">
                    <th>ID</th>
                    <th>Nombre</th>     
                    <th>Imagen</th>
                    <th>Libro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaLibros as $libro) {?>
                <tr>
                    <td><?php echo $libro['id'];?></td>
                    <td><?php echo $libro['nombre'];?></td>
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen'];?>" width="50" alt="" srcset="">
                    </td>
                    <td>
                        <i class="fa-solid fa-file-pdf"></i>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                        </form>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../template/pie.php"); ?>