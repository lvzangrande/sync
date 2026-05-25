<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de contratações</title>
    <link rel="stylesheet" href="../css/userpage.css">
</head>
<?php
require_once '../partials/header.php';
?>
<body>
    <table>
        <tr>
            <!--<th colspan="99">Histórico de contratações<th>-->
            <th>Data</th>
            <th>Tempo estimado</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Endereço</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>
                <a></a>
                <a>11/09</a>
                <a class='verdetalhes' href=''>Ver detalhes</a>
            </td>
        </tr>
<?php
require_once '../crud.php';

    /*
    if (isset($_SESSION['nome'])) {
        $valorAgendamento = trim($_SESSION['nome']);
    }
    if (isset($_SESSION['nome'])) {
        $dataAgendamento = trim($_SESSION['data']);
    }
    if (isset($_SESSION['nome'])) {
        $tempoAgendamento = trim($_SESSION['minutos']);
    }*/
    //pegar o nome do cliente e do profissional atrávez do id

$tableAgenda = readAll($pdo,'agenda');
        foreach($tableAgenda as $agendamento){

    $nomeProfi = read_nome_via_ID($pdo,'usuarios',$agendamento['id_cliente']);
    $nomeCliente = read_nome_via_ID($pdo,'usuarios',$agendamento['id_cliente']);
$palavras = explode(' ', trim($agendamento['descricao'])); 
    
    // 2. Se tiver mais de 4 palavras, corta e junta com '...', senão mantém o texto original
    $descricaoResumida = (count($palavras) > 4) 
        ? implode(' ', array_slice($palavras, 0, 4)) . '...' 
        : $agendamento['descricao'];
    echo "<tr>
            <td>ID: ".$agendamento['data']."</td>
            <td>Título: ".$agendamento['tempo_planejado_minutos']."</td>
            <td>".$agendamento['valor']."</td>
            <td><img src='".$agendamento['img']."' width='150'></td>
            <td>".$agendamento['descricao']."</td>
            <td>".$agendamento['atributo']."</td>";
    }
    echo "</tr>";
?>
</table>

</body>
</html>