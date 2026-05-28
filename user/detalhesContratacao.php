<?php
require_once '../crud.php';

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}
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
    <div class="container">
        <?php        
            $tableAgenda = readAll($pdo,'agenda');
            $idAgendamento = (int)$_GET['id'];
            
                    foreach($tableAgenda as $agendamento){
                    if($idAgendamento)
                        echo "  <p>".$agendamento['data']."</p>
                                <p>".$agendamento['tempo_planejado_minutos']."</p>
                                <p> teste".$agendamento['valor_total']."</p>
                                <p>".$descricaoResumida."</p>
                                <p>".$agendamento['endereco_servico']."</p>
                                <p>".$nomeCliente."</p>
                                <p>".$nomeProfi."</p>
                                <p>".$agendamento['status_os']."</p>
                    
                    "
                    ;}
                    else{
                        $_
                    ;}

        ?>
    </div>
</body>
</html>