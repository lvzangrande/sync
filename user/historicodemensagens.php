<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('{$_SESSION['mensagem']}');</script>";
    unset($_SESSION['mensagem']);
}

$statusFiltro = $_GET['status'] ?? 'Todos';

$nomeUsuarioLogado = $_SESSION['nome'] ?? '';
$where = "nome_cliente = '$nomeUsuarioLogado'";

if ($statusFiltro !== 'Todos') {
    $where .= " AND status_suporte = '$statusFiltro'";
}

$tableSuporte = readAll($pdo, 'suporte', $where);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Suporte</title>
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
            'Todos',
            'Respondido',
            'Pendente'
        ];

        foreach ($filtros as $filtro):
            $ativo = ($statusFiltro === $filtro) ? 'ativo' : '';
        ?>
            <a class="<?= $ativo ?>" href="?status=<?= urlencode($filtro) ?>">
                <?= $filtro ?>
            </a>
        <?php endforeach; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th colspan='4'>HISTÓRICO DE SUPORTE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($tableSuporte)) {
                foreach($tableSuporte as $ticket){
                    
                    $palavrasDesc = explode(' ', trim($ticket['desc_sup'])); 
                    $descricaoResumida = (count($palavrasDesc) > 4) 
                        ? implode(' ', array_slice($palavrasDesc, 0, 4)) . '...' 
                        : $ticket['desc_sup'];

                    echo "
                    <tr>
                        <td>" . htmlspecialchars($ticket['nome_cliente']) . "</td>
                        <td title='" . htmlspecialchars($ticket['desc_sup']) . "'>{$descricaoResumida}</td>
                        <td>" . htmlspecialchars($ticket['status_suporte']) . "</td>
                        <td class='td_verDetalhes'>
                            <a class='verDetalhes' href='detalhesSuporte.php?id={$ticket['id_sup']}'>Ver detalhes</a>
                        </td>
                    </tr>";
                }
            } else {
                if ($statusFiltro !== 'Todos') {
                    echo "<tr>
                            <td colspan='4' style='text-align: center; padding: 20px; color: #979DAC;'>
                                Não há mensagens com status '$statusFiltro'
                            </td>
                          </tr>";
                } else {
                    echo "<tr>
                            <td colspan='4' style='text-align: center; padding: 20px; color: #979DAC;'>
                                Ainda não há mensagens no seu histórico.
                            </td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>