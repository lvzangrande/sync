<?php require_once '../crud.php';
session_start();

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

function nomeUsuario() {
    if (isset($_SESSION['nome'])) {
        $nomeCompleto = trim($_SESSION['nome']);
        
        $palavras = explode(" ", $nomeCompleto);
        
        $duasPalavras = array_slice($palavras, 0, 2);
        
        $nomeEncurtado = implode(" ", $duasPalavras);

        echo htmlspecialchars($nomeEncurtado);
    } else {
        echo "Usuário";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá <?=nomeUsuario($pdo);?></title>
</head>
<body>
    <header>
        <a></a>
    </header>
    <?php require '../php/saudacao.php'?>
</body>
</html>