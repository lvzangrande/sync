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
    if ($agendamento['status_os'] == "Concluída") {
        $totalserv++;
    } elseif ($agendamento['status_os'] == "Cancelada") {
        $servcanc++;
    }
}

if (!empty($user['img_user']) && file_exists('../img/uploads/usuarios/profissionais/' . $user['img_user'])) {
    $foto = $user['img_user'];
} else {
    $foto = 'foto_default.png';
}
foreach ($tableAgenda as $agendamento) {
    if ($agendamento['status_os'] != 'Concluída' && new DateTime($agendamento['data']) < new DateTime()) {
        update($pdo, 'agenda', ['status_os' => 'Pendente'], "id_os = {$agendamento['id_os']}");
        $agendamento['status_os'] = 'Pendente';
    }
}
//Se algum serviço com status em andamento, exibir um alert e redirecionar para ele
//Se algum serviço do profissional estiver com status em andamento não permitir iniciar mais serviços

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profipage.css">
    <link rel="stylesheet" href="../css/partials.css">

    <link rel="icon" href="imagens/logosemfundo.png">
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
            <div class="status"></div><!--Se em andamento mudar a cor para laranja-->
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