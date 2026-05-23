<?php

require_once '../crud.php';


if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION['autenticado'])) {
    header("Location: ../login.php");
    exit();
}
$pedido = $_SESSION['pedido'];

$novo_contrato = [
    'tipo_servico' => $pedido['tipo_serv'],
    'descricao_problema' => $pedido['desc'],
    'data' => $pedido['data'],
    'tempo_planejado' => $pedido['tempo'],
    'endereco_servico' => $pedido['end_serv'],
    'id_profissional' => $pedido['id_profissional'],
    'id_cliente' => $_SESSION['id_user']
];

$udate_status = [
    'status' => 'Em Serviço'
];

$idnova_os = create(
    $pdo,
    'agenda',
    $novo_contrato
);

update($pdo, 'usuarios', $udate_status, "id_user = " . $pedido['id_profissional']);

unset($_SESSION['pedido']);


header('Location: ../user/confirmacao_pagamento.php');