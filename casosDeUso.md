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


## CDU 04 - Gerenciamento de Cadastros

**Atores:** Bibliotecários

**Pré-Condições:** Ser cadastrado no sistema como Bibliotecário e estar logado.

**Fluxo Principal:**

  1. Usuário tem acesso às informações dos Alunos e Professores (exceto a senha), não podendo alterá-las
