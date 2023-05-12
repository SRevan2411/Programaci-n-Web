<?php
//funciones/verificacorreo.php
require "conecta.php";
$con = conecta();
$ban = 0;
//Recibe variables

$correo = $_REQUEST['correo'];

if ($correo) {
    //$sql = "DELETE FROM administradores WHERE id = $id";
    if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
    {
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM administradores WHERE correo = '$correo' AND id != $id AND status = 1 AND eliminado = 0";
    }else{
        $sql = "SELECT * FROM administradores WHERE correo = '$correo' AND status = 1 AND eliminado = 0";
    }
    
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