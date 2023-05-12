<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/generico.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function Carrito(){
            $.ajax({
                url: "funciones/actualiza_carrito.php",
                type: 'post',
                dataType: 'text',
                data: {},
                success: function res(flag){
                    if (flag > 0) {
                        $('#carrito').html('CARRITO ('+flag+')')
                    }
                }
            });
        }


        function verificarcampos() {
            var nombre = $('#nombretxt').val();
            var apellidos = $('#apellidostxt').val();
            var correo = $('#correotxt').val();
            var mensaje = $('#mensajetxt').val();

            if (correo == "" || apellidos == "" || correo == "" || mensaje == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                ejecutarAjax(nombre,apellidos,correo,mensaje);

            }
        }

        function ejecutarAjax(nombre,apellidos,correo,mensaje){
            console.log(correo);
            $.ajax({
                url: "Funciones/envia_correo.php",
                type: 'post',
                dataType: 'text',
                data: {nombre : nombre,apellidos:apellidos, correo :correo,mensaje:mensaje},
                success: function res(flag){
                    console.log(flag);
                    if (flag == 1) {
                        alert("Se a enviado el correo");
                        window.location.href = 'index.php';

                    }else{
                        alert("Ocurrio un problema");
                        
                    }
                    
                }


            });
        }
    </script>
</head>
<body onload="Carrito();">
    <?php
        include("menu.php");
    ?>
    <div class="separador"></div>
    <div class="contenedor">
        <p id="Titulo">Contacto</p>
        <form action="" class="formulario" name="form01">
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Ingrese su nombre" name="nombre" class="entrada" id="nombretxt">
            <label for="apellidos">Apellidos:</label>
            <input type="text" placeholder="Ingrese sus apellidos" name="apellidos" class="entrada" id="apellidostxt">
            <label for="correo">Correo:</label>
            <input type="text" placeholder="Ingrese su correo" name="correo" class="entrada" id="correotxt">
            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensajetxt" class="entrada2" cols="30" rows="20"></textarea>
            <div id="alerta"></div>
            <input type="submit" value="Enviar" class="boton" onclick="verificarcampos(); return false;">
            <div id="mensaje"></div>
        </form>
        <a class="boton2" href="index.php">Regresar</a>
        
        <p></p>
    </div>
    <br>
    <br>
    <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
</body>
</html>