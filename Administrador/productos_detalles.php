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
                $sql = "SELECT * FROM productos WHERE id = $id";
                $res = $con->query($sql);
                $datos = $res->fetch_array();
                $archivo = $datos['archivo'];
                $path = "Imágenes/Productos/$archivo";
                echo "<img class=\"imagen\" src=\"$path\" alt=\"Imagen\">"
            ?>
        </div>

        <div class="contenedor">
            <div class="titulo">Detalles del producto</div>
            <?php
                $id = $_REQUEST['id'];
                $sql = "SELECT * FROM productos WHERE id = $id";
        
                $res = $con->query($sql);
                $datos = $res->fetch_array();
                $nombre = $datos["nombre"];
                $codigo = $datos["codigo"];
                $descripcion = $datos["descripcion"];
                $costo = $datos["costo"];
                $stock = $datos["stock"];
                $status = $datos["status"];
                $precios = number_format($costo,2);
                $status_txt = ($status == 1) ? "Activo" : "Inactivo";
                echo "<div class=\"lab\">Nombre</div>";
                echo "<div class=\"fila\">$nombre</div>";
                echo "<div class=\"lab\">Codigo</div>";
                echo "<div class=\"fila\">$codigo</div>";
                echo "<div class=\"lab\">Descripcion</div>";
                echo "<div class=\"fila\">$descripcion</div>";
                echo "<div class=\"lab\">Costo</div>";
                echo "<div class=\"fila\">$$precios</div>";
                echo "<div class=\"lab\">Stock</div>";
                echo "<div class=\"fila\">$stock</div>";
                echo "<div class=\"lab\">Status</div>";
                echo "<div class=\"fila\">$status_txt</div>";
                
        ?>
        <div class="fila"><a id="Enlace" class="" href="productos_lista.php">Regresar</a></div>
        </div>
    </div>
</body>
</html>