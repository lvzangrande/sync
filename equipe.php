<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossa Equipe</title>
    <link rel="stylesheet" href="css/equipe.css">
    <link rel="stylesheet" href="css/partials.css"> 

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100..900;1,100..900&family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    

    <link rel="icon" type="image/png" href="imagens/logosemfundo.png">
</head>

<body>
    
        <?php include 'partials/header.php'; ?>
    

    <section class="team-section">
        <h2 class="team-title">NOSSA <span>EQUIPE</span></h2>

        <div class="team-grid">

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="img/foto-equipe/foto-eloah.jpeg" alt="Eloah Barbosa" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-funcao">Dev Front-End</span>
                    <h3 class="dev-name">Eloah Barbosa</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-funcao">Dev Front-End</span>
                    <h3 class="dev-name-hover">Eloah Barbosa</h3>
                    <p class="dev-contribution">
                        Responsável pela página Home, trabalhando na interface visual, organização dos
                        elementos e experiência do usuário dentro do site.
                    </p>

                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="img/foto-equipe/foto-silas.jpeg" alt="" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-funcao">Dev Back-End</span>
                    <h3 class="dev-name">Silas Possarle</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-funcao">Dev Back-End</span>
                    <h3 class="dev-name-hover">Silas Possarle</h3>
                    <p class="dev-contribution">
                        Responsável pela área de contratação de profissionais, desenvolvendo
                        funcionalidades relacionadas ao formulário de contratação, visualização de profissionais,
                        candidatura de profissionais e área de pagamento do sistema.
                    </p>

                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="img/foto-equipe/foto-samuel.jpeg" alt="Samuel de Sousa" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-funcao">Dev Front-End</span>
                    <h3 class="dev-name">Samuel de Sousa</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-funcao">Dev Front-End</span>
                    <h3 class="dev-name-hover">Samuel de Sousa</h3>
                    <p class="dev-contribution">
                        Responsável pelas páginas de equipe e suporte, auxiliando na construção da interface
                        do site, organização visual das paginas e forma de contato entre o cliente
                        e o admin.
                    </p>
                    <div class="social-links">


                    </div>
                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="" alt="Lucas Zangrande" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-funcao">Gerente de Projeto</span>
                    <h3 class="dev-name">Lucas Zangrande</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-funcao">Gerente de Projeto</span>
                    <h3 class="dev-name-hover">Lucas Zangrande</h3>
                    <p class="dev-contribution">
                        Responsável pela organização e gerenciamento do projeto, além do desenvolvimento das áreas
                        do usuário, profsissional, administração e serviços agendados incluindo funcionalidades como
                        edição de informações, gerenciamneto de serviços e controle administrativo da plataforma.
                    </p>
                    <div class="social-links">

                    </div>
                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="img/foto-equipe/foto-gui.jpeg" alt="" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-funcao">Dev Back-End</span>
                    <h3 class="dev-name">Guilherme de Paula</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-funcao">Dev Back-End</span>
                    <h3 class="dev-name-hover">Guilherme de Paula</h3>
                    <p class="dev-contribution">
                        Responsável pelas paginas de acesso do sistema incluindo cadastro, login e edição de senha.
                        Também realizou a criação e organização do banco de dados do site, garantindo o funcionamento e
                        armazenamento das informações do sistema.
                    </p>

                </div>
            </div>

        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
</body>

</html>