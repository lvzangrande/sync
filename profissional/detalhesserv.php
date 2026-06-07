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
    }
    $tableAgenda = readAll($pdo,'agenda');
    $idAgendamento = (int)$_GET['id'];
    $agendamento = read($pdo,'agenda',"id_os = $idAgendamento");
    $valor = read($pdo, 'usuarios', 'id_user='.$agendamento['id_profissional']);
    unset($_SESSION['pedido']);

if(isset($_GET['acao']) && $_GET['acao'] == 'concluir' && isset($_GET['id'])){
    $id = $_GET['id'];
    /*opção de Iniciar serviço e marcar como concluída apenas o cliente após o serviço ser iniciado*/
    update($pdo, 'agenda', ['status_os' => 'Concluída'], "id_os = $id");
    $_SESSION['mensagem'] = "Serviço concluído com sucesso";
    unset($_SESSION['mensagem']);
    header('Location: historicodeservicos.php');
    exit;
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
    <body class="body">
        <header>
        <?php require_once "../partials/header.php";?>
            </header>
            <a href="<?=$_SERVER['HTTP_REFERER']?>" class="voltar">Voltar</a>
        <div class="container">
            <?php        
                
                $nomeCliente = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_cliente']);
                
                $nomeProfi   = read_nome_via_ID($pdo, 'usuarios', $agendamento['id_profissional']);
                $agendamento = read($pdo,'agenda',"id_os = $idAgendamento");
                if (!$agendamento) { die("Agendamento não encontrado."); }
                
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

                if($agendamento['status_os'] != 'Concluída'){
                    if($hoje->format('Y-m-d') == $dataAgendamento->format('Y-m-d') || $hoje->format('Y-m-d') > $dataAgendamento->format('Y-m-d')){
                        echo "<a href='?id=".$agendamento['id_os']."&acao=concluir'>Marcar como concluída</a>";
                    }
                }
    }
                if (!$agendamento) {
                    die("Agendamento não encontrado.");
                }
            ?>
        </div>
        <!--adicionar verificação para caso esteja no dia do serviço aparecer uma opção de marcar como concluída-->
    </body>
    </html>