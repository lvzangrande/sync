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
//adiciona o método de pagamento na tabela do sql, só exibe no detalhe de contratações
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de contratações</title>
    <link rel="stylesheet" href="../css/profipage.css">
    <link rel="stylesheet" href="../css/partials.css">
</head>
<?php
require_once '../partials/header.php';
?>
<body>
    <a href="./profipage.php">Voltar</a>
    <div class="body">
<?php
    require_once '../crud.php';

$tableAgenda = readAll($pdo,'agenda');


$serv_pend = 0;
$serv_conc = 0;
foreach($tableAgenda as $agendamento){"";}
if($agendamento['status_os'] == 'Concluída'){
    foreach($tableAgenda as $agendamento)
    $serv_conc++;
;}
if($agendamento['status_os'] != 'Concluída' && $agendamento['status_os'] != 'Cancelada'){
    foreach($tableAgenda as $agendamento)
    $serv_pend++;
;}
?>
<div class="servicos">

<p>Serviços pendentes<br><b class="pendente"><?=$serv_pend?></b></p>

<a href="#" class="conferir">Conferir</a>

<p>Serviços concluídos<br><b class="concluido"><?=$serv_conc?></b></p>
</div>    
    <table>
        <tr>
            <!--<th colspan="99">Histórico de contratações<th>-->
            <th>Data</th>
            <th>Tempo estimado</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Endereço</th>
            <th>Contratante</th>
            <th>Profissional</th>
            <th>Status</th>
            <th class='td_verDetalhes'></th>
        </tr>
<?php
        foreach($tableAgenda as $agendamento){

    $nomeProfi = read_nome_via_ID($pdo,'usuarios',$agendamento['id_profissional']);
    $nomeCliente = read_nome_via_ID($pdo,'usuarios',$agendamento['id_cliente']);
$palavras = explode(' ', trim($agendamento['descricao_problema'])); 
    
    $descricaoResumida = (count($palavras) > 4) 
        ? implode(' ', array_slice($palavras, 0, 4)) . '...' 
        : $agendamento['descricao_problema'];
        
        if($agendamento['id_profissional'] === $_SESSION['id_user']){
            echo "<tr>
                    <td>".$agendamento['data']."</td>
                    <td>".$agendamento['tempo_planejado']."</td>
                    <td>".$agendamento['valor_total']."</td>
                    <td>".$descricaoResumida."</td>
                    <td>".$agendamento['endereco_servico']."</td>
                    <td>".$nomeCliente."</td>
                    <td>".$nomeProfi."</td>
                    <td>".$agendamento['status_os']."</td>
                    <td class='td_verDetalhes'><a class='verDetalhes' href='detalhesserv.php?id=".$agendamento['id_os']."'>Ver detalhes</a></td>";
        }
    }
?>
</table>
</div>
</body>
</html>