<?php
    $num = $_REQUEST['num'];
    $ban = 0;
    if ($num > 10) {
        $ban = 1;
    }
    echo $ban;
?>