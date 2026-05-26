<?php
require_once 'crud.php';
require_once 'func/filtro.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/partials.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Catalago</title>
</head>

<body>
    <?php require_once 'partials/header.php'; ?>
    <main class="container">
        <section class="topo">

            <div class="textos">
                <span>Rede de Especialistas</span>

                <h1>Catálogo de Profissionais</h1>

                <p>
                    Sincronize sua operação com técnicos mecatrônicos
                    certificados e disponíveis em tempo real.
                </p>
            </div>
            <form method="GET">
                <select name="ordenar" onchange="this.form.submit()">
                    <option value="">
                        Ordenar
                    </option>
                    <option value="melhor_avaliacao" <?= ($_GET['ordenar'] ?? '') == 'melhor_avaliacao' ? 'selected' : '' ?>>
                        Melhor Avaliação
                    </option>
                    <option value="maior_preco" <?= ($_GET['ordenar'] ?? '') == 'maior_preco' ? 'selected' : '' ?>>
                        Maior Preço
                    </option>
                    <option value="menor_preco" <?= ($_GET['ordenar'] ?? '') == 'menor_preco' ? 'selected' : '' ?>>
                        Menor Preço
                    </option>
                </select>
            </form>
        </section>

        <section class="catalogo">
            <div class="sidebar-filtros">

                <form method="GET">

                    <div class="box-filtro">

                        <p>Especialidade</p>
                        <label>

                            <input type="checkbox" name="especialidade[]" value="Manutenção de Motores"
                                onchange="this.form.submit()" <?= isset($_GET['especialidade']) && in_array('Manutenção de Motores', $_GET['especialidade']) ? 'checked' : '' ?>>

                            <span>
                                Manutenção de Motores
                            </span>

                        </label>

                        <label>

                            <input type="checkbox" name="especialidade[]" value="Sistemas Pneumáticos"
                                onchange="this.form.submit()" <?= isset($_GET['especialidade']) && in_array('Sistemas Pneumáticos', $_GET['especialidade']) ? 'checked' : '' ?>>

                            <span>
                                Sistemas Pneumáticos
                            </span>

                        </label>

                        <label>

                            <input type="checkbox" name="especialidade[]" value="Sistemas Hidráulicos"
                                onchange="this.form.submit()" <?= isset($_GET['especialidade']) && in_array('Sistemas Hidráulicos', $_GET['especialidade']) ? 'checked' : '' ?>>

                            <span>
                                Sistemas Hidráulicos
                            </span>

                        </label>

                        <label>

                            <input type="checkbox" name="especialidade[]" value="Equipamentos Industriais"
                                onchange="this.form.submit()" <?= isset($_GET['especialidade']) && in_array('Equipamentos Industriais', $_GET['especialidade']) ? 'checked' : '' ?>>

                            <span>
                                Equipamentos Industriais
                            </span>

                        </label>
                    </div>

                    <div class="box-filtro">

                        <p>Status</p>

                        <label>
                            <input type="checkbox" name="status[]" value="Disponível" onchange="this.form.submit()"
                                <?= isset($_GET['status']) && in_array('Disponível', $_GET['status']) ? 'checked' : '' ?>>

                            <span>Disponível</span>
                        </label>

                        <label>
                            <input type="checkbox" name="status[]" value="Em Atendimento" onchange="this.form.submit()"
                                <?= isset($_GET['status']) && in_array('Em Atendimento', $_GET['status']) ? 'checked' : '' ?>>

                            <span>Em Atendimento</span>
                        </label>

                        <label>
                            <input type="checkbox" name="status[]" value="Inativo" onchange="this.form.submit()"
                                <?= isset($_GET['status']) && in_array('Inativo', $_GET['status']) ? 'checked' : '' ?>>

                            <span>Inativo</span>
                        </label>

                    </div>
                    <a href="catalogo_profissionais.php" class="btn-limpar">
                        <i class="bi bi-arrow-clockwise"></i> Limpar filtros
                    </a>

                </form>
            </div>

            <div class="cards">

                <?php
                $where = "categoria = 'profissional'";
                $where = filtroEspecialidade($where);
                $where = filtroStatus($where);
                $order = "";

                if (!empty($_GET['ordenar'])) {

                    if ($_GET['ordenar'] == 'melhor_avaliacao') {

                        $order = " ORDER BY notas DESC";
                    } elseif ($_GET['ordenar'] == 'maior_preco') {

                        $order = " ORDER BY valor_dia DESC";
                    } elseif ($_GET['ordenar'] == 'menor_preco') {

                        $order = " ORDER BY valor_dia ASC";
                    }
                }
                $cards = readALL($pdo, 'usuarios', $where . $order);
                foreach ($cards as $card) {
                    echo
                        '<div class="card">

                            <div class="disponibilidade">' . $card['status'] . '</div>

                            <div class="avaliacao"><i class="bi bi-star-fill"></i> ' . $card['notas'] . '</div>

                            <img src="' . $card['img_user'] . '"
                                alt="">

                            <p class="nome-profi">' . $card['nome'] . '</p>

                            <p class="especialidade">' . $card['especialidade'] . '</p>

                            <span>15 meses</span>

                            <span>320</span>
                            <div class="rodape">
                                <p class="preco">' . $card['valor_dia'] . '</p>
                                <p class="p-d">/dia</p>';
                    
                        if ($card['status'] == 'Indisponível') {
                            echo '<a>Indisponível</a>';
                        } elseif ($card['status'] == 'Em Atendimento') {
                            echo '<a>Indisponível</a>';
                        } else {
                            echo '<a href="contratar.php?id=' . $card['id_user'] . '">Contratar</a>';
                        }
                    echo '            
                            </div>

                        </div>
                        ';

                }
                ?>

            </div>
        </section>
    </main>

    <?php require_once 'partials/footer.php'; ?>
</body>

</html>