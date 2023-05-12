<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del pedido</title>
    <link rel="stylesheet" href="css/ped_detalles.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
         function Regresar(){
            window.location = "pedidos_lista.php";
         }
    </script>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div class="Tabla">
        <div class="fila">
            <div class="columnaT" id="begin">PRODUCTO</div>
            <div class="columnaT">CANTIDAD</div>
            <div class="columnaT">PRECIO UNITARIO</div>
            <div class="columnaT" id="end">SUBTOTAL</div>
            
        </div>
        <?php
            require "funciones/conecta.php";
            $con = conecta();
            
            
            $id_pedido = $_REQUEST['id'];

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
                    echo"<div class=\"fila\" id=\"fila$id_producto\">";
                        echo"<div class=\"columna\">$producto</div>";
                        echo"<div class=\"columna\">$cantidad</div>";
                        echo"<div class=\"columna\" id=\"prec$id_producto\">$$nformato</div>";
                        echo"<div class=\"columna\" id=\"subt$id_producto\">$$sformato</div>";
                    echo"</div>";
                    
                }
                $gformato = number_format($grantotal,2);
                echo"<div class=\"fila\">";
                echo"<div class=\"columna\"></div>";
                echo"<div class=\"columna\"></div>";
                echo"<div class=\"columna\">TOTAL:</div>";
                echo"<div class=\"columna\" id=\"Totales\">$$gformato</div>";
                
                echo"</div>";
                
                echo"<div class=\"boton\"><a href=\"javascript:void(0);\" onclick=\"Regresar();\">Regresar</a></div>";
                


        ?>
        

    </div>
    
</body>
    
</html>