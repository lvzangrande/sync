USE db_sync;

-- 1. Tabela usuarios
    CREATE TABLE IF NOT EXISTS usuarios (
        id_user INT AUTO_INCREMENT PRIMARY KEY,
        img_user VARCHAR(255),
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        senha VARCHAR(255) NOT NULL,
        telefone VARCHAR(20) NOT NULL,
        cpf_cnpj VARCHAR(20) UNIQUE NOT NULL,
        tipo ENUM ('PF', 'PJ') NOT NULL,
        categoria ENUM ('cliente', 'profissional', 'admin') NOT NULL,
        especialidade VARCHAR(100) NULL,
        status ENUM ('Disponível', 'Em Atendimento', 'Inativo') NULL,
        valor_dia DECIMAL(10,2) NULL,
        descricao_func TEXT NULL,
        notas INT NULL CHECK (notas BETWEEN 0 AND 5),
        data_cadastro DATE NOT NULL DEFAULT (CURRENT_DATE)
    );


-- DESC usuarios;
CREATE TABLE
    IF NOT EXISTS maquinas (
        id_maq INT AUTO_INCREMENT PRIMARY KEY,
        img_maq VARCHAR(255),
        nome_maq VARCHAR(100) NOT NULL,
        tipo_maq ENUM (
            'Motores',
            'Pneumática',
            'Hidráulica',
            'Equipamentos Industriais'
        ) NOT NULL,
        tipo2_maq VARCHAR(50),
        desc_maq TEXT,
        tempo_estimado_minutos INT NOT NULL
    );

-- DESC maquinas;
CREATE TABLE
    IF NOT EXISTS agenda (
        id_os INT AUTO_INCREMENT PRIMARY KEY,
        data DATE NOT NULL,
        tempo_planejado INT NOT NULL,
        valor_total DECIMAL(10, 2) NOT NULL,
        descricao_problema TEXT NOT NULL,
        tipo_servico ENUM (
            'Manutenção Preventiva',
            'Automação industrial',
            'Engenharia de precisão',
            'Mecatrônica'
        ) NOT NULL,
        endereco_servico VARCHAR(255) NOT NULL,
        metodo_pagamento ENUM ('Pix', 'Débito') NOT NULL,
        status_os ENUM (
            'Pendente',
            'Agendada',
            'Em Andamento',
            'Concluída',
            'Cancelada'
        ) DEFAULT 'Pendente',
        id_cliente INT NOT NULL,
        id_profissional INT NOT NULL,
        FOREIGN KEY (id_cliente) REFERENCES usuarios (id_user),
        FOREIGN KEY (id_profissional) REFERENCES usuarios (id_user)
    );

    CREATE TABLE
    IF NOT EXISTS suporte (
        id_sup INT AUTO_INCREMENT PRIMARY KEY,
        nome_cliente VARCHAR(100),
        desc_sup TEXT,
        tel_sup VARCHAR(20),
        email_sup VARCHAR(100),
        id_usuario INT NOT NULL,
        resposta_admin TEXT NULL,
        status_suporte ENUM ('Pendente', 'Respondido') DEFAULT 'Pendente',
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id_user)
    );

INSERT INTO
    usuarios (
        img_user,
        nome,
        email,
        senha,
        telefone,
        cpf_cnpj,
        tipo,
        categoria,
        especialidade,
        status,
        valor_dia,
        descricao_func,
        notas,
        data_cadastro
    )
VALUES
    (
        'techsolutions_cliente.png',
        'TechSolutions Indústria LTDA',
        'contato@techsolutions.com',
        'hash_senha_123',
        '(11) 98765-4321',
        '55.666.777/0001-88',
        'PJ',
        'cliente',
        NULL,
        NULL,
        NULL,
        NULL,
        5,
        '2021-04-12'
    ),
    (
        'maria_admin.png',
        'Maria Oliveira (Admin)',
        'admin@empresa.com.br',
        'hash_senha_admin',
        '(11) 90000-0000',
        '00.111.222/0001-33',
        'PJ',
        'admin',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        '2020-01-15'
    ),
    (
        'carlos_profissional.png',
        'Carlos Almeida Motores',
        'carlos.motores@email.com',
        'hash_senha_456',
        '(11) 91111-1111',
        '444.555.666-77',
        'PF',
        'profissional',
        'Manutenção de Motores',
        'Disponível',
        250.00,
        'Especialista em reparo, retífica e manutenção preventiva de motores elétricos e a combustão.',
        5,
        '2023-08-24'
    ),
    (
        'ana_profissional.png',
        'Ana Costa Pneumática',
        'ana.pneumatica@email.com',
        'hash_senha_789',
        '(11) 92222-2222',
        '777.888.999-00',
        'PF',
        'profissional',
        'Sistemas Pneumáticos',
        'Em Atendimento',
        300.00,
        'Manutenção e calibração de compressores de ar, válvulas e redes pneumáticas industriais.',
        4,
        '2022-11-02'
    ),
    (
        'marcos_profissional.png',
        'Marcos Ribeiro Hidráulica',
        'marcos.hidraulica@email.com',
        'hash_senha_101',
        '(11) 93333-3333',
        '222.333.444-55',
        'PF',
        'profissional',
        'Sistemas Hidráulicos',
        'Disponível',
        400.00,
        'Especialista no reparo de bombas, cilindros e unidades hidráulicas de alta pressão.',
        5,
        '2020-07-19'
    ),
    (
        'ricardo_profissional.png',
        'Ricardo Souza Equipamentos',
        'ricardo.equipamentos@email.com',
        'hash_senha_202',
        '(11) 94444-4444',
        '555.666.777-88',
        'PF',
        'profissional',
        'Equipamentos Industriais',
        'Inativo',
        450.00,
        'Manutenção corretiva e preventiva em esteiras, tornos CNC e maquinário pesado em geral.',
        3,
        '2025-03-14'
    ),
    (
        'fernando_automacao.jpg',
        'Fernando Lima Automação',
        'fernando.automacao@email.com',
        'hash_senha_303',
        '(11) 95555-1111',
        '111.222.333-44',
        'PF',
        'profissional',
        'Automação Industrial',
        'Disponível',
        550.00,
        'Projetos e manutenção de CLPs, sensores e sistemas automatizados.',
        5,
        '2024-01-30'
    ),
    (
        'juliana_robotica.jpg',
        'Juliana Mendes Robótica',
        'juliana.robotica@email.com',
        'hash_senha_304',
        '(11) 95555-2222',
        '222.333.444-66',
        'PF',
        'profissional',
        'Robótica Industrial',
        'Em Atendimento',
        650.00,
        'Integração e manutenção de células robotizadas industriais.',
        5,
        '2023-05-17'
    ),
    (
        'paulo_eletrica.jpg',
        'Paulo Henrique Elétrica',
        'paulo.eletrica@email.com',
        'hash_senha_305',
        '(11) 95555-3333',
        '333.444.555-77',
        'PF',
        'profissional',
        'Elétrica Industrial',
        'Disponível',
        380.00,
        'Instalação e manutenção de painéis elétricos industriais.',
        4,
        '2021-12-05'
    ),
    (
        'rodrigo_cnc.jpg',
        'Rodrigo Martins CNC',
        'rodrigo.cnc@email.com',
        'hash_senha_306',
        '(11) 95555-4444',
        '444.555.666-99',
        'PF',
        'profissional',
        'Usinagem CNC',
        'Disponível',
        700.00,
        'Programação e manutenção de centros de usinagem CNC.',
        5,
        '2025-10-11'
    ),
    (
        'beatriz_instrumentacao.jpg',
        'Beatriz Santos Instrumentação',
        'beatriz.instrumentacao@email.com',
        'hash_senha_307',
        '(11) 95555-5555',
        '555.666.777-11',
        'PF',
        'profissional',
        'Instrumentação Industrial',
        'Em Atendimento',
        480.00,
        'Calibração e manutenção de instrumentos de medição industrial.',
        4,
        '2022-04-29'
    ),
    (
        'gabriel_mecatronica.jpg',
        'Gabriel Rocha Mecatrônica',
        'gabriel.mecatronica@email.com',
        'hash_senha_308',
        '(11) 95555-6666',
        '666.777.888-22',
        'PF',
        'profissional',
        'Mecatrônica',
        'Disponível',
        520.00,
        'Manutenção integrada de sistemas mecânicos, elétricos e eletrônicos.',
        5,
        '2026-02-03'
    ),
    (
        'metalurgica_abc.png',
        'Metalúrgica ABC LTDA',
        'contato@metalurgicaabc.com.br',
        'hash_senha_401',
        '(11) 98888-1111',
        '12.345.678/0001-90',
        'PJ',
        'cliente',
        NULL,
        NULL,
        NULL,
        NULL,
        4,
        '2024-09-18'
    ),
    (
        'industria_novaera.png',
        'Indústria Nova Era LTDA',
        'contato@novaera.com.br',
        'hash_senha_402',
        '(11) 98888-2222',
        '98.765.432/0001-10',
        'PJ',
        'cliente',
        NULL,
        NULL,
        NULL,
        NULL,
        5,
        '2026-06-02' -- Conta recente, bem perto de hoje
    );

-- DESC agenda;


INSERT INTO
    suporte (
        nome_cliente,
        desc_sup,
        tel_sup,
        email_sup,
        id_usuario,
        resposta_admin,
        status_suporte
    )
VALUES
    (
        'TechSolutions Indústria LTDA',
        'Problema ao agendar manutenção para motor trifásico. O sistema apresenta erro ao confirmar a solicitação.',
        '(11) 98765-4321',
        'contato@techsolutions.com',
        1,
        NULL,
        'Pendente'
    ),
    (
        'TechSolutions Indústria LTDA',
        'Solicitação de suporte para atualização de status de ordem de serviço que permanece como pendente.',
        '(11) 98765-4321',
        'contato@techsolutions.com',
        1,
        'Verificamos o problema e o status foi atualizado corretamente no sistema.',
        'Respondido'
    ),
    (
    'TechSolutions Indústria LTDA',
    'Não consigo anexar imagens ao abrir um chamado de suporte.',
    '(11) 98765-4321',
    'contato@techsolutions.com',
    1,
    NULL,
    'Pendente'
    ),
    (
        'TechSolutions Indústria LTDA',
        'Erro ao visualizar o histórico de ordens de serviço concluídas.',
        '(11) 98765-4321',
        'contato@techsolutions.com',
        1,
        'O problema foi corrigido e o histórico já está disponível.',
        'Respondido'
    ),
    (
        'Metalúrgica ABC LTDA',
        'Dúvida sobre alteração do profissional vinculado a uma ordem de serviço.',
        '(11) 98888-1111',
        'contato@metalurgicaabc.com.br',
        13,
        NULL,
        'Pendente'
    ),
    (
        'Metalúrgica ABC LTDA',
        'Solicitação de relatório com todos os atendimentos realizados no mês.',
        '(11) 98888-1111',
        'contato@metalurgicaabc.com.br',
        13,
        'O relatório foi disponibilizado na área administrativa.',
        'Respondido'
    ),
    (
        'Indústria Nova Era LTDA',
        'Página de acompanhamento da manutenção está carregando lentamente.',
        '(11) 98888-2222',
        'contato@novaera.com.br',
        14,
        NULL,
        'Pendente'
    ),
    (
        'Indústria Nova Era LTDA',
        'Erro ao atualizar os dados de contato da empresa.',
        '(11) 98888-2222',
        'contato@novaera.com.br',
        14,
        'Os dados foram atualizados manualmente e o problema foi encaminhado para correção.',
        'Respondido'
    );

    INSERT INTO agenda (
    data, 
    tempo_planejado, 
    valor_total, 
    descricao_problema, 
    tipo_servico, 
    endereco_servico, 
    metodo_pagamento, 
    status_os, 
    id_cliente, 
    id_profissional
) VALUES
('2026-06-15', 4, 1000.00, 'Barulho excessivo no motor principal da esteira.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 3),
('2026-06-16', 3, 750.00, 'Aquecimento anormal em motor elétrico trifásico.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 3),
('2026-06-17', 5, 1250.00, 'Revisão completa no motor do compressor reserva.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 3),
('2026-06-18', 2, 500.00, 'Troca de rolamentos do motor de exaustão.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 3),
('2026-06-19', 4, 1000.00, 'Retífica preventiva de motor síncrono.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 3),
('2026-08-03', 4, 1000.00, 'Inspeção e lubrificação preventiva do motor principal.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 3),
('2026-06-15', 3, 900.00, 'Perda de pressão na rede principal de ar comprimido.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 4),
('2026-06-16', 4, 1200.00, 'Vazamento em válvulas pneumáticas do setor de embalagem.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 4),
('2026-06-17', 2, 600.00, 'Calibração dos reguladores de pressão dos cilindros.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 4),
('2026-06-18', 5, 1500.00, 'Troca de filtros e óleo do compressor industrial.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 4),
('2026-06-19', 3, 900.00, 'Substituição de conexões pneumáticas ressecadas.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 4),
('2026-08-03', 3, 900.00, 'Revisão da rede pneumática da linha de montagem.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 4),
('2026-06-15', 4, 1600.00, 'Vazamento de óleo na prensa hidráulica.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 5),
('2026-06-16', 3, 1200.00, 'Queda de performance na bomba hidráulica de alta pressão.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 5),
('2026-06-17', 5, 2000.00, 'Troca de reparos do cilindro hidráulico principal.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 5),
('2026-06-18', 2, 800.00, 'Análise de contaminação do fluido hidráulico.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 5),
('2026-06-19', 4, 1600.00, 'Revisão preventiva nas válvulas direcionais da linha.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 5),
('2026-08-03', 5, 2000.00, 'Substituição completa do óleo e filtros do sistema hidráulico.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 5),
('2026-06-20', 4, 1800.00, 'Alinhamento mecânico da esteira transportadora 02.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 6),
('2026-06-21', 5, 2250.00, 'Revisão geométrica do torno mecânico convencional.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 6),
('2026-06-22', 3, 1350.00, 'Lubrificação geral dos eixos da injetora de plásticos.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 6),
('2026-06-23', 4, 1800.00, 'Ajuste de folgas nas guias lineares do maquinário.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 6),
('2026-06-24', 2, 900.00, 'Substituição preventiva de correias de transmissão.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 6),
('2026-08-04', 4, 1800.00, 'Aferição e balanceamento dos mancais do misturador.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 6),
('2026-06-20', 4, 2200.00, 'Backup e otimização do programa do CLP da linha 1.', 'Automação industrial', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 7),
('2026-06-21', 3, 1650.00, 'Falha intermitente na leitura de sensores ópticos.', 'Automação industrial', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 7),
('2026-06-22', 5, 2750.00, 'Parametrização de novo inversor de frequência.', 'Automação industrial', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 7),
('2026-06-23', 4, 2200.00, 'Configuração de telas de alarmes no sistema supervisório.', 'Automação industrial', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 7),
('2026-06-24', 3, 1650.00, 'Revisão da rede comunicação Profibus da fábrica.', 'Automação industrial', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 7),
('2026-08-04', 3, 1650.00, 'Atualização de firmware e verificação do CLP da prensa.', 'Automação industrial', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 7),
('2026-06-20', 5, 3250.00, 'Ajuste fino nos pontos de solda do robô Kuka.', 'Mecatrônica', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 8),
('2026-06-21', 4, 2600.00, 'Troca das baterias da CPU e calibração dos eixos do robô.', 'Mecatrônica', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 8),
('2026-06-22', 6, 3900.00, 'Manutenção preventiva na garra pneumática do manipulador.', 'Mecatrônica', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 8),
('2026-06-23', 3, 1950.00, 'Atualização de firmware e testes de segurança da célula.', 'Mecatrônica', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 8),
('2026-06-24', 4, 2600.00, 'Revisão dos cabos de potência do braço robótico.', 'Mecatrônica', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 8),
('2026-08-04', 2, 1300.00, 'Reprogramação das trajetórias do braço robótico de paletização.', 'Mecatrônica', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 8),
('2026-06-25', 3, 1140.00, 'Termografia e reaperto de conexões no QGBT.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 9),
('2026-06-26', 4, 1520.00, 'Substituição de disjuntor motor danificado no painel.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 9),
('2026-06-27', 5, 1900.00, 'Instalação de novos medidores de energia multimedidores.', 'Manutenção Preventiva', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 9),
('2026-06-28', 2, 760.00, 'Substituição de lâmpadas queimadas por luminárias LED industriais.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 9),
('2026-06-29', 4, 1520.00, 'Teste e manutenção preventiva no banco de capacitores.', 'Manutenção Preventiva', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 9),
('2026-08-05', 4, 1520.00, 'Limpeza de barramentos e revisão do quadro elétrico geral.', 'Manutenção Preventiva', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 9),
('2026-06-25', 4, 2800.00, 'Nivelamento e teste de repetibilidade do centro de usinagem.', 'Engenharia de precisão', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 10),
('2026-06-26', 5, 3500.00, 'Ajuste eletrônico nas réguas digitais de medição linear.', 'Engenharia de precisão', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 10),
('2026-06-27', 3, 2100.00, 'Otimização de códigos G para redução do tempo de ciclo.', 'Engenharia de precisão', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 10),
('2026-06-28', 4, 2800.00, 'Manutenção no sistema de refrigeração de alta pressão da CNC.', 'Engenharia de precisão', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 10),
('2026-06-29', 3, 2100.00, 'Substituição dos raspadores de cavaco das guias.', 'Engenharia de precisão', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 10),
('2026-08-05', 3, 2100.00, 'Aferição a laser dos eixos X e Y do centro de usinagem.', 'Engenharia de precisão', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 10),
('2026-06-25', 3, 1440.00, 'Calibração RBC de transmissores de pressão em campo.', 'Engenharia de precisão', 'Rodovia BC, Km 12 - SP', 'Débito', 'Agendada', 14, 11),
('2026-06-26', 4, 1920.00, 'Ajuste de zero e span em medidores de vazão eletromagnéticos.', 'Engenharia de precisão', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 11),
('2026-06-27', 2, 960.00, 'Substituição de termopares tipo K danificados no forno.', 'Engenharia de precisão', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 11),
('2026-06-28', 4, 1920.00, 'Configuração e calibração de posicionadores de válvulas.', 'Engenharia de precisão', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 11),
('2026-06-29', 3, 1440.00, 'Revisão preventiva nos analisadores de gases da chaminé.', 'Engenharia de precisão', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 11),
('2026-08-05', 5, 2400.00, 'Calibração em malha fechada dos transmissores de temperatura.', 'Engenharia de precisão', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 11),
('2026-06-30', 4, 2080.00, 'Sincronismo eletromecânico entre duas esteiras motorizadas.', 'Mecatrônica', 'Av. Industrial, 1000 - SP', 'Pix', 'Agendada', 1, 12),
('2026-07-01', 5, 2600.00, 'Diagnóstico de erro intermitente em servomotor de posicionamento.', 'Mecatrônica', 'Rua das Fábricas, 450 - SP', 'Débito', 'Agendada', 13, 12),
('2026-07-02', 3, 1560.00, 'Troca de sensores magnéticos e ajuste físico de fim de curso.', 'Mecatrônica', 'Rodovia BC, Km 12 - SP', 'Pix', 'Agendada', 14, 12),
('2026-07-03', 4, 2080.00, 'Revisão eletromecânica completa na mesa giratória de indexação.', 'Mecatrônica', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 12),
('2026-07-04', 5, 2600.00, 'Substituição de encoder incremental e testes de pulso.', 'Mecatrônica', 'Rua das Fábricas, 450 - SP', 'Pix', 'Agendada', 13, 12),
('2026-08-06', 4, 2080.00, 'Análise de vibração e sincronismo do sistema servomotor-redutor.', 'Mecatrônica', 'Av. Industrial, 1000 - SP', 'Débito', 'Agendada', 1, 12);