<?php
//administradores_elimina.php
require "./funciones/conecta.php";
$con = conecta();
$ban = 0;
//Recibe variables
$id = $_REQUEST['id'];

if ($id > 0) {
    //$sql = "DELETE FROM administradores WHERE id = $id";
    $sql = "UPDATE administradores SET eliminado = 1 WHERE id = $id";
    if ($res = $con->query($sql)) {
       $ban = 1;
    }
    echo $ban; 
    
    
    
}

//redireccionamiento
//header("Location: administradores_lista.php");

?>
