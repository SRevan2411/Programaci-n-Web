<?php
//administradores_salva.php
require "./funciones/conecta.php";
$con = conecta();

//Recibe variables
$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];
$archivo_n = $_FILES['archivo']['name']; //Nombre real del archivo
$archivo = $_FILES['archivo']['tmp_name']; //Copia del archivo que se va a subir para evitar que se dupliquen o reemplacen
$cadena = explode(".","$archivo_n"); //Separa el nombre para obtener la extension y lo mete en un array 
$ext = end($cadena);
$dir = "Imágenes/Productos/"; //Carpeta donde se guardan los archivos
$file_enc = md5_file($archivo); //Nombre del archivo encriptado, cifra el contenido del archivo


if ($archivo_n != '') {
    $fileName1 = "$file_enc.$ext";
    copy($archivo, $dir.$fileName1);
    $sql = "INSERT INTO productos
    (nombre,codigo,descripcion,costo,stock,archivo_n,archivo)
    VALUES ('$nombre','$codigo','$descripcion',$costo,$stock,'$archivo_n','$fileName1')";
    $res = $con->query($sql);
    header("Location: productos_lista.php");
}



?>
