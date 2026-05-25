<?php

require_once '../crud.php';
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['pedido'] = [
        'id_profissional' => $_POST['id_profissional'],
        'tipo_serv' => $_POST['tipo_serv'],
        'desc' => $_POST['desc'],
        'data' => $_POST['data'],
        'tempo' => $_POST['tempo'],
        'end_serv' => $_POST['end_serv']
    ];
}
$pedido = $_SESSION['pedido'];

$idcard = $pedido['id_profissional'];

$tempo = $pedido['tempo'];

$profissional = read($pdo, "usuarios", "id_user=$idcard");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contratar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Contratar</title>
</head>

<body>
    <?php require_once '../partials/header.php'; ?>
    <main>
        <!-- ----- Card Funcionario ----- -->
        <section class="perfil-profissional">


            <?php
            echo '
                <a href="../contratar.php?id=' . $idcard . '" class="voltar">
                    ← Voltar
                </a>
                <div class="card-profissional">

                    <!-- Foto -->
                    <div class="foto-profissional">
                        <img src="' . $profissional['img_user'] . '"
                            alt="">
                    </div>

                    <!-- Informações -->
                    <div class="info-profissional">

                        <div class="topo-info">
                            <h1>' . $profissional['nome'] . '</h1>
                            <span class="disponibilidade">' . $profissional['status'] . '</span>
                        </div>

                        <h2>' . $profissional['especialidade'] . '</h2>

                        <div class="meta-info">
                            <span class="avaliacao"><i class="bi bi-star-fill"></i> ' . $profissional['notas'] . '</span>
                            <span>(247 trabalhos)</span>
                            <span>12 anos</span>
                        </div>
                    </div>

                    <!-- Preço -->
                    <div class="preco-servico">
                        <span class="valor">R$' . $profissional['valor_dia'] . '</span>
                        <span class="periodo">/dia</span>
                    </div>

                </div> 
                ';
            ?>


        </section>

        <section class="solicitacao-container">



            <!-- -------Cards------- -->
            <?php
                echo '
                    <div class="resumo-servico">

                        <div class="topo-resumo">

                            <h2>Resumo do Serviço</h2> 
                            <div class="linha-titulo"></div>

                        </div>

                        <div class="infos-resumo">

                            <div class="info-item">
                                <span>TIPO</span>
                                <p>' . $pedido['tipo_serv'] . '</p>
                            </div>

                            <div class="info-item">
                                <span>DATA</span>
                                <p>' . $pedido['data'] . '</p>
                            </div>

                            <div class="info-item">
                                <span>Dias</span>
                                <p>' . $pedido['tempo'] . '</p>
                            </div>

                            <div class="info-item">
                                <span>LOCAL</span>
                                <p>' . $pedido['end_serv'] . '</p>
                            </div>

                        </div>

                        <div class="descricao-resumo">

                            <span>DESCRIÇÃO</span>

                            <p>
                            ' . $pedido['desc'] . '
                            </p>
                            <form action="./pagamento.php" method="POST">
                                <button class="btn-continuar">
                                    Confirmar pagamento
                                </button>
                            </form>
                        </div>
                    </div>
                ';
                echo '
                    <div class="desc-card">
                        <h3>Descrição</h3>

                        <div class="linha-desc">
                            <span>Valor/dia</span>
                            <strong>R$ ' . $profissional['valor_dia'] . '</strong>
                        </div>

                        <hr>
                        <div class="linha-desc">
                            <span>Valor Total</span>
                            <strong>R$ ' . $profissional['valor_dia'] * $tempo . '</strong>
                        </div>

                        <p class="texto-desc">
                        ' . $profissional['descricao_func'] . '
                        </p>

                        <div class="garantia-box">
                            <h4>Garantia Sync</h4>
                            <p>
                                Todos os serviços incluem garantia de 90 dias e suporte técnico prioritário.
                            </p>
                        </div>
                    </div>
                ';
            ?>
        </section>

    </main>
    <?php require_once '../partials/footer.php'; ?>
</body>

</html>