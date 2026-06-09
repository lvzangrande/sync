    <?php
    require_once '../crud.php';

    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if (!isset($_SESSION['autenticado'])) {
        header("Location: ../login.php");
        exit();
    }

    if (isset($_SESSION['mensagem'])){
        echo "<script>alert('".$_SESSION['mensagem']."')</script>";
        unset($_SESSION['mensagem']);
    }

    $idAgendamento = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if(isset($_GET['acao']) && $idAgendamento > 0){
        $acao = $_GET['acao'];

        if ($acao == 'iniciar') {
            update($pdo, 'agenda', ['status_os' => 'Em andamento'], "id_os = $idAgendamento");
            $_SESSION['mensagem'] = "Serviço iniciado com sucesso.";
            header("Location: ?id=$idAgendamento");
            exit;
        } 
        elseif ($acao == 'concluir') {
            update($pdo, 'agenda', ['status_os' => 'Concluída'], "id_os = $idAgendamento");
            $_SESSION['mensagem'] = "Serviço concluído com sucesso";
            header('Location: historicodeservicos.php');
            exit;
        } 
        elseif ($acao == 'cancelar') {
            update($pdo, 'agenda', ['status_os' => 'Cancelada'], "id_os = $idAgendamento");
            $_SESSION['mensagem'] = "Serviço cancelado com sucesso.";
            header('Location: historicodeservicos.php');
            exit;
        }
    }

    $tableAgenda = readAll($pdo,'agenda');
    $agendamento = read($pdo,'agenda',"id_os = $idAgendamento");
    
    if (!$agendamento) { 
        die("Agendamento não encontrado."); 
    }

    $valor = read($pdo, 'usuarios', 'id_user='.$agendamento['id_profissional']);
    unset($_SESSION['pedido']);
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/userpage.css">
        <link rel="icon" href="imagens/logosemfundo.png">
        <title>Agendamento <?=$agendamento['data']?></title>
    </head>
    <body class="body">
        <header>
        <?php
        if($agendamento['status_os'] === 'Em Andamento'){
               '';
            }
            else{
                require_once "../partials/header.php";
            }
        ?>
            </header>
            <?php if($agendamento['status_os'] === 'Em Andamento'){
               echo '<a href="profipage.php" class="voltar">SAIR</a>';
            }
            else{
                echo '<a href="'.$_SERVER['HTTP_REFERER'].'" class="voltar">Voltar</a>';
            }
            ?>
        <div class="container">
            <?php        
                
                $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);
                
                $nomeProfi   = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
                
                $hoje = new DateTime();

    if($idAgendamento){
        $dataAgendamento = new DateTime($agendamento['data']);
        echo "  
                <label>Data: </label>
                <a>".$agendamento['data']."</a><br><hr>

                <label>Tempo estimado:</label>
                <a>".$agendamento['tempo_planejado']."</a><br><hr>
                
                <label>Método de pagamento:</label>
                <a>".$agendamento['metodo_pagamento']."</a><br><hr>

                <label>Valor: </label>
                <a>".$agendamento['tempo_planejado'] * $valor['valor_dia']."</a><br><hr>

                <label>Descrição</label>
                <a>".$agendamento['descricao_problema']."</a><br><hr>

                <label>Endereço:</label>
                <a>".$agendamento['endereco_servico']."</a><br><hr>

                <label>Contratante: </label>
                <a>".$nomeCliente."</a><br><hr>

                <label>Profissional: </label>
                <a>".$nomeProfi."</a><br><hr>

                <label>Status: </label>
                <a>".$agendamento['status_os']."</a><br><hr>";

                $statusAtual = $agendamento['status_os'];
                $dataValida = ($hoje->format('Y-m-d') >= $dataAgendamento->format('Y-m-d'));

            if ($statusAtual == 'Em Andamento') {
                    // Se já estiver em andamento, mostra APENAS Concluir e Cancelar
                    echo "<a href='?id=".$agendamento['id_os']."&acao=concluir' style='margin-right: 15px;' class='voltar'>Concluir</a>";
                    echo "<a href='?id=".$agendamento['id_os']."&acao=cancelar' onclick=\"return confirm('Tem certeza de que quer mesmo cancelar este serviço?');\">Cancelar</a>";
                } 
                elseif ($statusAtual != 'Concluída' && $statusAtual != 'Cancelada') {
                    if ($dataValida) {
                        echo "<a href='?id=".$agendamento['id_os']."&acao=iniciar' class='voltar'>Iniciar serviço</a>";
                    }
                }
    }
            ?>
        </div>
    </body>
    </html>