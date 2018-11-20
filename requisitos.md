# Especificação de Requisitos
## Sumário

- [Requisitos Não-Funcionais](Requisitos-Não---Funcionais)
- [RNF 01](RNF-01)
- [RNF 02](RNF-02)
- [RNF 03](RNF-03)
- [RNF 04](RNF-04)
- [RNF 05](RNF-05)
- [RNF 06](RNF-06)
- [RNF 07](RNF-07)
- [RNF 08](RNF-08)
- [RNF 09](RNF-09)
- [RNF 10](RNF-10)
- [RNF 11](RNF-11)
- [Requisitos Funcionais](Requisitos-Funcionais)
- [RF 01](RF-01)
- [RF 02](RF-02)
- [RF 03](RF-03)
- [RF 04](RF-04)
- [RF 05](RF-05)
- [RF 06](RF-06)
- [RF 07](RF-07)
- [RF 08](RF-08)
- [RF 09](RF-09)
- [RF 10](RF-10)
- [RF 11](RF-11)
- [RF 12](RF-12)
- [RF 13](RF-13)


## Requisitos Não-Funcionais

### RNF 01

-   Deve rodar com muitos alunos(as) ou professores(as) acessando ao mesmo tempo.

### RNF 02

-   Deve cadastrar muitos ao mesmo tempo.

### RNF 03

-   Deve fazer o cadastro, possibilitando o(a) cadastrado(a) fazer login após o cadastro.

### RNF 04

-   Deve ter comunicação e armazenamento instantâneos com o banco de dados.

### RNF 05

-   Deve ter suporte para mais de mil pessoas cadastradas.

### RNF 06   

-   Deve ter suporte para mais de 10 mil livros.

### RNF 07

- Deve rodar 100% do tempo, tendo alta disponibilidade.

### RNF 08    

-   Deve ter acesso à internet com velocidade suficiente para carregar páginas.

### RNF 09    

-   Deve rodar em qualquer plataforma na Web e dispositivos com acesso à internet (celular, tablet e etc).

### RNF 10    

-   Deve ficar fora do ar, caso hajam problemas que façam o sistema ficar ineficaz, até ser consertado.

### RNF 11    

-   Deve utilizar as linguagens: HTML 5, CSS, PHP e JavaScript.


## Requisitos Funcionais

### RF 01

O sistema gerencia cadastro e informações dos livros e de 3 tipos de usuário: Aluno(a), Professor(a) e Bibliotecário(a).

+ Informações do Livro:

		* As informações guardadas no sistema, sobre o(a) Livro são:

			1. Título;
			2. Autor;
			3. Aquisição;
			4. Observações;
			5. Volume;
			6. Edição;
			7. Editora;
			8. Exemplares;
			9. Classificação;

+ Informações do(a) Aluno(a):

		* As informações guardadas no sistema, sobre o(a) aluno(a), são:

			1. Matrícula;
			2. Nome;
			3. Telefone;   
			4. Turma;
			5. E-mail;
			6. Senha.

+ Informações do(a) Professor(a):

		* As informações guardadas no sistema, sobre o(a) professor(a) são:

			1. Matrícula;
			2. Nome;
			3. Telefone;
			4. E-mail;
			5. Senha.

+ Informações do(a) Bibliotecário(a):

		* As informações guardadas no sistema, sobre o(a) bibliotecário(a) são:

			1. Matricula;
			2. Nome;
			3. Telefone;
			4. E-mail;
			5. Senha.


### RF 02

- Todas as informações dos(as) Usuários(as) e dos Livros são guardadas em um banco de dados.

### RF 03

- O(a) Bibliotecário(a) tem acesso a várias informações, para visualização, de todos os usuários, menos à senha.

### RF 04

- Os(as) Alunos(as) e Professores(as) terão acesso somente a suas respectivas informações informando e-mail e senha;

### RF 05

- O(a) Bibliotecário(a) poderá ter acesso ao sistema informando e-mail e senha.

### RF 06

Livros

- O(a) Biblioracário(a) gerencia os livros contidos na biblioteca: catalogando-os, emprestando-os ou excluindo-os dos registros.

+ O(a) Biliotecário(a) cadastra os livros da biblioteca e as informações são armazenadas em um banco de dados.

### RF 07

- Os livros, após cadastrados no sistema, possuirão suas informações parcialmente disponibilizadas aos(às) Alunos(as) e Professores(as).

### RF 08

- Os(as) Alunos(as) ou o(a) Professores(as) poderão reservar até 2 livros no site. Após reservado(s), a pessoa terá prazo no máximo 24H úteis para retirar o livro na biblioteca, que ficará indisponível. Caso isso não venha a acontecer, a reserva será cancelada e o livro voltará a estar disponível.

### RF 09

- Os(as) Alunos(as) ou o(a) Professores(as) poderão colocar até 2 livros na lista de desejo (caso estejam emprestados). E ao fazer isso, serão notificadas quando o livro estiver disponível;

* Esta lista estará disponível apenas ao(à) Aluno(a) ou o(a) Professores(as).

### RF 10

- Alunos(as) e Professores(as) colocados(as) na Lista De Suspenção (por terem furtado algum livro ou terem causado alguma outra perturbação que venha a prejudicar o(s) livro(s) da biblioteca) serão impedidos(as) de acessar o sistema até serem retirados(as) da lista.

### RF 11

- O sistema enviará um e-mail aos(às) Alunos(as) e Professores(as) quando um livro de interesse for disponibilidado.

### RF 12

- Caso a data de entrega esteja próxima de chegar, será enviado um e-mail para lembrá-lo(a) da devolução do livro.

### RF 13

- O sistema tem uma ferramenta que possibilita os(as) Alunos(as) e Professores(as) pedir recomendações de leitura aleatoriamente.
