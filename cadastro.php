<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

    $img_user = 'uploads/default-avatar.png';

    if (empty($nome) || empty($email) || empty($senha) || empty($telefone) || empty($cpf_cnpj) || empty($tipo)) {
        $mensagem = "Por favor, preencha todos os campos obrigatórios.";
        $tipo_mensagem = "erro";
    } else {

        if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] === UPLOAD_ERR_OK) {

            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($_FILES['img_user']['type'], $tipos_permitidos)) {
                $mensagem = "Tipo de arquivo não permitido. Por favor, envie uma imagem JPEG, PNG ou WEBP.";
                $tipo_mensagem = "erro";
            } else {

                $tamanho_max = 1 * 1024 * 1024; // 1MB
                if ($_FILES['img_user']['size'] > $tamanho_max) {
                    $mensagem = "O arquivo é muito grande. O tamanho máximo permitido é 1MB.";
                    $tipo_mensagem = "erro";
                } else {

                    $extensao = pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION);
                    $novonome = "user_" . uniqid() . "." . $extensao;
                    $dir = "uploads/usuarios/";
                    $file = $dir . $novonome;

                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    if (move_uploaded_file($_FILES['img_user']['tmp_name'], $file)) {
                        $img_user = $file;
                    } else {
                        $mensagem = "Erro ao mover o arquivo de imagem para o servidor.";
                        $tipo_mensagem = "erro";
                    }
                }
            }
        }

        if ($tipo_mensagem !== "erro") {

            $dados = [
                'img_user'  => $img_user,
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
                header("refresh:1;url=login.php");
            } else {
                $mensagem = "Erro ao cadastrar. Verifique se o E-mail ou CPF/CNPJ já existem.";
                $tipo_mensagem = "erro";
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
    <title>Cadastro | Sync Mecatronics</title>
    <link rel="stylesheet" href="css/formularios.css">
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

        <form action="cadastro.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome / Razão Social</label>
                <input type="text" id="nome" name="nome" class="input-control" placeholder="Nome completo ou Empresa" required>
            </div>

            <div class="form-separacao">

                <div class="form-group">
                    <label for="email">E-mail de Contato</label>
                    <input type="email" id="email" name="email" class="input-control" placeholder="cliente@provedor.com" required>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone / WhatsApp</label>
                    <input type="text" id="telefone" name="telefone" class="input-control" placeholder="(11) 99999-9999" required>
                </div>

            </div>

            <div class="form-group">
                <label for="senha">Senha de Acesso</label>
                <input type="password" id="senha" name="senha" class="input-control" placeholder="Crie uma senha segura" required>
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

            <div class="form-group">
                <label>Foto de Perfil</label>
                <label for="foto" class="upload-container">
                    <span id="nome-arquivo">Selecione uma imagem (Máx: 1MB)</span>
                    <input type="file" id="foto" name="img_user" accept="image/*" class="input-file-hidden">
                </label>
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