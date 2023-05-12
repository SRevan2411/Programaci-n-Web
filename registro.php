<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de usuarios</title>
    <link rel="stylesheet" href="css/generico.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function verificarcampos() {
            var nombre = $('#nombre').val();
            var correo = $('#correotxt').val();
            var password = $('#password').val();
           

            if (nombre == "" ||  correo == "" || password == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'Funciones/usuarios_salva.php';
                document.form01.submit();
            }
        }

        function verificarcorreo(){
            var correo = $('#correotxt').val();
            console.log(correo);
            $.ajax({
                url: "Funciones/verificacorreo.php",
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
        if (isset($_SESSION['Userid'])) {
            header('Location: index.php');
        }
    ?>
    <div class="separador"></div>
    <div class="contenedor">
        <p id="Titulo">Alta de usuarios</p>
        <form action="" class="formulario" name="form01">
            
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Ingrese su nombre" name="nombre" class="entrada" id="nombre">
            <br>
            <label for="correo">Correo:</label>
            <input type="text" placeholder="Ingrese su correo" onblur="verificarcorreo();" name="correo" class="entrada" id="correotxt">
            <div id="alerta"></div>
            <label for="pass">Contraseña:</label>
            <input type="password" placeholder="Ingrese su contraseña" name="pass" class="entrada" id="password">
            
            <input type="submit" value="Enviar" class="boton" onclick="verificarcampos(); return false;">
            <div id="mensaje"></div>
            <a href="index.php" class="boton2">Regresar</a>
        </form>
        <p></p>
    </div>
    <br>
    <br>
    <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
</body>
</html>