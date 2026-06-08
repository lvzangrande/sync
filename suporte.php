<?php
require_once "crud.php";
session_start();

$mensagem_sucesso = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nome     = htmlspecialchars($_POST['nome']);
    $email    = htmlspecialchars($_POST['email']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $mensagem = htmlspecialchars($_POST['mensagem']);


    $id_usuario = $_SESSION['id_user'] ?? 1;

    $dados = [
        'nome_cliente' => $nome,
        'email_sup'    => $email,
        'tel_sup'      => $telefone,
        'desc_sup'     => $mensagem,
        'id_usuario'   => $id_usuario,
        'status_suporte' => 'Pendente'
    ];


    if (create($pdo, 'suporte', $dados)) {
        $mensagem_sucesso = "Solicitação enviada com sucesso!";
        header("Location: user/sucesso_suporte.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Técnico Especializado - SYNC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/suporte.css">
    <link rel="stylesheet" href="css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="imagens/logosemfundo.png">
</head>

<body>

    <?php require_once 'partials/header.php'; ?>

    <div class="form-header">
            <h1><span class="destaque-azul"><i class="fa-solid fa-screwdriver-wrench meu-icone3"></i>Suporte</span><br> Técnico Especializado</h1>
            <p>Conte-nos sobre o problema técnico que você está enfrentando. Nossa equipe de <br>suporte está pronta para ajudar a resolver qualquer questão relacionada ao sistema SYNC.</p>
        </div><br>
    <main class="main-container">
        <aside class="sidebar-info">
            <div class="status-card">
                <h3>Atendimento rápido</h3>
                <small>Tempo Médio de Resposta: 45 minutos</small>
            </div>

            <div class="contact-card">
                <h3>Canais de Emergência</h3>
                <div class="contact-item">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>+55 (11) 93056-9806</span>
                </div>
                <div class="contact-item">
                    <i class="fa-regular fa-envelope"></i>
                    <span>sync@gmail.com</span>
                </div>
            </div>
        </aside>

        <section class="form-container">
            <form action="#" method="POST" class="support-form" enctype="multipart/form-data">

                <div class="form-row">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user icon"></i>
                            <input type="text" name="nome" placeholder="Nome do Operador/Engenheiro" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>E-mail Corporativo</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope icon"></i>
                            <input type="email" name="email" placeholder="nome@empresa.com" required>
                        </div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Telefone</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-phone icon"></i>
                        <input type="number" name="telefone" placeholder="+55 (11) 93056-9806" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Descrição Detalhada do Problema Técnico</label>
                    <textarea name="mensagem" rows="5" placeholder="Descreva os códigos de erro e comportamento do sistema..." required></textarea>
                </div>


                <button type="submit" class="btn-submit">ENVIAR SOLICITAÇÃO TÉCNICA</button>

            </form>
        </section>
    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>