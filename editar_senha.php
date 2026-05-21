<?php
session_start();

require_once 'crud.php';

$erro = "";
$sucesso = "";

if (isset($_POST['senha_atual']) && isset($_POST['nova_senha']) && isset($_POST['confirma_senha'])) {

    $senha_atual    = trim($_POST['senha_atual']);
    $nova_senha     = trim($_POST['nova_senha']);
    $confirma_senha = trim($_POST['confirma_senha']);

    if(empty($senha_atual) || empty($nova_senha) || empty($confirma_senha)) {
        $erro = "Preencha todos os campos.";
    }

    else if ($nova_senha !== $confirma_senha){
        $erro = "As senhas não se coincidem.";
    }
    else{
        $id_usuario = $_SESSION['id_user'];
        $resultado = read($pdo, 'usuarios', "id_user = $id_usuario");
        $usuario_banco = isset($resultado[0]) ? $resultado[0] : $resultado;

        if ($senha_atual === $usuario_banco['senha']) {
            $dados_atualizados = ['senha' => $nova_senha];
            update($pdo, 'usuarios', $dados_atualizados, "id_user = $id_usuario");
            $sucesso = "Senha alterada com sucesso!";
        } 
        else {
            $erro = "Sua senha atual está errada.";
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
</head>

<body>
<div class="login-container"> <h2>Alterar Senha</h2>
    <p class="subtitle">Mantenha a segurança da sua conta Sync atualizada.</p>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-erro">
            <?php echo $erro; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($sucesso)): ?>
        <div class="alert alert-sucesso">
            <?php echo $sucesso; ?>
        </div>
    <?php endif; ?>

    <form action="editar_senha.php" method="POST">
        
        <div class="form-group">
            <label for="senha_atual">Senha Atual</label>
            <input type="password" id="senha_atual" name="senha_atual" class="input-control" placeholder="Digite sua senha atual" required>
        </div>

        <div class="form-separacao">
            
            <div class="form-group">
                <label for="nova_senha">Nova Senha</label>
                <input type="password" id="nova_senha" name="nova_senha" class="input-control" placeholder="Nova senha" required>
            </div>

            <div class="form-group">
                <label for="confirma_senha">Confirmar Nova Senha</label>
                <input type="password" id="confirma_senha" name="confirma_senha" class="input-control" placeholder="Repita a nova senha" required>
            </div>

        </div>

        <button type="submit" class="btn-submit">Atualizar Senha</button>
        
    </form>
</div>
</body>

</html>