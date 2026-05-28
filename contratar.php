<?php
require_once 'crud.php';

// if (!isset($_GET['id_user'])) {
//     die("Usuário não encontrado");
// }
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$idcard = intval($_GET['id']);

$profissional = read($pdo, 'usuarios', "id_user=$idcard");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/contratar.css">
    <link rel="stylesheet" href="./css/partials.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Pagina de Contrato</title>
</head>

<body>
    <?php require_once 'partials/header.php'; ?>
    <main>
        <!-- ----- Card Funcionario ----- -->
        <section class="perfil-profissional">

            <a href="./catalogo_profissionais.php" class="voltar">
                ← Voltar ao Catálogo
            </a>
            <?php
            echo '
                <div class="card-profissional">

                    <!-- Foto -->
                    <div class="foto-profissional">
                    <img src="uploads/usuarios/' . $profissional['img_user'] . '"
                    alt="Foto de ' . $profissional['nome'] . '">
                    </div>

                    <!-- Informações -->
                    <div class="info-profissional">

                        <div class="topo-info">
                            <h1>' . $profissional['nome'] . '</h1>
                            <span class="disponibilidade">' . $profissional['status'] . '</span>
                        </div>

                        <h2>' . $profissional['especialidade'] . '</h2>

                        <div class="meta-info">
                            <span class="avaliacao"><i class="bi bi-star-fill"></i>' . $profissional['notas'] . '</span>
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

        <!-- -----Formulario e div de descrição ------ -->
        <section class="solicitacao-container">

            <!-- -----Formulario----- -->
            <div class="formulario-card">
                <h2>Solicitação de Serviço</h2>
                <p class="descricao-formulario">
                    Preencha os dados do serviço para prosseguir.
                </p>

                <form action="./user/segundo_contrato.php" method="POST">

                    <input type="hidden" name="id_profissional" value="<?= $idcard ?>">
                    <input type="hidden" name="id_cliente" value="<?= $idcliente ?>">

                    <div class="campo">
                        <label>Tipo de Serviço</label>
                        <select name="tipo_serv">
                            <option selected disabled>Selecione o tipo de serviço</option>
                            <option value="Automação Industrial">Automação Industrial</option>
                            <option values="Manutenção Preventiva">Manutenção Preventiva</option>
                            <option values="Engenharia de Precisão">Engenharia de Precisão</option>
                            <option value="Mecatrônica">Mecatrônica</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Descrição do Problema</label>
                        <textarea name="desc" maxlength="500"
                            placeholder="Descreva detalhadamente o problema, equipamento, modelo......"></textarea>
                    </div>

                    <div class="linha-dupla">
                        <div class="campo">
                            <label>Data Desejada</label>
                            <input type="date" name="data">
                        </div>

                        <div class="campo">
                            <label for="">Tempo Estimado em Dias</label>
                            <input type="number" name="tempo" placeholder="ex: 20 dias">
                        </div>
                    </div>

                    <div class="campo">
                        <label>Local da Intervenção</label>
                        <input name="end_serv" type="text" placeholder="Endereço completo da unidade industrial">
                    </div>

                    <button class="btn-prosseguir">
                        Prosseguir
                    </button>
                </form>
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

    <?php require_once 'partials/footer.php'; ?>
</body>

</html>