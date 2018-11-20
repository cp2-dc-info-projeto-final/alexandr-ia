<?php

  require_once('../Modelo/CriaConexao.php');
  require_once('../Modelo/TabelaEmprestimo.php');
  require_once('../Modelo/TabelaLivros.php');
  require_once('../Modelo/TabelaUsuários.php');

  $request = array_map("trim", $_REQUEST);
  $request = filter_var_array($request, [

    'email_usuario' => FILTER_VALIDATE_EMAIL,
    'classificacao_livro' => FILTER_DEFAULT,
    'id_bibliotecario' => FILTER_VALIDATE_INT

  ]);

  $erros = [];

  if ($request['email_usuario'] == false){

    $erros[] = "Campo e-mail inexistente ou inválido";

  } else if( MesmoEmail($request['email_usuario']) == 0 ) {

    $erros[] = "O e-mail informado não está cadastrado no sistema";

  }

  if ($request['classificacao_livro'] == false){

    $erros[] = "Campo classificação do livro inexistente ou inválido";

  } else if( MesmaClassificacao($request['classificacao_livro']) == 0 ){

    $erros[] = "Não existe livro com a classificação informada";

  }

  if ($request['id_bibliotecario'] == false){

    $erros[] = "Id do bibliotecário inexistente ou inválido";

  }

  if( empty($erros) == false){

    foreach ($erros as $erro){

  		$text = $text.' | '.$erro;
  		header('Location: pagEmprestimo.php?erros='.urlencode($text));
  	}

  } else {

    $email_usuario = $request['email_usuario'];
    $classificacao_livro = $request['classificacao_livro'];
    $id_bibliotecario = $request['id_bibliotecario'];

    $mensagem = '';

    $infos_usuario = InfosUsuario($email_usuario);
    $id_usuario = $infos_usuario['id'];

    $id_livro = IdPorClassificacao($classificacao_livro);

    $diferencial = VerificaStatusEmprestimo($id_usuario, $id_livro);

    if($infos_usuario['status'] == 1){

      $mensagem = 'Este usuário está excluído do sistema, portanto não pode realizar empréstimos';

    } else if ($infos_usuario['banido'] == 1) {

      $mensagem = 'Este usuário está suspenso, portanto não pode realizar empréstimos';

    } else if($diferencial == 0){

      $mensagem = Empresta($id_usuario, $id_bibliotecario, $id_livro);

      if ($mensagem == 'Empréstimo registrado, retire o livro na biblioteca em até 48 Horas'){

        $id_emprestimo = ProcuraIdEmprestimo($id_usuario, $id_livro);
        Retirar($id_emprestimo, $id_bibliotecario);
        $mensagem = 'Empréstimo feito com sucesso';

      } else if ($mensagem == 'ERRO: <br> Você não pode pegar emprestado mais de 2 livros'){

        $mensagem = 'Não é possível realizar o empréstimo pois este aluno já possui 2 livros no momento';

      }


    } else {

      if (VerificaRetirado($id_usuario, $id_livro) == 1){

        $mensagem = 'Este item já está emprestado a este usuário';

      } else {

        Retirar($id_emprestimo, $id_bibliotecario);
        $mensagem = 'Empréstimo feito com sucesso';

      }

    }

    header('Location: pagEmprestimo.php?mensagem='.urlencode($mensagem));

  }

?>
