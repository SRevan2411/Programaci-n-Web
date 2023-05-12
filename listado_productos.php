<?php
    require "Funciones/conecta.php";
    $con = conecta();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script>
        

        function detalles(id){
            window.location = "detalles_producto.php?id="+id;
            
        }

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

        function Compra(id){
            console.log(id);
            var cantidad = $('#producto'+id).val();
            
            if (cantidad > 0) {
                $.ajax({
                url: "funciones/agregar_producto.php",
                type: 'post',
                dataType: 'text',
                data: {id : id, cantidad : cantidad},
                success: function res(flag){
                    
                    if (flag == 1) {
                        $('#mensaje'+id).html("Producto añadido!");
                        var tag = "$('#mensaje"+id+"')";
                        var string = tag+".html('');";
                        console.log(string);
                        setTimeout(string,5000);
                        Carrito();

                    }else{
                        alert("No hay suficiente stock");
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
    ?>
    <br>
    <div class="contenedor">
        <div class="separador"></div>
        <div class="separador"><h1>Listado de Productos</h1></div>
        <div class="separador"></div>
        <div class="columna">
        
            <div class="productos">
                <?php
                    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
                    $res = $con->query($sql);


                    while($row = $res->fetch_array()){
                        $id = $row["id"];
                        $nombre = $row["nombre"];
                        $codigo = $row["codigo"];
                        $costo = $row["costo"];
                        $imagen = $row["archivo"];
                        $almacen = $row["stock"];
                        $precio = number_format($costo,2);
                        $path = "Administrador/Imágenes/Productos/$imagen";
                        echo "<div class='objeto'> 
                        <img onclick=\"detalles($id);\" class=\"imagen\" src=\"$path\" alt=\"Imagen\">
                        <div class=''>Nombre:</div>
                        <div class=''>$nombre</div>
                        <div class=''>Codigo: $codigo</div>
                        <div class=''>Precio: $$precio</div>
                        <div class=''>Stock: $almacen</div>
                        ";
                        
                        if (isset($_SESSION['Userid'])) {
                            echo"<input type=\"text\" value=\"1\" id=\"producto$id\">";
                            echo "<a href=\"javascript:void(0);\" class='boton' onclick=\"Compra($id)\">Comprar</a>";
                            echo "<div id=\"mensaje$id\" class=''></div>";
                        }
                        echo"</div>";
                        
                    }
                ?>
                
            </div>
            <div class="separador"></div>
        </div>
    </div>
    <div class="separador"></div>
    <footer class="footer">Todos los derechos reservados 2023 | Terminos y condiciones | Política de privacidad | Redes sociales</footer>
</body>
</html>