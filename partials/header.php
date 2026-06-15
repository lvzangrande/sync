<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tipo_usuario = $_SESSION['tipo'] ?? 'visitante';

define('BASE_URL', 'http://localhost/2TD/sync/');
$base = BASE_URL;
?>
<link rel="stylesheet" href="../css/partials.css">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=home" />
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<header>
    <nav>
        <div class="menu-superior">
            <div class="logo">
                <img src="<?= $base ?>img/logosemfundo.png" class="logo">

            </div>

            <ul class="nav-links">
                <li><a href="<?= $base ?>inicio.php">Início</a></li>
                <li><a href="<?= $base ?>tecnologia.php">Tecnologia</a></li>
                <li><a href="<?= $base ?>catalogo_profissionais.php">Profissionais</a></li>
                <li><a href="<?= $base ?>equipe.php">Equipe</a></li>
                <li><a href="<?= $base ?>suporte.php">Suporte</a></li>
            </ul>

            <div class="buttons">
                <?php if ($tipo_usuario === 'visitante'): ?>
                    <a class="btn-entrar" href="<?= $base ?>login.php">Entrar</a>
                    <a class="btn-cadastro" href="<?= $base ?>cadastro.php">Começar <span
                            class="material-symbols-outlined">arrow_outward</span></a>
                <?php else: ?>
                    <button id="btn-menu">
                        ☰
                    </button>

                    <nav id="sidebar" class="sidebar">

                        <div class="topo-sidebar">

                            <div class="titulo">
                                Sync
                            </div>

                            <button id="fechar-menu" class="btn-fechar">
                                <i class="bi bi-x-lg"></i>
                            </button>

                        </div>
                        <?php 
                        if ($tipo_usuario === 'admin') {
                            echo '<a href="../admin/adminpage.php">
                                <i class="bi bi-house"></i>
                                Dashboard
                            </a>
                            <a href="../admin/cadastro_profissional.php">
                                <i class="bi bi-people"></i>
                                Cadastrar Profissional
                            </a>
                            <a class="btn-entrar" href="'. $base .'logout.php"
                            style="background-color: #e63946; color: white; border: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600;">
                            <i class="fas fa-power-off"></i> Sair
                            </a>';

                        } elseif ($tipo_usuario === 'profissional') {
                            echo '<a href="../profissional/profipage.php">
                                <i class="bi bi-person"></i>
                                Pefil
                            </a>

                            <a href="../profissional/historicodeservicos.php">
                                <i class="bi bi-tools"></i>
                                Serviços
                            </a>

                            <a href="../profissional/servagendados.php">
                                <i class="bi bi-calendar-event"></i>
                                Agenda
                            </a>
                            <a class="btn-entrar" href="'. $base .'logout.php"
                            style="background-color: #e63946; color: white; border: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600;">
                            <i class="fas fa-power-off"></i> Sair
                            </a>';
                        } elseif ($tipo_usuario === 'cliente') {
                            echo '
                                <a href="../user/userpage.php">
                                    <i class="bi bi-card-list"></i>
                                    Perfil
                                </a>
                                <a href="../user/historicodecontratacoes.php">
                                    <i class="bi bi-clock-history"></i>
                                    Histórico de serviços
                                </a>
                                <a href="../user/historicodemensagens.php">
                                    <i class="bi bi-headset"></i>
                                    Suporte
                                </a>
                                <a class="btn-entrar" href="'. $base .'logout.php"
                                    style="background-color: #e63946; color: white; border: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600;">
                                    <i class="fas fa-power-off"></i> Sair
                                </a>
                                ';
                        }
                        ?>

                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </nav>

</header>
<script>
    const sidebar = document.getElementById("sidebar");

    document.getElementById("btn-menu").onclick = () =>
        sidebar.classList.toggle("aberta");

    document.getElementById("fechar-menu").onclick = () =>
        sidebar.classList.remove("aberta");
</script>