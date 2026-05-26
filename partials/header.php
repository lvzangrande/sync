<?php
define('BASE_URL', 'http://localhost/sync/');
$base = BASE_URL;
?>

<link rel="stylesheet" href="<?= $base?>css/partials.css">
<header>
    <nav>
        <div class="menu-superior">
            <div class="logo">
                <img src="imagens/logosemfundo.png" class="logo">
            </div>
            <ul class="nav-links">
                <li><a href="<?= $base?>inicio.php">Início</a></li>
                <li><a href="<?= $base?>inicio.php#Tecnologia">Tecnologia</a></li>
                <li><a href="<?= $base?>catalogo_profissionais.php">Profissionais</a></li>
                <li><a href="<?= $base?>equipe.php">Equipe</a></li>
                <li><a href="<?= $base?>suporte.php">Suporte</a></li>
            </ul>

            <div class="buttons">
                <a class="btn-entrar" href="<?= $base?>login.php">Entrar</a>
                <a class="btn-cadastro" href="<?= $base?>cadastro.php">Começar <span class="material-symbols-outlined">arrow_outward</span></a>
            </div>
        </div>
    </nav>
</header>