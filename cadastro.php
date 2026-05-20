<?php
session_start();
require_once 'crud.php';

$mensagem = "";
$tipo_mensagem = "";

if (
    isset($_POST['nome']) &&
    isset($_POST['email']) &&
    isset($_POST['senha']) &&
    isset($_POST['telefone']) &&
    isset($_POST['cpf_cnpj']) &&
    isset($_POST['tipo'])
) {

    $nome     = trim($_POST['nome']);
    $email    = trim($_POST['email']);
    $senha    = trim($_POST['senha']);
    $telefone = trim($_POST['telefone']);
    $cpf_cnpj = trim($_POST['cpf_cnpj']);
    $tipo     = trim($_POST['tipo']);

    $categoria = 'cliente';

    if (empty($nome) || empty($email) || empty($senha) || empty($telefone) || empty($cpf_cnpj) || empty($tipo)) {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
        $tipo_mensagem = "erro";
    } else {
        $dados = [
            'nome'      => $nome,
            'email'     => $email,
            'senha'     => $senha,
            'telefone'  => $telefone,
            'cpf_cnpj'  => $cpf_cnpj,
            'tipo'      => $tipo,        
            'categoria' => $categoria
        ];

        $sucesso = create($pdo, 'usuarios', $dados);

        if ($sucesso) {
            $mensagem = "Cadastro de cliente realizado com sucesso! Vá para o login.";
            $tipo_mensagem = "sucesso";
        } else {
            $mensagem = "Erro ao cadastrar. Verifique se o E-mail ou CPF/CNPJ já existem.";
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
    <title>Sync | Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body>

    <div class="cadastro-container">
        <div class="cadastro-header">
            <h1>Cadastro de Cliente</h1>
            <p>JUNTE SE A NÓS!</p>
        </div>

        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-<?php echo $tipo_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <form action="cadastro.php" method="POST">

            <div class="form-group">
                <label for="nome">Nome / Razão Social</label>
                <input type="text" id="nome" name="nome" class="input-control" placeholder="Nome completo ou Empresa" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail de Contato</label>
                <input type="email" id="email" name="email" class="input-control" placeholder="cliente@provedor.com" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha de Acesso</label>
                <input type="password" id="senha" name="senha" class="input-control" placeholder="Crie uma senha segura" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone / WhatsApp</label>
                <input type="text" id="telefone" name="telefone" class="input-control" placeholder="(11) 99999-9999" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de Cliente</label>
                <select id="tipo" name="tipo" class="input-control" required>
                    <option value="" disabled selected>Selecione...</option>
                    <option value="PF">Pessoa Física (PF)</option>
                    <option value="PJ">Pessoa Jurídica (PJ)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF ou CNPJ</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="input-control" placeholder="Apenas números" required>
            </div>

            <button type="submit" class="btn-submit">Registrar Cliente</button>
        </form>

        <div class="cadastro-footer">
            <p>
                Já tem cadastro? <a href="login.php">Fazer Login</a>
            </p>
        </div>
    </div>

</body>

</html>