<?php
session_start();
require_once '../crud.php';

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['tipo']  !== 'admin') {
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

if (isset($_POST['acao']) && isset($_POST['id_prof']) && ($_POST['acao'] === 'ativar' || $_POST['acao'] === 'recusar')) {
    $id_prof = (int)$_POST['id_prof'];
    $acao = $_POST['acao'];

    if ($acao === 'ativar') {
        $dadosAtualizados = ['status' => 'Disponível'];
        update($pdo, 'usuarios', $dadosAtualizados, "id_user = $id_prof");
    } elseif ($acao === 'recusar') {
        delete($pdo, 'usuarios', "id_user = $id_prof");
    }
    header("Location: adminpage.php");
    exit();
}

if (isset($_POST['acao']) && $_POST['acao'] === 'excluir_ativo' && isset($_POST['id_prof'])) {
    $id_prof = (int)$_POST['id_prof'];
    $busca_prof = read($pdo, 'usuarios', "id_user = $id_prof");
    if ($busca_prof && $busca_prof['status'] === 'Em Atendimento') {
        $_SESSION['erro_admin'] = "Impossível remover um profissional quando ele está em atendimento.";
    } else {
        delete($pdo, 'usuarios', "id_user = $id_prof");
        header("Location: adminpage.php");
        exit();
    }
    header("Location: adminpage.php");
    exit();
}

$profissionaisPendentes = readAll($pdo, 'usuarios', "categoria = 'profissional' AND status = 'Inativo'");
$chamadosSuporte = readAll($pdo, 'suporte', "status_suporte = 'Pendente'");
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
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="imagens/logosemfundo.png">


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
                                    <form action="adminpage.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="acao" value="ativar">
                                        <input type="hidden" name="id_prof" value="<?= $prof['id_user']; ?>">
                                        <button type="submit" class="btn-action">
                                            Ativar
                                        </button>
                                    </form>
                                    <form action="adminpage.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="acao" value="recusar">
                                        <input type="hidden" name="id_prof" value="<?= $prof['id_user']; ?>">
                                        <button type="submit" class="btn-action btn-delete">
                                            Recusar
                                        </button>
                                    </form>
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

                                <td style="max-width: 300px; white-space: normal; word-break: break-word;">
                                    <?= htmlspecialchars($chamado['desc_sup'] ?? $chamado['mensagem']); ?>
                                </td>
                                <td>
                                    <a href="responder_suporte.php?id=<?= $chamado['id_sup']; ?>" class="btn-action" style="display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">chat</span> Responder
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
                <?php if (isset($_SESSION['sucesso_suporte'])): ?>
                    <div class="alert-success" style="padding: 12px; background-color: #092848; color: #FFFFFF; border: 1px solid #8BC0D6; border-radius: 4px; margin-bottom: 20px; text-align: center; font-family: 'Lexend', sans-serif;">
                        <i class="bi bi-check-circle-fill" style="color: #8BC0D6; margin-right: 8px;"></i> <?= $_SESSION['sucesso_suporte']; ?>
                    </div>
                    <?php unset($_SESSION['sucesso_suporte']);
                    ?>
                <?php endif; ?>
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
                                    $statusAgenda = $profAtivo['status'] ?? 'Disponível';
                                    $classeBadge = ($statusAgenda === 'Disponível') ? 'disponivel' : 'alocado';
                                    ?>
                                    <span class="status-badge <?= $classeBadge; ?>">
                                        <?= htmlspecialchars($statusAgenda); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="editar_item.php?id=<?= $profAtivo['id_user']; ?>&tipo=profissional" class="btn-action btn-edit">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">edit</span> Editar
                                    </a>

                                    <form action="adminpage.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="acao" value="excluir_ativo">
                                        <input type="hidden" name="id_prof" value="<?= $profAtivo['id_user']; ?>">
                                        <button type="submit" class="btn-action btn-delete">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">delete</span> Excluir
                                        </button>

                                    </form>

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
                <?php if (isset($_SESSION['erro_admin'])): ?>
                    <div class="alert-error" style="padding: 12px; background-color: #5c1e29; color: #f8d7da; border: 1px solid #721c24; border-radius: 4px; margin-bottom: 20px; text-align: center; font-family: 'Lexend', sans-serif;">
                        <?= $_SESSION['erro_admin']; ?>
                    </div>
                    <?php unset($_SESSION['erro_admin']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['sucesso_admin'])): ?>
                    <div class="alert-success" style="padding: 12px; background-color: #092848; color: #FFFFFF; border: 1px solid #8BC0D6; border-radius: 4px; margin-bottom: 20px; text-align: center; font-family: 'Lexend', sans-serif;">
                        <i class="bi bi-check-circle-fill" style="color: #8BC0D6; margin-right: 8px;"></i> <?= $_SESSION['sucesso_admin']; ?>
                    </div>
                    <?php unset($_SESSION['sucesso_admin']); ?>
                <?php endif; ?>
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
                                    $horas = ($maq['tempo_estimado_minutos'] ?? 0) / 60;
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