<?php
//funciones/verificacorreo.php
require "conecta.php";
$con = conecta();
$ban = 0;
//Recibe variables
$correo = $_REQUEST['correo'];

if ($correo) {
    //$sql = "DELETE FROM administradores WHERE id = $id";
    $sql = "SELECT * FROM administradores WHERE correo = '$correo'";
    $res = $con->query($sql);
    $rowcount = mysqli_num_rows($res);
    if ($rowcount > 0) {
        $ban = 1;
    }
    echo $ban;
    
    
    
    
}

//redireccionamiento
//header("Location: administradores_lista.php");

?>