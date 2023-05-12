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
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();
            var archivo = $('#archivo').val();
            console.log(archivo);

            if (nombre == "" || codigo == "" || descripcion == "" || costo == "" || stock == "" || archivo == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'productos_salva.php';
                document.form01.submit();
            }
        }

        function verificarcodigo(){
            var codigo = $('#codigo').val();
            console.log(codigo);
            $.ajax({
                url: "funciones/verificacodigo.php",
                type: 'post',
                dataType: 'text',
                data: 'codigo='+codigo,
                success: function res(flag){
                    console.log(flag);
                    if (flag == 1) {
                        console.log("entra");
                        $('#codigo').val('');
                        $('#alerta').html("El codigo "+codigo+" ya existe");
                        

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
        <p id="Titulo">Alta de productos</p>
        <form action="" class="formulario" name="form01" enctype="multipart/form-data">
            
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Ingrese el nombre" name="nombre" class="entrada" id="nombre">
            <br>
            <label for="codigo">Código:</label>
            <input type="text" placeholder="Ingrese el código" onblur="verificarcodigo();" name="codigo" class="entrada" id="codigo">
            <div id="alerta"></div>
            <br>
            <label for="descripcion">Descripción:</label>
            
            <textarea name="descripcion" id="descripcion" class="entrada" cols="30" rows="30"></textarea>
            <label for="costo">Costo:</label>
            <input type="text" placeholder="Ingrese el costo" name="costo" class="entrada" id="costo">
            <label for="stock">Stock:</label>
            <input type="text" placeholder="Ingrese el stock" name="stock" class="entrada" id="stock">
            <label for="archivo">Seleccionar archivo:</label>
            <input type="file" id="archivo" name="archivo">
            <input type="submit" value="Enviar" class="boton" onclick="verificarcampos(); return false;">
            <div id="mensaje"></div>
            <a href="productos_lista.php" class="boton2">Regresar al listado</a>
        </form>
        <p></p>
    </div>
</body>
</html>