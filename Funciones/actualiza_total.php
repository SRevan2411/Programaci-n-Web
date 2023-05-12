<?php
session_start();

require "conecta.php";
$con = conecta();
$id_pedido = $_REQUEST['id_pedido'];
$id_producto = $_REQUEST['id_producto'];
$cantidad = $_REQUEST['cantidad'];

if($cantidad >0){
    $sql = "UPDATE pedidos_productos SET cantidad = $cantidad WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
    $con->query($sql);
}


$sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
$res = $con->query($sql);
$grantotal = 0;
while ($row = $res->fetch_array()) {
    $cantidad = $row['cantidad'];
    $precio = $row['precio'];
    $subtotal = $precio * $cantidad;
    $grantotal = $grantotal + $subtotal;
}

echo $grantotal;

?>