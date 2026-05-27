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
    
    <main class="container-equipe">
        <h1 class="titulo">Nossa equipe</h1>
        
        <div class="grid-equipe">
            
            <div class="card-equipe">
                <div class="foto-container">
                     <img src="foto-silas" alt="Silas Porssales" class="foto-img">
                </div>
                <h3 class="dev-name">Silas Porssales</h3>
                <h4 class="dev-funcao">Desenvolvedor Back-End</h4>
                
                <hr class="card-divider">
                
                <div class="especialidades"></div>
                <p class="dev-text">Responsável pela área de pagamento, sistema de contratação e fluxo de pagamentos.</p>
                
                <div class="especialidades"></div>
                <ul class="contribuicao">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div class="card-equipe">
                <div class="foto-container">
                    <img src="foto-lucas.jpg" alt="Lucas Zangrande" class="foto-img">
                </div>
                <h3 class="dev-name">Lucas Zangrande</h3>
                <h4 class="dev-funcao">Gerente de Projeto & Desenvolvedor Fullstack</h4>
                
                <hr class="card-divider">
                
                <div class="especialidades"></div>
                <p class="dev-text">Liderança do projeto e desenvolvimento dos módulos centrais 
                    (Painel do Usuário, Profissional e Admin).</p>
                
                <div class="especialidades"></div>
                <ul class="contribuicao">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div class="card-equipe">
                <div class="foto-container">
                    <img src="foto-eloah.jpg" alt="Eloah Barbosa" class="foto-img">
                </div>
                <h3 class="dev-name">Eloah Barbosa</h3>
                <h4 class="dev-funcao">Desenvolvedor Front-End & UI Designer</h4>
                
                <hr class="card-divider">
                
                <div class="especialidades"></div>
                <p class="dev-text">Responsável pela arquitetura visual da Home, identidade visual do 
                    projeto e design de interface.</p>
                
                <div class="especialidades"></div>
                <ul class="contribuicao">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            
            <div class="card-equipe">
                <div class="foto-container">
                    <img src="foto-guilherme.jpg" alt="Guilherme de Paula" class="foto-img">
                </div>
                <h3 class="dev-name">Guilherme de Paula</h3>
                <h4 class="dev-funcao">Desenvolvedor Backend</h4>
                
                <hr class="card-divider">
                
                <div class="especialidades"></div>
                <p class="dev-text">Responsável pelo banco de dados e 
                    sistemas de autenticação (Login, Cadastro e Acessos).</p>
                
                <div class="especialidades"></div>
                <ul class="contribuicao">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div class="card-equipe">
                <div class="foto-container">
                    <img src="foto-samuel.jpg" alt="Samuel de Sousa" class="foto-img">
                </div>
                <h3 class="dev-name">Samuel de Sousa</h3>
                <h4 class="dev-funcao">Desenvolvedor Front-End & UI Designer</h4>
                
                <hr class="card-divider">
                
                <div class="especialidades"></div>
                <p class="dev-text">Responsável pelas áreas institucionais (Equipe e Suporte) e 
                    também pela identidade visual da interface e do projeto.</p>
                
                <div class="especialidades"></div>
                <ul class="contribuicao">
                    <li></li>
                    <li></li>
                    <li></li>
                
                </ul>
            </div>

        </div>
    </main>

    <?php include 'partials/footer.php'; ?>
</body>
</html>