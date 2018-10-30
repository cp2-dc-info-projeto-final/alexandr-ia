<?php

  function Reserva($id_usuario, $id_livro) {

    $bd = CriaConexãoBd();

    /* $sql = $bd -> prepare('INSERT INTO emprestimo(aluno_prof,	bibliotecario,	livro,	retirado,	_data,	horario)
                          VALUES (:id_usuario, :id_bibliotecario, :id_livro, FALSE, NULL, NULL);

    ');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_bibliotecario', $id_bibliotecario);
    $sql -> bindValue(':id_livro', $id_livro); */

    $sql = $bd -> prepare('SELECT reserva.id, emprestimo.id FROM Reserva
                           JOIN Emprestimo ON emprestimo.aluno_prof = reserva.aluno_prof
                           WHERE reserva.aluno_prof = :id_usuario AND emprestimo.aluno_prof = :id_usuario');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> execute();

    $linhas =  $sql -> rowCount();
    $mensagem = '';

    $sql = NULL;
    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT reserva.id, emprestimo.id FROM reserva
                           JOIN Emprestimo ON emprestimo.aluno_prof = reserva.aluno_prof
                           WHERE reserva.aluno_prof = :id_usuario AND emprestimo.aluno_prof = :id_usuario
                           AND reserva.livro = :id_livro OR emprestimo.livro = :id_livro');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_livro', $id_livro);

    $sql -> execute();

    $retorno = $sql -> rowCount();

    if($linhas < 2 AND $retorno == 0){

      $sql = $bd -> prepare('INSERT INTO reserva(aluno_prof,	livro) VALUES (:id_usuario, :id_livro);');
      $sql -> bindValue('id_usuario', $id_usuario);
      $sql -> bindValue('id_livro', $id_livro);

      $sql -> execute();

      $mensagem = 'Reserva feita com sucesso';

    } else if ($linhas >= 2){

      $mensagem = 'Você só pode reservar/pegar emprestado, no máximo, 2 itens';

    } else if($retorno != 0){

      $mensagem = 'Você não pode reservar o mesmo item novamente';

    }

    return($mensagem);

  }

  function Empresta($id_usuario, $id_bibliotecario, $id_livro) {

    $bd = CriaConexãoBd();
    $erro = '';

    date_default_timezone_set ('America/Sao_Paulo');
    $data = date('Y-m-d');
    $horario = date('H:i:s');

    $sql = $bd -> prepare('SELECT aluno_prof, livro FROM emprestimo WHERE aluno_prof = :id_usuario AND livro = :id_livro');
    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_livro', $id_livro);

    $sql -> execute();

    $retorno = $sql -> rowCount();

    $bd = CriaConexãoBd();
    $sql = $bd -> prepare('SELECT reserva.id, emprestimo.id FROM Reserva
                           JOIN Emprestimo ON emprestimo.aluno_prof = reserva.aluno_prof
                           WHERE reserva.aluno_prof = :id_usuario AND emprestimo.aluno_prof = :id_usuario');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> execute();

    $linhas =  $sql -> rowCount();

    if($retorno == 0 AND $linhas < 2){

      $bd = CriaConexãoBd();
      $sql = NULL;

      $sql = $bd -> prepare('INSERT INTO emprestimo(aluno_prof,	bibliotecario,	livro,	retirado,	_data,	horario)
                            VALUES (:id_usuario, :id_bibliotecario, :id_livro, TRUE, :_data, :horario);

      ');

      $sql -> bindValue(':id_usuario', $id_usuario);
      $sql -> bindValue(':id_bibliotecario', $id_bibliotecario);
      $sql -> bindValue(':id_livro', $id_livro);
      $sql -> bindValue(':_data', $data);
      $sql -> bindValue(':horario', $horario);

      $sql -> execute();

      $erro = 'Empréstimo registrado, retire o livro na biblioteca em até 48 Horas';
      return($erro);

    } else {

      if($linhas >= 2){

        $erro = 'ERRO: <br> Você não pode pegar emprestado mais de 2 livros';
        return($erro);

      }

      if($retorno != 0){

        $erro = 'ERRO: <br> Este livro já está emprestado a este usuário';
        return($erro);

      }

    }

    // return($erro);

  }

  function Retirar($id_emprestimo){

    $bd = CriaConexãoBd();

    date_default_timezone_set ('America/Sao_Paulo');
    $data = date('d-m-Y');
    $horario = date('H:i:s');

    $sql = $bd -> preapre('UPDATE emprestimo SET retirado = TRUE, _data = :_data, horario = :horario');

    $sql -> bindValue(':_data', $data);
    $sql -> bindValue(':horario', $horario);

  }

  function ExemplaresDisponiveis($id_livro){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT retirado FROM emprestimo WHERE livro = :id_livro AND retirado = TRUE;');

    $sql -> bindValue('id_livro', $id_livro);
    $sql -> execute();

    $emprestados = 0;
    $emprestados = $sql -> rowCount();

    $sql = NULL;
    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT exemplar FROM livro WHERE id = :id_livro');

    $sql -> bindValue('id_livro', $id_livro);
    $sql -> execute();

    $sql = $sql -> fetch();

    $total = 0;
    $total = $sql['exemplar'];

    $qtd_disponivel = $total - $emprestados;

    return($qtd_disponivel);

  }

  function ListaEmprestimos(){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT emprestimo.*, usuario.nome, usuario.email, livro.classificacao, livro.titulo FROM emprestimo
                          JOIN usuario
                          ON emprestimo.aluno_prof = usuario.id
                          JOIN livro
                          ON emprestimo.livro = livro.id');

    $sql -> execute();
    $sql = $sql -> fetchAll();

    return($sql);

  }

  function ListaReservas(){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT reserva.*, usuario.nome, usuario.email, livro.classificacao, livro.titulo FROM reserva
                          JOIN usuario
                          ON reserva.aluno_prof = usuario.id
                          JOIN livro
                          ON reserva.livro = livro.id');

    $sql -> execute();
    $sql = $sql -> fetchAll();

    return($sql);

  }

  function ListaReservasPorId($idUsuario){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT reserva.*, usuario.nome, usuario.email, livro.classificacao, livro.titulo FROM reserva
                          JOIN usuario
                          ON reserva.aluno_prof = usuario.id
                          JOIN livro
                          ON reserva.livro = livro.id
                          WHERE aluno_prof = :idUsuario');

    $sql -> bindValue('idUsuario', $idUsuario);

    $sql -> execute();
    $sql = $sql -> fetchAll();

    return($sql);

  }

  function ListaEmprestimosPorId($idUsuario){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT emprestimo.*, usuario.nome, usuario.email, livro.classificacao, livro.titulo FROM emprestimo
                          JOIN usuario
                          ON emprestimo.aluno_prof = usuario.id
                          JOIN livro
                          ON emprestimo.livro = livro.id
                          WHERE aluno_prof = :idUsuario ');

    $sql -> bindValue('idUsuario', $idUsuario);

    $sql -> execute();
    $sql = $sql -> fetchAll();

    return($sql);

  }

  function CancelaReserva($id_reserva){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('DELETE FROM reserva WHERE id = :id_reserva');

    $sql -> bindValue(':id_reserva', $id_reserva);
    $sql -> execute();

  }

?>
