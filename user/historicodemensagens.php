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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Suporte</title>
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
            <th colspan='99'>HISTÓRICO DE SUPORTE</th>
        </tr>
<?php
require_once '../crud.php';

// Lê todos os registros da tabela de suporte (ajuste o nome 'suporte' se sua tabela tiver outro nome)
$tableSuporte = readAll($pdo, 'suporte');

// Verifica se há registros antes de fazer o loop
if ($tableSuporte) {
    foreach($tableSuporte as $ticket){
        
        // Resume a descrição enviada pelo usuário (limita a 4 palavras)
        $palavrasDesc = explode(' ', trim($ticket['desc_sup'])); 
        $descricaoResumida = (count($palavrasDesc) > 4) 
            ? implode(' ', array_slice($palavrasDesc, 0, 4)) . '...' 
            : $ticket['desc_sup'];

        // Resume a resposta do administrador, caso exista
        $resposta = $ticket['resposta_admin'] ? trim($ticket['resposta_admin']) : 'Aguardando...';
        $palavrasResp = explode(' ', $resposta);
        $respostaResumida = (count($palavrasResp) > 4)
            ? implode(' ', array_slice($palavrasResp, 0, 4)) . '...' 
            : $resposta;
        if ($ticket['nome_cliente'] == $_SESSION['nome']){
        echo "<tr>
                <td>".$ticket['nome_cliente']."</td>
                <td title='".$ticket['desc_sup']."'>".$descricaoResumida."</td>
                <td>".$ticket['status_suporte']."</td>
                <td class='td_verDetalhes'>
                    <a class='verDetalhes' href='detalhesSuporte.php?id=".$ticket['id_sup']."'>Ver detalhes</a>
                </td>
              </tr>";
        }
        //adicionar data de envio e data de resposta
    }
} else {
    echo "<tr><td colspan='8'>Nenhum ticket de suporte encontrado.</td></tr>";
}
?>
    </table>
</body>
</html>