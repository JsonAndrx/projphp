<?php include('cabecera.php');?>
<?php include('conexion.php');?>
<?php
    $objconexion = new conexion();
    $proyectos = $objconexion->consultar("SELECT * FROM `proyectos` ")
?>

    <div class="p-5 bg-ligth">
        <h1 class="display-4">Bienvenido</h1>
        <p class="lead">Este es un portafolio</p>
        <hr class="my-4">
        <div class="row row-cols-2 row-cols-md-3 g-4">
            <?php foreach($proyectos as $resultado) {?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="imagenes/<?php echo $resultado['imagen'];?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $resultado['nombre'];?></h5>
                            <p class="card-text"><?php echo $resultado['descripcion'];?></p>
                        </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>