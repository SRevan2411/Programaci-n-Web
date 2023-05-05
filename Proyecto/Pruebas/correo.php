
<?php
$para      = 'edurafperflo@gmail.com';
$titulo    = 'Prueba';
$mensaje   = 'Hola Mundo';
$cabeceras = 'From: edurafperflo2@gmail.com' . "\r\n" .
    'Reply-To: edurafperflo2@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
?>
