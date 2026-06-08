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
    <link rel="stylesheet" href="../css/partials.css">
    <title>Editar dados pessoais</title>
</head>
<body>


<?php require_once '../partials/header.php';
    $tableUser = readAll($pdo,'usuarios');
    $idUser = (int)$_SESSION['id_user'];
    $user = read($pdo,'usuarios',"id_user = $idUser");
?>
<a href="profipage.php" class='voltar'>Voltar</a>

    <h2>Editar Dados Pessoais</h2>
    <div class='formulario'>
        <form action="#" method="POST" enctype="multipart/form-data" class="form-editar-usuario">
            
            <input type="hidden" name="id" value="<?=$idUser?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?=$user['nome']?>" placeholder="Nome/Razão social" required>

            <label>Email</label>
            <input type="email" name="email" value="<?=$user['email']?>" placeholder="Email" required>

            <label>Telefone</label>
            <input type="tel" name="tel" value="<?=$user['telefone']?>" placeholder="Telefone" required>

            <label>CPF/CNPJ</label>
            <input type="text" name="cpf_cnpj" value="<?=$user['cpf_cnpj']?>" placeholder="CPF/CPNJ" required>

            <label>Foto de Perfil</label>
            <input type="file" name="img_user"> 

            <button type="submit">
                Salvar Alterações
            </button>
        </form>
        <br>
        <a class='editarsenha' href='../editar_senha.php'>Quero editar minha senha</a>
    </div>
<?php
    $idUser = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dadosAtualizados = [
        'nome'     => $_POST['nome'],
        'email'    => $_POST['email'],
        'telefone' => $_POST['tel'], 
        'cpf_cnpj' => $_POST['cpf_cnpj'] 
    ];
    if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] === UPLOAD_ERR_OK) {
        $nome_foto = $_FILES['img_user']['name'];
        
        if (move_uploaded_file($_FILES['img_user']['tmp_name'], "../img/uploads/usuarios/profissionais/" . $nome_foto)) {
            $dadosAtualizados['img_user'] = $nome_foto;
        }
    }

    $linhasAfetadas = update($pdo, 'usuarios', $dadosAtualizados, "id_user = $idUser");

    if ($linhasAfetadas > 0) {
        echo '<script>alert("Usuário atualizado com sucesso!!!"); window.location.href="profipage.php";</script>';
        exit();
    } else {
        echo '<script>alert("Nenhuma alteração foi feita ou erro ao atualizar!");</script>';
    }
}

$usuario_banco = read($pdo, 'usuarios', "id_user = $idUser");

/*if ($usuario_banco) {
    $_SESSION['nome']    = $usuario_banco['nome'];
    $_SESSION['email']   = $usuario_banco['email'];
    $_SESSION['foto']    = $usuario_banco['img_user'];
    $_SESSION['cpfCnpj'] = $usuario_banco['cpf_cnpj'];
    $_SESSION['tel']     = $usuario_banco['telefone'];
}*/
?>

</body>
</html>