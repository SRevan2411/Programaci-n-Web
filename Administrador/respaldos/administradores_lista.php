<?php
        require "funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT * FROM administradores WHERE status = 1 AND eliminado = 0";
        $res = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <title>Listado de administradores</title>
    <link rel="stylesheet" href="css/adm_lista.css">
</head>
<body>
    <div class="contenedor">
        <div class="header">
            <div class="hitem" id="hitem1"> Listado de administradores</div>
        </div>
        <br>
        <div class="hitem" id="hitem2"> <a href="administradores_alta.php">Crear nuevo registro</a> </div>
        <br>
        <div class="fila" id="cabecera">
            <div class="titulo b">ID</div>
            <div class="titulo">Nombre Completo</div>
            <div class="titulo">Correo</div>
            <div class="titulo">Rol</div>
            <div class="titulo f">Acción</div>
        </div>
        <!-- Obtener datos y desplegar tabla -->
        <?php
        while($row = $res->fetch_array()){
            $id = $row["id"];
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $correo = $row["correo"];
            $rol = $row["rol"];
            $nombrecompleto = $nombre." ".$apellidos;

            $rol_txt = ($rol == 1) ? "Gerente" : "Ejecutivo";
            echo "<div class= 'fila'>";
            echo "<div class='columna'> $id</div>";
            echo "<div class='columna'> $nombrecompleto</div>";
            echo "<div class='columna'> $correo</div>";
            echo "<div class='columna'> $rol_txt</div>";
            echo "<div class='columna'>";
                echo "<a href=\"administradores_elimina.php?id=$id\" class='boton' onclick=\"return confirm('Desea eliminar el registro?')\">Eliminar</a>";
            echo "</div>";
            echo "</div>";
            
        }
        ?>
    </div>
</body>
</html>