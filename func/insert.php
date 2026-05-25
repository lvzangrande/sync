<?php

require_once '../crud.php';

$novo_contrato = [
    'tipo_servico' => $_POST['tipo_serv'],
    'descricao_problema' => $_POST['desc'],
    'data' => $_POST['data'],
    'tempo_planejado'=> $_POST['tempo'],
    'endereco_servico'=> $_POST['end_serv'],
    'id_profissional' => $_POST['id_profissional'],
    'id_cliente' => $_POST['id_cliente']
];


$idnova_os = create($pdo, 'agenda', $novo_contrato);

header('Location: ../user/confirmacao_pagamento.php');