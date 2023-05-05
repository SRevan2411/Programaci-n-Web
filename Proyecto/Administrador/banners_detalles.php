<?php
        require "funciones/conecta.php";
        $con = conecta();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver detalles</title>
    <link rel="stylesheet" href="css/adm_detalles.css">
</head>
<body>
    <?php
        include('menu.php')
    ?>
    <div class="master">
        <div class="contenedor2">
            <?php
                $id = $_REQUEST['id'];
                $sql = "SELECT * FROM banners WHERE id = $id AND status = 1 AND eliminado = 0";
                $res = $con->query($sql);
                $datos = $res->fetch_array();
                $archivo = $datos['archivo'];
                $path = "Imágenes/Banners/$archivo";
                echo "<img class=\"imagen\" src=\"$path\" alt=\"Imagen\">"
            ?>
        </div>

        <div class="contenedor">
            <div class="titulo">Detalles del banner</div>
            <?php
                $id = $_REQUEST['id'];
                $sql = "SELECT * FROM banners WHERE id = $id AND status = 1 AND eliminado = 0";
        
                $res = $con->query($sql);
                $datos = $res->fetch_array();
                $nombre = $datos["nombre"];
                
                echo "<div class=\"lab\">Nombre</div>";
                echo "<div class=\"fila\">$nombre</div>";
                
                
        ?>
        <div class="fila"><a id="Enlace" class="" href="banners_lista.php">Regresar</a></div>
        </div>
    </div>
</body>
</html>