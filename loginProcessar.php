<?php
session_start();

require_once 'crud.php';

if (isset($_SESSION['autenticado'])) {
    redirecionarPorPerfil($_SESSION['tipo']);
}

$erro = "";

if (isset($_POST['usuario']) && isset($_POST['senha'])) {

    $usuario_digitado = trim($_POST['usuario']);
    $senha_digitada   = trim($_POST['senha']);

    if (empty($usuario_digitado) || empty($senha_digitada)) {
        $erro = "Preencha todos os campos!";
    } else {
        $email_seguro = $pdo->quote($usuario_digitado);
        $condicao = "email = $email_seguro";
        $usuario_banco = read($pdo, 'usuarios', $condicao);

        if ($usuario_banco) {

            if ($senha_digitada === $usuario_banco['senha']) {
                $_SESSION['autenticado'] = true;
                $_SESSION['id_user'] = $usuario_banco['id_user'];
                $_SESSION['nome']    = $usuario_banco['nome'];
                $_SESSION['tipo']    = $usuario_banco['tipo'];

                redirecionarPorPerfil($_SESSION['tipo']);
            } else {
                $erro = "Acesso negado! Dados incorretos.";
            }
        } else {
            $erro = "Acesso negado! Dados incorretos.";
        }
    }
}

function redirecionarPorPerfil($tipo)
{
    switch ($tipo) {
        case 'admin':
            header("Location: area_admin.php");
            break;
        case 'profissional':
            header("Location: area_profissional.php");
            break;
        case 'cliente':
            header("Location: area_usuario.php");
            break;
        default:
            header("Location: dashboard.php");
            break;
    }
    exit();
}
