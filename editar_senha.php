<?php
session_start();
require_once 'crud.php';

$modo = isset($_GET['modo']) ? $_GET['modo'] : 'logado';

$erro = "";
$sucesso = "";
$usuario_banco = null;

if ($modo === 'recuperar') {
    $link_voltar = "login.php";
} else {
    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit();
    }
    
    $id_usuario = $_SESSION['id_user'];
    $resultado = readAll($pdo, 'usuarios', "id_user = $id_usuario");
    $usuario_banco = (!empty($resultado)) ? $resultado[0] : null;

    $tipo = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : '';
    if ($tipo === 'cliente') {
        $link_voltar = "user/editardados.php"; 
    } else {
        $link_voltar = "profissional/editardados_prof.php";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nova_senha     = trim($_POST['nova_senha']);
    $confirma_senha = trim($_POST['confirma_senha']);

    if (empty($nova_senha) || empty($confirma_senha)) {
        $erro = "Preencha as novas senhas.";
    } else if ($nova_senha !== $confirma_senha) {
        $erro = "As senhas não coincidem.";
    } else {

        if ($modo === 'recuperar') {
            $email = trim($_POST['email']);
            
            if (empty($email)) {
                $erro = "Preencha o seu email.";
            } else {
                $busca = readAll($pdo, 'usuarios', "email = '$email'");
                if (!empty($busca)) {
                    $id_achado = $busca[0]['id_user'];
                    update($pdo, 'usuarios', ['senha' => $nova_senha], "id_user = $id_achado");
                    $sucesso = "Senha redefinida! Redirecionando para o login...";
                    header("refresh:3;url=login.php");
                } else {
                    $erro = "Email não encontrado.";
                }
            }
        } 
        else {
            $senha_atual = trim($_POST['senha_atual']);
            
            if (empty($senha_atual)) {
                $erro = "Preencha a senha atual.";
            } else if ($senha_atual !== $usuario_banco['senha']) {
                $erro = "Sua senha atual está errada.";
            } else if ($senha_atual === $nova_senha) {
                $erro = "A nova senha não pode ser igual a anterior.";
            } else {
                update($pdo, 'usuarios', ['senha' => $nova_senha], "id_user = $id_usuario");
                $sucesso = "Senha alterada com sucesso! Redirecionando...";
                header("refresh:3;url=login.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar senha | Sync Mecatronics</title>
    <link rel="stylesheet" href="css/formularios.css">
    <link rel="stylesheet" href="css/partials.css">
    <link rel="icon" href="imagens/logosemfundo.png">
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    
    <a href="<?= $link_voltar ?>" class="voltar">Voltar</a>
    
    <div class="login-container">
        <div class="login-header">
            <h1><?= ($modo === 'recuperar') ? 'Recuperar Senha' : 'Alterar Senha' ?></h1>
            <?php if ($modo !== 'recuperar'): ?>
                <p>Logado como: <strong style="color: var(--misty-blue);"><?php echo $usuario_banco['email']; ?></strong></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-sucesso"><?php echo $sucesso; ?></div>
        <?php endif; ?>

        <form action="editar_senha.php?modo=<?= $modo ?>" method="POST">

            <?php if ($modo === 'recuperar') { ?>
                
                <div class="form-group">
                    <label>Seu Email</label>
                    <input type="email" name="email" class="input-control" placeholder="Digite seu email cadastrado" required>
                </div>

            <?php } else { ?>

                <div class="form-group">
                    <label>Senha Atual</label>
                    <input type="password" name="senha_atual" class="input-control" placeholder="Digite sua senha atual" required>
                </div>

            <?php } ?>

            <div class="form-group">
                <label>Nova Senha</label>
                <input type="password" name="nova_senha" class="input-control" placeholder="Nova senha" required>
            </div>

            <div class="form-group">
                <label>Confirmar Nova Senha</label>
                <input type="password" name="confirma_senha" class="input-control" placeholder="Repita a nova senha" required>
            </div>

            <button type="submit" class="btn-submit">
                <?= ($modo === 'recuperar') ? 'Redefinir Senha' : 'Atualizar Senha' ?>
            </button>
        </form>
    </div>
</body>
</html>