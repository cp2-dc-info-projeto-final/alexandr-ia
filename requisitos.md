# Requisitos Não-Funcionais
## Sistema
### Dividido em duas partes:

#### Sistema Web:
 - Deve rodar com muitos alunos(as) ou professores(as) acessando ao mesmo tempo.
 - Deve cadastrar muitos ao mesmo tempo.
 - Deve fazer o cadastro instantaneamente, possibilitando o(a) cadastrado(a) fazer login imediatamente após o cadastro.
 
 - Deve ter  comunicação e armazenamento instantâneos com o banco de dados.
 - Deve ter suporte para mais de mil pessoas cadastradas.
 - Deve ter suporte para mais de 10 mil livros.
 - Deve rodar 100% do tempo, tendo alta disponibilidade.
 - Deve ter acesso à internet com velocidade suficiente para carregar páginas.
 - Deve rodar em qualquer plataforma na Web e dispositivos com acesso à internet (celular, tablet e etc).
 - Deve ficar fora do ar, caso hajam problemas que façam o sistema ficar ineficaz, até ser consertado.
 - Deve utilizar as linguagens: HTML 5, CSS, PHP, JavaScript // e JSON.
 - Operações com o sistema C#.

#### Sistema Software em C#:
 - Roda em sistema operacional Windows.
 - Será rodado apenas nos computadores dos(as) bibliotecários(as).
 - Memória suficiente para acessar e armazenar o banco de dados (sql server) com todos os cadastros (mais de 10 mil livros, 2 mil alunos e professores).
 - Os dados dos usuários devem ser mantidos em sigilo para os demais cadastrados, com exceção dos(as) bibliotecários(as) e o próprio usuário dono dos tais dados.
 - Precisa de acesso à internet.
 - Comunicação e acesso instantâneos às mudanças no banco de dados.
 - Operações com o sistema web.
 - O(A) bibliotecário(a) deverá operar o sistema após um breve tempo de treinamento.
 - Utilização de linguagem orientada a objeto na plataforma .NET.
 - O sistema deverá atender às normas legais, tais como padrões, leis, etc.
 
# Requisitos Funcionais

### O sistema gerencia cadastro e informações de 3 tipos de usuário: Aluno(a), Professor(a) e Bibliotecário(a)
	
+ Informações do(a) Aluno(a):

		* As informações guardadas no sistema, sobre o(a) aluno(a), são: 

			1. Matrícula;
			2. Nome;
			3. Ano cursado no Colégio;      
			4. E-mail;
			5. Senha.
	
+ Informações do(a) Professor(a):

		* As informações guardadas no sistema, sobre o(a) professor(a) são:

			1. Matrícula;
			2. Nome;
			3. Disciplina;
			4. E-mail;
			5. Senha.

+ Informações do(a) Bibliotecário(a):
	
		* As informações guardadas no sistema, sobre o(a) bibliotecário(a) são:

			1. ID (Identificador Único no sistema);
			2. Nome;
			3. E-mail.

- Todos os cadastros são realizados pelo(a) Bibliotecário(a);
- Todas as informações dos(as) Usuários(as) são guardadas em um banco de dados;
- O(a) Bibliotecário(a) tem acesso à informação de todos os usuários e a permissão de alterá-los quando necessário;
- Os(as) Alunos(as) e Professores(as) terão acesso somente a suas respectivas informações, através da plataforma Web e informando matrícula e senha;
- O(a) Bibliotecário(a) poderão ter acesso ao sistema informando somente o seus  respectivos códigos, na aplicação Desktop.

### Livros

- O sistema gerencia os livros contidos na biblioteca, catalogando-os ou excluindo-os dos registros. 

  + O(a) Biliotecário(a) cadastra os livros na biblioteca.

  + Para catalogar os livros o(a) Bibliotecário(a) insere as seguintes informações no sistema:  

	+ Título do livro;
	+ Autores do livro;
	+ Editora(s) do livro;
	+ Gênero do livro.

  (Essas informações serão utilizadas na elaboração dos bancos de dados do sistema);

- Os livros, após cadastrados no sistema, possuirão suas informações parcialmente disponibilizadas aos(às) Alunos(as) e Professores(as), através da plataforma Web, sendo elas:

	+ Se o livro está emprestado ou não;
	+ Título do livro;
	+ Autores do livro;
	+ Editora(s) do livro;
	+ Gênero do livro.

- Caso a data de entrega esteja próxima de chegar, será enviado um e-mail para lembrá-lo(a) da devolução do livro.

- Os(as) Alunos(as) poderão colocar até 8 livros na lista de desejo (caso estejam emprestados). E ao fazer isso, serão notificadas quando o livro estiver disponível;

* Esta lista estará disponível apenas ao(à) Bibliotecário(a), na parte Desktop do Sistema.

- Alunos(as) e Professores(as) colocados(as) na Lista Negra (por terem furtado algum livro ou terem causado alguma outra perturbação que venha a prejudicar o sistema de gerenciamento da biblioteca) serão impedidos(as) de acessar o sistema até serem retirados(as) da lista.

- O sistema irá fazer recomendações de leitura aos(às) Usuários(as) baseados nos gêneros lidos recentementes.

- O sistema enviará um e-mail aos(às) Alunos(as) e Professores(as) quando um novo livro for catalogado.
