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
    <title>Editar dados pessoas</title>
</head>
<body>
<?php 
require_once '../crud.php';
require_once '../partials/header.php';
$usuario_banco = read($pdo, 'usuarios', );

$_SESSION['autenticado'] = true;
$_SESSION['id_user']     = $usuario_banco['id_user'];
$_SESSION['nome']        = $usuario_banco['nome'];
$_SESSION['email']        = $usuario_banco['email'];
$_SESSION['foto']        = $usuario_banco['img_user'];
$_SESSION['cpfCnpj']     = $usuario_banco['cpf_cnpj'];
$_SESSION['tel']         = $usuario_banco['telefone'];
?>


    <h2>Editar Dados Pessoais</h2>
    <div class='formulario'>
        <form action="#" method="POST" class="form-editar-usuario">
        <!--<label>Nome</label> adicionar label em cada input -->
        <input type="hidden" name="nome" value="<?=$_SESSION['id_user']?>">

        <input type="text" name="nome" value="<?=$_SESSION['nome']?>" placeholder="Nome/Razão social" required>

        <input type="email" name="email" value="<?=$_SESSION['email']?>" placeholder="Email" required>

        <input type="tel" name="telefone" value="<?=$_SESSION['tel']?>" placeholder="Telefone" required>

        <input type="text" name="cpf_cnpj" value="<?=$_SESSION['cpfCnpj']?>" placeholder="CPF/CPNJ" required>

        <input type="file" name="img_user">

        <button type="submit">
            Salvar Alterações
        </button>
        
        </form>
        <a class='editarsenha' href='../editar_senha.php'>Quero editar minha senha</a>
    </div>
<?php
if (isset($_GET['id'])){
        $id = $_GET['id'];
        $user = read($pdo, 'cartas', "id = $id");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUser = $_POST['id'];
        
        $dadosAtualizados = [
            'nome'       => $_POST['nome'],
            'email'      => $_POST['email'],
            'telefone'   => $_POST['tel'],
            'cpf_cpnj'  => $_POST['cpfCnpj'],
            'img'    => $_POST['img'],
        ];
    }
        $linhasAfetadas = update($pdo, 'cartas', $dadosAtualizados, "id = $idCarta");

        if ($linhasAfetadas > 0) {
            echo '<script>alert("Carta atualizada com sucesso!!!"); window.location.href="index.php";</script>';
        } else {
            echo '<script>alert("Nenhuma alteração foi feita ou erro ao atualizar!");</script>';
        
    }

?>
</body>
</html>