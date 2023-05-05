<?php
//administradores_salva.php
require "./funciones/conecta.php";
$con = conecta();

//Recibe variables
$id = $_REQUEST['identificador'];
$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];
$archivo_n = $_FILES['archivo']['name']; //Nombre real del archivo
$archivo = $_FILES['archivo']['tmp_name']; //Copia del archivo que se va a subir para evitar que se dupliquen o reemplacen
if($archivo){
    $cadena = explode(".","$archivo_n"); //Separa el nombre para obtener la extension y lo mete en un array 
    $ext = end($cadena);
    $dir = "Imágenes/Productos/"; //Carpeta donde se guardan los archivos
    $file_enc = md5_file($archivo); //Nombre del archivo encriptado, cifra el contenido del archivo
}



if ($archivo_n != '') {
    $fileName1 = "$file_enc.$ext";
    copy($archivo, $dir.$fileName1);
    $sql = "UPDATE productos
    SET nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', costo = $costo, stock = $stock,archivo_n='$archivo_n',archivo='$fileName1'
    WHERE id = $id AND status = 1 AND eliminado = 0";
    $res = $con->query($sql);
    header("Location: productos_lista.php");
}else{
    $sql = "UPDATE productos
    SET nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', costo = $costo, stock = $stock
    WHERE id = $id AND status = 1 AND eliminado = 0";
    $res = $con->query($sql);
    header("Location: productos_lista.php");
}
/*
$sql = "INSERT INTO administradores
(nombre,apellidos,correo,pass,rol,archivo_n,archivo)
VALUES ('$nombre','$apellidos','$correo','$passEnc',$rol,'$archivo_n','$archivo')";

$res = $con->query($sql);

header("Location: administradores_lista.php");
*/
?>
