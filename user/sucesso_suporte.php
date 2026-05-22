<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Enviado com Sucesso - SYNC</title>
    <style>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .sucesso-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            text-align: center;
            color: #fff;
        }
        .icon-sucesso {
            font-size: 80px;
            color: #2ecc71;
            margin-bottom: 20px;
        }
        .btn-voltar {
            margin-top: 30px;
            padding: 12px 25px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-voltar:hover { background: #2980b9; }
    </style>
</head>
<body>
    <main class="main-container">
        <div class="sucesso-container">
            <i class="fa-solid fa-check-double icon-sucesso"></i>
            <h1>Pedido enviado com sucesso!</h1>
            <p>Nossa equipe técnica recebeu sua solicitação.<br>Aguarde nossa resposta em breve.</p>
            
            <a href="../inicio.php" class="btn-voltar">Voltar para o Inicio</a>
        </div>
    </main>
</body>
</html>