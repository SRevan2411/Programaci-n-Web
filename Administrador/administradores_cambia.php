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
$archivo_n = $_FILES['archivo']['name']; //Nombre real del archivo
$archivo = $_FILES['archivo']['tmp_name']; //Copia del archivo que se va a subir para evitar que se dupliquen o reemplacen
if($archivo){
    $cadena = explode(".","$archivo_n"); //Separa el nombre para obtener la extension y lo mete en un array 
    $ext = end($cadena);
    $dir = "Imágenes/"; //Carpeta donde se guardan los archivos
    $file_enc = md5_file($archivo); //Nombre del archivo encriptado, cifra el contenido del archivo
}
if ($pass) {
    $passEnc = md5($pass);
}



if ($archivo_n != '' && $pass != '') {
    $fileName1 = "$file_enc.$ext";
    copy($archivo, $dir.$fileName1);
    $sql = "UPDATE administradores
    SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', rol = $rol,archivo_n='$archivo_n',archivo='$fileName1'
    WHERE id = $id";
    $res = $con->query($sql);
    header("Location: administradores_lista.php");
}else if ($archivo_n != '' && $pass == '') {
    $fileName1 = "$file_enc.$ext";
    copy($archivo, $dir.$fileName1);
    $sql = "UPDATE administradores
    SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = $rol,archivo_n='$archivo_n',archivo='$fileName1'
    WHERE id = $id";
    $res = $con->query($sql);
    header("Location: administradores_lista.php");
}

else if ($pass != '' && $archivo == '') {
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
