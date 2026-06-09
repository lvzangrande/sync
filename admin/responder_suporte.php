<?php
session_start();
require_once '../crud.php';

if (!isset($_SESSION['autenticado']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$id_sup = $_GET['id'] ?? $_POST['id_sup'] ?? null;
$erro = "";

if (isset($_POST['btn_enviar_resposta'])) {
    $resposta = $_POST['resposta_admin'] ?? '';

    if (empty($resposta)) {
        $erro = "Por favor, digite uma resposta antes de enviar.";
    } else {
        $dados = [
            'resposta_admin' => $resposta,
            'status_suporte' => 'Respondido'
        ];

        update($pdo, 'suporte', $dados, "id_sup = $id_sup");

        $_SESSION['sucesso_suporte'] = "Chamado respondido com sucesso!";
        header("Location: adminpage.php");
        exit();
    }
}

$chamado = null;
if ($id_sup) {
    $busca = readAll($pdo, 'suporte', "id_sup = $id_sup");
    if (!empty($busca)) {
        $chamado = $busca[0];
    }
}

if (!$chamado) {
    header("Location: adminpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Suporte | Sync</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Lexend', sans-serif;
            background-color: #001233;
            /* --deep-midnight */
            color: #FFFFFF;
        }

        .info-box {
            background-color: #092848;
            /* --navy-dark */
            border: 1px solid #326B93;
            /* --steel-blue */
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .info-row {
            margin-bottom: 12px;
            border-bottom: 1px solid #33415C;
            /* --slate-gray */
            padding-bottom: 8px;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .info-label {
            color: #8BC0D6;
            /* --misty-blue */
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            color: #FFFFFF;
        }

        .mensagem-texto {
            background-color: #001233;
            /* --deep-midnight */
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #164578;
            /* --royal-industrial */
            margin-top: 5px;
            white-space: pre-wrap;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #8BC0D6;
            /* --misty-blue */
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .form-group textarea {
            width: 100%;
            height: 150px;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #7D8597;
            /* --cool-gray */
            background-color: #092848;
            /* --navy-dark */
            color: #fff;
            font-family: 'Lexend', sans-serif;
            font-size: 15px;
            box-sizing: border-box;
            resize: vertical;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #8BC0D6;
            /* --misty-blue */
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-sync {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
        }

        .btn-enviar {
            background-color: #164578;
            /* --royal-industrial */
            color: #FFFFFF;
        }

        .btn-enviar:hover {
            background-color: #326B93;
            /* --steel-blue */
        }

        .btn-voltar {
            background-color: transparent;
            border: 1px solid #7D8597;
            color: #979DAC;
            /* --text-secondary */
        }

        .btn-voltar:hover {
            border-color: #FFFFFF;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <?php require_once '../partials/header.php' ?>

    <main class="admin-container" style="max-width: 650px; margin: 40px auto; padding: 0 20px;">
        <div class="admin-header-saudacao" style="margin-bottom: 30px;">
            <h1>Responder Solicitação de Suporte</h1>
            <p style="color: #979DAC;">Analise o problema relatado pelo usuário e envie a solução técnica direta para o painel dele.</p>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert-error" style="padding: 12px; background-color: #5c1e29; color: #f8d7da; border: 1px solid #721c24; border-radius: 4px; margin-bottom: 20px; text-align: center;">
                <?= $erro; ?>
            </div>
        <?php endif; ?>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Nome do Solicitante</span>
                <span class="info-value"><?= htmlspecialchars($chamado['nome_cliente']); ?></span>
            </div>

            <div class="info-row">
                <span class="info-label">E-mail de Contato</span>
                <span class="info-value"><?= htmlspecialchars($chamado['email_sup']); ?></span>
            </div>

            <?php if (!empty($chamado['tel_sup'])): ?>
                <div class="info-row">
                    <span class="info-label">Telefone</span>
                    <span class="info-value"><?= htmlspecialchars($chamado['tel_sup']); ?></span>
                </div>
            <?php endif; ?>

            <div class="info-row">
                <span class="info-label">Mensagem Relatada</span>
                <div class="mensagem-texto"><?= htmlspecialchars($chamado['desc_sup']); ?></div>
            </div>
        </div>

        <form action="" method="POST">
            <input type="hidden" name="id_sup" value="<?= $id_sup; ?>">

            <div class="form-group">
                <label for="resposta_admin">Sua Resposta Técnica</label>
                <textarea id="resposta_admin" name="resposta_admin" placeholder="Escreva aqui a resposta detalhada ou solução para o cliente..." required><?= htmlspecialchars($chamado['resposta_admin'] ?? ''); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" name="btn_enviar_resposta" class="btn-sync btn-enviar">
                    <span class="material-symbols-outlined" style="font-size: 18px;">send</span> Enviar Resposta
                </button>
                <a href="adminpage.php" class="btn-sync btn-voltar">
                    <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span> Voltar ao Painel
                </a>
            </div>
        </form>
    </main>

    <?php require_once '../partials/footer.php' ?>
</body>

</html>