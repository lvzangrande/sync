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
$id = $_SESSION['id_user'];
$where = "id_profissional = $id";

if (!empty($_GET['ordenar'])) {
    if ($_GET['ordenar'] == 'mais_proxima') $where .= " ORDER BY data ASC";
    if ($_GET['ordenar'] == 'mais_distante') $where .= " ORDER BY data DESC";
}
$tableAgenda = readAll($pdo, 'agenda', $where);

$filtro = $_GET['filtro'] ?? 'Todos';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de serviços</title>
    <link rel="stylesheet" href="../css/profipage.css">
    <link rel="stylesheet" href="../css/partials.css">
    <link rel="icon" href="imagens/logosemfundo.png">
</head>
<?php
$serv_pend = 0;
$serv_conc = 0;
$serv_agend = 0;

foreach ($tableAgenda as $agendamento) {
    if ($agendamento['id_profissional'] === $_SESSION['id_user']) {
        if ($agendamento['status_os'] == 'Concluída') {
            $serv_conc++;
        } elseif ($agendamento['status_os'] == 'Pendente') {
            $serv_pend++;
        } elseif ($agendamento['status_os'] == 'Agendada') {
            $serv_agend++;
        }
    }
}
?>

<body>
    <?php require_once '../partials/header.php'; ?>

    <a href="./profipage.php">Voltar</a>

    <?php
    $agenPendOuAgend = 0;
    foreach ($tableAgenda as $agendamento) {
        if (($agendamento['status_os'] === 'Pendente' || $agendamento['status_os'] === 'Agendada') && $agendamento['id_profissional'] === $_SESSION['id_user']) {
            $agenPendOuAgend++;
        }
    }
    if ($agenPendOuAgend > 0) {
        echo "
    <div class='servicos'>
        <h2>Atenção você tem:</h2>

        <div class='pendeagen'>
            <p>SERVIÇOS PENDENTES<br><a class='servpendente'><b>{$serv_pend}</b></a></p>

            <p>SERVIÇOS AGENDADOS<br><a class='servagend'><b>{$serv_agend}</b></a></p>
        </div>

        <a href='servagendados.php'>
            <div class='conferir'>
                <b>Conferir</b>
            </div>
        </a>
    </div>";
    }
    ?>
    
    <div class="filtros">
        <?php
        $filtros = [
            'Todos',
            'Concluída',
            'Cancelada',
        ];

        foreach ($filtros as $item):
            $ativo = ($filtro === $item) ? 'ativo' : '';
            // Mantém o parâmetro de ordenação ao clicar nos filtros
            $urlParams = "?filtro=" . urlencode($item);
            if (!empty($_GET['ordenar'])) {
                $urlParams .= "&ordenar=" . urlencode($_GET['ordenar']);
            }
        ?>
            <a class="<?= $ativo ?>" href="<?= $urlParams ?>">
                <?= $item ?>
            </a>
        <?php endforeach; ?>
    </div>

    <table>
        <tr>
            <th colspan='99'>
                <div class="th-header">
                    <span>HISTÓRICO DE SERVIÇOS</span>
                    <form method="GET" class="form-ordenar">
                        <input type="hidden" name="filtro" value="<?= htmlspecialchars($filtro) ?>">
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
                </div>
            </th>
        </tr>
        <?php
        $temAgendamento = false;

        foreach ($tableAgenda as $agendamento) {
            if ($agendamento['id_profissional'] !== $_SESSION['id_user']) {
                continue;
            }

            $nomeProfi = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
            $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);

            $palavras = explode(' ', trim($agendamento['descricao_problema']));
            $descricaoResumida = (count($palavras) > 4)
                ? implode(' ', array_slice($palavras, 0, 4)) . '...'
                : $agendamento['descricao_problema'];
            $statusFiltroAtual = $agendamento['status_os'];


            if ($filtro != 'Todos' && $filtro != $statusFiltroAtual) {
                continue;
            }

            if ($agendamento['status_os'] == 'Concluída' || $agendamento['status_os'] == 'Cancelada') {
                $temAgendamento = true;
                echo "<tr class='linhatabela'>
                <td>" . $descricaoResumida . "</td>
                <td>" . $agendamento['data'] . "</td>
                <td><a class='verDetalhes' href='detalhesserv.php?id=" . $agendamento['id_os'] . "'>Ver detalhes</a></td>
              </tr>";
            }
        }

        if ($temAgendamento == false) {
            if ($filtro == 'Todos') {
                echo "<tr class='linhatabela'>
                    <td colspan='99'>Nenhum serviço finalizado no seu histórico.</td>
                  </tr>";
            } else {
                echo "<tr class='linhatabela'>
                    <td colspan='99'>Nenhum serviço encontrado com o status '" . htmlspecialchars($filtro) . "'.</td>
                  </tr>";
            }
        }
        ?>
    </table>
</body>

</html>