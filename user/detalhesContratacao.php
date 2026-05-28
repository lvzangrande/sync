<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

$tableAgenda = readAll($pdo,'agenda');
$idAgendamento = (int)$_GET['id'];
$agendamento = read($pdo,'agenda',"id_os = $idAgendamento");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/userpage.css">
    <title>Agendamento <?=$agendamento['data']?></title>
</head>
<body>
    <header>
    <?php require_once "../partials/header.php";?>
    <div class="container">
        <?php        
            
            
                    $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);
                    $nomeProfi   = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
                    
                    
                    if($idAgendamento){
                        echo "  <p>".$agendamento['data']."</p>
                                <p>".$agendamento['tempo_planejado_minutos']."</p>
                                <p>".$agendamento['valor_total']."</p>
                                <p>".$agendamento['descricao_problema']."</p>
                                <p>".$agendamento['endereco_servico']."</p>
                                <p>".$nomeCliente."</p>
                                <p>".$nomeProfi."</p>
                                <p>".$agendamento['status_os']."</p>";
                                }
            if (!$agendamento) {
                die("Agendamento não encontrado.");
            }

        ?>
    </div>
</body>
</html>