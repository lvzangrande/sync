<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Erro 404</title>
</head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        :root {
            --color-night-blue: #001233;
            --color-navy-dark: #092848;
            --color-slate-blue: #33415c;
            --white: #ffffff;
            --color-cool-gray: #7d8597;
            --color-deep-blue: #164578;
            --color-sky-light: #8bc0d6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--color-night-blue);
            font-family: Montserrat, sans-serif;
            color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .erro-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            text-align: center;
            color: #fff;
        }

        .icon-erro {
            font-size: 80px;
            color: #ca0909;
            margin-bottom: 20px;
        }

        .btn-voltar {
            margin-top: 20px;
            padding: 12px 25px;
            background: var(--color-deep-blue);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            width: 220px;
            text-align: center;
        }

        .btn-voltar:hover {
            background-color: #39678f;
            color: white;
            transition: 0.3s;
            transform: scale(1.05);
        }

    </style>
<body>
    <main class="main-container">
        <div class="erro-container">
            <i class="fa-solid fa-triangle-exclamation icon-erro"></i>
            <h1>Página não encontrada</h1>
            <p>Ops! A página que você está procurando não foi encontrada.</p>
            <p>Pode ser que o link esteja quebrado ou a página tenha sido removida.</p>
            <a href="inicio.php" class="btn-voltar">Voltar para o início</a>
            <a href="suporte.php" class="btn-voltar">Falar com o suporte</a>
        </div>
    </main>
</body>
</html>