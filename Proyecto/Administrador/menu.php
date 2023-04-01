<?php
    session_start();
    if ($_SESSION['idU'] == NULL) {
        header('Location: index.php');
    }
    $nombre = " ". $_SESSION['nombre']; 
?>

<link rel="stylesheet" href="css/menu.css">

<div class="contenedorm">
    <div class="columnam" onclick="window.location.href = 'bienvenido.php'">INICIO</div>
    <div class="columnam" onclick="window.location.href = 'administradores_lista.php'">ADMINISTRADORES</div>
    <div class="columnam">PRODUCTOS</div>
    <div class="columnam">PEDIDOS</div>
    <div class="columnam">BIENVENIDO <?php echo $nombre ?> </div>
    <div class="columnam" onclick="window.location.href = 'funciones/salir.php'">CERRAR SESION</div>
</div>
