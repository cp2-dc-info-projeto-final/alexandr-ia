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



## CDU 00 - Gerenciamento do Acervo (dos livros)

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado.

**Fluxo Principal:**

  1. Usuário preencherá um formulário
