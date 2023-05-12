<?php
        require "funciones/conecta.php";
        $con = conecta();
        $id = $_REQUEST["id"];
        $sql = "SELECT * FROM banners WHERE status = 1 AND eliminado = 0 AND id = $id";
        $res = $con->query($sql);
        $arr = $res->fetch_array();
        $nombre = $arr["nombre"];
        $archivo = $arr["archivo"];
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar administrador</title>
    <link rel="stylesheet" href="css/adm_alta.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function precargarcampos2(){
            var ident = "<?php echo $id;?>";
            console.log(ident);
            var nom = "<?php echo $nombre;?>";
            var imagen = "<?php echo $archivo;?>";
            var path = "Imágenes/Banners/"+imagen;
            console.log(path);
            $('#identificador').val(ident);
            console.log(nom);
            $('#nombre').val(nom);
            $('#Imagen').attr("src",path);
            console.log(nom);
        }

        function verificarcampos(ident) {
            console.log(ident);
            var nombre = $('#nombre').val();
            if (nombre == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'banners_cambia.php';
                document.form01.submit();
            }
        }

        
    </script>
</head>
<body onload="precargarcampos2()">
    <?php
        include('menu.php');
    ?>
    <div class="contenedor">
        <p id="Titulo">Edición de productos</p>
        <form action="" class="formulario" name="form01" enctype="multipart/form-data">
            
            <label for="nombre" class="etiqueta">Nombre:</label>
            <input type="text" placeholder="Ingrese el nombre" name="nombre" class="entrada" id="nombre">
            
            <label for="imagen" class="etiqueta">Imagen Actual:</label>
            <img src="" alt="Imagen" id="Imagen" class="imagen">
            <label for="archivo" class="etiqueta">Editar Imagen:</label>
            <input type="file" id="archivo" name="archivo" class="etiqueta">
            
            <input type="hidden" name="identificador" id="identificador">
            <?php
            echo "<input type=\"submit\" value=\"Enviar\" class=\"boton\" onclick=\"verificarcampos($id); return false;\">"
            ?>
            <div id="mensaje" class="etiqueta"></div>
            <a href="banners_lista.php" class="boton2">Regresar al listado</a>
        </form>
        <p></p>
    </div>
</body>
</html>