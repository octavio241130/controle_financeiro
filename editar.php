<?php

if (isset ($_POST['edit'])) {
    $id = $_POST [ 'id'];
    header( "Location: editar_lancamentos.php?id=$id");
    exit();
} else {
    echo "id do lancamentos não foi recebido";
}
?>