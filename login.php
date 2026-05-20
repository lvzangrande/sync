<?php
session_start();

require_once 'crud.php';

if (isset($_SESSION['autenticado'])) {
    redirecionarPorPerfil($_SESSION['tipo']);
}

$erro = "";

if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    $usuario_digitado = trim($_POST['usuario']);
    $senha_digitada   = trim($_POST['senha']);

    if (empty($usuario_digitado) || empty($senha_digitada)) {
        
        $erro = "Preencha todos os campos!";
        
    } else {
        
        $email_seguro = $pdo->quote($usuario_digitado);
        $condicao = "email = $email_seguro";
        $resultado = read($pdo, 'usuarios', $condicao);

        if ($resultado) {
            
            if (isset($resultado[0])) {
                $usuario_banco = $resultado[0];
            } else {
                $usuario_banco = $resultado;
            }

            if ($senha_digitada === $usuario_banco['senha']) {
                
                $_SESSION['autenticado'] = true;
                $_SESSION['id_user']     = $usuario_banco['id_user'];
                $_SESSION['nome']        = $usuario_banco['nome'];
                $_SESSION['tipo']        = $usuario_banco['categoria'];

                redirecionarPorPerfil($_SESSION['tipo']);
                exit();
                
            } else {
                $erro = "Acesso negado! Dados incorretos.";
            }
            
        } else {
            $erro = "Acesso negado! Dados incorretos.";
        }
    }
}

function redirecionarPorPerfil($tipo)
{
    switch ($tipo) {
        case 'admin':
            header("Location: area_admin.php");
            break;
        case 'profissional':
            header("Location: area_profissional.php");
            break;
        case 'cliente':
            header("Location: inicio.php");
            break;
        default:
            header("Location: dashboard.php");
            break;
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYNC | Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <h1>SYNC</h1>
            <p>Acesse sua conta industrial com segurança.</p>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert-error">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="usuario">E-mail Corporativo</label>
                <input
                    type="email"
                    id="usuario"
                    name="usuario"
                    class="input-control"
                    placeholder="exemplo@sync.com"
                    required>
            </div>

            <div class="form-group">
                <label for="senha">Senha técnica</label>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    class="input-control"
                    placeholder="••••••••"
                    required>
            </div>

            <button type="submit" class="btn-submit">Entrar no Sistema</button>
        </form>

        <div class="login-footer">
            <p style="color: var(--light-slate);">
                Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>
            </p>
            <p style="margin-top: 8px;">
                <a href="editar_senha.php">Esqueceu a senha?</a>
            </p>
        </div>
    </div>

</body>

</html>