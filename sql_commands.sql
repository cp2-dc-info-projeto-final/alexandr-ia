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
    senha VARCHAR(127)

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
    bibliotecario INT NOT NULL,
    livro INT NOT NULL,
    retirado BOOLEAN NOT NULL,
    _data DATE NOT NULL,
    horario TIME NOT NULL,
    FOREIGN KEY (aluno_prof) REFERENCES aluno_professor(id),
    FOREIGN KEY (bibliotecario) REFERENCES bibliotecario(id),
    FOREIGN KEY (livro) REFERENCES livro(id)

);
