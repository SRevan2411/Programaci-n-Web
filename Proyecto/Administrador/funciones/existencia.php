<?php
require "conecta.php";
$con = conecta();
$ban = 0;
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passEnc = md5($pass);

if ($correo) {
    $sql = "SELECT * FROM administradores WHERE correo = '$correo' AND pass = '$passEnc' AND status = 1 AND eliminado = 0";
    $res = $con->query($sql);
    $rowcount = mysqli_num_rows($res);
    if ($rowcount > 0) {
        $ban = 1;
    }
    echo $ban; 
}
?>