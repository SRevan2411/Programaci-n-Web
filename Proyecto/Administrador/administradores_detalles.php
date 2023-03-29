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
    <div class="master">
        <div class="contenedor2"></div>

        <div class="contenedor">
            <div class="titulo">Detalles del administrador</div>
            <?php
                $id = $_REQUEST['id'];
                $sql = "SELECT * FROM administradores WHERE id = $id";
        
                $res = $con->query($sql);
                $datos = $res->fetch_array();
                $nombre = $datos["nombre"];
                $apellidos = $datos["apellidos"];
                $correo = $datos["correo"];
                $rol = $datos["rol"];
                $rol_txt = ($rol == 1) ? "Gerente" : "Ejecutivo";
                $status = $datos["status"];
                $status_txt = ($status == 1) ? "Activo" : "Inactivo";
                echo "<div class=\"lab\">Nombre y Apellidos</div>";
                echo "<div class=\"fila\">$nombre $apellidos</div>";
                echo "<div class=\"lab\">Correo</div>";
                echo "<div class=\"fila\">$correo</div>";
                echo "<div class=\"lab\">Rol</div>";
                echo "<div class=\"fila\">$rol_txt</div>";
                echo "<div class=\"lab\">Status</div>";
                echo "<div class=\"fila\">$status_txt</div>";
                
        ?>
        <div class="fila"><a id="Enlace" class="" href="administradores_lista.php">Regresar</a></div>
        </div>
    </div>
</body>
</html>