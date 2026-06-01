<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../crud.php';

if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$erro = "";

if (isset($_POST['btn_salvar'])) {

    if ($_POST['senha'] !== $_POST['confirma_senha']) {
        $erro = "As senhas não coincidem!";
    } else {
        $dados = [
            'nome'           => $_POST['nome'],
            'email'          => $_POST['email'],
            'senha'          => $_POST['senha'],
            'telefone'       => $_POST['telefone'],
            'cpf_cnpj'       => $_POST['cpf_cnpj'],
            'tipo'           => 'PF',
            'categoria'      => 'profissional',
            'especialidade'  => $_POST['especialidade'],
            'valor_dia'      => $_POST['valor_dia'],
            'descricao_func' => $_POST['descricao_func'],
            'status'         => 'Inativo'
        ];

        if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] === UPLOAD_ERR_OK) {

            $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $tamanho_max = 1 * 1024 * 1024; // 1MB

            if (!in_array($_FILES['img_user']['type'], $tipos_permitidos)) {
                $erro = "Tipo de arquivo não permitido.";
            } 
            elseif ($_FILES['img_user']['size'] > $tamanho_max) {
                $erro = "O arquivo é muito grande. O tamanho máximo permitido é 1MB.";
            } 
            else {
                $extensao = pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION);
                $novonome = "profissional_" . uniqid() . "." . $extensao;

                $dir = "../uploads/usuarios/";
                $file = $dir . $novonome;

                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                if (move_uploaded_file($_FILES['img_user']['tmp_name'], $file)) {
                    $dados['img_user'] = $novonome;
                } else {
                    $erro = "Erro ao mover o arquivo de imagem para o servidor.";
                }
            }
        }
        if (empty($erro)) {
            create($pdo, 'usuarios', $dados);
            header("Location: adminpage.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de profissonal | Sync</title>

    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/formularios.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="imagens/logosemfundo.png">
</head>

<body>
    <?php require_once '../partials/header.php' ?>
    <main>
        <div class="cadastro-container" style="max-width: 800px; margin: 40px auto; padding: 40px 30px;">

            <div class="cadastro-header">
                <h1 style="font-weight: 600;">Novo Profissional</h1>
                <p>Preencha os dados técnicos para criar o perfil</p>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert-error" style="margin-bottom: 20px; text-align: center; padding: 12px; background-color: #5c1e29; color: #f8d7da; border: 1px solid #721c24; border-radius: 4px;">
                    <?= $erro; ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome do profissional</label>
                    <input type="text" id="nome" name="nome" class="input-control" value="<?= htmlspecialchars($item['nome'] ?? ''); ?>" placeholder="Ex: James Rodríguez" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="input-control" value="<?= htmlspecialchars($item['email'] ?? ''); ?>" placeholder="Ex: jamesrodriguez@spfc.com" required>
                </div>

                <div class="form-separacao">
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" class="input-control" placeholder="Ex: colombia@123" required>
                    </div>

                    <div class="form-group">
                        <label for="confirma_senha">Confirmar Senha</label>
                        <input type="password" id="confirma_senha" name="confirma_senha" class="input-control" placeholder="Ex: colombia@123" required>
                    </div>
                </div>

                <div class="form-separacao">

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" class="input-control" value="<?= htmlspecialchars($item['telefone'] ?? ''); ?>" placeholder="(00) 00000-0000" required>
                    </div>

                    <div class="form-group">
                        <label for="cpf_cnpj">CPF</label>
                        <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="input-control" value="<?= htmlspecialchars($item['cpf_cnpj'] ?? ''); ?>" placeholder="000.000.000-00" required>
                    </div>
                </div>

                <div class="form-separacao">
                    <div class="form-group">
                        <label for="especialidade">Especialidade</label>
                        <input type="text" id="especialidade" name="especialidade" class="input-control" value="<?= htmlspecialchars($item['especialidade'] ?? 'Geral'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="valor_dia">Valor da diária (R$)</label>
                        <input type="number" id="valor_dia" step="0.01" name="valor_dia" class="input-control" value="<?= htmlspecialchars($item['valor_dia'] ?? 0.00); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao_func">Descrição das Habilidades / Experiência</label>
                    <textarea id="descricao_func" name="descricao_func" class="input-control" rows="5" placeholder="Conte um pouco sobre suas qualificações técnicas..."><?= htmlspecialchars($item['descricao_func'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Foto de Perfil</label>
                    <label for="foto" class="upload-container">
                        <span id="nome-arquivo">Selecione uma imagem (Máx: 1MB)</span>
                        <input type="file" id="foto" name="img_user" accept="image/*" class="input-file-hidden">
                    </label>
                </div>

                <button type="submit" name="btn_salvar" class="btn-submit">Salvar Cadastro</button>
            </form>
        </div>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>

</html>