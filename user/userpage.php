<?php require_once '../crud.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}
$tableUser = readAll($pdo, 'agenda');
$idUser = (int)$_SESSION['id_user'];
$user = read($pdo, 'usuarios', "id_user = $idUser");

function nomeUsuario($user)
{
    if (isset($user['nome'])) {
        $nomeCompleto = trim($user['nome']);

        $palavras = explode(" ", $nomeCompleto);

        $duasPalavras = array_slice($palavras, 0, 2);

        $nomeEncurtado = implode(" ", $duasPalavras);

        return htmlspecialchars($nomeEncurtado);
    }

    return "Usuário";
}

if ($user['img_user'] != '' && file_exists('../img/uploads/usuarios/clientes/' . $user['img_user'])) {
    $foto = $user['img_user'];
} else {
    $foto = 'foto_default.png';
}
if (isset($user['nome'])) {
    $nomeCompleto = trim($user['nome']);
}
$categoria = $_SESSION['tipo'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá <?= nomeUsuario($user); ?></title>
    <link rel="stylesheet" href="../css/userpage.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="icon" type="image/png" href="../img/logosemfundo.png">

</head>

<body>

    <?php
    require_once '../partials/header.php';
    ?>

    <div class="perfil">
        <div class="imgperfil">
            <a href="editardados.php"><img class="fotoperfil" src="../img/uploads/usuarios/clientes/<?= $foto ?>" width="900" alt="Foto de Perfil"></a>
            <br>
            <div class="botaoEditarDados">
                <a href="editardados.php">
                    <img src="../img/lapiseditar.png" width="90" alt="Editar Dados">
                </a>
            </div>
        </div>

        <div class="perfil-textos">
            <?php require_once '../php/saudacao.php'; ?>
            <h1 style="text-align: center; text-transform: capitalize;"><?= $nomeCompleto ?>.</h1>
            <p style="font-size: 1.0rem; margin-top: 20px;">Bem-vindo ao seu painel de controle Sync Mecatronics,<br> gerencie seus dados e acompanhe suas inovações em um só lugar.</p>
        </div>

        

    </div>
    <h1 style="text-transform: uppercase; letter-spacing: 1.5px; font-size: 1.2rem;">O que deseja fazer?</h1>
    <div class="funcionalidades">
        <div class="historico">
        <a href="historicodecontratacoes.php"><i class="fa-solid fa-clipboard-list icon-func"></i>Histórico de contratações</a>
        <p>Clique aqui para acessar o seu<br> histórico completo.</p>
        </div>
        <div class="historico">
        <a href="historicodemensagens.php"><i class="fa-solid fa-headset icon-func"></i>Mensagens de suporte</a>
        <p>Clique aqui para visualizar suas <br>mensagens de suporte.</p>
        </div>
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

    if (!empty($user['data_cadastro'])) {
        $dataCadastro = new DateTime($user['data_cadastro']);
        $mesNome = $meses[(int)$dataCadastro->format('m')];
        $ano = $dataCadastro->format('Y');
    } else {
        $mesNome = null;
        $ano = null;
    }
    ?>
    <footer class="footer-perfil">
        <p>Cadastrado desde de <?= $mesNome ?> de <?= $ano ?></p>
    </footer>



</body>

</html>