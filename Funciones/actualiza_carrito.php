<?php
session_start();

require "conecta.php";
$con = conecta();



if (isset($_SESSION['Userid'])) {
    $id_cliente = $_SESSION['Userid'];
    $sql = "SELECT * FROM pedidos WHERE id_cliente = $id_cliente AND status = 0";
    $res = $con->query($sql);
    $num = $res->num_rows;
    if ($num > 0) {
        $row = $res->fetch_array();
        $id_pedido = $row['id'];
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
        $res = $con->query($sql);
        $num = $res->num_rows;
        echo $num;
    }
}
?>