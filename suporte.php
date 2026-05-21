<?php
if ($_SERVER["REQUESTED_METHOD"] == "POST") {
    

$nome = ($_POST['name']);
$email = ($_POST['email']);
$modeloMaquina = ($_POST['modelo-maquina']);
$mensagemCliente = ($_POST['mensagem']);



}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Técnico Especializado - SYNC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="suporte.css">
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
                    <span>+55 (11) 98765-4321</span>
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
                    <label>Modelo da Máquina/Sistema</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-gear icon"></i>
                        <input type="text" name="modelo-maquina" placeholder="Ex: CNC, CLP, Braço Robótico" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Descrição Detalhada do Problema Técnico</label>
                    <textarea name="mensagem" rows="5" placeholder="Descreva os códigos de erro e comportamento do sistema..." required></textarea>
                </div>

                <div class="upload-area">
                    <i class="fa-solid fa-paperclip"></i>
                    <label for="inserir-arquivo">Anexar uma imagem do erro</label>
                    <input type="file" id="inserir-arquivo" hidden>
                </div>

                <button type="submit" class="btn-submit">ENVIAR SOLICITAÇÃO TÉCNICA</button>

            </form>
        </section>
    </main>

</body>
</html>