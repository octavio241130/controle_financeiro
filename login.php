<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE login = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usuario, $senha]);
    $usuarioEncontrado = $stmt->fetch();

    if ($usuarioEncontrado) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="css/estilo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="usuario">Usuário:</label>
        <input typeF"text" id="usuario" name="usuario" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>

</html>