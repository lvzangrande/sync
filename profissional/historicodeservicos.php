<?php
if (session_status() === PHP_SESSION_NONE){
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
// adiciona o método de pagamento na tabela do sql, só exibe no detalhe de contratações
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
require_once '../crud.php';
require_once '../partials/header.php';

$tableAgenda = readAll($pdo, 'agenda');

$serv_pend  = 0;
$serv_conc  = 0;
$serv_agend = 0;

foreach($tableAgenda as $agendamento){
    if($agendamento['id_profissional'] === $_SESSION['id_user']){
        if($agendamento['status_os'] == 'Concluída'){
            $serv_conc++;
        }
        elseif($agendamento['status_os'] == 'Pendente'){
            $serv_pend++;
        }
        elseif($agendamento['status_os'] == 'Agendada'){
            $serv_agend++;
        }
    }
}
?>
<body>
    <a href="./profipage.php">Voltar</a>

    <?php
    $agenPendOuAgend = 0;
        foreach($tableAgenda as $agendamento){
            if(($agendamento['status_os'] === 'Pendente' || $agendamento['status_os'] === 'Agendada') && $agendamento['id_profissional'] === $_SESSION['id_user']){
                $agenPendOuAgend++;
            }
        }
    if($agenPendOuAgend > 0){
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
        
        <table class="históricoserv">
            <tr>
                <th colspan="99"><h2>HISTÓRICO DE SERVIÇOS</h2></th>
            </tr>
<?php
$temAgendamento = false;

foreach($tableAgenda as $agendamento){

    $nomeProfi   = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
    $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);

    $palavras = explode(' ', trim($agendamento['descricao_problema']));
    $descricaoResumida = (count($palavras) > 4)
        ? implode(' ', array_slice($palavras, 0, 4)) . '...'
        : $agendamento['descricao_problema'];

    if($agendamento['id_profissional'] === $_SESSION['id_user'] && $agendamento['status_os'] == 'Concluída'){
        $temAgendamento = true;
        echo "<tr class='linhatabela'>
                <td>".$descricaoResumida."</td>
                <td>".$agendamento['data']."</td>
                <td><a class='verDetalhes' href='detalhesserv.php?id=".$agendamento['id_os']."'>Ver detalhes</a></td>
              </tr>";
    }
}

if($temAgendamento == false){
    echo "<tr class='linhatabela'>
            <td colspan='99'>Nenhum serviço foi concluído</td>
          </tr>";
}
?>
        </table>
    </div>
</body>
</html>