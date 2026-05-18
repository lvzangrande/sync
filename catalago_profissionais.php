<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/catalogo.css">
    <title>Catalago</title>
</head>

<body>

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

    <section>

        <div class="card">

            <div class="disponibilidade">Disponivel</div>

            <div class="avaliacao">4.9</div>

            <img src="https://static.vecteezy.com/ti/fotos-gratis/t2/57068323-solteiro-fresco-vermelho-morango-em-mesa-verde-fundo-comida-fruta-doce-macro-suculento-plantar-imagem-foto.jpg"
                alt="">

            <p>Nome Profissional</p>

            <p>Especialidade Profissional</p>

            <span>Tempo de empresa</span>

            <span>Quantidade de Trabalhos</span>

            <p>Preço do serviço</p>
            <p>por dia</p>

            <a href="./contratar">Contatra Profissional</a>
        </div>

        <div class="box-filtro">
            <p>Especialidade</p>
            <input type="checkbox" name=""> <span>Automção Industrial</span>
            <input type="checbox" name=""> <span>Manutenção Preventiva</span>
            <input type="checbox" name=""> <span>Engenharia de Precisão</span>
            <input type="checbox" name=""> <span>Mecatronica</span>
        
        
        </div>

        <div class="box-filtro">
            <p>Disponibilidade</p>
            <input type="checkbox" name=""> <span>Disponivel</span>      
            <input type="checkbox" name=""> <span>Em Serviço</span>
            <input type="checkbox" name=""> <span>Indisponivel</span>

        </div>
        
        <button>Limpar Filtros</button>

    </section>

</body>

</html>