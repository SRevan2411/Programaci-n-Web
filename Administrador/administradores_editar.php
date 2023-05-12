<?php
        require "funciones/conecta.php";
        $con = conecta();
        $id = $_REQUEST["id"];
        $sql = "SELECT * FROM administradores WHERE status = 1 AND eliminado = 0 AND id = $id";
        $res = $con->query($sql);
        $arr = $res->fetch_array();
        $nombre = $arr["nombre"];
        $apellidos = $arr["apellidos"];
        $correo = $arr["correo"];
        $rol = $arr["rol"];
        $archivo = $arr["archivo"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar administrador</title>
    <link rel="stylesheet" href="css/adm_edita.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function precargarcampos(){
            var ident = "<?php echo $id;?>";
            var nom = "<?php echo $nombre;?>";
            var app = "<?php echo $apellidos;?>";
            var cor = "<?php echo $correo;?>";
            var roln = "<?php echo $rol;?>";
            var imagen = "<?php echo $archivo;?>";
            var path = "Imágenes/"+imagen;
            $('#identificador').val(ident);
            console.log(nom);
            $('#nombre').val(nom);
            $('#apellidos').val(app);
            $('#correotxt').val(cor);
            $('#rol').val(roln).change();
            $('#Imagen').attr("src",path);
            console.log(nom);
        }

        function verificarcampos(ident) {
            console.log(ident);
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correotxt').val();
            var password = $('#password').val();
            var rol = $('#rol').val();

            if (nombre == "" || apellidos == "" || correo == "" || rol == 0) {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'administradores_cambia.php';
                document.form01.submit();
            }
        }

        function verificarcorreo(){
            var ids = $('#identificador').val();
            var correo = $('#correotxt').val();
            console.log(correo);
            $.ajax({
                url: "funciones/verificacorreo.php",
                type: 'post',
                dataType: 'text',
                data: {correo : correo, id : ids},
                success: function res(flag){
                    if (flag == 1) {
                        $('#correotxt').val('');
                        $('#alerta').html("El correo "+correo+" ya existe");
                        

                    }
                    setTimeout("$('#alerta').html('');",5000);
                }


            });
        }
    </script>
</head>
<body onload="precargarcampos();">
    <?php
        include('menu.php');
    ?>
    <div class="contenedor">
        <p id="Titulo">Edición de administradores</p>
        <form action="" class="formulario" name="form01" enctype="multipart/form-data">
            
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Ingrese su nombre" name="nombre" class="entrada" id="nombre">
            <br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" placeholder="Ingrese sus apellidos" name="apellidos" class="entrada" id="apellidos" value="<?php echo $apellidos;?>">
            <br>
            <label for="correo">Correo:</label>
            <input type="text" placeholder="Ingrese su correo" onblur="verificarcorreo();" name="correo" class="entrada" id="correotxt" value="<?php echo $correo;?>">
            <div id="alerta"></div>
            <label for="pass">Contraseña:</label>
            <input type="password" placeholder="Ingrese su contraseña" name="pass" class="entrada" id="password">
            <label for="imagen" class="etiqueta">Imagen Actual:</label>
            <img src="" alt="Imagen" id="Imagen" class="imagen">
            <label for="archivo">Editar Imagen:</label>
            <input type="file" id="archivo" name="archivo">
            <label for="rol">Rol</label>
            <select name="rol" id="rol">
                <option value="0">Selecciona</option>
                <option value="1">Gerente</option>
                <option value="2">Ejecutivo</option>
            </select>
            <input type="hidden" name="identificador" id="identificador">
            <?php
            echo "<input type=\"submit\" value=\"Enviar\" class=\"boton\" onclick=\"verificarcampos($id); return false;\">"
            ?>
            <div id="mensaje"></div>
            <a href="administradores_lista.php" class="boton2">Regresar al listado</a>
        </form>
        <p></p>
    </div>
</body>
</html>