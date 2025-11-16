-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS admin_daw
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

-- Usa o banco de dados recém-criado
USE admin_daw;

CREATE TABLE IF NOT EXISTS Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo VARCHAR(60) NOT NULL
);

CREATE TABLE IF NOT EXISTS Escolas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    endereco VARCHAR(255),
    interesse_aulao_enem TINYINT(1)
);

CREATE TABLE IF NOT EXISTS Alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    serie VARCHAR(50) NOT NULL, -- 1º ano, 2º ano, 3º ano
    senha VARCHAR(255) NOT NULL,
    interesse_aulao_enem TINYINT(1),
    id_escola INT
);

CREATE TABLE IF NOT EXISTS Professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    especialidade VARCHAR(50) NOT NULL, -- Química, Física, Matemática
    biografia TEXT,
    valor_hora_aula DECIMAL(10, 2) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    interesse_aulao_enem TINYINT(1),
    id_escola INT
);

CREATE TABLE IF NOT EXISTS HorariosProfessores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_professor INT NOT NULL,
    data DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    FOREIGN KEY (id_professor) REFERENCES Professores(id)
);

CREATE TABLE IF NOT EXISTS Disciplinas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE IF NOT EXISTS Aulas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_professor INT, -- NULL para o cadastro da escola com Aulão do Enem, que a princípio não tem professor definido
    disciplina VARCHAR(50), -- NULL para o cadastro da escola com Aulão do Enem.
    id_escola INT, -- NULL para o cadastro da escola com Aulão do Enem.
    data DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    status VARCHAR(50) NOT NULL, -- Agendada, Confirmada, Cancelada, Concluída
    tipo VARCHAR(50) NOT NULL, -- Online, Presencial
    link VARCHAR(255),
    endereco VARCHAR(255),
    observacoes TEXT,
    FOREIGN KEY (id_professor) REFERENCES Professores(id),
    FOREIGN KEY (id_escola) REFERENCES Escolas(id)
);

CREATE TABLE IF NOT EXISTS AulasAlunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_aula INT NOT NULL,
    id_aluno INT NOT NULL,
    FOREIGN KEY (id_aula) REFERENCES Aulas(id) ON DELETE CASCADE,
    FOREIGN KEY (id_aluno) REFERENCES Alunos(id) ON DELETE CASCADE,
    UNIQUE (id_aula, id_aluno) -- evita duplicidades
);

CREATE TABLE IF NOT EXISTS Notificacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    mensagem VARCHAR(255) NOT NULL,
    lida TINYINT(1) DEFAULT 0,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id)
);

INSERT INTO Usuarios (nome, email, senha, tipo) VALUES
('Harry Potter', 'harry.potter@email.com', MD5('senha123'), 'aluno'),
('Ronie', 'ronie@email.com', MD5('senha123'), 'aluno'),
('Laila', 'laila.leal@email.com', MD5('senha123'), 'professor'),
('Francisca', 'francisca.leal@email.com', MD5('senha123'), 'professor'),
('Colégio Aurora', 'aurora@saber.edu', MD5('senha123'), 'escola'),
('Instituto Horizonte Jovem', 'horizonte@ijovem.org', MD5('senha123'), 'escola'),
('Centro Educacional Estrela Polar', 'estrela@polar.edu', MD5('senha123'), 'escola'),
('Hermione', 'hermione@email.com', MD5('senha123'), 'professor');

INSERT INTO Disciplinas (nome) VALUES
('Química'),
('Física'),
('Matemática');

INSERT INTO Escolas (nome, email, endereco, interesse_aulao_enem) VALUES
('Colégio Aurora do Saber', 'aurora@saber.edu', 'Rua das Estrelas, 45 - Bairro Luz, São Paulo - SP', 1),
('Instituto Horizonte Jovem', 'horizonte@ijovem.org', 'Av. dos Ventos, 980 - Centro, Belo Horizonte - MG', 1),
('Centro Educacional Estrela Polar', 'estrela@polar.edu', 'Rua Norte, 120 - Centro, Manaus - AM', 0);

INSERT INTO Alunos (nome, email, telefone, serie, senha, interesse_aulao_enem, id_escola) VALUES
('Harry Potter', 'harry.potter@email.com', '11227755331', '1º ano', MD5('senha123'), 1, 1),
('Ronie', 'ronie@email.com', '22998866442', '2º ano', MD5('senha123'), null, null);

INSERT INTO Professores (nome, email, telefone, especialidade, biografia, valor_hora_aula, senha, interesse_aulao_enem, id_escola) VALUES
('Prof. Laila Leal', 'laila.leal@email.com', '10110111122', 'Química', 'Professora de Química com 10 anos de experiência.', 65.00, MD5('senha123'), null, null),
('Prof. Francisca Leal', 'francisca.leal@email.com', '10110111123', 'Física', 'Especialista em Física para ensino médio.', 45.00, MD5('senha123'), null, null),
('Prof. Hermione', 'hermione@email.com', '10110111124', 'Matemática', 'Matemática descomplicada para todos os níveis.', 55.00, MD5('senha789'), 1, 1);

INSERT INTO HorariosProfessores (id_professor, data, hora_inicio, hora_fim) VALUES
( 1, '2025-12-10', '08:00:00', '10:00:00'),
( 1, '2025-12-10', '10:30:00', '12:30:00'),
( 2, '2025-12-10', '09:00:00', '11:00:00'),
( 2, '2025-12-11', '14:00:00', '16:00:00'),
( 3, '2025-12-12', '07:30:00', '09:30:00');

INSERT INTO Aulas (id_professor, disciplina, data, hora_inicio, hora_fim, status, tipo, observacoes, link, endereco) VALUES
( 1, 'Química', '2025-07-10', '10:00:00', '11:00:00', 'Pendente', 'Online', 'Revisão para prova de química.', 'https://meet.google.com/abc-defg-hij', NULL),
( 2, 'Matemática', '2025-07-11', '14:30:00', '16:00:00', 'Confirmada', 'Presencial', 'Física - Leis de Newton.', NULL, 'Rua XXX, 123, Centro'),
( 3, 'Física', '2025-07-12', '09:00:00', '10:00:00', 'Pendente', 'Online', 'Cálculo I - Derivadas.', 'https://zoom.us/j/123456789', NULL);

INSERT INTO AulasAlunos (id_aula, id_aluno) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1);
