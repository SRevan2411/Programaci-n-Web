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
        function precargarcampos(){
            var nom = "<?php echo $nombre;?>";
            var app = "<?php echo $apellidos;?>";
            var cor = "<?php echo $correo;?>";
            var roln = "<?php echo $rol;?>";

            $('#nombre').val(nom);
            $('#apellidos').val(app);
            $('#correotxt').val(cor);
            $('#rol').val(roln).change();
            console.log(nom);
        }

        function verificarcampos(ident) {
            console.log(ident);
            $('#identificador').val(ident);
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
            var correo = $('#correotxt').val();
            console.log(correo);
            $.ajax({
                url: "funciones/verificacorreo.php",
                type: 'post',
                dataType: 'text',
                data: 'correo='+correo,
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
    <div class="contenedor">
        <p id="Titulo">Editar administrador</p>
        <form action="" class="formulario" name="form01">
            <a href="administradores_lista.php">Regresar al listado</a>
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
        </form>
        <p></p>
    </div>
</body>
</html>