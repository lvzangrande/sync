<?php
function loginInteligente(){
    if (isset($_SESSION['id_user'])) {
        echo "login.php";
    } else {
        echo "cadastro.php";
    }
};
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Sync Mecatronics</title>
    <link rel="stylesheet" href="css/partials.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="imagens/logosemfundo.png">
</head>

<body>
    <header>
        <?php include 'partials/header.php'; ?>
    </header>

    <main>
        <div class="banner">
            <div class="banner2">

                <div class="simbolo">● Plataforma Sync Mecatronics</div>

                <h1>Sync<br>Mecatronics</h1>

                <p class="sub">Sincronize sua operação industrial com a plataforma premium de<br> manutenção
                    mecatrônica. Técnicos especializados, métricas em<br>
                    tempo real e excelência técnica comprovada.</p>

                <div class="btns">
                    <a href="./cadastro.php" class="btn-comecar">
                        Sincronizar operação <span class="material-symbols-outlined">arrow_outward</span>
                    </a>
                    <a href="catalogo_profissionais.php" class="btn-profs">Explorar profissionais</a>
                </div>

                <div class="estatisticas-container">
                    <div class="box">
                        <h2>2.400+</h2>
                        <p>Serviços Sincronizados</p>
                    </div>
                    <div class="box">
                        <h2>350+</h2>
                        <p>Técnicos Certificados</p>
                    </div>
                    <div class="box">
                        <h2>99.8%</h2>
                        <p>Taxa de Sucesso</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <section id="dados" class="dados">
        <div class="dados-badge">Dados em tempo real</div>
        <h1>Performance<br>
            <div class="sincro">Sincronizada</div>
            Global
        </h1>
        <p>Métricas que comprovam a excelência mecatrônica da nossa<br> rede de especialistas</p>
        <div class="container-boxes">
            <div class="caixa">
                <h1>99.8% <i class="fa-solid fa-chart-simple meu-icon"></i> </h1>
                <h2>Taxa de Sucesso Operacional</h2>
                <p>Das manutenções realizadas pela nossa rede de técnicos<br> especializados
                    são concluídas com precisão técnica<br>
                    dentro dos prazos estabelecidos pelas indústrias<br> parceiras.</p>
            </div>

            <div class="caixa2">
                <h1>4x <i class="fa-solid fa-piggy-bank meu-icon"></i> </h1>
                <h2>Retorno sobre Investimento </h2>
                <p>Empresas que utilizam a plataforma Sync Mecatronics para <br>
                    gestão de manutenção mecatrônica reportam quatro vezes<br>
                    mais eficiência operacional e redução drástica de paradas<br>
                    não planejadas em seus processos produtivos.</p>
            </div>
        </div>

    </section>

    <section id="passos" class="passos">
        <div class="passos-badge">Processo Sincronizado</div>
        <h1>Como <span class="destaque-azul">Funciona</span></h1>
        <p>Quatro passos para sincronizar sua operação industrial com <br>excelência mecatrônica</p>
        <div class="container-cards">

            <div class="card">
                <h1>01</h1>
                <h2>Cadastre sua Demanda</h2>
                <p>Descreva o serviço
                    mecatrônico necessário com
                    especificações técnicas,
                    localização e urgência. Nossa
                    IA analisa e categoriza automaticamente.</p>
            </div>

            <div class="card">
                <h1>02</h1>
                <h2>Sincronização<br> Inteligente</h2>
                <p>Nosso algoritmo identifica os
                    técnicos mais qualificados e disponíveis para sua<br>
                    demanda, considerando
                    especialidade, localização
                    e avaliações.</p>
            </div>

            <div class="card">
                <h1>03</h1>
                <h2>Execução com Precisão</h2>
                <p>O técnico especializado<br>
                    executa o serviço com
                    acompanhamento em tempo
                    real via dashboard.
                    Métricas, fotos e relatórios técnicos em
                    um só lugar.</p>
            </div>

            <div class="card">
                <h1>04</h1>
                <h2>Avaliação & <br>Histórico</h2>
                <p>Avalie o profissional, receba o
                    relatório técnico finalizado e
                    mantenha todo o histórico de
                    manutenção da sua planta
                    organizado digitalmente.</p>
            </div>
    </section>

    <section class="depoimentos">
        <h1 class="titulo-depoimentos"><span class="destaque-azul">(Confiança)</span> Industrial</h1>

        <div class="carrossel-css-only">
            <input type="radio" name="slider" id="slide1" checked>
            <input type="radio" name="slider" id="slide2">
            <input type="radio" name="slider" id="slide3">

            <div class="carrossel-track">

                <div class="carrossel-slide">
                    <div class="rating"><i class="fa-solid fa-star"></i> 5</div>
                    <p class="texto-depoimento">A Sync Industrial revolucionou nossa gestão de manutenção. Reduzimos
                        paradas não planejadas em 73% no primeiro semestre e a qualidade técnica dos profissionais da
                        plataforma é simplesmente excepcional. É como ter um departamento de engenharia de precisão sob
                        demanda.</p>

                    <div class="slide-footer">
                        <div class="autor">
                            <img src="img/fernando.png">
                            <div class="info-autor">
                                <h3>Fernando Gomes</h3>
                                <span>Diretor de Operações — Metalúrgica Premium SA</span>
                            </div>
                        </div>
                        <div class="carrossel-controles">
                            <label for="slide3" class="seta-btn"><i class="fa-solid fa-arrow-left"></i></label>
                            <label for="slide2" class="seta-btn btn-azul"><i
                                    class="fa-solid fa-arrow-right"></i></label>
                        </div>
                    </div>
                </div>

                <div class="carrossel-slide">
                    <div class="rating"><i class="fa-solid fa-star"></i> 4.8</div>
                    <p class="texto-depoimento">Trabalhar como técnico na Sync me permite focar no que faço de melhor:
                        resolver problemas mecatrônicos complexos. A plataforma cuida de toda a burocracia, pagamentos e
                        logística. Já completei mais de 300 jobs com avaliação média de 5 estrelas.</p>

                    <div class="slide-footer">
                        <div class="autor">
                            <img src="img/daniel.png">
                            <div class="info-autor">
                                <h3>Daniel Oliveira</h3>
                                <span>Técnico Mecatrônico Senior — Rede Sync</span>
                            </div>
                        </div>
                        <div class="carrossel-controles">
                            <label for="slide1" class="seta-btn"><i class="fa-solid fa-arrow-left"></i></label>
                            <label for="slide3" class="seta-btn btn-azul"><i
                                    class="fa-solid fa-arrow-right"></i></label>
                        </div>
                    </div>
                </div>

                <div class="carrossel-slide">
                    <div class="rating"><i class="fa-solid fa-star"></i> 4.9</div>
                    <p class="texto-depoimento">Como gestora industrial, preciso de confiabilidade total. A plataforma
                        Sync entrega exatamente isso: sincronização perfeita entre demanda técnica e execução. Os
                        dashboards em tempo real nos dão visibilidade completa de todos os indicadores críticos de nossa
                        planta.</p>

                    <div class="slide-footer">
                        <div class="autor">
                            <img src="img/patricia.png">
                            <div class="info-autor">
                                <h3>Patrícia Lima</h3>
                                <span>Gestora Industrial — Automação Norte LTDA</span>
                            </div>
                        </div>
                        <div class="carrossel-controles">
                            <label for="slide2" class="seta-btn"><i class="fa-solid fa-arrow-left"></i></label>
                            <label for="slide1" class="seta-btn btn-azul"><i
                                    class="fa-solid fa-arrow-right"></i></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carrossel-dots">
                <label for="slide1" class="dot"></label>
                <label for="slide2" class="dot"></label>
                <label for="slide3" class="dot"></label>
            </div>
        </div>
    </section>

    <section class="sincronize">
        <h1>Sincronize Sua <div class="destaque-azul">Operação</div>
        </h1>
        <p>Reduza paradas não planejadas<br> e maximize a eficiência produtiva</p>

        <a href="./<?php loginInteligente()?>" class="btn-comecar2">
            <i class="fa-solid fa-gear gear-icone"></i> COMEÇAR AGORA <i class="fa-solid fa-arrow-right seta-icone"></i>
        </a>

    </section>


    <?php include 'partials/footer.php'; ?>

</body>

</html>