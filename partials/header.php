<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tipo_usuario = $_SESSION['tipo'] ?? 'visitante';

define('BASE_URL', 'http://localhost/2TD/sync/');
$base = BASE_URL;
?>
<link rel="stylesheet" href="../css/partials.css">
<header>
    <nav>
        <div class="menu-superior">
            <div class="logo">
                <img src="<?= $base?>img/logosemfundo.png" class="logo">

            </div>

            <ul class="nav-links">
                <li><a href="<?= $base ?>inicio.php">Início</a></li>
                <li><a href="<?= $base ?>inicio.php#Tecnologia">Tecnologia</a></li>
                <li><a href="<?= $base ?>catalogo_profissionais.php">Profissionais</a></li>
                <li><a href="<?= $base ?>equipe.php">Equipe</a></li>
                <li><a href="<?= $base ?>suporte.php">Suporte</a></li>

                <?php if ($tipo_usuario === 'admin'): ?>
                    <li><a href="<?= $base ?>admin/adminpage.php" style="color: #8BC0D6; font-weight: bold;">Painel Admin</a></li>
                    <li><a href="<?= $base ?>admin/cadastro_profissional.php" style="color: #8BC0D6; font-weight: bold;">Novo profissional</a></li>
                <?php endif; ?>

                <?php if ($tipo_usuario === 'profissional'): ?>
                    <li><a href="<?= $base ?>profissional/profipage.php" style="color: #8BC0D6; font-weight: bold;">Meu Painel</a></li>
                <?php endif; ?>

                <?php if ($tipo_usuario === 'cliente'): ?>
                    <li><a href="<?= $base ?>user/userpage.php" style="color: #8BC0D6; font-weight: bold;">Minha Conta</a></li>
                <?php endif; ?>
            </ul>

            <div class="buttons">
                <?php if ($tipo_usuario === 'visitante'): ?>
                    <a class="btn-entrar" href="<?= $base ?>login.php">Entrar</a>
                    <a class="btn-cadastro" href="<?= $base ?>cadastro.php">Começar <span class="material-symbols-outlined">arrow_outward</span></a>
                <?php else: ?>
                    <a class="btn-entrar" href="<?= $base ?>logout.php" style="background-color: #e63946; color: white; border: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-power-off"></i> Sair
                    </a> <?php endif; ?>
            </div>
        </div>
    </nav>
</header>