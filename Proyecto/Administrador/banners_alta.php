<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de productos</title>
    <link rel="stylesheet" href="css/adm_alta.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function verificarcampos() {
            var nombre = $('#nombre').val();
            var archivo = $('#archivo').val();
            console.log(archivo);

            if (nombre == "" || archivo == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'banners_salva.php';
                document.form01.submit();
            }
        }

       
    </script>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div class="contenedor">
        <p id="Titulo">Alta de productos</p>
        <form action="" class="formulario" name="form01" enctype="multipart/form-data">
            
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Ingrese el nombre" name="nombre" class="entrada" id="nombre">
            <label for="archivo">Seleccionar archivo:</label>
            <input type="file" id="archivo" name="archivo">
            <input type="submit" value="Enviar" class="boton" onclick="verificarcampos(); return false;">
            <div id="mensaje"></div>
            <a href="banners_lista.php" class="boton2">Regresar al listado</a>
        </form>
        <p></p>
    </div>
</body>
</html>