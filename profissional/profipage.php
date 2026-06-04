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

    $tableAgenda = readAll($pdo,'agenda');
    $totalserv = 0;
    $servcanc = 0;
    foreach($tableAgenda as $agendamento){
        if($agendamento['status_os'] == "Concluída"){
            $totalserv ++;
            }
        elseif($agendamento['status_os'] == "Cancelada"){
            $servcanc ++;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="stylesheet" href="../css/profipage.css">
    <title>Olá <?=nomeUsuario();?></title>
</head>
<body>
    <?php
    require_once '../partials/header.php';
    require_once '../php/saudacao.php';
    ?>
    <div class="perfil">
        <div class='imgperfil'>
            <div class="status"></div>
            <img class="fotoperfil" src=../img/uploads/usuarios/profissionais/<?=$user['img_user']?>>
            <br>
            <a href='editardados.php' class="editar"><img src=../img/lapiseditar.png width='50'></a>
        </div>
    </div>
    <h1><?=nomeUsuario($pdo)?></h1>
    <div class="funcionalidades">
    <a class="func" href="historicodeservicos.php">Ver histórico de serviços</a>
    <p><b class="qntdserv"><?=$totalserv?></b><br>serviços prestados</p>
    <a class="func" href="servagendados.php">Ver serviços agendados</a>
    </div>
    <footer>
        <p>Cadastrado desde de 2026</p>
    </footer>
</body>
</html>