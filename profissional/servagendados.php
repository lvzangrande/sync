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

require_once "../crud.php";

$tableAgenda = readAll($pdo,'agenda');



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
    <div class="tipos_status">
    
    <div class="concluido"></div><a>Concluído</a>

    <div class="proximo"></div><a>Próximo</a>

    <div class="distante"></div><a>Distante</a>

    <div class="atrasado"></div><a>Pendente</a>
</div>
<a href="./profipage.php">Voltar</a>
    <div class="body">
<?php
    require_once '../crud.php';

$tableAgenda = readAll($pdo,'agenda');

?>    
    <table>
        <tr>
            <!--<th colspan="99">Histórico de contratações<th>-->
            <th><th>
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
$hoje = new DateTime();

        foreach($tableAgenda as $agendamento){

    $nomeProfi = read_nome_via_ID($pdo,'usuarios',$agendamento['id_profissional']);
    $nomeCliente = read_nome_via_ID($pdo,'usuarios',$agendamento['id_cliente']);
$palavras = explode(' ', trim($agendamento['descricao_problema'])); 
    
    $descricaoResumida = (count($palavras) > 4) 
        ? implode(' ', array_slice($palavras, 0, 4)) . '...' 
        : $agendamento['descricao_problema'];

        $dataAgendamento =new DateTime($agendamento['data']);
                
        $diferenca = (int)$hoje->diff($dataAgendamento)->format('%r%a');

        $status = "";
        if($diferenca <= 0){
            $status="atrasado";
        }
        if($diferenca >= 21){
            $status="distante";
        }
        else{
            $status="proximo";
        }
            if($agendamento['id_profissional'] === $_SESSION['id_user']){
                if($agendamento['status_os'] != 'Concluída' && $agendamento['status_os'] != 'Cancelada'){

                        echo "<tr>
                                <td><div class='".$status."'></div></td>
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
        }
?>
</table>
</div>
</body>
</html>