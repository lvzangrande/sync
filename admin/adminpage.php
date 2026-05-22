<?php
session_start();
require_once '../crud.php';


if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

function nomeUsuario()
{
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

$profissionaisPendentes = readAll($pdo, 'usuarios', "tipo = 'profissional' AND status = 'Inativo'");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá <?php nomeUsuario(); ?>!</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <?php require_once '../partials/header.php'; ?>
    <main>

    </main>
    <?php require_once '../partials/footer.php'; ?>
</body>

</html>