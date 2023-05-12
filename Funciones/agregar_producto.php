<?php
session_start();
require "conecta.php";
$con = conecta();
$ban = 0;
$idP = $_REQUEST['id'];
$cantidad = $_REQUEST['cantidad'];
$id_cliente = $_SESSION['Userid'];
//Pedido
$sql = "SELECT * FROM pedidos WHERE id_cliente = $id_cliente AND status = 0";
$res = $con->query($sql);
$num = $res->num_rows;
//Cantidad
$sql3 = "SELECT stock FROM productos WHERE id = $idP";
$res3 = $con->query($sql3);
$num3 = $res3->num_rows;

if ($num3) {
    $row3 = $res3->fetch_array();
    $stocks = $row3['stock'];
    if ($cantidad > $stocks) {
        echo "$ban";
        return;
    }
}

//Checar pedidos
if ($num == 0) {
    date_default_timezone_set('America/Chihuahua');
    $fecha = date('Y-m-d H:i:s');
    $sql = "INSERT into pedidos (fecha,id_cliente)
    VALUES ('$fecha',$id_cliente)";

    $res = $con->query($sql);
    $id_pedido = $con->insert_id;
}else {
    $row = $res->fetch_array();
    $id_pedido = $row['id'];
}



//Costo
$sql = "SELECT costo FROM productos WHERE id = $idP";
$res = $con->query($sql);
$num = $res->num_rows;

if ($num) {
    $row = $res->fetch_array();
    $precio = $row['costo'];
}

if ($idP) {
    //Verificar si se repite el producto
    $sql = "SELECT * FROM pedidos_productos WHERE id_producto = $idP AND id_pedido = $id_pedido";
    $res = $con->query($sql);
    $num = $res->num_rows;
    if ($num == 0) {
        $sql = "INSERT INTO pedidos_productos(id_pedido,id_producto,cantidad,precio)
        VALUES ($id_pedido,$idP,$cantidad,$precio)";
        if($con->query($sql)){
            $ban = 1;
        }
    }else{
        $sql = "UPDATE pedidos_productos SET cantidad = cantidad + $cantidad WHERE id_producto = $idP AND id_pedido = $id_pedido";
        if($con->query($sql)){
            $ban = 1;
        }
    }
    

    echo $ban; 
}
?>