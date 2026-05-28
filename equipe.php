<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/partials.css">
    <link rel="stylesheet" href="./css/equipe.css">
    <title>Nossa Equipe</title>
</head>
<body>
    <header>
        <?php include 'partials/header.php'; ?>
    </header>
    
    <section class="team-section">
        <h2 class="team-title">NOSSA <span>EQUIPE</span></h2>
        
        <div class="team-grid">
            
            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="" alt="Eloah Barbosa" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-front">DEV FRONT-END</span>
                    <h3 class="dev-name">Eloah Barbosa</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-front">DEV FRONT-END</span>
                    <h3 class="dev-name-hover">Eloah Barbosa</h3>
                    <p class="dev-contribution">
                        Responsável pela criação da interface responsiva, componentização do front system e aplicação das transições e efeitos em CSS.
                    </p>
                    <div class="social-links">
                        <i class="fab fa-linkedin"></i>
                        <i class="fab fa-github"></i>
                    </div>
                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="" alt="" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-back">DEV BACK-END</span>
                    <h3 class="dev-name"></h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-back">DEV BACK-END</span>
                    <h3 class="dev-name-hover">Silas Porsales</h3>
                    <p class="dev-contribution">
                        Contribuiu de forma crucial na modelagem do banco de dados (MySQL), desenvolvendo as rotas da API em PHP e integrando o sistema de autenticação segura.
                    </p>
                    <div class="social-links">
                        <i class="fab fa-linkedin"></i>
                        <i class="fab fa-github"></i>
                    </div>
                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="" alt="Samuel de Sousa" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-front">DEV FRONT-END</span>
                    <h3 class="dev-name">Samuel de Sousa</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-front">DEV FRONT-END</span>
                    <h3 class="dev-name-hover">Samuel de Sousa</h3>
                    <p class="dev-contribution">
                        Desenhou o protótipo de alta fidelidade no Figma, definiu a paleta de cores, tipografia e mapeou a jornada de experiência do usuário.
                    </p>
                    <div class="social-links">
                        <i class="fab fa-linkedin"></i>
                        <i class="fab fa-behance"></i>
                    </div>
                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400" alt="Luca Silva" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-back">DEV BACK-END</span>
                    <h3 class="dev-name">Luca Silva</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-back">DEV BACK-END</span>
                    <h3 class="dev-name-hover">Luca Silva</h3>
                    <p class="dev-contribution">
                        Estruturou as regras de negócio em PHP, configurou os servidores de hospedagem e garantiu o desempenho das consultas do site.
                    </p>
                    <div class="social-links">
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <div class="team-card">
                <div class="card-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400" alt="Mariana Souza" class="card-img">
                </div>
                <div class="card-info-basic">
                    <span class="badge-pm">PROJECT MANAGER</span>
                    <h3 class="dev-name">Mariana Souza</h3>
                </div>
                <div class="card-hover-panel">
                    <span class="badge-pm">PROJECT MANAGER</span>
                    <h3 class="dev-name-hover">Mariana Souza</h3>
                    <p class="dev-contribution">
                        Coordenou os prazos das sprints, organizou as entregas do grupo e validou os requisitos do sistema junto às regras do projeto.
                    </p>
                    <div class="social-links">
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php include 'partials/footer.php'; ?>
</body>
</html>