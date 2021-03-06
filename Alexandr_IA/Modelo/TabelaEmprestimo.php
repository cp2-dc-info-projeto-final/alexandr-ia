<?php

  function Reserva($id_usuario, $id_livro) {

    $bd = CriaConexãoBd();

    /* $sql = $bd -> prepare('INSERT INTO emprestimo(aluno_prof,	bibliotecario,	livro,	retirado,	_data,	horario)
                          VALUES (:id_usuario, :id_bibliotecario, :id_livro, FALSE, NULL, NULL);

    ');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_bibliotecario', $id_bibliotecario);
    $sql -> bindValue(':id_livro', $id_livro); */

    $sql = $bd -> prepare('SELECT reserva.id FROM reserva WHERE reserva.aluno_prof = :id_usuario');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> execute();

    $linhas =  $sql -> rowCount();
    $mensagem = '';

    $sql = NULL;
    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT emprestimo.id FROM emprestimo WHERE emprestimo.aluno_prof = :id_usuario AND emprestimo.livro = :id_livro AND _data_devolucao IS NULL');

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

      $mensagem = 'Você só pode reservar, no máximo, 2 itens';

    } else if($retorno != 0){

      $mensagem = 'Você não pode reservar um item já emprestado a você';

    }

    return($mensagem);

  }

  function ExemplaresDisponiveis($id_livro){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT id FROM emprestimo WHERE livro = :id_livro AND _data_devolucao IS NULL;');

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

  function Empresta($id_usuario, $id_bibliotecario, $id_livro) {

    $bd = CriaConexãoBd();
    $erro = '';

    date_default_timezone_set ('America/Sao_Paulo');
    $data = date('Y-m-d');
    $horario = date('H:i:s');

    $sql = $bd -> prepare('SELECT aluno_prof, livro FROM emprestimo WHERE aluno_prof = :id_usuario AND livro = :id_livro AND _data_devolucao IS NULL');
    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_livro', $id_livro);

    $sql -> execute();

    $retorno = $sql -> rowCount();

    $qtd_disponivel = ExemplaresDisponiveis($id_livro);

    $bd = CriaConexãoBd();
    $sql = $bd -> prepare('SELECT emprestimo.id FROM emprestimo WHERE emprestimo.aluno_prof = :id_usuario AND _data_devolucao IS NULL');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> execute();

    // $linhas_emprestimo = $sql -> rowCount();
    $linhas = $sql -> rowCount();

    /* $bd = CriaConexãoBd();
    $sql = $bd -> prepare('SELECT reserva.id FROM reserva WHERE reserva.aluno_prof = :id_usuario');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> execute();

    $linhas_reserva = $sql -> rowCount();

    $linhas = $linhas_reserva + $linhas_emprestimo; */

    if($retorno == 0 AND $linhas < 2 AND $qtd_disponivel > 0){

      $bd = CriaConexãoBd();
      $sql = NULL;

      $data_prevista_s = strtotime('+2 day', strtotime($data));
      $data_prevista = date('Y-m-d', $data_prevista_s);

      $horario_previsto = '00:00:00';

      if($id_bibliotecario == NULL){

        $horario_previsto = $horario;

      }

      $sql = $bd -> prepare('INSERT INTO emprestimo(aluno_prof,	bibliotecario,	livro,	retirado,	_data_emprestimo,	horario_emprestimo, _data_devolucao, horario_devolucao, _data_prazo, horario_prazo)
                            VALUES (:id_usuario, :id_bibliotecario, :id_livro, FALSE, :_data_emprestimo, :horario_emprestimo, NULL, NULL, :_data_prazo, :horario_prazo);

      ');

      $sql -> bindValue(':id_usuario', $id_usuario);
      $sql -> bindValue(':id_bibliotecario', $id_bibliotecario);
      $sql -> bindValue(':id_livro', $id_livro);
      $sql -> bindValue(':_data_emprestimo', $data);
      $sql -> bindValue(':horario_emprestimo', $horario);
      $sql -> bindValue(':_data_prazo', $data_prevista);
      $sql -> bindValue(':horario_prazo', $horario_previsto);

      $sql -> execute();

      $consulta = $bd -> prepare('SELECT * FROM reserva WHERE aluno_prof = :id_usuario AND livro = :id_livro');
      $consulta -> bindValue(':id_usuario', $id_usuario);
      $consulta -> bindValue(':id_livro', $id_livro);

      $consulta -> execute();

      if( $consulta->rowCount() == 1 ){

        $bd = CriaConexãoBd();
        $sql = NULL;

        $sql = $bd -> prepare('DELETE FROM reserva WHERE aluno_prof = :id_usuario AND livro = :id_livro');
        $sql -> bindValue(':id_usuario', $id_usuario);
        $sql -> bindValue(':id_livro', $id_livro);

        $sql -> execute();

      }

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

      if($qtd_disponivel <= 0){

        $erro = 'ERRO: <br> Não há mais exemplares disponíveis deste livro para empréstimo';
        return($erro);

      }

    }

    // return($erro);

  }

  function Retirar($id_emprestimo, $id_bibliotecario){

    $bd = CriaConexãoBd();

    date_default_timezone_set ('America/Sao_Paulo');
    $data = date('Y-m-d');
    $horario = date('H:i:s');

    $data_prazo = strtotime('+7 day', strtotime($data));
    $data_prazo = date('Y-m-d', $data_prazo);

    $sql = $bd -> prepare('UPDATE emprestimo SET retirado = TRUE, _data_emprestimo = :_data, horario_emprestimo = :horario, _data_prazo = :_data_prazo, horario_prazo = :horario_prazo, bibliotecario = :id_bibliotecario WHERE id = :id_emprestimo');

    $sql -> bindValue(':_data', $data);
    $sql -> bindValue(':horario', $horario);
    $sql -> bindValue(':_data_prazo', $data_prazo);
    $sql -> bindValue(':horario_prazo', '18:00:00');
    $sql -> bindValue(':id_bibliotecario', $id_bibliotecario);
    $sql -> bindValue(':id_emprestimo', $id_emprestimo);

    $sql -> execute();

  }

  function Devolve($id_usuario, $id_bibliotecario, $id_livro){

    $bd = CriaConexãoBd();

    date_default_timezone_set ('America/Sao_Paulo');
    $data = date('Y-m-d');
    $horario = date('H:i:s');

    if( VerificaStatusEmprestimo($id_usuario, $id_livro) == 1){

      $id_emprestimo = ProcuraIdEmprestimo($id_usuario, $id_livro);

      $sql = $bd -> prepare('UPDATE emprestimo SET _data_devolucao = :_data_devolucao, horario_devolucao = :horario_devolucao, retirado = FALSE WHERE id = :id_emprestimo');

      $sql -> bindValue(':_data_devolucao', $data);
      $sql -> bindValue(':horario_devolucao', $horario);
      $sql -> bindValue(':id_emprestimo', $id_emprestimo);

      $sql -> execute();

      return('Item devolvido com sucesso');

    } else {

      return('Este usuário não está com este item emprestado');

    }

  }

  function RenovaEmprestimo($id_usuario, $id_bibliotecario, $id_livro){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT id FROM emprestimo WHERE aluno_prof = :id_usuario AND bibliotecario = :id_bibliotecario AND livro = :id_livro AND _data_devolucao IS NULL');
    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_bibliotecario', $id_bibliotecario);
    $sql -> bindValue(':id_livro', $id_livro);

    $sql -> execute();
    $sql = $sql -> fetch();
    $id_emprestimo = $sql['id'];

    if(VerificaStatusEmprestimo($id_usuario, $id_livro) == 1){

      $sql = $bd -> prepare('SELECT emprestimo._data_prazo FROM emprestimo WHERE id = :id_emprestimo');
      $sql -> bindValue(':id_emprestimo', $id_emprestimo);

      $sql -> execute();
      $sql = $sql -> fetch();

      $data = $sql['_data_prazo'];
      $data = strtotime('+7 day', strtotime($data));
      $data = date('Y-m-d', $data);

      $sql = $bd -> prepare('UPDATE emprestimo SET _data_prazo = :data WHERE id = :id_emprestimo');
      $sql -> bindValue(':data', $data);
      $sql -> bindValue(':id_emprestimo', $id_emprestimo);

      $sql -> execute();

      return("Empréstimo renovado");

    } else {

      return('Este empréstimo não está em aberto ou não existe');

    }

  }

  function ListaEmprestimos(){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT emprestimo.*, usuario.nome, usuario.email, livro.classificacao, livro.titulo FROM emprestimo
                          JOIN usuario
                          ON emprestimo.aluno_prof = usuario.id
                          JOIN livro
                          ON emprestimo.livro = livro.id
                          ORDER BY usuario.nome');

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
                          ON reserva.livro = livro.id
                          ORDER BY livro.titulo');

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

    $sql = $bd -> prepare('SELECT emprestimo.*, usuario.nome, usuario.email, livro.classificacao, livro.titulo, livro.id AS id_livro FROM emprestimo
                          JOIN usuario
                          ON emprestimo.aluno_prof = usuario.id
                          JOIN livro
                          ON emprestimo.livro = livro.id
                          WHERE aluno_prof = :idUsuario AND _data_devolucao IS NULL');

    $sql -> bindValue('idUsuario', $idUsuario);

    $sql -> execute();
    $sql = $sql -> fetchAll();

    return($sql);

  }

  function VerificaStatusEmprestimo($id_usuario, $id_livro){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT * FROM emprestimo WHERE aluno_prof = :id_usuario AND livro = :id_livro AND _data_devolucao IS NULL');

    $sql -> bindValue('id_usuario', $id_usuario);
    $sql -> bindValue('id_livro', $id_livro);

    $sql -> execute();

    if( $sql->rowCount() == 0 ){

      return(0);
      // O empréstimo não existe

    } else {

      return(1);
      // O empréstimo existe

    }

  }

  function TempoLimite($id_emprestimo){

    $bd = CriaConexãoBd();

    $dataHora = new DateTime('now',/*'2018-11-21',*/ new DateTimeZone('America/Sao_Paulo'));
    //$data = date('Y-m-d', strtotime('2018-11-16') );
    //$horario = date('H:i:s');
    //$horario = date('H:i:s', strtotime('04:00:00'));
    $sql = $bd -> prepare('SELECT _data_prazo, horario_prazo, livro, retirado FROM emprestimo WHERE id = :id');

    $sql -> bindValue(':id', $id_emprestimo);
    $sql -> execute();

    $sql = $sql -> fetch();

    $infos = [];

    $livro = DetalhaLivro($sql['livro']);
    $titulo = $livro['titulo'];

    $prazo = DateTime::createFromFormat('Y-m-d H:i:s', $sql['_data_prazo'].' '.$sql['horario_prazo']);
    $tempo_restante = $dataHora->diff($prazo);
    //echo "Agora: ", $dataHora->format('Y-m-d H:i:s'), "<br>";
    //echo "Prazo: ", $prazo->format('Y-m-d H:i:s'), "<br>";
    //echo "Diff: ", var_dump($tempo_restante), "<br>";
    //exit();

    //$horario_prazo = DateTime::createFromFormat('H:i:s', $emprestimo['horario_prazo']);
    //$horario_restante[] = date_diff($horario_prazo, $horario);

    $infos['nome_livro'] = $titulo;
    $infos['tempo_restante'] = $tempo_restante;
    $infos['retirado'] = $sql['retirado'];
    //$infos['horario'] = $horario_restante;

    return($infos);

  }

  function CancelaReserva($id_reserva){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('DELETE FROM reserva WHERE id = :id_reserva');

    $sql -> bindValue(':id_reserva', $id_reserva);
    $sql -> execute();

  }

  function CancelaPreEmprestimo($id_emprestimo){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('DELETE FROM emprestimo WHERE id = :id_emprestimo');

    $sql -> bindValue(':id_emprestimo', $id_emprestimo);
    $sql -> execute();

  }

  function VerificaPreEmprestimo($id_emprestimo){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT * FROM emprestimo WHERE id = :id_emprestimo');

    $sql -> bindValue(':id_emprestimo', $id_emprestimo);
    $sql -> execute();

    $sql = $sql -> fetch();

    return($sql['_data_prazo']);

  }

  function VerificaRetirado($id_usuario, $id_livro){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('SELECT * FROM emprestimo WHERE aluno_prof = :id_usuario AND livro = :id_livro AND _data_devolucao IS NULL');

    $sql -> bindValue(':id_usuario', $id_usuario);
    $sql -> bindValue(':id_livro', $id_livro);
    $sql -> execute();

    $sql = $sql -> fetch();

    return($sql['retirado']);

  }

  function RemovePreEmprestimo($id_emprestimo){

    $bd = CriaConexãoBd();

    $sql = $bd -> prepare('UPDATE emprestimo SET retirado = FALSE AND _data_prazo = NULL AND horario_prazo = NULL WHERE id = :id_emprestimo');

    $sql -> bindValue(':id_emprestimo', $id_emprestimo);
    $sql -> execute();

  }

  function ProcuraIdEmprestimo($id_usuario, $id_livro) {

    $bd = CriaConexãoBd();
    $sql = $bd -> prepare('SELECT id FROM emprestimo WHERE aluno_prof = :id_usuario AND livro = :id_livro AND _data_devolucao IS NULL');

    $sql -> bindValue('id_usuario', $id_usuario);
    $sql -> bindValue('id_livro', $id_livro);

    $sql -> execute();
    // $sql = $sql -> fetchAll();
    $sql = $sql -> fetch();

    /* $linhaFinal = [];

    foreach ($sql as $linha) {

      $linhaFinal = $linha;

    } */

    return($sql['id']);

  }

?>
