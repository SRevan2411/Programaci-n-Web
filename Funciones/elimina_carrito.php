<?php
//administradores_elimina.php
require "conecta.php";
$con = conecta();
$ban = 0;
//Recibe variables
$id_producto = $_REQUEST['id_producto'];
$id_pedido = $_REQUEST['id_pedido'];

    $sql = "DELETE FROM pedidos_productos WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
    if ($res = $con->query($sql)) {
       $ban = 1;
    }
    echo $ban; 



//redireccionamiento
//header("Location: administradores_lista.php");

?>