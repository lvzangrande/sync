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
</head>

<body>

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
            <header class="form-header">
                <h2>Área de Suporte SYNC </h2>
            </header>

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

                <div class="upload-area">
                    <label for="inserir-arquivo" class="upload-label">
                        <i class="fa-solid fa-paperclip"></i>
                        Anexar uma imagem do erro
                    </label>
                    <input type="file" id="inserir-arquivo" name="arquivo_erro" accept="image/*" hidden>
                </div>

                <button type="submit" class="btn-submit">ENVIAR SOLICITAÇÃO TÉCNICA</button>

            </form>
        </section>
    </main>

</body>

</html>