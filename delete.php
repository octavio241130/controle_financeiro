<?php
include 'conexao.php';


if (isset($_POST['delete'])){
    $id = $_POST ['id'];

    try {
        $sql = "DELETE FROM lancamentos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("Location: index.php");
        exit();
         } catch (PDOException $e) {
       echo "Erro ao excluir lancamentos: " . $e->getMessage();
    }
}
?>