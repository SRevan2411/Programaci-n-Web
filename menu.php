<?php
/*
    session_start();
    if ($_SESSION['idU'] == NULL) {
        header('Location: index.php');
    }
    $nombre = " ". $_SESSION['nombre']; 
    */
?>

<link rel="stylesheet" href="css/menu.css">

<div class="contenedorm">
    <div class="columnam"><img class="logo" src="Imagenes/Recursos/logo.png" alt="logo"></div>
    <div class="columnam" onclick="window.location.href = 'index.php'">HOME</div>
    <div class="columnam" onclick="window.location.href = 'listado_productos.php'">PRODUCTOS</div>
    <div class="columnam" onclick="window.location.href = 'contacto.php'">CONTACTO</div>

    <?php
        session_start();
        if (isset($_SESSION['Userid'])) {
            echo "<div onclick=\"window.location.href = 'Funciones/salir.php'\"  class=\"columnam\">CERRAR SESION</div>";
            echo "<div id=\"carrito\" class=\"columnam\" onclick=\"window.location.href = 'carrito1.php'\">CARRITO</div>";
        }else {
            echo "<div onclick=\"window.location.href = 'login.php'\" class=\"columnam\">LOG IN</div>";
            echo "<div id=\"carrito\" class=\"columnam\" onclick=\"window.location.href = 'login.php'\">CARRITO</div>";
        }
    ?>

    
    
    
</div>
