<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profipage.css">
    <title>Seu perfil</title>
</head>
<body>
    <?php
    require_once '../partials/header.php';
    require_once '../php/saudacao.php';
    ?>
    <div class='imgperfil'>
        <img src=../img/lenda.jfif>
        <br>
        <a href='editardados.php'><img src=../img/lapiseditar.png width='50'></a>
    </div>
    <h1>João linux</h1>
    <a class="historico" href="historicodeservicos.php">Ver histórico de serviços</a>
    <footer>
        <p>Cadastrado desde de 2026</p>
    </footer>
</body>
</html>