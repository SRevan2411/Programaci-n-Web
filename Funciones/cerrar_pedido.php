<?php
session_start();

require "conecta.php";
$con = conecta();
$id_cliente = $_SESSION['Userid'];
$ban = 0;

$sql = "UPDATE pedidos SET status = 1 WHERE id_cliente = $id_cliente";
if ($con->query($sql)) {
    $ban = 1;
   
}
echo $ban;
?>