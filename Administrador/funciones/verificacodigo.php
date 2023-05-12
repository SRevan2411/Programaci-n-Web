<?php
//funciones/verificacorreo.php
require "conecta.php";
$con = conecta();
$ban = 0;
//Recibe variables

$codigo = $_REQUEST['codigo'];

if ($codigo) {
    if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
    {
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM productos WHERE codigo = '$codigo' AND id != $id AND status = 1 AND eliminado = 0";
    }else{
        $sql = "SELECT * FROM productos WHERE codigo = '$codigo' AND status = 1 AND eliminado = 0";
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