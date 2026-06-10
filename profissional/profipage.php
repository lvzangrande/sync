<?php
require_once '../crud.php';
session_start();

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

        return htmlspecialchars($nomeEncurtado);
    } else {
        return "Usuário";
    }
}

$idUser = (int)$_SESSION['id_user'];
$user = read($pdo, 'usuarios', "id_user = $idUser");

$tableAgenda = readAll($pdo, 'agenda', "id_profissional = $idUser");
$totalserv = 0;
$servcanc = 0;

foreach ($tableAgenda as $agendamento) {
    if ($agendamento['status_os'] == "Concluída" && $agendamento['id_profissional'] == $_SESSION['id_user']) {
        $totalserv++;
    } elseif ($agendamento['status_os'] == "Cancelada" && $agendamento['id_profissional'] == $_SESSION['id_user']) {
        $servcanc++;
    }
}

if (!empty($user['img_user']) && file_exists('../img/uploads/usuarios/profissionais/' . $user['img_user'])) {
    $foto = $user['img_user'];
} else {
    $foto = 'foto_default.png';
}
foreach ($tableAgenda as $agendamento) {
    if (
        $agendamento['status_os'] != 'Concluída'
        && $agendamento['status_os'] != 'Em Andamento'
        && $agendamento['id_profissional'] == $_SESSION['id_user']
        && new DateTime($agendamento['data']) < new DateTime()
    ) {
        update($pdo, 'agenda', ['status_os' => 'Pendente'], "id_os = {$agendamento['id_os']}");
        $agendamento['status_os'] = 'Pendente';
    }
}

//Se algum serviço com status Em Andamento, exibir um card na profipage que redireciona para o serviço em agendamento 
//Se algum serviço do profissional estiver com status Em Andamento não permitir iniciar mais serviços
$status = 'status';
$idServEmAndamento = '';
foreach ($tableAgenda as $agendamento) {
    if ($agendamento['status_os'] == 'Em Andamento' && $agendamento['id_profissional'] == $_SESSION['id_user']) {
        $status = 'Em Andamento';
        $idServEmAndamento = $agendamento['id_os'];

        $idCliente = $agendamento['id_cliente'];
        $nomeClienteEmAndamento = read_nome_via_id($pdo, 'usuarios', $idCliente);
        break; 
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profipage.css">
    <link rel="stylesheet" href="../css/partials.css">

    <link rel="icon" href="imagens/logosemfundo.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Olá <?= nomeUsuario(); ?></title>
</head>

<body>
    <?php
    require_once '../partials/header.php';
    ?>
    <div class="perfil">
        <div style="text-align: center; width: 100%;">
            <?php require_once '../php/saudacao.php'; ?>
        </div>

        <h1 style="text-align: center;">Olá <?= nomeUsuario(); ?></h1><br>




        <div class="imgperfil">
            <div class=<?= "$status" ?>></div><!--Se Em Andamento mudar a cor para laranja-->
            <img class="fotoperfil" src="../img/uploads/usuarios/profissionais/<?= $foto ?>" alt="Foto de Perfil">
            <br>
            <a href="editardados.php" class="editar">
                <img src="../img/lapiseditar.png" width="50" alt="Editar">
            </a>
        </div>
    </div>
    <div class="funcionalidades">
        <a class="func" href="historicodeservicos.php">Ver histórico de serviços</a>
        <p><b class="qntdserv"><?= $totalserv ?></b><br>Serviços prestados</p>
        <a class="func" href="servagendados.php">Ver serviços agendados</a>
    </div>
    <?php
    if ($status == 'Em Andamento') {
        echo "
        <div class='AlertaServico'>
            <h1><i class='fa-solid fa-triangle-exclamation'></i> ATENÇÃO <i class='fa-solid fa-triangle-exclamation'></i></h1>
            <p>VOCÊ INICIOU UM SERVIÇO PARA:</p>

            <div class='pendeagen'>
                <h2 class='nomecliente'><b>{$nomeClienteEmAndamento}</b></h2>
            </div>
             <a href='detalhesserv.php?id={$idServEmAndamento}'>
                    <div class='continuar'>
                        <b>CONTINUAR</b>
                    </div>
                </a>
        </div>";
    }

    ?>
    <?php
    $meses = [
        1 => 'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    ];

    $dataCadastro = new DateTime($user['data_cadastro']);

    $mesNome = $meses[(int)$dataCadastro->format('m')];
    $ano = $dataCadastro->format('Y');


    ?>
    <footer class="footer-perfil">
        <p>Cadastrado desde de <?= $mesNome ?> de <?= $ano ?></p>
    </footer>
</body>

</html>