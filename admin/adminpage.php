<?php
session_start();
require_once '../crud.php';



if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

function nomeUsuario()
{
    if (isset($_SESSION['nome'])) {
        $nomeCompleto = trim($_SESSION['nome']);
        $palavras = explode(" ", $nomeCompleto);
        $duasPalavras = array_slice($palavras, 0, 2);
        $nomeEncurtado = implode(" ", $duasPalavras);

        echo htmlspecialchars($nomeEncurtado);
    } else {
        echo "Usuário";
    }
}

$profissionaisPendentes = readAll($pdo, 'usuarios', "tipo = 'profissional' AND status = 'Inativo'");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração - Sync</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <style>
        .admin-header-saudacao {
            margin-bottom: 30px;
        }

        .linha-saudacao {
            display: flex;
            flex-direction: row;
            align-items: baseline;
            flex-wrap: nowrap;
        }

        .linha-saudacao h1 {
            color: #8BC0D6;
            /* Misty Blue */
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            padding: 0;
            display: inline;
        }

        /* Estilização do Nome do Usuário */
        .nome-user {
            color: #fff;
            /* Nome em Branco */
            font-size: 28px;
            font-weight: 700;
        }

        /* Texto de apoio embaixo */
        .admin-header-saudacao p {
            color: #979DAC;
            /* Light Slate */
            font-size: 16px;
            margin-top: 5px;
        }

        .admin-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            font-family: 'Lexend', sans-serif;
        }

        .admin-title {
            color: #fff;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 700;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: #33415C;
            border: 1px solid #7D8597;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card h3 {
            font-size: 14px;
            color: #979DAC;
            margin-bottom: 5px;
        }

        .card .number {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
        }

        .card .icon {
            color: #326B93;
            font-size: 35px;
        }

        .section-box {
            background-color: #33415C;
            border: 1px solid #7D8597;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 35px;
        }

        .section-box h2 {
            color: #fff;
            font-size: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #7D8597;
            padding-bottom: 10px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .custom-table th,
        .custom-table td {
            padding: 14px 15px;
            border-bottom: 1px solid #7D8597;
        }

        .custom-table th {
            color: #8BC0D6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .custom-table td {
            color: #fff;
            font-size: 15px;
        }

        /* STATUS E BOTÕES DE AÇÃO */
        .status-badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-badge.pendente {
            background-color: #e6a23c;
            color: #000;
        }

        .btn-action {
            background-color: #164578;
            /* Royal Industrial */
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .btn-action:hover {
            background-color: #326B93;
            /* Steel Blue */
        }

        .btn-delete {
            background-color: #c0392b;
            margin-left: 5px;
        }

        .btn-delete:hover {
            background-color: #e74c3c;
        }
    </style>
</head>

<body>

    <?php require_once '../partials/header.php'; ?>

    <main class="admin-container">

        <div class="admin-header-saudacao">
            <?php require_once '../php/saudacao.php'; ?>
            <span class="nome-user">, <?php nomeUsuario(); ?>!</span>
            <p>Painel de Controle Estratégico</p>
        </div>

        <section class="dashboard-cards">
            <div class="card">
                <div>
                    <h3>Técnicos Pendentes</h3>
                    <div class="number">3</div>
                </div>
                <span class="material-symbols-outlined icon">person_add</span>
            </div>
            <div class="card">
                <div>
                    <h3>OS Ativas</h3>
                    <div class="number">12</div>
                </div>
                <span class="material-symbols-outlined icon">build</span>
            </div>
            <div class="card">
                <div>
                    <h3>Suporte em Aberto</h3>
                    <div class="number">2</div>
                </div>
                <span class="material-symbols-outlined icon">mail</span>
            </div>
        </section>

        <section class="section-box">
            <h2>Aprovação de Novos Profissionais</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Carlos Mendoza</td>
                        <td>Sistemas Hidráulicos</td>
                        <td><span class="status-badge pendente">Inativo</span></td>
                        <td>
                            <button class="btn-action">Ativar</button>
                            <button class="btn-action btn-delete">Recusar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Roberto Silva</td>
                        <td>Manutenção de Motores</td>
                        <td><span class="status-badge pendente">Inativo</span></td>
                        <td>
                            <button class="btn-action">Ativar</button>
                            <button class="btn-action btn-delete">Recusar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section-box">
            <h2>Chamados de Suporte Recentes</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Mensagem/Reclamação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Metalúrgica Alfa</td>
                        <td>"Problema ao tentar selecionar múltiplos motores no formulário."</td>
                        <td>
                            <button class="btn-action">Responder</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

    <?php require_once '../partials/footer.php'; ?>

</body>

</html>