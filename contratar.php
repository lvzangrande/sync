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

            <a href="./catalogo_profissionais" class="voltar">
                ← Voltar ao Catálogo
            </a>

            <div class="card-profissional">

                <!-- Foto -->
                <div class="foto-profissional">
                    <img src="https://static.vecteezy.com/ti/fotos-gratis/t2/57068323-solteiro-fresco-vermelho-morango-em-mesa-verde-fundo-comida-fruta-doce-macro-suculento-plantar-imagem-foto.jpg"
                        alt="">
                </div>

                <!-- Informações -->
                <div class="info-profissional">

                    <div class="topo-info">
                        <h1>Nome Profissional</h1>
                        <span class="disponibilidade">DISPONÍVEL</span>
                    </div>

                    <h2>Especialidade Profissional</h2>

                    <p class="subespecialidade">Automação Industrial</p>

                    <div class="meta-info">
                        <span class="avaliacao"> 4.9 </span>
                        <span>(247 trabalhos)</span>
                        <span>12 anos</span>
                    </div>
                </div>

                <!-- Preço -->
                <div class="preco-servico">
                    <span class="valor">R$ 280</span>
                    <span class="periodo">/hora</span>
                </div>

            </div>

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
                            placeholder="Descreva detalhadamente o problema, equipamento, modelo, sintomas observados..."></textarea>
                        <span class="contador">0/500</span>
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
            <div class="orcamento-card">
                <h3>Orçamento Estimado</h3>

                <div class="linha-orcamento">
                    <span>Valor/hora</span>
                    <strong>R$ 280</strong>
                </div>

                <div class="linha-orcamento">
                    <span>Horas estimadas</span>
                    <strong>4h</strong>
                </div>

                <hr>

                <div class="total-estimado">
                    <span>Total estimado</span>
                    <strong>R$ 1.120</strong>
                </div>

                <p class="texto-orcamento">
                    Este é um valor estimado com base em 4 horas de trabalho.
                    O valor final pode variar conforme a complexidade do serviço.
                </p>

                <div class="garantia-box">
                    <h4>Garantia Sync</h4>
                    <p>
                        Todos os serviços incluem garantia de 90 dias e suporte técnico prioritário.
                    </p>
                </div>
            </div>
        </section>
    </main>


</body>

</html>