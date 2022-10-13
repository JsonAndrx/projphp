<?php include('cabecera.php');?>
<?php include('conexion.php');?>
<?php

    if(isset($_SESSION['usuario'])!='yeison'){
        header("location:login.php");
    }

    if($_POST){

        $nombre = $_POST['nombre'];
        $fecha = new DateTime();
        $descripcion = $_POST['descripcion'];

        $imagen = $fecha->getTimestamp()."_".$_FILES['archivo']['name'];
        $imagen_temporal=$_FILES['archivo']['tmp_name'];
        move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

        $objconexion = new conexion();
        $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`) VALUES (NULL, '$nombre', '$imagen', '$descripcion');";
        $objconexion -> ejecutar($sql);
        header("location:album.php");
    }

    $objconexion = new conexion();
    $proyectos = $objconexion->consultar("SELECT * FROM `proyectos` ");

    if($_GET){
        $id = $_GET['borrar'];
        $objconexion = new conexion();
        $sql="DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$id;
        $objconexion->ejecutar($sql);
        $imagen = $objconexion->consultar("SELECT imagen FROM `proyectos` WHERE id=".$id);
        unlink("imagenes/".$imagen[0]['imagen']);
        header("location:album.php");
        
    }

?>
    <br>
    <br>
   <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Datos del proyecto
                </div>
            <div class="card-body">
                <form action="album.php" method="post" enctype="multipart/form-data">
                    Nombre del proyecto: <input class="form-control" type="text" name="nombre" id="" required>
                    <br>
                    Imagen del proyecto: <input class="form-control" type="file" name="archivo" id="" required>
                    <br>
                    Descripcion: <textarea class="form-control" name="descripcion" id="" cols="30" rows="3" required></textarea>
                    <br>
                    <button class="btn btn-success" type="submit">Enviar</button>
                </form> 
            </div>
        </div>
    </div>
    <div class="col-md-6">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($proyectos as $resultado){?>
                    <tr class="">
                        <td><?php echo $resultado['id'];?></td>
                        <td><?php echo $resultado['nombre'];?></td>
                        <td><img width="100px" src="imagenes/<?php echo $resultado['imagen'];?>" alt=""></td>
                        <td><?php echo $resultado['descripcion'];?></td>
                        <td><a class="btn btn-danger" href="?borrar=<?php echo $resultado['id'];?>">Eliminar</a></td>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
   </div>
</body>
<?php include('pie.php');?>
</html>