CREATE TABLE livro(

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    autor VARCHAR(255) NOT NULL,
    titulo VARCHAR(127) NOT NULL,
    edicao VARCHAR(31) NOT NULL,
    editora VARCHAR(31),
    volume VARCHAR(15),
    exemplar INT NOT NULL,
	  classificacao VARCHAR(34) NOT NULL,
	  aquisicao DATE NOT NULL,
	  observacao VARCHAR(144)

);

CREATE TABLE usuario(

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    matricula VARCHAR(15),
    nome VARCHAR(255),
    email VARCHAR(63),
    senha VARCHAR(127),
    telefone VARCHAR(30),
    turma VARCHAR(10),
    foto VARCHAR(127),
    banido BOOL

);

CREATE TABLE aluno_professor (

    id INT NOT NULL PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES usuario(id)

);

CREATE TABLE bibliotecario(

    id INT NOT NULL PRIMARY KEY,
    FOREIGN KEY (id) REFERENCES usuario(id)

);

CREATE TABLE reserva(

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    aluno_prof INT NOT NULL,
    livro INT NOT NULL,
    FOREIGN KEY (aluno_prof) REFERENCES aluno_professor(id),
    FOREIGN KEY (livro) REFERENCES livro(id)

);

CREATE TABLE emprestimo (

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    aluno_prof INT NOT NULL,
    bibliotecario INT NULL,
    livro INT NOT NULL,
    retirado BOOLEAN NOT NULL,
    _data DATE NOT NULL,
    horario TIME NOT NULL,
    FOREIGN KEY (aluno_prof) REFERENCES aluno_professor(id),
    FOREIGN KEY (bibliotecario) REFERENCES bibliotecario(id),
    FOREIGN KEY (livro) REFERENCES livro(id)

);

-- =-= Inserts =-=

INSERT INTO usuario VALUES

  (1, 'M00000000', 'Bibliotecário Admin Padrão', 'bib_admin@example.com', '$2y$10$JfLURWJ3HjCl00odKV2fwe5wxc1K3ULs2Eopr59U.LvrXFJ6/7LSm', NULL, FALSE),
  (2, 'M00000001', 'Allison Matheus', 'allison@example.com', '$2y$10$Ir.WpDxsPMIhdpuc9dPUnOpILhhLx.zXQNzDgx9E.TRkbClAN8fOC', NULL, FALSE),
  (3, 'M00000002', 'Carlos Eduardo', 'filhao@example.com', '$2y$10$MUxxWHYZ7sr4.CWxPkWcO./1EzvqgBN/zeqipBHUJDOP3J/JY2tn.', NULL, FALSE),
  (4, 'M00000003', 'Gabriel Teixeira', 'gabriel@example.com', '$2y$10$.Dqxl58TMI8yR147u5j12ei/JsC18hkRQdqLmlcXmpnycVqIqgzim', NULL, FALSE),
  (5, 'M00000004', 'Gabriele Gomes', 'gabriele@example.com', '$2y$10$z2OGHu6H0F5YNDtqHMUOyO4CiIrMwWNK7jIzqmiz6cOG8nwp49ACq', NULL, FALSE);

INSERT INTO aluno_professor VALUES

  (2),
  (3),
  (4),
  (5);

INSERT INTO bibliotecario VALUES

  (1);

INSERT INTO livro VALUES

  (1, 'Machado de Assis', 'Dom Casmurro', '10', '', '1', 1, '324F. 87', '2018-09-19', ''),
  (2, 'Borges, Taisa', 'Frankstein em Quadrinhos', '1', 'Peirópolis', '1', 1, '741.5 B732f', '2015-09-05', ''),
  (3, 'Thomas Cormen', 'Introduction to Algorithms', '3', 'The MIT Press', '1', 1, '123A. 34', '2018-09-25', ''),
  (4, '', 'Questões de Matemática', '1', 'Saraiva', '', 1, '510 Q5', '2015-08-19', 'CD'),
  (5, 'Jenny Wang, Sue Blackman', 'Unity for Absolute Beginners', '1', '', '1', 1, 'YT4F. 8S', '2014-06-13', '');
