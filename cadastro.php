<?php
session_start();
require_once 'crud.php'; 

$mensagem = "";
$tipo_mensagem = "";

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['tipo'])) {
    
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $tipo  = $_POST['tipo'];

    if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
        $mensagem = "Por favor, preencha todos os campos.";
        $tipo_mensagem = "erro";
    } else {
        $nome_seguro  = $pdo->quote($nome);
        $email_seguro = $pdo->quote($email);
        $senha_segura = $pdo->quote($senha);
        $tipo_seguro  = $pdo->quote($tipo);

        $dados = [
            'nome'  => $nome_seguro,
            'email' => $email_seguro,
            'senha' => $senha_segura,
            'tipo'  => $tipo_seguro
        ];

        $sucesso = create($pdo, 'usuarios', $dados);

        if ($sucesso) {
            $mensagem = "Usuário cadastrado com sucesso! Faça o login.";
            $tipo_mensagem = "sucesso";
        } else {
            $mensagem = "Erro ao cadastrar. Tente novamente.";
            $tipo_mensagem = "erro";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sync - Cadastro Industrial</title>
    
</head>
<body>

    <div class="cadastro-container">
        <div class="cadastro-header">
            <h1>Criar Conta</h1>
            <p>SISTEMA DE GESTÃO DE MANUTENÇÃO SYNC</p>
        </div>

        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-<?php echo $tipo_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form action="cadastro.php" method="POST">
            
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" class="input-control" placeholder="Nome do colaborador ou cliente" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="input-control" placeholder="exemplo@sync.com" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha de Acesso</label>
                <input type="password" id="senha" name="senha" class="input-control" placeholder="Mínimo 6 caracteres" required>
            </div>

            <div class="form-group">
                <label for="tipo">Perfil de Acesso</label>
                <select id="tipo" name="tipo" class="input-control" required>
                    <option value="" disabled selected>Selecione o nível de acesso...</option>
                    <option value="cliente">Cliente (Solicitar OS)</option>
                    <option value="profissional">Profissional (Técnico Mecatrônico)</option>
                    <option value="admin">Administrador (Gestor Sync)</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Finalizar Cadastro</button>
        </form>

        <div class="cadastro-footer">
            <p style="color: var(--light-slate);">
                Já possui uma conta? <a href="login.php">Voltar para o Login</a>
            </p>
        </div>
    </div>

</body>
</html>