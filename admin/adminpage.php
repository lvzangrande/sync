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

    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


</head>

<body>

    <?php require_once '../partials/header.php'; ?>

    <main class="admin-container">

        <div class="admin-header-saudacao">
            <div class="linha-saudacao">
                <?php require_once '../php/saudacao.php'; ?><span class="nome-user">, <?php nomeUsuario(); ?>!</span>
            </div>
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

        <section class="section-box">
            <h2>Profissionais Ativos e Diárias</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>Valor Diária</th>
                        <th>Status Atual</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lucas Zangrande</td>
                        <td>Manutenção Mecatrônica</td>
                        <td>R$ 450,00</td>
                        <td><span class="status-badge disponivel">Disponível</span></td>
                        <td>
                            <button class="btn-action btn-edit"><span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Editar Diária</button>
                            <button class="btn-action btn-delete"><span class="material-symbols-outlined" style="font-size: 16px;">delete</span> Excluir</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Guilherme Silva</td>
                        <td>Sistemas Pneumáticos</td>
                        <td>R$ 400,00</td>
                        <td><span class="status-badge alocado">Em Atendimento</span></td>
                        <td>
                            <button class="btn-action btn-edit"><span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Editar Diária</button>
                            <button class="btn-action btn-delete"><span class="material-symbols-outlined" style="font-size: 16px;">delete</span> Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section-box">
            <h2>Catálogo de Equipamentos e Serviços</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Equipamento / Máquina</th>
                        <th>Tipo/Especialidade</th>
                        <th>Tempo Estimado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Injetora de Plástico</td>
                        <td>Hidráulica / Mecatrônica</td>
                        <td>16 Horas</td>
                        <td>
                            <button class="btn-action btn-edit"><span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Modificar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Servomotores AC/DC</td>
                        <td>Motores / Eletromecânica</td>
                        <td>08 Horas</td>
                        <td>
                            <button class="btn-action btn-edit"><span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Modificar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

    <?php require_once '../partials/footer.php'; ?>

</body>

</html>