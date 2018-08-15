# Especificação de Casos de Uso

## Sumário

## CDU 01 - Cadastro de Alunos e Professores

**Atores:** Alunos e Professores

**Pré-Condições:** Ser aluno ou professor do Cólegio Pedro II, Campus Duque de Caxias.

**Fluxo Principal:**

  1. Usuário informa Matrícula, Nome, E-mail e Senha.
  2. Sistema verifica se a matrícula é válida.
    - Se a Matrícula não for válida o sistema retorna um erro.
    - Se a Matrícula for válida o sistema cadastra o Usuário como Aluno/Professor.

## CDU 02 - Cadastro de Bibliotecários

**Atores:** Bibliotecários

**Pré-Condições:** Ser funcionário da biblioteca do Cólegio Pedro II, Campus Duque de Caxias.

**Fluxo Principal:**

  1. Usuário informa Matrícula, Nome, E-mail e Senha.
  2. Sistema verifica se a matrícula é válida.
    - Se a Matrícula não for válida o sistema retorna um erro.
    - Se a Matrícula for válida o sistema cadastra o Usuário como Bibliotecário.

## CDU 03 - Login

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Ser cadastrado no sistema

**Fluxo Principal:**

  1. Usuário informa e-mail ou matrícula e senha.
    - Se os dados informados estiverem de acordo com os registrados no sistema, o usuário recebe permissão de acesso de acordo com o cadastro
      * Bibliotecários recebem as permissões de acesso de Biliotecário.
      * Alunos e Professores recebem as permissões de acesso de Alunos e Professores.

  2. Caso o Usuário tenha esquecido sua senha, ele será redirecionado para a página de Recuperação de Senha.

## CDU 00 - Recuperação de Senha

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Ser cadastrado no sistema

**Fluxo Principal:**

  1. Usuário informa e-mail
  2. Sistema envia um link de redefinição de senha para o e-mail informado.
  3. O link enviado, quando for acessado, redirecionará o usuário para a Página de definição de Nova Senha.

## CDU 00 - Página de definição de Nova Senha

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Ser cadastrado no sistema

**Fluxo Principal:**

  1. Usuário insere nova senha e a confirma
  2. Sistema redefine o cadastro do usuário, trocando a velha senha pela nova senha.

## CDU 00 - Gerenciamento de Cadastros

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado

**Fluxo Principal:**

  1. Sistema disponibiliza as informações dos Alunos e Professores (exceto a senha), não podendo alterá-las

## CDU 00 - Página Inicial

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Estar logado no sistema

**Fluxo Principal:**

    1. O sistema permite:
      - Navegação entre as várias outras partes do website
      - Busca por livros
        * O usuário insere um parâmetro de busca (título, autor(a), gênero, etc.) e o sistema redireciona para a página de livros.

    2. Exibe os livros adcionados recentemente e os mais lidos
    3. Exibe um resumo do perfil do usuário, juntamente às recomendações de leitura

## CDU 00 - Página de Listagem de Livros

**Atores:** Alunos, Professores e Bibliotecários

**Pré-Condições:** Estar logado

**Fluxo Principal:**

  1. Sistema exibe uma listagem de livros baseado na pesquisa do Usuário
    * Caso não haja pesquisa, o sistema não exibe quaisquer resultados

  2. Caso o usuário selecione um livro, será redirecionado para a Página do Livro (de acordo com sua hierarquia de cadastro).

## CDU 00 - Página do Livro para Alunos e Professores

**Atores:** Alunos e Professores

**Pré-Condições:** Ser cadastrado no sistema como Aluno ou Professor e estar logado no sistema

**Fluxo Principal:**

  1. Sistema disponibiliza mais detalhes do livro selecionado
    - Dentre os detelhes, há o de se o livro está ou não disponível
      * Caso esteja disponível, o usuário poderá reservar o livro
      * Caso não esteja disponível, o usuário poderá adcionar o livro à lista de desejos

## CDU 00 - Página do Livro para Bibliotecários

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. Sistema disponibiliza mais detalhes do livro selecionado
    - Há a possibilidade de excluir o livro do acervo
    - Caso o usuário queira editar as informações de um livro, ele será redirecionado para a página de Edição de Informações dos Livros

## CDU 00 - Página de Edição de Informações dos Livros

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. Usuário informa as alterações que deverão ser feitas nos campos que exibem as informações do livro
  2. Sistema atualiza as informações do livro a partir das mudanças feitas pelo usuário

## CDU 00 - Gerenciamento do Acervo (dos livros)

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado.

**Fluxo Principal:**

  1. Usuário preencherá um formulário contendo as informações do livro a ser adcionados
  2. Sistema adcionará o novo livro à coleção de livros, com as informações dadas pelo usuário

## CDU 00 - Gerenciamento de Empréstimos

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado.

**Fluxo Principal:**

  1. Usuário informa ao sistema se o livro reservado foi retirado ou não
    * No caso de reservas feitas anteriormente, com quantidade superior aos livros disponíveis, se a quantidade de livros retirados for igual a quantidade existente no acervo, a reserva irá para a lista de desejos.

## CDU 00 - Perfil de Alunos e Professores

**Atores:** Alunos e Professores

**Pré-Condições:** Ser cadastrado no sistema como Aluno ou Professor e estar logado no sistema

**Fluxo Principal:**

  1. Sistema exibe as informações do Aluno/Professor, com a possiblidade da edição das informações pelo mesmo.
  2. Caso o usuário tenha retirado um livro na biblioteca e ele não esteja em uma lista de desejos, ele poderá pedir, até 2 vezes, adiamento da devolução do livro.
    * Estando o livro numa lista de desejos, o pedido de adiamento não será aceito.
  3. Sistema mostra as recomendações de leitura baseadas nas informações do usuário.
  4. As informações do Usuário poderão ser vizualizadas a qualquer momento pelo bibliotecário.

## CDU 00 - Perfil de Bibliotecários

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. Sistema exibe as informações do Bibliotecário, com a possiblidade da edição das informações pelo mesmo.

## CDU 00 - Lista Negra

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. O bibliotecário pode colocar ou tirar Alunos/Professores da lista, que poderá ser acessada e alterada através do próprio perfil do bibliotecário
