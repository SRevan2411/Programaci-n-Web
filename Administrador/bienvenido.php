<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="css/generico.css">
</head>
<body>
    <?php
        include('menu.php');
        if ($_SESSION['idU'] == NULL) {
            header('Location: index.php');
        }
    ?>
    <div class="master">
        <h1>Hola, bienvenido al sistema de administración</h1>
        
    
    <?php
        $id = $_SESSION['idU'];
        $nombre = $_SESSION['nombre'];
        $correo = $_SESSION['correo'];
        
        echo "<h3>$nombre</h3>";
        //<a href="funciones/salir.php">Salir/Cerrar Sesion</a>
    ?>

    </div>
    
</body>
</html>