<?php
        require "funciones/conecta.php";
        $con = conecta();
        $id = $_REQUEST["id"];
        $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 AND id = $id";
        $res = $con->query($sql);
        $arr = $res->fetch_array();
        $nombre = $arr["nombre"];
        $codigo = $arr["codigo"];
        $descripcion = $arr["descripcion"];
        $costo = $arr["costo"];
        $stock = $arr["stock"];
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
            var codigo = "<?php echo $codigo;?>";
            var descripcion = "<?php echo $descripcion;?>";
            var costo = "<?php echo $costo;?>";
            var stock = "<?php echo $stock;?>";
            var imagen = "<?php echo $archivo;?>";
            var path = "Imágenes/Productos/"+imagen;
            console.log(path);
            $('#identificador').val(ident);
            console.log(nom);
            $('#nombre').val(nom);
            $('#codigo').val(codigo);
            $('#descripcion').val(descripcion);
            $('#costo').val(costo);
            $('#stock').val(stock);
            $('#Imagen').attr("src",path);
            console.log(nom);
        }

        function verificarcampos(ident) {
            console.log(ident);
            var nombre = $('#nombre').val();
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();

            if (nombre == "" || codigo == "" || descripcion == "" || costo == "" || stock == "") {
                $('#mensaje').html("Faltan campos por llenar");
                setTimeout("$('#mensaje').html('');",5000);
            }else{
                document.form01.method = 'post';
                document.form01.action = 'productos_cambia.php';
                document.form01.submit();
            }
        }

        function verificarcodigo(){
            var ids = $('#identificador').val();
            var codigo = $('#codigo').val();
            console.log(codigo);
            console.log(ids);
            $.ajax({
                url: "funciones/verificacodigo.php",
                type: 'post',
                dataType: 'text',
                data: {codigo : codigo, id : ids},
                success: function res(flag){
                    
                    if (flag == 1) {
                        $('#codigo').val('');
                        $('#alerta').html("El codigo "+codigo+" ya existe");
                        
                        

                    }
                    setTimeout("$('#alerta').html('');",5000);
                }


            });
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
            <br>
            <label for="codigo" class="etiqueta">Codigo:</label>
            <input type="text" placeholder="Ingrese el codigo" onblur="verificarcodigo();"  name="codigo" class="entrada" id="codigo">
            <div id="alerta" class="etiqueta"></div>
            <br>
            <label for="descripcion" class="etiqueta">Descripcion:</label>
            
            <textarea name="descripcion" id="descripcion" class="entrada" cols="30" rows="10"></textarea>
            <label for="costo" class="etiqueta">Costo:</label>
            <input type="text" placeholder="Ingrese el costo" name="costo" class="entrada" id="costo">

            <label for="costo" class="etiqueta">Stock:</label>
            <input type="text" placeholder="Ingrese el stock" name="stock" class="entrada" id="stock">
            <label for="costo" class="etiqueta">Imagen Actual:</label>
            <img src="" alt="Imagen" id="Imagen" class="imagen">
            <label for="archivo" class="etiqueta">Editar Imagen:</label>
            <input type="file" id="archivo" name="archivo" class="etiqueta">
            
            <input type="hidden" name="identificador" id="identificador">
            <?php
            echo "<input type=\"submit\" value=\"Enviar\" class=\"boton\" onclick=\"verificarcampos($id); return false;\">"
            ?>
            <div id="mensaje" class="etiqueta"></div>
            <a href="productos_lista.php" class="boton2">Regresar al listado</a>
        </form>
        <p></p>
    </div>
</body>
</html>