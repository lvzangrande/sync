<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['mensagem'])) {
    echo "
    <script>
        alert('{$_SESSION['mensagem']}');
    </script>
    ";
    unset($_SESSION['mensagem']);
}

require_once "../crud.php";
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

$filtro = $_GET['filtro'] ?? 'Todos';

foreach ($tableAgenda as $agendamento) {
    if ($agendamento['status_os'] != 'Concluída' && new DateTime($agendamento['data']) < new DateTime()) {
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
    <title>Serviços Agendados</title>
    <link rel="stylesheet" href="../css/profipage.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="icon" href="imagens/logosemfundo.png">
</head>
<?php require_once '../partials/header.php'; ?>

<body>

    <a href="./profipage.php">Voltar</a>

    <div class="filtros">
        <?php
        $filtros = [
            'Todos',
            'Pendente',
            'Próximo',
            'Distante',
        ];

        foreach ($filtros as $item):
            $ativo = ($filtro === $item) ? 'ativo' : '';
            ?>
            <a class="<?= $ativo ?>" href="?filtro=<?= urlencode($item) ?>">
                <?= $item ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="tipos_status">
        <div class="atrasado"></div><a>Pendente</a>
        <div class="proximo"></div><a>Próximo</a>
        <div class="distante"></div><a>Distante</a>
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
            <th colspan='99'>SERVIÇOS AGENDADOS</th>
        </tr>

        <?php
        $hoje = new DateTime();
        $temAgendamento = false;

        foreach ($tableAgenda as $agendamento) {

            $nomeProfi = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
            $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);

            $palavras = explode(' ', trim($agendamento['descricao_problema']));
            $descricaoResumida = (count($palavras) > 4)
                ? implode(' ', array_slice($palavras, 0, 4)) . '...'
                : $agendamento['descricao_problema'];

            $dataAgendamento = new DateTime($agendamento['data']);
            $diferenca = (int) $hoje->diff($dataAgendamento)->format('%r%a');

            $status = "";

            if ($diferenca <= 0) {
                $status = "atrasado";

                if ($agendamento['status_os'] != 'Concluída' && $agendamento['status_os'] != 'Cancelada') {
                    update($pdo, 'agenda', ['status_os' => 'Pendente'], "id_os = " . $agendamento['id_os']);
                    $agendamento['status_os'] = 'Pendente';
                }
            } elseif ($diferenca >= 21) {
                $status = "distante";
            } else {
                $status = "proximo";
            }

            $statusFiltroAtual = '';

            if ($agendamento['status_os'] == 'Pendente') {
                $statusFiltroAtual = 'Pendente';
            } elseif ($status == 'proximo') {
                $statusFiltroAtual = 'Próximo';
            } elseif ($status == 'distante') {
                $statusFiltroAtual = 'Distante';
            }

            if ($filtro != 'Todos' && $filtro != $statusFiltroAtual) {
                continue;
            }

            if ($agendamento['id_profissional'] === $_SESSION['id_user']) {
                if ($agendamento['status_os'] != 'Concluída' && $agendamento['status_os'] != 'Cancelada') {
                    $temAgendamento = true;

                    echo "<tr>
                    <td><div class='" . $status . "'></div></td>
                    <td>" . $agendamento['data'] . "</td>
                    <td>" . $descricaoResumida . "</td>
                    <td>" . $agendamento['endereco_servico'] . "</td>
                    <td class='td_verDetalhes'>
                        <a class='verDetalhes' href='detalhesserv.php?id=" . $agendamento['id_os'] . "'>
                            Ver detalhes
                        </a>
                    </td>
                  </tr>";
                }
            }
        }

        if ($temAgendamento == false) {
            if ($filtro == 'Todos') {
                echo "<tr>
            <td colspan='99'>Nenhum serviço agendado</td>
          </tr>";
            } else {
                echo "<tr>
            <td colspan='99'>Nenhum serviço agendado com o status '" . $filtro . "'</td>
          </tr>";
            }
        }
        ?>
    </table>
</body>

</html>