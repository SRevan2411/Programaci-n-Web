<?php
//administradores_salva.php
require "./funciones/conecta.php";
$con = conecta();

//Recibe variables
$id = $_REQUEST['identificador'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$archivo_n = '';
$archivo = '';



if ($pass != '') {
    $passEnc = md5($pass);
    $sql = "UPDATE administradores
    SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', rol = $rol
    WHERE id = $id";
    $res = $con->query($sql);
    header("Location: administradores_lista.php");
    
}else{
    $sql = "UPDATE administradores
    SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo',rol = $rol
    WHERE id = $id";
    $res = $con->query($sql);
    header("Location: administradores_lista.php");
}
/*
$sql = "INSERT INTO administradores
(nombre,apellidos,correo,pass,rol,archivo_n,archivo)
VALUES ('$nombre','$apellidos','$correo','$passEnc',$rol,'$archivo_n','$archivo')";

$res = $con->query($sql);

header("Location: administradores_lista.php");
*/
?>
