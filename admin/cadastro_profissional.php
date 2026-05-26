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
                <h1>Novo Profissional</h1>
                <p>Preencha os dados técnicos para criar o perfil</p>
            </div>

            <form action="" method="post">

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

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="input-control" value="<?= htmlspecialchars($item['telefone'] ?? ''); ?>" placeholder="(00) 00000-0000" required>
                </div>

                <div class="form-group">
                    <label for="cpf_cnpj">CPF</label>
                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="input-control" value="<?= htmlspecialchars($item['cpf_cnpj'] ?? ''); ?>" placeholder="000.000.000-00" required>
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

                <button type="submit" name="btn_salvar" class="btn-submit">Salvar Cadastro</button>
            </form>
        </div>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>

</html>