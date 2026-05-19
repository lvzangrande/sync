SELECT current_user();
SHOW DATABASES;
USE sync_db;


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

DESC usuarios;

CREATE TABLE IF NOT EXISTS maquinas (
    id_maq INT AUTO_INCREMENT PRIMARY KEY,
    img_maq VARCHAR(255),
    nome_maq VARCHAR(100) NOT NULL,
    tipo_maq ENUM('Motores', 'Pneumática', 'Hidráulica', 'Equipamentos Industriais') NOT NULL,
    tipo2_maq VARCHAR(50),
    desc_maq TEXT,
    tempo_estimado_minutos INT NOT NULL 
);

DESC maquinas;


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

DESC agenda;

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

DESC suporte;

