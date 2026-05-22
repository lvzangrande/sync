<?php
require_once '../crud.php';
$metodo = $_GET['metodo'] ?? 'cartao';

session_start();

$tipo = $_SESSION['tipo_servico'] = $_POST['tipo_serv'];
$desc = $_SESSION['descricao_problema'] = $_POST['desc'];
$data = $_SESSION['data'] = $_POST['data'];
$tempo = $_SESSION['tempo_planejado'] = $_POST['tempo'];
$endereco = $_SESSION['endereco_servico'] = $_POST['end_serv'];
$idcard = $_SESSION['id_profissional'] = $_POST['id_profissional'];

$profissional = read($pdo, "usuarios", "id_user=$idcard");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>

    <link rel="stylesheet" href="../css/pagamento.css">
</head>

<body>

    <main class="pagamento-container">

        <!-- ESQUERDA -->
        <section class="pagamento-formulario">

            <?php
            echo '<a href="./segundo_contrato?id=' . $idcard . '.php" class="voltar">
                ← Voltar
            </a>';
            ?>
            <h1>Finalizar Pagamento</h1>

            <p class="descricao">
                Complete os dados abaixo para concluir a contratação do serviço.
            </p>

            <!-- MÉTODOS -->
            <div class="metodos-pagamento">

                <a href="?metodo=cartao" class="metodo <?= $metodo == 'cartao' ? 'ativo' : '' ?>">
                    Cartão
                </a>

                <a href="?metodo=pix" class="metodo <?= $metodo == 'pix' ? 'ativo' : '' ?>">
                    PIX
                </a>

                <a href="?metodo=boleto" class="metodo <?= $metodo == 'boleto' ? 'ativo' : '' ?>">
                    Boleto
                </a>

            </div>


            <?php
            if ($metodo == 'cartao') {

                echo '
                    <div class="metodo-box">

                        <form>

                            <div class="campo">
                                <label>Nome no Cartão</label>
                                <input type="text">
                            </div>

                            <div class="campo">
                                <label>Número do Cartão</label>
                                <input type="text">
                            </div>

                            <a href="./confirmacao_pagamento.php" class="btn-pagar">
                                Confirmar Pagamento
                            </a>

                        </form>

                    </div>
                ';
            } elseif ($metodo == 'pix') {
                echo '
                    <div class="metodo-box">

                        <div class="pix-box">

                            <h3>Pagamento via PIX</h3>

                            <p>Escaneie o QR Code abaixo.</p>

                            <div class="qr-code">
                                QR CODE
                            </div>

                            <a href="./confirmacao_pagamento.php" class="btn-pagar">
                                Já Paguei
                            </a>

                        </div>

                    </div>
                ';
            } elseif ($metodo == 'boleto') {
                echo '
                <div class="metodo-box">

                    <div class="boleto-box">

                        <h3>Pagamento via Boleto</h3>

                        <p>Gere o boleto abaixo.</p>

                        <a href="#" class="btn-pagar">
                            Gerar Boleto
                        </a>

                    </div>

                </div>
                ';
            }
            ?>

        </section>

        <!-- DIREITA -->
        <?php
        echo '
        <div class="resumo-pedido">

            <h2>Resumo do Pedido</h2>

            <div class="profissional-box">

                <img src="https://static.vecteezy.com/ti/fotos-gratis/t2/57068323-solteiro-fresco-vermelho-morango-em-mesa-verde-fundo-comida-fruta-doce-macro-suculento-plantar-imagem-foto.jpg"
                    alt="">

                <div>

                    <h3>'.$profissional['nome'].'</h3>

                    <p>'.$tipo.'</p>

                </div>

            </div>

            <div class="linha-resumo">
                <span>Valor/dia</span>
                <strong>R$ '.$profissional['valor_dia'].'</strong>
            </div>

            <div class="linha-resumo">
                <span>Tempo de contrato</span>
                <strong>'.$tempo.'</strong>
            </div>

            <hr>

            <div class="total">
                <span>Total</span>
                <strong>'.$profissional['valor_dia'] * $tempo.'</strong>
            </div>

        </div>
        ';
        ?>
    </main>

</body>

</html>