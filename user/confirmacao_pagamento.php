<?php
require_once "../crud.php";

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}
$pedido = $_SESSION['pedido'];
$nome = read($pdo, 'usuarios', "id_user = " . $pedido['id_profissional']);
print_r($pedido);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Pagamento Confirmado</title>

    <link rel="stylesheet" href="../css/confirmacao_pagamento.css">
</head>

<body>

    <main class="confirmacao-container">

        <div class="card-confirmacao">

            <!-- Ícone -->
            <div class="icone-confirmado">
                <i class="bi bi-check-circle"></i>
            </div>

            <!-- Título -->
            <h1>Pagamento Confirmado</h1>
            <!-- Texto -->
            <p class="descricao">
                Seu pagamento foi processado com sucesso.
                O profissional já recebeu a solicitação do serviço.
            </p>

            <!-- Informações -->
            <div class="info-pagamento">

                <div class="linha-info">
                    <span>Profissional</span>
                    <strong><?= $nome['nome'] ?></strong>
                </div>

                <div class="linha-info">
                    <span>Serviço</span>
                    <strong><?= $pedido['tipo_serv'] ?></strong>
                </div>

                <div class="linha-info">
                    <span>Data</span>
                    <strong><?= $pedido['data'] ?></strong>
                </div>

                <div class="linha-info">
                    <span>Total Pago</span>
                    <strong class="valor">R$ <?= $pedido['tempo'] * $nome['valor_dia'] ?></strong>
                </div>

            </div>

            <!-- Botões -->
            <div class="acoes">

                <a href="../catalogo_profissionais.php" class="btn-secundario">
                    Voltar ao Catálogo
                </a>

                <a href="./historicodecontratacoes.php" class="btn-principal">
                    Ver Solicitação
                </a>

            </div>

        </div>

    </main>

</body>

</html>


