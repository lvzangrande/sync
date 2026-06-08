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
    <link rel="icon" href="imagens/logosemfundo.png">

</head>

<body>

    <?php
    require_once '../partials/header.php';
    ?>
    <div class="perfil">
    <?php require_once '../php/saudacao.php';?>
    <h1><?= $nomeCompleto ?></h1>
    
        <div class="imgperfil">
            <a href="editardados.php"><img class="fotoperfil" src="../img/uploads/usuarios/clientes/<?= $foto ?>" width="900" alt="Foto de Perfil"></a>
            <br>
            <div class="botaoEditarDados">
                <a href="editardados.php">
                    <img src="../img/lapiseditar.png" width="80" alt="Editar Dados">
                </a>
            </div>
        </div>
    </div>
    <h1>O que deseja fazer?</h1>
    <div class="funcionalidades">
        <a class="historico" href="historicodecontratacoes.php">Ver histórico de contratações</a>

        <a class="historico" href="historicodemensagens.php">Visualizar mensagens de suporte</a>
    </div>
    <?php
    $meses = [
        1 => 'janeiro',
        'fevereiro',
        'março',
        'abril',
        'maio',
        'junho',
        'julho',
        'agosto',
        'setembro',
        'outubro',
        'novembro',
        'dezembro'
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
    <footer>
        <p>Cadastrado desde de <?= $mesNome ?> de <?= $ano ?></p>
    </footer>
</body>

</html>