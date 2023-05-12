<?php
        require "funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT * FROM pedidos WHERE status = 1";
        $res = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <title>Listado de pedidos</title>
    <link rel="stylesheet" href="css/ped_lista.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function ejecutarAjax(ident){
            if (confirm("Desea eliminar el campo seleccionado?")==true) {
                $.ajax({
                    url :'administradores_elimina.php',
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
            <div class="hitem" id="hitem1"> Listado de pedidos</div>
        </div>
        <br>
        <br>
        <div class="fila" id="cabecera">
            <div class="titulo b">ID</div>
            <div class="titulo">FECHA</div>
            <div class="titulo">ID_CLIENTE</div>
            <div class="titulo">STATUS</div>
            <div class="titulo f"></div>
        </div>
        <!-- Obtener datos y desplegar tabla -->
        <?php
        while($row = $res->fetch_array()){
            $id = $row["id"];
            $fecha = $row["fecha"];
            $id_cliente = $row["id_cliente"];
            $status = $row["status"];
            

            
            echo "<div class= 'fila' id='fila$id'>";
            echo "<div class='columna'> $id</div>";
            echo "<div class='columna'> $fecha</div>";
            echo "<div class='columna'> $id_cliente</div>";
            echo "<div class='columna'> $status</div>";
            echo "<div class = 'columna'>";
                echo "<a href=\"pedidos_detalles.php?id=$id\" class='boton2'>Ver Detalles</a>";
            echo "</div>";
            echo "</div>";
            
        }
        ?>
    </div>
</body>
</html>