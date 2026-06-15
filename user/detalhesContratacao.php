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
    $valor = read($pdo, 'usuarios', 'id_user='.$agendamento['id_profissional']);
    unset($_SESSION['pedido']);
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="imagens/logosemfundo.png">
        <link rel="stylesheet" href="../css/userpage.css">
        <link rel="icon" href="../img/logosemfundo.png">
        
        <title>Agendamento <?=$agendamento['data']?></title>
    </head>
    <body class="body">
        <header>
        <?php require_once "../partials/header.php";?>
            </header>
            <a href="./historicodecontratacoes.php">Voltar</a>
        <div class="container">
            <?php        
                
                
                        $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);
                        $nomeProfi   = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
                        
                        
    if($idAgendamento){
        echo "  
                <label>Data: </label>
                <a>".$agendamento['data']."</a><br><hr>

                <label>Tempo estimado:</label>
                <a>".$agendamento['tempo_planejado']."</a><br><hr>

                <label>Valor: </label>
                <a>".$agendamento['tempo_planejado'] * $valor['valor_dia']."</a><br><hr>

                <label>Descrição</label>
                <a>".$agendamento['descricao_problema']."</a><br><hr>

                <label>Metódo de pagamento</label>
                <a>".$agendamento['metodo_pagamento']."</a><br><hr>

                <label>Endereço:</label>
                <a>".$agendamento['endereco_servico']."</a><br><hr>

                <label>Contratante: </label>
                <a>".$nomeCliente."</a><br><hr>

                <label>Profissional: </label>
                <a>".$nomeProfi."</a><br><hr>

                <label>Status: </label>
                <a>".$agendamento['status_os']."</a><br><hr>";
    }
                if (!$agendamento) {
                    die("Agendamento não encontrado.");
                }

            ?>
        </div>
    </body>
    </html>