# Projeto Final
## Biblioteca

##Proposta de viabilidade sobre TCC (Trabalho de Conclusão de Curso)
 
### VISÃO GERAL
O projeto consiste em computadorizar o sistema de empréstimo de livros da biblioteca do Colégio Pedro II, visando facilitar a organização e manutenção do sistema.
 
### OBJETIVOS   
- Catalogar os livros e excluí-los; 
- Cadastrar alunos/professores e excluir ex-alunos/professores;
- Gerenciar os empréstimos dos livros;
- Definir prazos de entrega dos livros e prorrogações;
- Permitir ao bibliotecário controlar o sistema.
 
### ESPECIFICAÇÕES
1. O acesso ao sistema seria dado de acordo com a matrícula do aluno/professor ou o código do bibliotecário, dependendo de quem for o utilizador;
 
    a. Os diferentes utilizadores possuem níveis de acesso ao sistema diferentes e cada um deles possuem seu perfil e ninguém além dos bibliotecários podem acessar o perfil dos alunos e professores cadastrados no sistema ;
	
	b. Alunos: Matricula, nome, ano cursado no colégio, email e senha (própria);
	
	c. Professores: Matricula, nome, disciplina, email e senha (própria);
	
	d. Bibliotecário: Id, nome, email e senha (própria);
	
2. O bibliotecário tem acesso a todas as informações dos alunos e dos livros, tanto se está emprestado ou não e com quem; 

3. O aluno/professor tem acesso a  informações parciais dos livros, mas não a quem está emprestado, caso esteja emprestado mostra que está indisponível no momento. O aluno/professor recebe notificações por email caso esteja próximo da data de entrega do livro emprestado. Ele também pode colocar o livro em uma lista de desejos, onde receberá notificações por email caso o livro esteja disponível.

	a. Caso algum aluno/professor tenha furtado algum livro, ele será cortado e será impedido de acessar o sistema de empréstimos dos livros.
	
4. O aluno/professor também pode solicitar o adiamento da data de entrega do livro ao bibliotecário.

5. Os livros serão catalogados de acordo com o acervo disponível na biblioteca do campus. Caso algum livro tenha sido danificado ao ponto de não poder ser mais utilizado pela biblioteca, o bibliotecário tem a opção de excluir o livro do acervo até que possam colocar outro no lugar e sendo assim, necessário recadastra-lo. Existindo também a possibilidade de cadastrar novos livros, adicionando-os ao sistema, neste processo os alunos cadastrados recebem um email sobre o novo livro do acervo da biblioteca.

6. O aluno/professor receberá sugestões de leitura baseados em seu histórico de empréstimos de livros.