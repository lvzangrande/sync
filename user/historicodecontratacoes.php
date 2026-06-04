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
unset($_SESSION['pedido']);
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
<?php
require_once '../partials/header.php';
?>
<a href="./userpage.php">Voltar</a>
<body>
    <table>
        <tr>
            <th colspan="99">HISTÓRICO DE CONTRATAÇÕES<th>
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

    $nomeProfi = read_nome_via_ID($pdo,'usuarios',$agendamento['id_profissional']);
    $nomeCliente = read_nome_via_ID($pdo,'usuarios',$agendamento['id_cliente']);
    $valor = read($pdo, 'usuarios', 'id_user='.$agendamento['id_profissional']);
    $palavras = explode(' ', trim($agendamento['descricao_problema'])); 
    
    $descricaoResumida = (count($palavras) > 4) 
        ? implode(' ', array_slice($palavras, 0, 4)) . '...' 
        : $agendamento['descricao_problema'];
    echo "<tr>
            <td>".$agendamento['data']."</td>
            <td>".$descricaoResumida."</td>
            <td>".$agendamento['status_os']."</td>
            <td class='td_verDetalhes'><a class='verDetalhes' href='detalhesContratacao.php?id=".$agendamento['id_os']."'>Ver detalhes</a></td>";
    }
    echo "</tr>";
?>
</table>

</body>
</html>