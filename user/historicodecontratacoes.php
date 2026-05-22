<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
require_once '../crud.php';

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
            <th colspan="99">Histórico de contratações<th>
        </tr>
        <tr>
            <td>
                <a>joaolinux</a>
                <a>11/09</a>
                <a class='verdetalhes' href=''>Ver detalhes</a>
            </td>
        </tr>
<?php

$tableAgenda = readAll($pdo,'agenda');

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

$agendamentos = [
;]
        foreach($tableAgenda as $agendamentos){

    echo "<tr>
            <td>ID: ".$carta['id']."</td>
            <td>Título: ".$carta['nome']."</td>
            <td>".$carta['tipo_carta']."</td>
            <td><img src='".$carta['img']."' width='150'></td>
            <td>".$carta['descricao']."</td>
            <td>".$carta['atributo']."</td>";
    }
    echo "</tr>";
?>
</table>

</body>
</html>