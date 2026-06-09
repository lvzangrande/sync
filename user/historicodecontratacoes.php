<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}

$id_usuario_logado = $_SESSION['id_user'] ?? $_SESSION['id_usuario'] ?? null;
$statusFiltro = $_GET['status'] ?? 'Todas';
$ordenar = $_GET['ordenar'] ?? '';

$where = "id_cliente = $id_usuario_logado";

if ($statusFiltro !== 'Todas') {
    $where .= " AND status_os = '$statusFiltro'";
}

if ($ordenar === 'mais_proxima') {
    $where .= " ORDER BY data DESC";
} elseif ($ordenar === 'mais_distante') {
    $where .= " ORDER BY data ASC";
}

$tableAgenda = readAll($pdo, 'agenda', $where);

foreach ($tableAgenda as &$agendamento) {
    if (new DateTime($agendamento['data']) < new DateTime() && $agendamento['status_os'] === 'Agendada') {
        update($pdo, 'agenda', ['status_os' => 'Pendente'], "id_os = {$agendamento['id_os']}");
        $agendamento['status_os'] = 'Pendente';
    }
}
unset($agendamento);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de contratações</title>
    <link rel="stylesheet" href="../css/userpage.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="icon" href="imagens/logosemfundo.png">
</head>

<body>
    <?php require_once '../partials/header.php'; ?>

    <a href="./userpage.php" class="botao">Voltar</a>

    <div class="filtros">
        <?php
        $filtros = [
            'Todas',
            'Agendada',
            'Pendente',
            'Concluída',
            'Cancelada',
            'Em andamento'
        ];

        foreach ($filtros as $filtro):
            $urlParam = "?status=" . urlencode($filtro);
            if (!empty($ordenar)) {
                $urlParam .= "&ordenar=" . urlencode($ordenar);
            }

            $ativo = ($statusFiltro === $filtro) ? 'ativo' : '';
        ?>
            <a class="<?= $ativo ?>" href="<?= $urlParam ?>">
                <?= $filtro ?>
            </a>
        <?php endforeach; ?>
    </div>

    <table>
        <tr>
            <th colspan='99'>
                <div class="th-header">
                    <span>HISTÓRICO DE CONTRATAÇÕES</span>
                    <form method="GET" class="form-ordenar">
                        <input type="hidden" name="status" value="<?= htmlspecialchars($statusFiltro) ?>">
                        <select name="ordenar" onchange="this.form.submit()">
                            <option value="">Ordenar por data</option>
                            <option value="mais_proxima" <?= ($_GET['ordenar'] ?? '') == 'mais_proxima' ? 'selected' : '' ?>>
                                Data mais próxima
                            </option>
                            <option value="mais_distante" <?= ($_GET['ordenar'] ?? '') == 'mais_distante' ? 'selected' : '' ?>>
                                Data mais distante
                            </option>
                        </select>
                    </form>
                </div>
            </th>
        </tr>

        <?php
        $semContrato = false;

        foreach ($tableAgenda as $agendamento) {
            $semContrato = true;

            $nomeProfi = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
            $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);
            $valor = read($pdo, 'usuarios', 'id_user=' . $agendamento['id_profissional']);

            $palavras = explode(' ', trim($agendamento['descricao_problema']));
            $descricaoResumida = (count($palavras) > 4)
                ? implode(' ', array_slice($palavras, 0, 4)) . '...'
                : $agendamento['descricao_problema'];

            echo "
            <tr>
                <td>{$agendamento['data']}</td>
                <td title='{$agendamento['descricao_problema']}'>{$descricaoResumida}</td>
                <td><span class='status-badge " . strtolower(str_replace(' ', '-', $agendamento['status_os'])) . "'>{$agendamento['status_os']}</span></td>
                <td class='td_verDetalhes'>
                    <a class='verDetalhes' href='detalhesContratacao.php?id={$agendamento['id_os']}'>Ver detalhes</a>
                </td>
            </tr>";
        }

        if ($semContrato == false) {
            if ($statusFiltro !== 'Todas') {
                echo "<tr>
                        <td colspan='99' style='text-align: center; padding: 20px; color: #979DAC;'>Não há serviços com status '$statusFiltro'</td>
                      </tr>";
            } else {
                echo "<tr>
                        <td colspan='99' style='text-align: center; padding: 20px; color: #979DAC;'>Ainda não há mensagens</td>
                      </tr>";
            }
        }
        ?>
    </table>

</body>

</html>