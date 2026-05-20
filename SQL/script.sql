SELECT current_user();
-- SHOW DATABASES;
USE db_sync;


CREATE TABLE IF NOT EXISTS usuarios (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    img_user VARCHAR(255),
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    cpf_cnpj VARCHAR(20) UNIQUE NOT NULL,
    tipo ENUM('PF', 'PJ') NOT NULL,
    categoria ENUM('cliente', 'profissional', 'admin') NOT NULL,
    
    especialidade VARCHAR(100) NULL,
    status ENUM('Disponível', 'Em Atendimento', 'Inativo') NULL,
    valor_dia DECIMAL(10, 2) NULL,
    descricao_func TEXT NULL,
    
    notas INT NULL CHECK (notas BETWEEN 0 AND 5)
);

-- DESC usuarios;

CREATE TABLE IF NOT EXISTS maquinas (
    id_maq INT AUTO_INCREMENT PRIMARY KEY,
    img_maq VARCHAR(255),
    nome_maq VARCHAR(100) NOT NULL,
    tipo_maq ENUM('Motores', 'Pneumática', 'Hidráulica', 'Equipamentos Industriais') NOT NULL,
    tipo2_maq VARCHAR(50),
    desc_maq TEXT,
    tempo_estimado_minutos INT NOT NULL 
);

-- DESC maquinas;


	CREATE TABLE IF NOT EXISTS agenda (
	    id_os INT AUTO_INCREMENT PRIMARY KEY,
	    data DATE NOT NULL,
	    
		tempo_planejado_minutos INT NOT NULL,
		
		valor_total DECIMAL(10, 2) NOT NULL,
	    descricao_problema TEXT NOT NULL,
	    endereco_servico VARCHAR(255) NOT NULL,
	    
	    status_os ENUM('Pendente', 'Agendada', 'Em Andamento', 'Concluída', 'Cancelada') DEFAULT 'Pendente',
	    
	    id_cliente INT NOT NULL,
	    id_profissional INT NOT NULL,
	    id_maquina INT NOT NULL,
	    
	    FOREIGN KEY (id_cliente) REFERENCES usuarios(id_user),
	    FOREIGN KEY (id_profissional) REFERENCES usuarios(id_user),
	    FOREIGN KEY (id_maquina) REFERENCES maquinas(id_maq)
	);

-- DESC agenda;

CREATE TABLE IF NOT EXISTS suporte (
    id_sup INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100),
    desc_sup TEXT,
    tel_sup VARCHAR(20),
    email_sup VARCHAR(100),
    id_usuario INT NOT NULL,
    resposta_admin TEXT NULL,
    status_suporte ENUM('Pendente', 'Respondido') DEFAULT 'Pendente',
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_user)
);

-- DESC suporte;

INSERT INTO usuarios (
    img_user, nome, email, senha, telefone, cpf_cnpj, tipo, categoria, 
    especialidade, status, valor_dia, descricao_func, notas
) VALUES
('techsolutions_cliente.png', 'TechSolutions Indústria LTDA', 'contato@techsolutions.com', 'hash_senha_123', '(11) 98765-4321', '55.666.777/0001-88', 'PJ', 'cliente', NULL, NULL, NULL, NULL, 5),
('maria_admin.png', 'Maria Oliveira (Admin)', 'admin@empresa.com.br', 'hash_senha_admin', '(11) 90000-0000', '00.111.222/0001-33', 'PJ', 'admin', NULL, NULL, NULL, NULL, NULL),
('carlos_profissional.png', 'Carlos Almeida Motores', 'carlos.motores@email.com', 'hash_senha_456', '(11) 91111-1111', '444.555.666-77', 'PF', 'profissional', 'Manutenção de Motores', 'Disponível', 250.00, 'Especialista em reparo, retífica e manutenção preventiva de motores elétricos e a combustão.', 5),
('ana_profissional.png', 'Ana Costa Pneumática', 'ana.pneumatica@email.com', 'hash_senha_789', '(11) 92222-2222', '777.888.999-00', 'PF', 'profissional', 'Sistemas Pneumáticos', 'Em Atendimento', 300.00, 'Manutenção e calibração de compressores de ar, válvulas e redes pneumáticas industriais.', 4),
('marcos_profissional.png', 'Marcos Ribeiro Hidráulica', 'marcos.hidraulica@email.com', 'hash_senha_101', '(11) 93333-3333', '222.333.444-55', 'PF', 'profissional', 'Sistemas Hidráulicos', 'Disponível', 400.00, 'Especialista no reparo de bombas, cilindros e unidades hidráulicas de alta pressão.', 5),
('ricardo_profissional.png', 'Ricardo Souza Equipamentos', 'ricardo.equipamentos@email.com', 'hash_senha_202', '(11) 94444-4444', '555.666.777-88', 'PF', 'profissional', 'Equipamentos Industriais', 'Inativo', 450.00, 'Manutenção corretiva e preventiva em esteiras, tornos CNC e maquinário pesado em geral.', 3);

INSERT INTO maquinas (
    img_maq, nome_maq, tipo_maq, tipo2_maq, desc_maq, tempo_estimado_minutos
) VALUES
('motor_indutivo.png', 'Motor de Indução Trifásico AC', 'Motores', 'Elétrico', 'Motor elétrico de alta eficiência utilizado para acionamento de esteiras transportadoras e exaustores industriais.', 120),
('compressor_parafuso.png', 'Compressor de Parafuso Rotativo', 'Pneumática', 'Geração de Ar', 'Equipamento responsável pelo fornecimento contínuo de ar comprimido para ferramentas e atuadores pneumáticos da fábrica.', 90),
('bomba_pistao.png', 'Bomba Hidráulica de Pistão Axial', 'Hidráulica', 'Alta Pressão', 'Unidade geradora de fluxo hidráulico para sistemas de alta pressão, como prensas e braços mecânicos.', 180),
('torno_cnc.png', 'Torno CNC Industrial X-1000', 'Equipamentos Industriais', 'Usinagem', 'Maquinário automatizado para usinagem de precisão de peças metálicas e plásticas de alta complexidade.', 240);

