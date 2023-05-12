<?php
        require "funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
        $res = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="css/prod_lista.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function ejecutarAjax(ident){
            if (confirm("Desea eliminar el campo seleccionado?")==true) {
                $.ajax({
                    url :'productos_elimina.php',
                    type: 'post',
                    dataType : 'text',
                    data : 'id='+ident,
                    success : function(res){
                        
                        if (res == 1) {
                            $('#fila'+ident).hide();
                        }else{
                            alert('A ocurrido un error');
                        }
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
            }
            
        }
    </script>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <br>
    <div class="contenedor">
        <div class="header">
            <div class="hitem" id="hitem1"> Listado de productos</div>
        </div>
        <br>
        <div class="hitem" id="hitem2"> <a href="productos_alta.php">Crear nuevo registro</a> </div>
        <br>
        <div class="fila" id="cabecera">
            <div class="titulo b">ID</div>
            <div class="titulo">Nombre</div>
            <div class="titulo">Codigo</div>
            <div class="titulo">Costo</div>
            <div class="titulo">Stock</div>
            <div class="titulo"></div>
            <div class="titulo"></div>
            <div class="titulo f"></div>
        </div>
        <!-- Obtener datos y desplegar tabla -->
        <?php
        while($row = $res->fetch_array()){
            $id = $row["id"];
            $nombre = $row["nombre"];
            $codigo = $row["codigo"];
            $costo = $row["costo"];
            $stock = $row["stock"];
            
            $precios = number_format($costo,2);
           
            echo "<div class= 'fila' id='fila$id'>";
            echo "<div class='columna'> $id</div>";
            echo "<div class='columna'> $nombre</div>";
            echo "<div class='columna'> $codigo</div>";
            echo "<div class='columna'> $$precios</div>";
            echo "<div class='columna'> $stock</div>";
            echo "<div class='columna'>";
                echo "<a href=\"javascript:void(0);\" class='boton' onclick=\"ejecutarAjax($id)\">Eliminar</a>";
            echo "</div>";

            echo "<div class = 'columna'>";
                echo "<a href=\"productos_detalles.php?id=$id\" class='boton2'>Ver Detalles</a>";
            echo "</div>";
            echo "<div class = 'columna'>";
                echo "<a href=\"productos_editar.php?id=$id\" class='boton3'>Editar</a>";
            echo "</div>";
            echo "</div>";
            
        }
        ?>
    </div>
</body>
</html>