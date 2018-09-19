CREATE TABLE Livro(

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

CREATE TABLE Usuario(

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    matricula VARCHAR(15),
    nome VARCHAR(255),
    email VARCHAR(63),
    senha VARCHAR(127)

);

CREATE TABLE Aluno_Professor (

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    FOREIGN KEY (id) REFERENCES Usuario(id)

);

CREATE TABLE Bibliotecario(
    
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FOREIGN KEY (id) REFERENCES Usuario(id)
    
);

CREATE TABLE Reserva(
    
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    aluno_prof INT NOT NULL,
    livro INT NOT NULL,
    FOREIGN KEY (aluno_prof) REFERENCES Aluno_Professor(id),
    FOREIGN KEY (livro) REFERENCES Livro(id)
    
);

CREATE TABLE Emprestimo (

    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    aluno_prof INT NOT NULL,
    bibliotecario INT NOT NULL,
    livro INT NOT NULL,
    retirado BOOLEAN NOT NULL,
    _data DATE NOT NULL,
    horario TIME NOT NULL,
    FOREIGN KEY (aluno_prof) REFERENCES Aluno_Professor(id),
    FOREIGN KEY (bibliotecario) REFERENCES Bibliotecario(id),
    FOREIGN KEY (livro) REFERENCES Livro(id)

);
