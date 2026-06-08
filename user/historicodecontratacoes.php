<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}

$statusFiltro = $_GET['status'] ?? 'Todas';

$where = null;

if ($statusFiltro !== 'Todas') {
    $where = "status_os = '$statusFiltro'";
}
$order = '';

if (!empty($_GET['ordenar'])) {

    if ($_GET['ordenar'] == 'mais_proxima') {
        $order = '1=1 ORDER BY data DESC';
    }

    if ($_GET['ordenar'] == 'mais_distante') {
        $order = '1=1 ORDER BY data ASC';
    }
}

$tableAgenda = readAll($pdo, 'agenda', $order);

foreach ($tableAgenda as $agendamento) {
    if (new DateTime($agendamento['data']) < new DateTime()) {
        update($pdo, 'agenda', ['status_os' => 'Pendente'], "id_os = {$agendamento['id_os']}");
        $agendamento['status_os'] = 'Pendente';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de contratações</title>
    <link rel="stylesheet" href="../css/userpage.css">
    <link rel="stylesheet" href="../css/partials.css">
</head>

<body>
    <?php require_once '../partials/header.php'; ?>

    <a href="./userpage.php">Voltar</a>

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
            $ativo = ($statusFiltro === $filtro) ? 'ativo' : '';
            ?>
            <a class="<?= $ativo ?>" href="?status=<?= urlencode($filtro) ?>">
                <?= $filtro ?>
            </a>
        <?php endforeach; ?>
    </div>
    <form method="GET">
        <select name="ordenar" onchange="this.form.submit()">
            <option value="">Ordenar</option>

            <option value="mais_proxima" <?= ($_GET['ordenar'] ?? '') == 'mais_proxima' ? 'selected' : '' ?>>
                Data mais próxima
            </option>

            <option value="mais_distante" <?= ($_GET['ordenar'] ?? '') == 'mais_distante' ? 'selected' : '' ?>>
                Data mais distante
            </option>
        </select>
    </form>
    <table>
        <tr>
            <th colspan="99">HISTÓRICO DE CONTRATAÇÕES</th>
        </tr>

        <?php
        $semContrato = false;
        foreach ($tableAgenda as $agendamento) {
            $semContrato = true;
            $nomeProfi = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
            $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);
            $valor = read($pdo, 'usuarios', 'id_user=' . $agendamento['id_profissional']);
            $palavras = explode(' ', trim($agendamento['descricao_problema']));

            if (count($palavras) > 4) {
                $descricaoResumida = implode(' ', array_slice($palavras, 0, 4)) . '...';
            } else {
                $descricaoResumida = $agendamento['descricao_problema'];
            }
            echo "
    <tr>
        <td>{$agendamento['data']}</td>
        <td>{$descricaoResumida}</td>
        <td>{$agendamento['status_os']}</td>
        <td class='td_verDetalhes'>
            <a class='verDetalhes' href='detalhesContratacao.php?id={$agendamento['id_os']}'>Ver detalhes</a>
        </td>
    </tr>";
        }
        if ($semContrato == false) {
            echo "<tr>
            <td colspan='99'>Não há serviços $status</td>
          </tr>";
        }
        ?>
    </table>

</body>

</html>