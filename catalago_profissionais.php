<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/catalogo.css">
    <title>Catalago</title>
</head>

<body>
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

            <select>
                <option>Ordenar: Melhor Avaliação</option>
                <option>Ordenar: Maior Preço</option>
                <option>Ordenar: Menor Preço</option>
            </select>

        </section>

        <section class="catalogo">
            <div class="sidebar-filtros">

                <div class="box-filtro">

                    <p>Especialidade</p>

                    <label>
                        <input type="checkbox">
                        <span>Automação Industrial</span>
                    </label>

                    <label>
                        <input type="checkbox">
                        <span>Manutenção Preventiva</span>
                    </label>

                    <label>
                        <input type="checkbox">
                        <span>Engenharia de Precisão</span>
                    </label>

                    <label>
                        <input type="checkbox">
                        <span>Mecatrônica</span>
                    </label>

                </div>

                <div class="box-filtro">

                    <p>Disponibilidade</p>

                    <label>
                        <input type="checkbox">
                        <span>Disponível</span>
                    </label>

                    <label>
                        <input type="checkbox">
                        <span>Em Serviço</span>
                    </label>

                    <label>
                        <input type="checkbox">
                        <span>Indisponível</span>
                    </label>

                </div>

                <button>Limpar Filtros</button>

            </div>

             <div class="card">

                    <div class="disponibilidade">Disponivel</div>

                    <div class="avaliacao">4.9</div>

                    <img src="https://static.vecteezy.com/ti/fotos-gratis/t2/57068323-solteiro-fresco-vermelho-morango-em-mesa-verde-fundo-comida-fruta-doce-macro-suculento-plantar-imagem-foto.jpg"
                        alt="">

                    <p class="nome-profi">Nome Profissional</p>

                    <p class="especialidade">Especialidade Profissional</p>

                    <span>Tempo de empresa</span>

                    <span>Quantidade de Trabalhos</span>
                    <div class="rodape">
                        <p class="preco">R$ 200</p>
                        <p class="p-d">/dia</p>

                        <a href="./contratar">Contratar</a>
                    </div>

                </div>
                <div class="card">

                    <div class="disponibilidade">Disponivel</div>

                    <div class="avaliacao">4.9</div>

                    <img src="https://static.vecteezy.com/ti/fotos-gratis/t2/57068323-solteiro-fresco-vermelho-morango-em-mesa-verde-fundo-comida-fruta-doce-macro-suculento-plantar-imagem-foto.jpg"
                        alt="">

                    <p class="nome-profi">Nome Profissional</p>

                    <p class="especialidade">Especialidade Profissional</p>

                    <span>Tempo de empresa</span>

                    <span>Quantidade de Trabalhos</span>
                    <div class="rodape">
                        <p class="preco">R$ 200</p>
                        <p class="p-d">/dia</p>

                        <a href="./contratar.php">Contratar</a>
                    </div>

                </div>
            </div>

        </section>
    </main>


</body>

</html>