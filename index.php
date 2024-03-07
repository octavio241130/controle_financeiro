<?php
include 'conexao.php';
echo "Bem-vindo ao Sistema de Controle Financeiro!";
?>
<!DOCTYPE html> 
<html lang="pt-br"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Controle Financeiro Pessoal</title> 
</head> 
<body>
    <h1>Controle Financeiro Pessoal</h1>
    <a href="lancamentos.php"><button>Acessar Lancamentos</button></a>
<?php
include 'conexao.php';

try{
    $stmt = $conn->query("SELECT *, MONTH(data) as mes, YEAR(data) as ano FROM lancamentos ORDER BY data DESC");
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
                </tr>";
            foreach($lancamentos as $lancamentos) {
                echo "<tr>
                <td>{$lancamentos['descricao']}</td>
                <td>R$ {$lancamentos['valor']}</td>
                <td>{$lancamentos['tipo']}</td>
                <td>" . date("d/m/Y", strtotime($lancamentos['data'])) . "</td>
                <td>{$lancamentos['fixa']}</td>
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