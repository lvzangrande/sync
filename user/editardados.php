<?php 
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}

$_SESSION['id_user'] = $usuario_banco['id_user'];
$_SESSION['nome']    = $usuario_banco['nome'];
$_SESSION['tipo']    = $usuario_banco['categoria'];
$_SESSION['foto']    = $usuario_banco['img_user'];

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
<?php require_once '../partials/header.php';?>


    <h2>Editar Dados Pessoais</h2>
    <div class='formulario'>
        <form action="#" method="POST" class="form-editar-usuario">

        <input type="text" name="nome" placeholder="Nome completo" required>

        <input type="email" name="email" placeholder="E-mail" required>

        <input type="tel" name="telefone" placeholder="Telefone" required>

        <input type="text" name="cpf_cnpj" placeholder="CPF" required>

        <input type="file" name="img_user">

        <button type="submit">
            Salvar Alterações
        </button>
        
        </form>
        <a class='editarsenha' href='../editarsenha.php'>Quero editar minha senha</a>
    </div>

</body>
</html>