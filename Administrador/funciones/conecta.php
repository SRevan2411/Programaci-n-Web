<?php
// Ubicacion del archivo
// funciones/conecta.php
define("HOST",'localhost');
define("BD", 'cliente01');
define("USER_BD",'root');
define("PASS_BD",'');

function conecta(){
    //host que se quiere conectar, usuario y su contrasenia y la base de datos
    $con = new mysqli(HOST,USER_BD,PASS_BD,BD);
    return $con;
}
?>