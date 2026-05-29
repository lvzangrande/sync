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

    $tableUser = readAll($pdo,'agenda');
    $idUser = (int)$_SESSION['id_user'];
    $user = read($pdo,'usuarios',"id_user = $idUser");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="stylesheet" href="../css/profipage.css">
    <title>Olá <?=nomeUsuario($pdo);?></title>
</head>
<body>
    <?php
    require_once '../partials/header.php';
    require_once '../php/saudacao.php';
    ?>
    <div class='imgperfil'>
        <img src=../img/<?=$user?>>
        <br>
        <a href='editardados.php'><img src=../img/lapiseditar.png width='50'></a>
    </div>
    <h1><?=nomeUsuario($pdo)?></h1>
    <a class="historico" href="historicodeservicos.php">Ver histórico de serviços</a>
    <footer>
        <p>Cadastrado desde de 2026</p>
    </footer>
</body>
</html>