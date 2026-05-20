<?php require_once '../crud.php';

$tableUsuarios = readAll($pdo,'usuarios');
function nomeUsuario($pdo) {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Busca o usuário no banco usando o $pdo
        $user = read($pdo, 'usuarios', "id = $id");
        
        if ($user && isset($user['nome'])) {
            $nomeUser = $user['nome']; // Agora o $user['nome'] funciona!
            echo $nomeUser;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá<?=nomeUsuario($pdo);?></title>
    <link rel="stylesheet" href="../css/userpage.css">
</head>
<body>
    <?php
    require_once '../partials/header.php';
    require_once '../php/saudacao.php';
    ?>
    <div class='imgperfil'>
        <img src=../img/joia.jfif>
        <br>
        <a href='editardados.php'><img src=../img/lapiseditar.png width='50'></a>
    </div>
    <h1>Zé</h1>
    <a class="historico" href="historicodecontratacoes.php">Ver histórico de contratações</a>
    <footer>
        <p>Cadastrado desde de 2026</p>
    </footer>
    <?php
    
    ?>
</body>
</html>