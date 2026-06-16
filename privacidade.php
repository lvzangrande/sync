
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacidade do Usuário - Sync Mecatronics</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/privacidade.css">
    <link rel="stylesheet" href="css/partials.css">
</head>
<body>
    <?php require_once 'partials/header.php';?>
    <div class="header-privacidade">
        <div class="simbolo">Segurança e Transparência</div>
        <h1>Garantia de <span class="sincro">Privacidade</span></h1>
    </div>

    <main class="container-principal">
        <p class="texto-intro">
            Na Sync Mecatronics, entendemos que a gestão de serviços industriais exige o mais alto nível de confidencialidade. Nosso compromisso é proteger seus dados operacionais e as informações de seus colaboradores com infraestrutura robusta e processos rigorosos, em total conformidade com a LGPD.
        </p>

        <div class="container-boxes">
            <div class="caixa">
                <i class="fa-solid fa-shield-halved icone-caixa"></i>
                <h2>Proteção B2B</h2>
                <p>Nossa plataforma foi desenvolvida para isolar completamente os dados de cada cliente. As informações de suas plantas, máquinas, ordens de serviço e histórico de manutenção são tratadas sob estrito sigilo comercial, acessíveis apenas pelos usuários que você autorizar.</p>
            </div>

            <div class="caixa2">
                <i class="fa-solid fa-user-lock icone-caixa"></i>
                <h2>Dados dos Profissionais</h2>
                <p>As informações pessoais dos técnicos da Sync Mecatronics (como CPF, RG e certificações de segurança) são disponibilizadas no sistema exclusivamente para fins de controle de acesso físico às suas instalações e auditoria de conformidade, garantindo a segurança do trabalho sem expor dados desnecessários.</p>
            </div>

            <div class="caixa2">
                <i class="fa-solid fa-server icone-caixa"></i>
                <h2>Infraestrutura Segura</h2>
                <p>Utilizamos servidores com criptografia de ponta a ponta e backups redundantes. Em caso de término do contrato, garantimos um período de 30 dias para extração de seus relatórios, seguido da eliminação segura e definitiva dos seus dados operacionais do nosso ambiente.</p>
            </div>

            <div class="caixa">
                <i class="fa-solid fa-eye-slash icone-caixa"></i>
                <h2>Controle de Acesso</h2>
                <p>Você gerencia quem pode visualizar, aprovar orçamentos ou solicitar serviços. A responsabilidade pelas credenciais é gerida através de níveis de permissão definidos pelo próprio cliente, evitando acessos não autorizados internamente.</p>
            </div>
        </div>

        <section class="passos-seguranca">
            <h2>Nossos Pilares de <span class="destaque-azul">Segurança</span></h2>
            
            <div class="container-cards">
                <div class="card">
                    <h1>01</h1>
                    <h3>Criptografia</h3>
                    <p>Todos os dados em trânsito e em repouso são protegidos por protocolos de criptografia avançados, impedindo interceptações.</p>
                </div>
                
                <div class="card">
                    <h1>02</h1>
                    <h3>Conformidade LGPD</h3>
                    <p>Atuamos como operadores deles mesmos, respeitando rigorosamente a Lei Geral de Proteção de Dados brasileira.</p>
                </div>

                <div class="card">
                    <h1>03</h1>
                    <h3>Auditoria Contínua</h3>
                    <p>Monitoramos o sistema constantemente para identificar e bloquear tentativas de acesso anômalas ou atividades suspeitas.</p>
                </div>

                <div class="card">
                    <h1>04</h1>
                    <h3>Transparência</h3>
                    <p>Qualquer atualização em nossas políticas de privacidade será comunicada de forma clara e com antecedência aos gestores da conta.</p>
                </div>
            </div>
        </section>

        <div class="sincronize">
            <a href="<?= $base ?>termosdeuso.php" class="btn-comecar2">
                <i class="fa-solid fa-file-contract"></i> Ler Termos de Uso Completos
            </a>
        </div>
    </main>
</body>
</html>
