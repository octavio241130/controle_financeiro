<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname ="controle_financeiro";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$dbname", $usuario, $senha);

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "<br/>";
}catch(PDOException $e){
    echo "Conexão falhou: " . $e->getMessage();
}
?>