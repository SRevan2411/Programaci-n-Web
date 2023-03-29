<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/adm_alta.css">
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
                url: "funciones/existencia.php",
                type: 'post',
                dataType: 'text',
                data: {correo : correo, pass :password},
                success: function res(flag){
                    console.log(flag);
                    if (flag == 1) {
                        console.log('entra')
                        window.location.href = 'bienvenido.php';

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
        <p></p>
    </div>
</body>
</html>