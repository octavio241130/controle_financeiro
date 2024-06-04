<?php
include 'conexao.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];

    try {
       $stmt = $conn->query("SELECT * FROM lancamentos WHERE id = $id");
       $lancamento = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao editar lançamento: " . $e->getMessage();
    }
}
if (isset($_POST['fixa'])){
    $descricao = $_POST ['descricao'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $fixa = $_POST['fixa'];

    try {
        $sql = "UPDATE lancamentos SET descricao = ?, valor = ?, tipo = ?, data = ?, fixa = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$descricao, $valor, $tipo, $data,  $fixa,$id]);
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Erro ao editar lancamento: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/estilo.css">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method='post'>
    <label>descricao</label>
    <input type="text" value="<?php echo $lancamento['descricao'] ?>" name="descricao"/> <br/> <br/>
    <label>valor</label>
    <input type="text" value="<?php echo $lancamento['valor']?>" name="valor"/> <br/> <br/>
    <label>tipo</label>
    <select name="tipo">
                <option value="entrada" <?php echo ($lancamento ['tipo'] == 'entrada' ? 'selected': '')?>>entrada</option> 
                <option value="saida" <?php echo ($lancamento ['tipo'] == 'saida' ? 'selected': '')?>>saida</option> 
              </select><br> <br/>
    <label>data</label>
    <input type="text" value="<?php echo $lancamento['data'] ?>" name="data"/> <br/> <br/>
    <label>fixa</label>
    <select name="fixa"> 
                <option value="nao" <?php echo ($lancamento ['fixa'] == 'nao' ? 'selected': '')?>>nao</option> 
                <option value="sim" <?php echo ( $lancamento ['fixa'] == 'sim' ? 'selected': '')?>>sim</option> 
              </select><br>
              <input type="submit" name="submit" value="Editar Lançamentos"> 

    </form>
</body>
</html>