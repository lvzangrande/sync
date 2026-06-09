<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnologia | Sync Mecatronics</title>
    <link rel="stylesheet" href="css/partials.css">
    <link rel="stylesheet" href="css/tecnologia.css">
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
    
        <?php include 'partials/header.php'; ?>
    

    <section class="tecnologia">
        <div class="tecnologia-badge">Tecnologia Aplicada</div>
        <h1>Elevando o padrão da <br><span class="destaque-azul">Manutenção Industrial</span></h1>
        <p>Combinamos inteligência artificial, análise de dados em tempo real e a expertise dos melhores<br> profissionais do mercado para garantir que a sua linha de produção nunca pare.<br> Descubra como nossa infraestrutura tecnológica suporta cada etapa do seu processo.</p>
    </section>

    <section class="especialidades">
        <div class="cima-card">
            <div class="titulo">
                <h1>Automação &<br><span class="texto-claro">Precisão</span></h1>
            </div>
            <div class="desc">
                <p>Especialidades técnicas sincronizadas para<br> atender às demandas mais complexas da indústria<br> moderna</p>
            </div>
        </div>

        <div class="container-cards">

            <div class="card">
                <img src="img/automacao.png" class="img-card">
                <div class="texto">
                    <h2>Automação e Controle Mecatrônico</h2>
                    <p>Assistência técnica validada e especializada em Servomotores (AC/DC) e Motores de Passo (Stepper Motors). Oferecemos também integração completa de Sensores e Controladores Mecatrônicos para garantir o controle total e a precisão dos seus processos produtivos.</p>
                    <a href="catalogo_profissionais.php" class="btn">Contratar Serviço <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="card">
                <img src="img/manutencao.png" class="img-card">
                <div class="texto">
                    <h2>Manutenção Técnica de Máquinas</h2>
                    <p>Serviços especializados para manter sua planta operando sem interrupções. Realize o agendamento de manutenção técnica preventiva e corretiva para Máquinas de Injeção de Plástico, Prensas de Estampagem ou Hidráulicas, e Unidades de Preparação de Ar (FRL).</p>
                    <a href="catalogo_profissionais.php" class="btn">Contratar Serviço <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="card">
                <img src="img/engenharia.png" class="img-card">
                <div class="texto">
                    <h2>Engenharia e Serviços Padrão</h2>
                    <p>Catálogo completo de soluções para a longevidade do seu maquinário. Disponibilizamos como serviços padrão as rigorosas rotinas de nivelamento, verificação de folgas, lubrificação de rolamentos e a inspeção detalhada de eixos e motores.</p>
                    <a href="catalogo_profissionais.php" class="btn">Contratar Serviço <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

        </div>
    </section>

<section class="equipe">
    <div class="topo">
        <div>
            <span class="tag">Rede Especializada</span>
            <h2>Técnicos em <span class="destaque-azul">Destaque</span></h2>
        </div>
        <a href="catalogo_profissionais.php" class="vermais">Ver Catálogo Completo <i class="fa-solid fa-arrow-right"></i></a>
    </div>
<?php 
require_once 'crud.php';
$tableProfissionais = readAll($pdo, 'usuarios', "categoria = 'profissional' ORDER BY notas DESC LIMIT 4");

echo '<div class="membros">';
foreach ($tableProfissionais as $profissional) {
    $servicos = readAll($pdo, 'agenda', "id_profissional = {$profissional['id_user']} AND status_os = 'Concluída'");
    $total_servicos = count($servicos);

    if ($profissional['img_user'] != '' && file_exists('img/uploads/usuarios/profissionais/' . $profissional['img_user'])) {
        $foto = $profissional['img_user'];
    } else {
        $foto = 'foto_default.png';
    }

    echo "
        <div class='perfil'>
            <div class='foto'>
                <a href='contratar.php?id={$profissional['id_user']}'><img src='img/uploads/usuarios/profissionais/{$foto}'><a/>
                <span class='nota'><i class='fa-solid fa-star'></i> {$profissional['notas']}</span>
                <span class='qtd'>{$total_servicos} serviços</span>
            </div>
            <h3>{$profissional['nome']}</h3>
            <p>{$profissional['especialidade']}</p>
        </div>
    ";
}
echo '</div>';
?>
</div>
</section>

<section class="marcas">
    <p class="tag">Compatibilidade Total</p>
    <h2>Sistemas e Fabricantes <span class="destaque-azul">Suportados</span></h2>
    <p>Técnicos totalmente capacitados para diagnosticar, calibrar e reparar componentes e equipamentos das principais marcas do mercado industrial.</p>
<div class="logos">
    <div class="logo"><a href="https://www.siemens.com" target="_blank"><img src="img/siemens.png"></a></div>
    <div class="logo"><a href="https://www.weg.net" target="_blank"><img src="img/weg.png"></a></div>
    <div class="logo"><a href="https://www.se.com" target="_blank"><img src="img/schneider.png"></a></div>
    <div class="logo"><a href="https://www.abb.com" target="_blank"><img src="img/abb.png"></a></div>
    <div class="logo"><a href="https://www.rockwellautomation.com" target="_blank"><img src="img/rockwell.png"></a></div>
    <div class="logo"><a href="https://www.kuka.com" target="_blank"><img src="img/kuka.jpg"></a></div>
    <div class="logo"><a href="https://www.yaskawa.com" target="_blank"><img src="img/yaskawa.png"></a></div>
</div>
</section>




    <?php include 'partials/footer.php'; ?>


</body>

</html>