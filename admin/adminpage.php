<?php
session_start();
require_once '../crud.php';

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['tipo']  !== 'admin'){
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

if (isset($_GET['acao']) && isset($_GET['id_prof']) && ($_GET['acao'] === 'ativar' || $_GET['acao'] === 'recusar')) {
    $id_prof = (int)$_GET['id_prof'];
    $acao = $_GET['acao'];

    if ($acao === 'ativar') {
        $dadosAtualizados = ['status' => 'Disponível'];
        update($pdo, 'usuarios', $dadosAtualizados, "id_user = $id_prof");
    } elseif ($acao === 'recusar') {
        delete($pdo, 'usuarios', "id_user = $id_prof");
    }
    header("Location: adminpage.php");
    exit();
}

if (isset($_GET['acao']) && $_GET['acao'] === 'resolver' && isset($_GET['id_sup'])) {
    $id_sup = (int)$_GET['id_sup'];
    delete($pdo, 'suporte', "id_sup = $id_sup");
    header("Location: adminpage.php");
    exit();
}

if (isset($_GET['acao']) && $_GET['acao'] === 'excluir_ativo' && isset($_GET['id_prof'])) {
    $id_prof = (int)$_GET['id_prof'];
    delete($pdo, 'usuarios', "id_user = $id_prof");
    header("Location: adminpage.php");
    exit();
}

$profissionaisPendentes = readAll($pdo, 'usuarios', "categoria = 'profissional' AND status = 'Inativo'");
$chamadosSuporte = readAll($pdo, 'suporte');
$profissionaisAtivos = readAll($pdo, 'usuarios', "categoria = 'profissional' AND status != 'Inativo'");
$listaMaquinas = readAll($pdo, 'maquinas');
$osAtivas = readAll($pdo, 'agenda', "status_os = 'Em Andamento' OR status_os = 'Agendada' OR status_os = 'Pendente'");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração | Sync</title>

    <link rel="stylesheet" href="../css/admin.css">
    <!-- <link rel="stylesheet" href="../css/home.css"> -->
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
                <h1><?php require_once '../php/saudacao.php'; ?><span class="nome-user">, <?php nomeUsuario(); ?>!</span></h1>
            </div>
            <p>Bem-vindo ao núcleo da gestão de nossos valores. Sincronize os dados, sincronize com a <strong>SYNC</strong>!</p>
        </div>

        <section class="dashboard-cards">

            <div class="card">
                <div>
                    <h3>Técnicos Pendentes</h3>
                    <div class="number"><?= count($profissionaisPendentes); ?></div>
                </div>
                <span class="material-symbols-outlined icon">person_add</span>
            </div>

            <div class="card">
                <div>
                    <h3>OS Ativas</h3>
                    <div class="number"><?= count($osAtivas); ?></div>
                </div>
                <span class="material-symbols-outlined icon">build</span>
            </div>

            <div class="card">
                <div>
                    <h3>Suporte em Aberto</h3>
                    <div class="number"><?= count($chamadosSuporte); ?></div>
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
                    <?php if (!empty($profissionaisPendentes)): ?>
                        <?php foreach ($profissionaisPendentes as $prof): ?>
                            <tr>
                                <td><?= htmlspecialchars($prof['nome']); ?></td>
                                <td><?= htmlspecialchars($prof['especialidade'] ?? 'Não informada'); ?></td>
                                <td>
                                    <span class="status-badge pendente">
                                        <?= htmlspecialchars($prof['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="adminpage.php?acao=ativar&id_prof=<?= $prof['id_user']; ?>" class="btn-action">
                                        Ativar
                                    </a>
                                    <a href="adminpage.php?acao=recusar&id_prof=<?= $prof['id_user']; ?>" class="btn-action btn-delete"
                                        onclick="return confirm('Tem certeza que deseja recusar e excluir o cadastro de <?= htmlspecialchars($prof['nome']); ?>?');">
                                        Recusar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #979DAC; padding: 20px;">
                                Nenhum profissional aguardando aprovação no momento.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <section class="section-box">
            <h2>Chamados de Suporte Recentes</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Cliente / Usuário</th>
                        <th>Mensagem/Reclamação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($chamadosSuporte)): ?>
                        <?php foreach ($chamadosSuporte as $chamado): ?>
                            <tr>
                                <td><?= htmlspecialchars($chamado['nome_cliente'] ?? $chamado['email'] ?? 'Usuário'); ?></td>

                                <td>"<?= htmlspecialchars($chamado['desc_sup'] ?? $chamado['mensagem']); ?>"</td>

                                <td>
                                    <a href="adminpage.php?acao=resolver&id_sup=<?= $chamado['id_sup']; ?>"
                                        class="btn-action"
                                        onclick="return confirm('Deseja marcar este chamado como respondido/resolvido? Ele será arquivado.');">
                                        <span class="material-symbols-outlined" style="font-size: 16px; margin-right: 2px;">check_circle</span> Resolver
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #979DAC; padding: 20px;">
                                Nenhum chamado de suporte pendente. Bom trabalho! </td>
                        </tr>
                    <?php endif; ?>
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
                    <?php if (!empty($profissionaisAtivos)): ?>
                        <?php foreach ($profissionaisAtivos as $profAtivo): ?>
                            <tr>
                                <td><?= htmlspecialchars($profAtivo['nome']); ?></td>
                                <td><?= htmlspecialchars($profAtivo['especialidade'] ?? 'Geral'); ?></td>

                                <td>R$ <?= number_format($profAtivo['valor_dia'] ?? 0, 2, ',', '.'); ?></td>

                                <td>
                                    <?php
                                    $statusAgenda = $profAtivo['status_os'] ?? 'Disponível';
                                    $classeBadge = ($statusAgenda === 'Disponível') ? 'disponivel' : 'alocado';
                                    ?>
                                    <span class="status-badge <?= $classeBadge; ?>">
                                        <?= htmlspecialchars($statusAgenda); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="editar_item.php?id=<?= $profAtivo['id_user']; ?>&tipo=profissional" class="btn-action btn-edit">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Editar Diária
                                    </a>

                                    <a href="adminpage.php?acao=excluir_ativo&id_prof=<?= $profAtivo['id_user']; ?>"
                                        class="btn-action btn-delete"
                                        onclick="return confirm('ATENÇÃO: Deseja realmente excluir permanentemente o cadastro de <?= htmlspecialchars($profAtivo['nome']); ?>?');">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">delete</span> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #979DAC; padding: 20px;">
                                Nenhum profissional ativo encontrado no banco de dados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <section class="section-box">
            <h2>Catálogo de Equipamentos e Serviços</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Equipamento / Máquina</th>
                        <th>Tipo / Categoria</th>
                        <th>Subtipo</th>
                        <th>Tempo Estimado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaMaquinas)): ?>
                        <?php foreach ($listaMaquinas as $maq): ?>
                            <tr>
                                <td><?= htmlspecialchars($maq['nome_maq']); ?></td>
                                <td><?= htmlspecialchars($maq['tipo_maq']); ?></td>
                                <td><?= htmlspecialchars($maq['tipo2_maq'] ?? '---'); ?></td>

                                <td>
                                    <?php
                                    $horas = $maq['tempo_estimado_minutos'] / 60;
                                    echo number_format($horas, 1, ',', '') . ' Horas';
                                    ?>
                                </td>
                                <td>
                                    <a href="editar_item.php?id=<?= $maq['id_maq']; ?>&tipo=servico" class="btn-action btn-edit">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Modificar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: #979DAC; padding: 20px;">
                                Nenhuma máquina cadastrada no catálogo.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

    </main>

    <?php require_once '../partials/footer.php'; ?>

</body>

</html>