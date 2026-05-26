<?php
session_start();
require_once '../crud.php';


if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}


$id   = $_GET['id'] ?? null;
$tipo = $_GET['tipo'] ?? null;

if (isset($_POST['btn_salvar'])) {

    if ($tipo === 'profissional') {
        $dados = [
            'nome'          => $_POST['nome'],
            'especialidade' => $_POST['especialidade'],
            'valor_dia'     => $_POST['valor_dia']
        ];
        update($pdo, 'usuarios', $dados, "id_user = $id");
    }

    if ($tipo === 'servico') {
        $dados = [
            'nome_maq'               => $_POST['nome_maq'],
            'tipo_maq'               => $_POST['tipo_maq'],
            'tipo2_maq'              => $_POST['tipo2_maq'],
            'tempo_estimado_minutos' => $_POST['tempo_estimado_minutos']
        ];
        update($pdo, 'maquinas', $dados, "id_maq = $id");
    }

    header("Location: adminpage.php");
    exit();
}

$item = null;

if ($tipo === 'profissional') {
    $busca = readAll($pdo, 'usuarios', "id_user = $id");
    if (!empty($busca)) {
        $item = $busca[0];
    }
} elseif ($tipo === 'servico') {
    $busca = readAll($pdo, 'maquinas', "id_maq = $id");
    if (!empty($busca)) {
        $item = $busca[0];
    }
}

if (!$item) {
    header("Location: adminpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar item | Sync</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="imagens/logosemfundo.png">
    <style>
        .form-edit-group {
            margin-bottom: 20px;
        }

        .form-edit-group label {
            display: block;
            color: #8BC0D6;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .form-edit-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #7D8597;
            background-color: #1d273b;
            color: #fff;
            font-family: 'Lexend', sans-serif;
            font-size: 15px;
            box-sizing: border-box;
        }

        .form-edit-group input:focus {
            outline: none;
            border-color: #8BC0D6;
        }

        .form-actions-edit {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
    <?php require_once '../partials/header.php' ?>
    <main class="admin-container" style="max-width: 600px;">
        <div class="admin-header-saudacao">
            <div class="linha-saudacao">
                <h1>
                    <?php if ($tipo === 'profissional'): ?>
                        Altere as informações do Profissional
                    <?php else: ?>
                        Altere as informações da máquina
                    <?php endif; ?>
                </h1>
            </div>
            <p>Atualize os dados desejados nos campos abaixo e clique em salvar para registrar.</p>
        </div>

        <section class="section-box">
            <h2>Modificar Registro (<?= ucfirst($tipo); ?>)</h2>

            <form action="" method="POST">

                <?php if ($tipo === 'profissional'): ?>
                    <div class="form-edit-group">
                        <label>Nome do Profissional</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($item['nome']); ?>" required>
                    </div>

                    <div class="form-edit-group">
                        <label>Especialidade</label>
                        <input type="text" name="especialidade" value="<?= htmlspecialchars($item['especialidade'] ?? 'Geral'); ?>" required>
                    </div>

                    <div class="form-edit-group">
                        <label>Valor da Diária (R$)</label>
                        <input type="number" step="0.01" name="valor_dia" value="<?= htmlspecialchars($item['valor_dia'] ?? 0); ?>" required>
                    </div>
                <?php endif; ?>

                <?php if ($tipo === 'servico'): ?>
                    <div class="form-edit-group">
                        <label>Equipamento / Máquina</label>
                        <input type="text" name="nome_maq" value="<?= htmlspecialchars($item['nome_maq']); ?>" required>
                    </div>

                    <div class="form-edit-group">
                        <label>Tipo / Categoria</label>
                        <input type="text" name="tipo_maq" value="<?= htmlspecialchars($item['tipo_maq']); ?>" required>
                    </div>

                    <div class="form-edit-group">
                        <label>Subtipo</label>
                        <input type="text" name="tipo2_maq" value="<?= htmlspecialchars($item['tipo2_maq'] ?? ''); ?>">
                    </div>

                    <div class="form-edit-group">
                        <label>Tempo Estimado (em Minutos)</label>
                        <input type="number" name="tempo_estimado_minutos" value="<?= htmlspecialchars($item['tempo_estimado_minutos']); ?>" required>
                    </div>
                <?php endif; ?>

                <div class="form-actions-edit">
                    <button type="submit" name="btn_salvar" class="btn-action btn-edit">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span> Salvar Alterações
                    </button>
                    <a href="adminpage.php" class="btn-action btn-delete">
                        <span class="material-symbols-outlined" style="font-size: 18px;">cancel</span> Cancelar
                    </a>
                </div>

            </form>
        </section>
    </main>

    <?php require_once '../partials/footer.php' ?>
</body>

</html>