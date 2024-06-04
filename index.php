<?php
include 'conexao.php';


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

echo "Bem-vindo, " . $_SESSION['usuario'];

?>
<!DOCTYPE html> 
<html lang="pt-br"> 
<head>
    <link rel="stylesheet" href="css/estilo.css"> 
    <meta charset="UTF-8"> 
    <title>Controle Financeiro Pessoal</title> 
</head> 
<body>
    <h1>Controle Financeiro Pessoal</h1>
    <a href="lancamentos.php"><button>Acessar Lancamentos</button></a>
<?php


try{
    $stmt = $conn->query("SELECT *, MONTH(data) as mes, YEAR(data) as ano FROM lancamentos ORDER BY data ASC");
    $lancamentosPorMes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $lancamentosPorMes[$row['ano']][$row['mes']][] = $row;
    }

    foreach ($lancamentosPorMes as $ano =>$meses){
        foreach ($meses as $mes => $lancamentos){
            echo "<h3>" . DateTime::createFromFormat('!m', $mes)->format('F') . " $ano</h3>";
            echo "<table border='1'>
                <tr>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Fixa</th>
                    <th>Ação</th>
                </tr>";
            foreach($lancamentos as $lancamentos) {
                echo "<tr class='{$lancamentos['tipo']}'>
                <td>{$lancamentos['descricao']}</td>
                <td>R$ {$lancamentos['valor']}</td>
                <td>{$lancamentos['tipo']}</td>
                <td>" . date("d/m/Y", strtotime($lancamentos['data'])) . "</td>
                <td>{$lancamentos['fixa']}</td>
                <td>
                <form action='editar.php' method='post'>
                <input type='hidden' name='id' value='{$lancamentos['id']}'>
                <button type='submit' name='edit'>Editar</button>
           </form>
                    <form action='delete.php' method='post'>
                         <input type='hidden' name='id' value='{$lancamentos['id']}'>
                         <button type='submit' name='delete'>Excluir</button>
                    </form>
                 </td>   
              </tr>";
           
            }
            echo "</table><br>";
        }        

    }
} catch(PDOException $e){
    echo "Erro ao consultar lancamentos: " . $e->getMessage();
}
?>
</body>