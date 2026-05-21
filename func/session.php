<?php
session_start();

$_SESSION['tipo_servico'] = $_POST['tipo_serv'];
$_SESSION['descricao_problema'] = $_POST['desc'];
$_SESSION['data'] = $_POST['data'];
$_SESSION['tempo_planejado'] = $_POST['tempo'];
$_SESSION['endereco_servico'] = $_POST['end_serv'];
$_SESSION['idcard'] = $_POST['id_profissional'];

header('Location: ../user/contrato_info.php');
