<?php require_once '../crud.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

if (isset($_SESSION['foto'])) {
    $foto = $_SESSION['foto'];
}
$categoria = $_SESSION['tipo'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá <?= nomeUsuario(); ?></title>
    <link rel="stylesheet" href="../css/userpage.css">
    <link rel="stylesheet" href="../css/partials.css">

</head>

<body>
    <?php
    if (isset($_SESSION['foto'])) {
        $foto = $_SESSION['foto'];
    }
    //else{} receber foto default
    if (isset($_SESSION['nome'])) {
        $nomeCompleto = trim($_SESSION['nome']);
    }
    //else{} receber foto default

    require_once '../partials/header.php';
    require_once '../php/saudacao.php';


    ?>

    <div class="imgperfil">
        <img src="../img/uploads/usuarios/clientes/<?= $foto ?>" width="900" alt="Foto de Perfil">
        <br>
        <div class="botaoEditarDados">
            <a href="editardados.php">
                <img src="../img/lapiseditar.png" width="80" alt="Editar Dados">
            </a>
        </div>
    </div>

    <h1><?= $nomeCompleto ?></h1>

    <a class="historico" href="historicodecontratacoes.php">Ver histórico de contratações</a>
    <footer>
        <p>Cadastrado desde de 2026</p>
    </footer>
    <?php

    ?>
</body>

</html>