<?php
session_start();
require "conecta.php";
$con = conecta();
$ban = 0;
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passEnc = md5($pass);

if ($correo) {
    $sql = "SELECT * FROM administradores WHERE correo = '$correo' AND pass = '$passEnc' AND status = 1 AND eliminado = 0";
    $res = $con->query($sql);
    $rowcount = $res->num_rows;
    $row = $res->fetch_assoc();
    if ($rowcount) {
        $idU = $row['id'];
        $nombre = $row['nombre'];
        $correou = $row['correo'];
        $_SESSION['idU'] = $idU;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correou;
        $ban = 1;
    }
    echo $ban; 
}
?>