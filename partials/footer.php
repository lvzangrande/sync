<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$tipo_usuario = $_SESSION['tipo'] ?? 'visitante';

if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/2TD/sync/');
}


$base = BASE_URL;
?>

<footer>
    <div class="footer-container">

        <div class="footer-section">
            <div class="logo2">
                <img src="<?= $base ?>img/logosemfundo.png" class="logo">
            </div>
            <h3>Sync Mecatronics</h3>
            <p>Plataforma premium de manutenção<br> mecatrônica industrial.
                Sincronizando<br> operações com excelência técnica<br> desde 2024.</p><br>
        </div>

        <div class="footer-section">
            <h3 class="heading">Empresa</h3>
            <ul>
                <li><a href="<?= $base ?>inicio.php">Sobre</a></li>
                <li><a href="<?= $base ?>inicio.php#Tecnologia">Tecnologias</a></li>

                <?php if ($tipo_usuario === 'admin'): ?>
                    <li><a href="<?= $base ?>admin/adminpage.php">Painel Admin</a></li>
                <?php elseif ($tipo_usuario === 'profissional'): ?>
                    <li><a href="<?= $base ?>profissional/profipage.php">Meu Painel</a></li>
                <?php elseif ($tipo_usuario === 'cliente'): ?>
                    <li><a href="<?= $base ?>user/userpage.php">Minha Conta</a></li>
                <?php else: ?>
                    <li><a href="<?= $base ?>login.php">Área do Cliente</a></li>
                <?php endif; ?>

                <li><a href="<?= $base ?>suporte.php">Contato</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Conecte-se</h3>
            <ul class="icons">
                <li><a href="#"><i class="fa-brands fa-linkedin meu-icone"></i>Linkedin</a></li>
                <li><a href="#"><i class="fa-brands fa-instagram meu-icone"></i>Instagram</a></li>
                <li><a href="#"><i class="fa-brands fa-square-facebook meu-icone"></i>Facebook</a></li>
                <li><a href="#"><i class="fa-brands fa-youtube meu-icone"></i>YouTube</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Newsletter</h3>
            <p>Receba insights técnicos.<br>
                Newsletter mensal industrial.
            </p>
            <form>
                <div class="newsletter-form"> <input type="email" placeholder="seu@email.com" />
                    <button type="submit"><span class="material-symbols-outlined">arrow_forward</span></button>
                </div>
            </form>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2026 Sync Mecatronics. Todos os direitos reservados.</p>
        <ul>
            <li><a href="#">Privacidade</a></li>
            <li><a href="#">Termos de Uso</a></li>
            <li><a href="#">Cookies</a></li>
        </ul>
    </div>
</footer>