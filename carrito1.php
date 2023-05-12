<?php
    session_start();
    if ($_SESSION['Userid']==NULL) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/carrito.css">
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

        function Formato(gtotal){
            $.ajax({
                url: "funciones/formato.php",
                type: 'post',
                dataType: 'text',
                data: {subtotal:gtotal},
                success: function res(formato){
                    $('#Totalisimo').html('$'+formato);
                }
            });
        }

        function ActualizarTotal(id_pedido,id_producto,cantidad){
            
            $.ajax({
                url: "funciones/actualiza_total.php",
                type: 'post',
                dataType: 'text',
                data: {id_pedido:id_pedido,id_producto:id_producto,cantidad:cantidad},
                success: function res(formato){
                    $('#Totalisimo').attr('data',formato);
                    Formato(formato);
                }
            });
            
            
            

        }

        function ModificaCantidad(id,pedido){
            var valor = $('#cant'+id).val();
            var precio = $('#prec'+id).attr('data');
            var subtotal = valor * precio;

            $('#subt'+id).attr('data',subtotal);
            

            $.ajax({
                url: "funciones/formato.php",
                type: 'post',
                dataType: 'text',
                data: {subtotal:subtotal},
                success: function res(formato){
                    $('#subt'+id).html('$'+formato);
                    ActualizarTotal(pedido,id,valor);
                }
            });
        }



        function Eliminar(id_producto,id_pedido) {
            console.log(id_pedido);
            if (confirm("Desea eliminar el campo seleccionado?")==true) {
                $.ajax({
                    url :'funciones/elimina_carrito.php',
                    type: 'post',
                    dataType : 'text',
                    data : {id_pedido:id_pedido,id_producto:id_producto},
                    success : function(res){
                        
                        if (res == 1) {
                            $('#fila'+id_producto).hide();
                            ActualizarTotal(id_pedido,id_producto,0);
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
    <script>
        function Continuar(id_pedido){
            $.ajax({
                url: "funciones/existencia_carrito.php",
                type: 'post',
                dataType: 'text',
                data: {id_pedido:id_pedido},
                success: function res(totales){
                    if (totales > 0) {
                        window.location = "carrito2.php";
                    }else{
                        alert("Agregue algo al carrito");
                    }

                }
            });




            
            
        }
    </script>
</head>
<body onload="Carrito();">
    
    <div class="contenedorm">
    <div class="columnam"><img class="logo" src="Imagenes/Recursos/logo.png" alt="logo"></div>
    <div class="columnam" onclick="window.location.href = 'index.php'">HOME</div>
    <div class="columnam" onclick="window.location.href = 'listado_productos.php'">PRODUCTOS</div>
    <div class="columnam" onclick="window.location.href = 'contacto.php'">CONTACTO</div>

    <?php
        
        if (isset($_SESSION['Userid'])) {
            echo "<div onclick=\"window.location.href = 'Funciones/salir.php'\"  class=\"columnam\">CERRAR SESION</div>";
            echo "<div id=\"carrito\" class=\"columnam\" onclick=\"window.location.href = 'carrito1.php'\">CARRITO</div>";
        }else {
            echo "<div onclick=\"window.location.href = 'login.php'\" class=\"columnam\">LOG IN</div>";
            echo "<div id=\"carrito\" class=\"columnam\" onclick=\"window.location.href = 'login.php'\">CARRITO</div>";
        }
    ?>

    
    
    
</div>
    <div class="Titulos">
        <div class="Usuarios">
            <?php
        
            if (isset($_SESSION['Userid'])) {
                $nombre = $_SESSION['nombreU'];
                echo "Carrito de: $nombre";
                
            }
    ?>

        </div>
    </div>
    <br>
    <div class="Tabla">
        <div class="fila">
            <div class="columnaT" id="begin">PRODUCTO</div>
            <div class="columnaT">CANTIDAD</div>
            <div class="columnaT">PRECIO UNITARIO</div>
            <div class="columnaT">SUBTOTAL</div>
            <div class="columnaT" id="end"></div>
        </div>
        <?php
            require "Funciones/conecta.php";
            $con = conecta();
            $id_cliente = $_SESSION['Userid'];
            $sql = "SELECT * FROM pedidos WHERE id_cliente = $id_cliente AND status = 0";
            $res = $con->query($sql);
            $num = $res->num_rows;
            if($num > 0){
                $row = $res->fetch_array();
                $id_pedido = $row['id'];

                $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
                $res = $con->query($sql);
                $grantotal = 0;
                while ($row = $res->fetch_array()) {
                    $id_producto = $row['id_producto'];
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    $sql = "SELECT * FROM productos WHERE id = $id_producto";
                    $res2 = $con->query($sql);
                    $row2 = $res2->fetch_array();
                    $producto = $row2['nombre'];
                    $subtotal = $precio * $cantidad;
                    $grantotal = $grantotal + $subtotal;
                    $nformato = number_format($precio,2);
                    $sformato = number_format($subtotal,2);
                    $stock = $row2['stock'];
                    echo"<div class=\"fila\" id=\"fila$id_producto\">";
                        echo"<div class=\"columna\">$producto</div>";
                        echo"<div class=\"columna\" id=\"\">
                        <select name=\"cantidades\" id=\"cant$id_producto\" >
                            <option value=\"none\" selected disabled hidden>$cantidad</option>";
                            for($i = 1; $i <= $stock; $i++){
                                echo"<option value=\"$i\" onclick=\"ModificaCantidad($id_producto,$id_pedido);\">$i</option>";
                            }
                        echo"</select>";
                        echo"</div>";
                        echo"<div class=\"columna\" id=\"prec$id_producto\" data=\"$precio\">$$nformato</div>";
                        echo"<div class=\"columna\" id=\"subt$id_producto\" data=\"$subtotal\">$$sformato</div>";
                        echo"<div class=\"columna\" ><a class=\"boton2\" href=\"javascript:void(0);\"  onclick=\"Eliminar($id_producto,$id_pedido)\">Eliminar</a></div>";
                    echo"</div>";
                    
                }
                $gformato = number_format($grantotal,2);
                echo"<div class=\"fila\">";
                echo"<div class=\"columna\"></div>";
                echo"<div class=\"columna\"></div>";
                echo"<div class=\"columna\">TOTAL:</div>";
                echo"<div class=\"columna\" id=\"Totalisimo\" data=\"$grantotal\">$$gformato</div>";
                echo"<div class=\"columna\"></div>";
                echo"</div>";
                echo"<div class=\"boton\"><a href=\"javascript:void(0);\"  onclick=\"Continuar($id_pedido);\">Continuar</a></div>";
                


            }else{
                echo"<div class=\"columna\">SIN PEDIDOS ABIERTOS</div>";
            }



        ?>
        

    </div>
    <br>
    <br>
    <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
</body>
</html>