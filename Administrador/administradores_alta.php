<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de administradores</title>
    <link rel="stylesheet" href="css/adm_alta.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function verificarcampos() {
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correotxt').val();
            var password = $('#password').val();
            var rol = $('#rol').val();
            var archivo = $('#archivo').val();
            console.log(archivo);

            if (nombre == "" || apellidos == "" || correo == "" || password == "" || rol == 0 || archivo == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'administradores_salva.php';
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
                    console.log(flag);
                    if (flag == 1) {
                        console.log("entra");
                        $('#correotxt').val('');
                        $('#alerta').html("El correo "+correo+" ya existe");
                        

                    }
                    setTimeout("$('#alerta').html('');",5000);
                }


            });
        }
    </script>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div class="contenedor">
        <p id="Titulo">Alta de administradores</p>
        <form action="" class="formulario" name="form01" enctype="multipart/form-data">
            
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Ingrese su nombre" name="nombre" class="entrada" id="nombre">
            <br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" placeholder="Ingrese sus apellidos" name="apellidos" class="entrada" id="apellidos">
            <br>
            <label for="correo">Correo:</label>
            <input type="text" placeholder="Ingrese su correo" onblur="verificarcorreo();" name="correo" class="entrada" id="correotxt">
            <div id="alerta"></div>
            <label for="pass">Contraseña:</label>
            <input type="password" placeholder="Ingrese su contraseña" name="pass" class="entrada" id="password">
            <label for="archivo">Seleccionar archivo:</label>
            <input type="file" id="archivo" name="archivo">
            <label for="rol">Rol</label>
            <select name="rol" id="rol">
                <option value="0">Selecciona</option>
                <option value="1">Gerente</option>
                <option value="2">Ejecutivo</option>
            </select>
            <input type="submit" value="Enviar" class="boton" onclick="verificarcampos(); return false;">
            <div id="mensaje"></div>
            <a href="administradores_lista.php" class="boton2">Regresar al listado</a>
        </form>
        <p></p>
    </div>
</body>
</html>