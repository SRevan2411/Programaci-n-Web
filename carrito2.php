<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Pedido</title>
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

        function Finalizar() {
            if (confirm("Desea Cerrar el pedido?")==true) {
                $.ajax({
                url: "funciones/cerrar_pedido.php",
                type: 'post',
                dataType: 'text',
                data: {},
                success: function res(flag){
                    if (flag = 1) {
                        alert("Pedido Cerrado");
                        window.location="index.php";
                    }
                }
            });
            }
        }
    </script>
</head>
<body onload="Carrito();">
    <?php
        include("menu.php");
        if ($_SESSION['Userid']==NULL) {
            header('Location: index.php');
        }
    ?>
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
                $existencias = $res->num_rows;
                if($existencias == 0){
                    header("Location: carrito1.php");
                }
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
                    echo"<div class=\"fila\" id=\"fila$id_producto\">";
                        echo"<div class=\"columna\">$producto</div>";
                        echo"<div class=\"columna\">$cantidad</div>";
                        
                        echo"<div class=\"columna\" id=\"prec$id_producto\">$$nformato</div>";
                        echo"<div class=\"columna\" id=\"subt$id_producto\">$$sformato</div>";
                        echo"<div class=\"columna\" ></div>";
                    echo"</div>";
                    
                }
                $gformato = number_format($grantotal,2);
                echo"<div class=\"fila\">";
                echo"<div class=\"columna\"></div>";
                echo"<div class=\"columna\"></div>";
                echo"<div class=\"columna\">TOTAL:</div>";
                echo"<div class=\"columna\" id=\"Totales\">$$gformato</div>";
                echo"<div class=\"columna\"></div>";
                echo"</div>";
                echo"<div class=\"boton\"><a href=\"javascript:void(0);\" onclick=\"Finalizar();\">Cerrar Pedido</a></div>";
                


            }else{
                echo"<div class=\"columna\">SIN PEDIDOS ABIERTOS</div>";
            }



        ?>
        

    </div>
    <center>
        <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
    </center>
</body>
    <br>
    <br>
    <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
</html>