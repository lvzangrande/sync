<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Técnico Especializado - SYNC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="suporte.css">
</head>
<body>

    <main class="main-container">
        <section class="form-card">
            <header class="form-header">
                <h2>Solicitar Suporte</h2>
                <p>Preencha os dados abaixo para entrar em contato com o suporte.</p>
            </header>

            <form action="#" method="POST" class="support-form">
                
                <div class="input-group">
                    <label>Nome Completo</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user icon"></i> 
                        <input type="text" id="name" name="name" placeholder="Digite seu nome completo" required>
                     </div>
                </div>

                <div class="input-group">
                    <label for="email">E-mail Corporativo</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope icon"></i>
                        <input type="email" id="email" name="email" placeholder="nome@empresa.com" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="number">Telefone</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-mobile-screen-button icon"></i>
                        <input type="number" id="telefone" name="telefone" placeholder="(DDD) 9999-9999" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Urgência do Suporte</label>
                    <div class="priority-selector">
                    <input type="radio" name="urgencia" id="rotina" value="rotina" checked>
                    <label for="rotina" class="priority-btn">
                        <i class="fa-solid fa-calendar-check"></i> Rotina
                    </label>

                    <input type="radio" name="urgencia" id="critico" value="critico">
                    <label for="critico" class="priority-btn">
                        <i class="fa-solid fa-triangle-exclamation"></i> Crítico
                    </label>
        
                    </div>
                </div>

                <div class="input-group">
                    <label for="message">Descrição do Problema/Dúvida</label>
                    <textarea id="message" name="message" rows="5" placeholder="Descreva o defeito ou sua dúvida técnica aqui..." required></textarea>
                </div>

                <button type="submit" class="btn-submit">SOLICITAR ASSISTÊNCIA TÉCNICA</button>

            </form>
        </section>
    </main>

</body>
</html>