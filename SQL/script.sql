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
    tipo ENUM('PF', 'PJ')NOT NULL,
    categoria ENUM('cliente', 'profissional', 'admin') NOT NULL,
    especialidade VARCHAR(100),
    status VARCHAR(20) CHECK (
        (categoria = 'profissional' AND status IS NOT NULL) OR 
        (categoria <> 'profissional' AND status IS NULL)
    ),
    valor_dia DECIMAL(10, 2),
    descricao_func TEXT,
    notas INT CHECK (notas BETWEEN 0 AND 5)
);

DROP TABLE usuarios;

DESC usuarios;

CREATE TABLE IF NOT EXISTS agenda (
    id_os INT AUTO_INCREMENT PRIMARY KEY,
    data DATE,
    horas_previstas VARCHAR(50) NULL,
    valor_total DECIMAL(10, 2),
    descricao_problema TEXT,
    endereco_servico VARCHAR(255),
    
    id_cliente INT NOT NULL,
    id_profissional INT NOT NULL,
    id_maquina INT NOT NULL,
    
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id_user),
    FOREIGN KEY (id_profissional) REFERENCES usuarios(id_user),
    FOREIGN KEY (id_maquina) REFERENCES maquinas(id_maq)
);

DESC agenda;

CREATE TABLE IF NOT EXISTS maquinas (
    id_maq INT AUTO_INCREMENT PRIMARY KEY,
    img_maq VARCHAR(255),
    nome_maq VARCHAR(100) NOT NULL,
    tipo_maq VARCHAR(50),
    tipo2_maq VARCHAR(50),
    desc_maq TEXT,
    tempo_maq VARCHAR(50)
);

DESC maquinas;

CREATE TABLE IF NOT EXISTS suporte (
    id_sup INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100),
    desc_sup TEXT,
    tel_sup VARCHAR(20),
    email_sup VARCHAR(100),
    
    id_usuario INT NOT NULL,
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_user)
);

DESC suporte;

