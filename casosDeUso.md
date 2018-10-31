# Especificação de Casos de Uso

## Sumário

- [CDU 01 - Cadastro de Alunos e Professores](#cdu-01---cadastro-de-alunos-e-professores)
- [CDU 02 - Cadastro de Bibliotecários](#cdu-02---cadastro-de-bibliotecários)
- [CDU 03 - Login](#cdu-03---login)
- [CDU 04 - Recuperação de Senha](#cdu-04---recuperação-de-senha)
- [CDU 05 - Página de definição de Nova Senha](#cdu-05---página-de-definição-de-nova-senha)
- [CDU 06 - Gerenciamento de Cadastros](#cdu-06---gerenciamento-de-cadastros)
- [CDU 07 - Pesquisa por Livros](#cdu-07---pesquisa-por-livros)
- [CDU 08 - Detalhes do Livro para Alunos e Professores](#cdu-08---detalhes-do-livro-para-alunos-e-professores)
- [CDU 09 - Detalhes do Livro para Bibliotecários](#cdu-09---detalhes-do-livro-para-bibliotecários)
- [CDU 10 - Página de Edição de Informações dos Livros](#cdu-10---página-de-edição-de-informações-dos-livros)
- [CDU 11 - Gerenciamento do Acervo (dos livros)](#cdu-11---gerenciamento-do-acervo-(dos-livros))
- [CDU 12 - Gerenciamento de Empréstimos](#cdu-12---gerenciamento-de-empréstimos)
- [CDU 13 - Atualização de Perfil de Alunos e Professores](#cdu-13---atualização-de-perfil-de-alunos-e-professores)
- [CDU 14 - Atualização de Perfil de Bibliotecários](#cdu-14---atualização-de-perfil-de-bibliotecários)
- [CDU 15 - Lista Negra](#cdu-15---lista-negra)

## CDU 01 - Cadastro de Alunos e Professores

**Atores:** Alunos e Professores

**Pré-Condições:** Ser aluno ou professor do Cólegio Pedro II, Campus Duque de Caxias.

**Fluxo Principal:**

  1. Usuário informa Matrícula, Nome, Telefone, Turma, E-mail e Senha.
  2. Sistema verifica se o e-mail é válido
    - Se o e-mail já estiver cadastrado no sistema, ele retorna um erro.
    - Se o e-mail for válido o sistema cadastra o Usuário como Aluno/Professor.
    - O usuário se cadastra pela internet, através da página de Login.

## CDU 02 - Cadastro de Bibliotecários

**Atores:** Bibliotecários

**Pré-Condições:** Ser funcionário da biblioteca do Cólegio Pedro II, Campus Duque de Caxias.

**Fluxo Principal:**

  1. Usuário informa Matrícula, Nome, Telefone, Turma, E-mail e Senha.
  2. Sistema verifica se a o e-mail é válido
    - Se o e-mail já estiver cadastrado no sistema, ele retorna um erro.
    - Se o e-mail for válido o sistema cadastra o Usuário como Bibliotecário.
    - Somente Bibliotecário cadastra outro bibliotecário.

## CDU 03 - Login

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Ser cadastrado no sistema

**Fluxo Principal:**

  1. Usuário informa e-mail e senha.
    - Se os dados informados estiverem de acordo com os registrados no sistema, o usuário recebe permissão de acesso de acordo com o cadastro, indo para a tela inicial das respectivas permissão
      * Bibliotecários recebem as permissões de acesso de Biliotecário.
      * Alunos e Professores recebem as permissões de acesso de Alunos e Professores.

  2. Caso o Usuário tenha esquecido sua senha, será redirecionado para a página de Recuperação através do email informado <!>

## CDU 04 - Recuperação ou Alterar de Senha

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Ser cadastrado no sistema

**Fluxo Principal:**

  1. Recuperação de Senha
    - Usuário informa e-mail
    - Sistema envia um link de redefinição de senha para o e-mail informado.
    - O link enviado, quando for acessado, redirecionará o usuário para a Página de definição de Nova Senha.

  2. Alterar de Senha
    - Usuário, na pagina de perfil, pode trocar a senha.
    - Sistema redirecionará o usuário para a Página de definição de Nova Senha.

## CDU 05 - Página de definição de Nova Senha

**Atores:** Alunos, Professores e Biliotecários

**Pré-Condições:** Ser cadastrado no sistema

**Fluxo Principal:**

  1. Usuário insere nova senha e a confirma
  2. Sistema redefine o cadastro do usuário, trocando a velha senha pela nova senha.

## CDU 06 - Gerenciamento de Cadastros

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado

**Fluxo Principal:**

  1. Sistema disponibiliza as informações dos Alunos e Professores (exceto a senha), não podendo alterá-las

## CDU 07 - Pesquisa por Livros

**Atores:** Alunos, Professores e Bibliotecários

**Pré-Condições:** Ser cadastrado e estar logado

**Fluxo Principal:**

  1. Sistema exibe uma listagem de livros baseado na pesquisa do Usuário, que pode ser feita pelo título, editora ou autor.
    * Caso não haja pesquisa, o sistema não exibe quaisquer resultados

  2. Caso o usuário selecione um livro, será redirecionado para a Página do Livro (de acordo com sua hierarquia de cadastro).

  3. O Usuário pode filtar a pesquisa pelo tipo de suporte do livro.

## CDU 08 - Detalhes do Livro para Alunos e Professores

**Atores:** Alunos e Professores

**Pré-Condições:** Ser cadastrado no sistema como Aluno ou Professor e estar logado no sistema

**Fluxo Principal:**

  1. Sistema disponibiliza mais detalhes do livro selecionado
    - Dentre os detalhes, há o de se o livro está ou não disponível
      * Caso esteja disponível, o usuário poderá reservar o livro
      * Caso não esteja disponível, o usuário poderá adcionar o livro à lista de desejos

## CDU 09 - Detalhes do Livro para Bibliotecários

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. Sistema disponibiliza todos os detalhes do livro selecionado
    - Há a possibilidade de excluir o livro do acervo
    - Caso o usuário queira editar as informações de um livro, ele será redirecionado para a página de Edição de Informações dos Livros

## CDU 10 - Página de Edição de Informações dos Livros

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. Usuário informa as alterações que deverão ser feitas nos campos que exibem as informações do livro
  2. Sistema atualiza as informações do livro a partir das mudanças feitas pelo usuário

## CDU 11 - Gerenciamento do Acervo (dos livros)

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado.

**Fluxo Principal:**

  1. Usuário preencherá um formulário contendo as informações do livro a ser adcionados
  2. Sistema adcionará o novo livro à coleção de livros, com as informações dadas pelo usuário

## CDU 12 - Gerenciamento de Empréstimos

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado.

**Fluxo Principal:**

  1. Usuário informa ao sistema se o livro reservado foi retirado ou não
    * No caso de reservas feitas anteriormente, com quantidade superior aos livros disponíveis, se a quantidade de livros retirados for igual a quantidade existente no acervo, a reserva irá para a lista de desejos.

## CDU 13 - Atualização de Perfil de Alunos e Professores

**Atores:** Alunos e Professores

**Pré-Condições:** Ser cadastrado no sistema como Aluno ou Professor e estar logado no sistema

**Fluxo Principal:**

  1. Sistema exibe as informações do Aluno/Professor, com a possiblidade da edição das informações pelo mesmo.
  2. Caso o usuário tenha retirado um livro na biblioteca e ele não esteja em uma lista de desejos, ele poderá pedir, até 2 vezes, adiamento da devolução do livro.
    * Estando o livro numa lista de desejos, o pedido de adiamento não será aceito.
  3. Sistema disponibiliza um botão novidade, que mostra ao usuário um livro aleatoriamente.
  4. As informações desse Usuário poderão ser vizualizadas a qualquer momento pelo bibliotecário, sem poder ser alterados por estes.
  5. Sistema exibe os livros pegos emprestados por aquele Aluno/Professor.

## CDU 14 - Atualização de Perfil de Bibliotecários

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. Sistema exibe as informações do Bibliotecário, com a possiblidade da edição das informações pelo mesmo.
  2. Sistema mostra um painel de controle da biblioteca virtual:
    - Inserir Novo Livro
    - Cadastrar Novo Bibliotecário
    - Gerencias Liste de Usuários "Banidos"
    - Listar Usuários
    - Emprestar  Livros
    - Ver Emprestimos

## CDU 15 - Lista Negra

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado no sistema

**Fluxo Principal:**

  1. O bibliotecário pode colocar ou tirar Alunos/Professores da lista, que poderá ser acessada e alterada através do próprio perfil do bibliotecário
