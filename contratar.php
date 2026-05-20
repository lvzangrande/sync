<?php
require_once 'crud.php';

// if (!isset($_GET['id_user'])) {
//     die("Usuário não encontrado");
// }

$idcard = intval($_GET['id']);
$profissional = read($pdo, "usuarios", "id_user=$idcard");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/contratar.css">
    <title>Pagina de Contrato</title>
</head>

<body>
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

        <!-- -----Formulario e div de descrição ------ -->
        <section class="solicitacao-container">

            <!-- -----Formulario----- -->
            <div class="formulario-card">
                <h2>Solicitação de Serviço</h2>
                <p class="descricao-formulario">
                    Preencha os dados do serviço para prosseguir.
                </p>

                <form action="./insert.php">

                    <div class="campo">
                        <label>Tipo de Serviço</label>
                        <select>
                            <option selected disabled>Selecione o tipo de serviço</option>
                            <option>Automação Industrial</option>
                            <option>Manutenção Preventiva</option>
                            <option>Engenharia de Precisão</option>
                            <option>Mecatrônica</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Descrição do Problema</label>
                        <textarea maxlength="500"
                            placeholder="Descreva detalhadamente o problema, equipamento, modelo......"></textarea>
                    </div>

                    <div class="linha-dupla">
                        <div class="campo">
                            <label>Data Desejada</label>
                            <input type="date">
                        </div>

                        <div class="campo">
                            <label>Horário Preferencial</label>
                            <select>
                                <option selected disabled>Selecione</option>
                                <option>Manhã</option>
                                <option>Tarde</option>
                                <option>Noite</option>
                            </select>
                        </div>
                    </div>

                    <div class="campo">
                        <label>Local da Intervenção</label>
                        <input type="text" placeholder="Endereço completo da unidade industrial">
                    </div>

                    <button type="submit" class="btn-prosseguir">
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
                        <strong>R$ '.$profissional['valor_dia'].'</strong>
                    </div>

                    <hr>


                    <p class="texto-desc">
                       '.$profissional['descricao_func'].'
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