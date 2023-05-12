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
        function verificarcampos() {
            var correo = $('#correotxt').val();
            var password = $('#password').val();

            if (correo == "" || password == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                ejecutarAjax(correo,password);

            }
        }

        function ejecutarAjax(correo,password){
            console.log(correo);
            $.ajax({
                url: "Funciones/existencia.php",
                type: 'post',
                dataType: 'text',
                data: {correo : correo, pass :password},
                success: function res(flag){
                    console.log(flag);
                    if (flag == 1) {
                        console.log('entra')
                        window.location.href = 'index.php';

                    }else{
                        $('#correotxt').val("");
                        $('#password').val("");
                        $('#mensaje').html('El usuario no existe');
                        setTimeout("$('#mensaje').html('');",5000);
                    }
                    
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
        <p id="Titulo">Login</p>
        <form action="" class="formulario" name="form01">
            <label for="correo">Correo:</label>
            <input type="text" placeholder="Ingrese su correo" name="correo" class="entrada" id="correotxt">
            <div id="alerta"></div>
            <label for="pass">Contraseña:</label>
            <input type="password" placeholder="Ingrese su contraseña" name="pass" class="entrada" id="password">
            <input type="submit" value="Enviar" class="boton" onclick="verificarcampos(); return false;">
            <div id="mensaje"></div>
        </form>
        <a href="index.php">Regresar</a>
        <a href="registro.php">No tienes cuenta? Crea una</a>
        <p></p>
    </div>
    <br>
    <br>
    <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
</body>
</html>