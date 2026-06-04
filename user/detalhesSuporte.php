<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

// Resgata o ID do ticket enviado via GET
$idSuporte = (int)$_GET['id'];

// Busca os dados do ticket na tabela 'suporte' (ajuste o nome se for diferente no seu banco)
$ticket = read($pdo, 'suporte', "id_sup = $idSuporte");

if (!$ticket) {
    die("Ticket de suporte não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/userpage.css">
    <title>Suporte #<?=$ticket['id_sup']?> - <?=$ticket['nome_cliente']?></title>
</head>
<body class="body">
    <header>
        <?php require_once "../partials/header.php";?>
    </header>
    
    <a href="./historicodemensagens.php">Voltar</a>
    
    <div class="container">
        <?php     
        if($idSuporte){
            // Verifica se existe uma resposta do administrador, senão define uma mensagem padrão
            $respostaAdmin = !empty($ticket['resposta_admin']) ? $ticket['resposta_admin'] : "Aguardando resposta do administrador.";
            
            echo "  
                <label>Código do Chamado (ID): </label>
                <a>#".$ticket['id_sup']."</a><br><hr>

                <label>Nome do Cliente: </label>
                <a>".$ticket['nome_cliente']."</a><br><hr>

                <label>Telefone de Contato: </label>
                <a>".$ticket['tel_sup']."</a><br><hr>

                <label>E-mail: </label>
                <a>".$ticket['email_sup']."</a><br><hr>

                <label>ID do Usuário no Sistema: </label>
                <a>".$ticket['id_usuario']."</a><br><hr>

                <label>Mensagem / Descrição do Problema: </label>
                <div style='margin-top: 5px; padding: 10px; background: #f9f9f9; border-radius: 4px;'>
                    ".nl2br($ticket['desc_sup'])."
                </div><br><hr>

                <label>Status do Suporte: </label>
                <strong><a>".$ticket['status_suporte']."</a></strong><br><hr>

                <label>Resposta do Administrador: </label>
                <div style='margin-top: 5px; padding: 10px; background: #f0f7ff; border-left: 4px solid #007bff; border-radius: 4px;'>
                    ".nl2br($respostaAdmin)."
                </div><br><hr>";
        }
        ?>
    </div>
</body>
</html>