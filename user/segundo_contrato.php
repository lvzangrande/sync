<?php

require_once '../crud.php';
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
    <link rel="stylesheet" href="../css/contratar.css">
    <title>Contratar</title>
</head>

<body>
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
                            <span class="avaliacao">' . $profissional['notas'] . '</span>
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
            <div class="resumo-servico">

                <div class="topo-resumo">

                    <h2>Resumo do Serviço</h2>

                </div>

                <div class="infos-resumo">

                    <div class="info-item">
                        <span>TIPO</span>
                        <p>Automação Industrial</p>
                    </div>

                    <div class="info-item">
                        <span>DATA</span>
                        <p>1212-12-01</p>
                    </div>

                    <div class="info-item">
                        <span>HORÁRIO</span>
                        <p>07:00 - 09:00</p>
                    </div>

                    <div class="info-item">
                        <span>LOCAL</span>
                        <p>aaaaaaaa</p>
                    </div>

                </div>

                <div class="descricao-resumo">

                    <span>DESCRIÇÃO</span>

                    <p>
                        aaaaaaaaaaaaaaaaaaaaaaaa
                    </p>

                </div>

            </div>

            <!-- -------Card------- -->
            <?php
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
</body>

</html>