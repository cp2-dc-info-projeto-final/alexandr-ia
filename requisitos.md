# Requisitos Funcionais

## RF 01

O sistema gerencia cadastro e informações de 3 tipos de usuário: Aluno(a), Professor(a) e Bibliotecário(a)

+ Informações do(a) Aluno(a):

		* As informações guardadas no sistema, sobre o(a) aluno(a), são:

			1. Matrícula;
			2. Nome;     
			3. E-mail;
			4. Senha.

+ Informações do(a) Professor(a):

		* As informações guardadas no sistema, sobre o(a) professor(a) são:

			1. Matrícula;
			2. Nome;
			3. E-mail;
			4. Senha.

+ Informações do(a) Bibliotecário(a):

		* As informações guardadas no sistema, sobre o(a) bibliotecário(a) são:

			1. Nome;
			2. E-mail;
			3. Senha.


## RF 02

- Todas as informações dos(as) Usuários(as) são guardadas em um banco de dados.

## RF 03

- O(a) Bibliotecário(a) tem acesso a várias informações de todos os usuários, menos à senha.

## RF 04

- Os(as) Alunos(as) e Professores(as) terão acesso somente a suas respectivas informações, através da plataforma Web e informando matrícula ou e-mail e senha;

## RF 05

- O(a) Bibliotecário(a) poderá ter acesso ao sistema informando nome ou e-mail e senha, na Web.

## RF 06

Livros

- O sistema gerencia os livros contidos na biblioteca, catalogando-os ou excluindo-os dos registros.

+ O(a) Biliotecário(a) cadastra os livros da biblioteca através da Web e as informações são armazenadas em um banco de dados.

  + Para catalogar os livros o(a) Bibliotecário(a) insere as seguintes informações no sistema:  

	+ Título do livro;
	+ Autores do livro;
	+ Editora(s) do livro;
	+ Gênero do livro.

  (Essas informações serão utilizadas na elaboração dos bancos de dados do sistema);

## RF 07

- Os livros, após cadastrados no sistema, possuirão suas informações parcialmente disponibilizadas aos(às) Alunos(as) e Professores(as), através da plataforma Web, sendo elas:

	+ Se o livro está emprestado ou não;
	+ Título do livro;
	+ Autores do livro;
	+ Editora(s) do livro;
	+ Gênero do livro.

## RF 08

- Os(as) Alunos(as) poderão reservar até 2 livros no site. Após reservado(s), a pessoa terá prazo no máximo 24H úteis para retirar o livro na biblioteca, que ficará indisponível. Caso isso não venha a acontecer, a reserva será cancelada e o livro voltará a estar disponível.

## RF 09

- Os(as) Alunos(as) poderão colocar até 8 livros na lista de desejo (caso estejam emprestados). E ao fazer isso, serão notificadas quando o livro estiver disponível;

* Esta lista estará disponível apenas ao(à) Aluno(a)

## RF 10

- Alunos(as) e Professores(as) colocados(as) na Lista Negra (por terem furtado algum livro ou terem causado alguma outra perturbação que venha a prejudicar o sistema de gerenciamento da biblioteca) serão impedidos(as) de acessar o sistema até serem retirados(as) da lista.

## RF 11

- O sistema irá fazer recomendações de leitura aos(às) Usuários(as) baseados nos gêneros lidos recentementes.

## RF 12

- O sistema enviará um e-mail aos(às) Alunos(as) e Professores(as) quando um novo livro for catalogado.

## RF 13

- Caso a data de entrega esteja próxima de chegar, será enviado um e-mail para lembrá-lo(a) da devolução do livro.
