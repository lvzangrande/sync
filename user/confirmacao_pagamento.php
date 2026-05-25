<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Confirmado</title>

    <link rel="stylesheet" href="../css/confirmacao_pagamento.css">
</head>

<body>

    <main class="confirmacao-container">

        <div class="card-confirmacao">

            <!-- Ícone -->
            <div class="icone-confirmado">
                ✓
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
                    <strong>Carlos Mendes</strong>
                </div>

                <div class="linha-info">
                    <span>Serviço</span>
                    <strong>Automação Industrial</strong>
                </div>

                <div class="linha-info">
                    <span>Data</span>
                    <strong>12/03/2026</strong>
                </div>

                <div class="linha-info">
                    <span>Total Pago</span>
                    <strong class="valor">R$ 1.120</strong>
                </div>

            </div>

            <!-- Botões -->
            <div class="acoes">

                <a href="../catalogo_profissionais.php" class="btn-secundario">
                    Voltar ao Catálogo
                </a>

                <a href="./meus_servicos.php" class="btn-principal">
                    Ver Solicitação
                </a>

            </div>

        </div>

    </main>

</body>

</html>