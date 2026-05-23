<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}
print_r($_SESSION);



if (!isset($_SESSION['pedido'])) {

    header("Location: catalogo.php");
    exit();
}

$pedido = $_SESSION['pedido'];
$idcard = $pedido['id_profissional'];
$tipo = $pedido['tipo_serv'];
$desc = $pedido['desc'];
$data = $pedido['data'];
$tempo = $pedido['tempo'];
$endereco = $pedido['end_serv'];
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

                <a  class="metodo <?= $metodo == 'cartao' ? 'ativo' : '' ?>">
                    Cartão
                </a>

                <a class="metodo <?= $metodo == 'pix' ? 'ativo' : '' ?>">
                    PIX
                </a>

                <a  class="metodo <?= $metodo == 'boleto' ? 'ativo' : '' ?>">
                    Boleto
                </a>

            </div>


            <?php
            // if ($metodo == 'cartao') {

                echo '
                    <div class="metodo-box">

                        <form action="../func/insert.php" method="POST">

                            <div class="campo">
                                <label>Nome no Cartão</label>
                                <input type="text">
                            </div>

                            <div class="campo">
                                <label>Número do Cartão</label>
                                <input type="text">
                            </div>
                            <input type="hidden" name="id_profissional" value="'.$idcard .'">

                            <input type="hidden" name="tipo_serv" value="'.$tipo .'">

                            <input type="hidden" name="desc" value="'.$desc .'">

                            <input type="hidden" name="data" value="'.$data .'">
                            
                            <input type="hidden" name="tempo" value="'.$tempo .'">                                 
                            
                            <input type="hidden" name="end_serv" value="'.$endereco .'">
                            
                            <input type="hidden" name="id_cliente" value="'.$_SESSION['id_user'] .'">

                            <button class="btn-pagar">
                                Confirmar Pagamento
                            </button>

                        </form>

                    </div>
                ';
            // } elseif ($metodo == 'pix') {
            
                // echo '
                //     <div class="metodo-box">

                //         <div class="pix-box">

                //             <h3>Pagamento via PIX</h3>

                //             <p>Escaneie o QR Code abaixo.</p>

                //             <div class="qr-code">
                //                 QR CODE
                //             </div>

                //             <a href="./confirmacao_pagamento.php" class="btn-pagar">
                //                 Já Paguei
                //             </a>

                //         </div>

                //     </div>
                // ';
            // } elseif ($metodo == 'boleto') {
               
                // echo '
                // <div class="metodo-box">

                //     <div class="boleto-box">

                //         <h3>Pagamento via Boleto</h3>

                //         <p>Gere o boleto abaixo.</p>

                //         <a href="#" class="btn-pagar">
                //             Gerar Boleto
                //         </a>

                //     </div>

                // </div>
                // ';
            // }
            ?>

        </section>

        <!-- DIREITA -->
        <?php
        echo '
        <div class="resumo-pedido">

            <h2>Resumo do Pedido</h2>

            <div class="profissional-box">

                <img src="'.$profissional['img_user'].'"
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