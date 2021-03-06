<?php

	/* function CriaConexãoBd(){
		$bd = new PDO('mysql:host=localhost;
		dbname=alexandria;charset=utf8',
		'alexandria',
		'bibliteclinha'
	);

		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $bd;
	} */

	function MesmoEmail($email){
		$bd = CriaConexãoBd();
		$dadosbd = $bd->prepare('SELECT email FROM usuario WHERE email = :email ');
		$dadosbd->bindValue(':email', $email);
		$dadosbd->execute();

		if($dadosbd->rowCount() != 0){
			return 1;
		}
		else{
			return 0;
		}
	}

	function InsereUsuario($dadosNovoUsuario, $tipo)
	{
		$bd = CriaConexãoBd();

		if(array_key_exists('turma', $dadosNovoUsuario)){
		$sql = $bd ->prepare('INSERT INTO usuario(matricula, nome, email, senha, banido, telefone, turma) VALUES( :matricula, :nome, :email, :senha, FALSE, :telefone, :turma);');
		} else {
		$sql = $bd ->prepare('INSERT INTO usuario(matricula, nome, email, senha, banido, telefone, turma) VALUES( :matricula, :nome, :email, :senha, FALSE, :telefone, NULL);');
		}
		$sql ->bindValue(':matricula',$dadosNovoUsuario['matricula']);
		$sql ->bindValue(':nome',$dadosNovoUsuario['nome']);
		$sql ->bindValue(':email', $dadosNovoUsuario['email']);
		$sql ->bindValue(':senha', $dadosNovoUsuario['senha']);
		$sql ->bindValue(':telefone', $dadosNovoUsuario['telefone']);

		if(array_key_exists('turma', $dadosNovoUsuario)){
		$sql ->bindValue(':turma', $dadosNovoUsuario['turma']);
		}

		$sql -> execute();

		$bd = CriaConexãoBd();
		$sql = NULL;

		$id = $bd -> prepare('SELECT id FROM usuario WHERE email = :email');
		$id -> bindValue(':email', $dadosNovoUsuario['email']);
		$id -> execute();

		$bd = CriaConexãoBd();

		if ($tipo == 0){

			$sql = $bd -> prepare('INSERT INTO aluno_professor(id) VALUES(:id)');

		} else if ($tipo == 1){


			$sql = $bd -> prepare('INSERT INTO bibliotecario(id) VALUES(:id)');

		}

		$id = $id -> fetch();
		$id = $id['id'];

		$sql -> bindValue(':id', $id);
		$sql -> execute();
	}

	function InfosUsuario($email){

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('SELECT * FROM usuario WHERE email = :email');
		$sql -> bindValue(':email', $email);

		$sql -> execute();
		$sql = $sql -> fetch();

		return($sql);

	}

	function TipoUsuario($id){

		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('SELECT id FROM bibliotecario WHERE id = :id');
		$sql -> bindValue(':id', $id);

		$sql -> execute();

		if ($sql -> rowCount() == 1){

			$tipo = 1;

		} else {

			$tipo = 0;

			}

		return($tipo);

	}

	function AlteraUsuario($nome, $matricula, $id){

		$bd = CriaConexãoBd();

		$id = intval($id);

		if($matricula != NULL){

			$sql = $bd -> prepare('UPDATE usuario SET nome = :nome, matricula = :matricula WHERE id = :id');
			$sql -> bindValue(':nome', $nome);
			$sql -> bindValue(':matricula', $matricula);
			$sql -> bindValue(':id', $id, PDO::PARAM_INT);

		} else {

			$sql = $bd -> prepare('UPDATE usuario SET nome = :nome WHERE id = :id');
			$sql -> bindValue(':nome', $nome);
			$sql -> bindValue(':id', $id, PDO::PARAM_INT);

		}

		$sql -> execute();

	}

	function AlteraMatricula($id, $matricula){

		$bd = CriaConexãoBd();

		$id = intval($id);

		$sql = $bd -> prepare('UPDATE usuario SET matricula = :matricula WHERE id = :id');
		$sql -> bindValue(':matricula', $matricula);
		$sql -> bindValue(':id', $id, PDO::PARAM_INT);

		$sql -> execute();

	}

	function Usuarios(){

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('SELECT * FROM usuario WHERE status = FALSE ORDER BY nome');

		$sql -> execute();
		$sql = $sql -> fetchAll(PDO::FETCH_ASSOC);

		return($sql);

	}

	function Ban($player){

		// player é Id nesse contexto

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('UPDATE usuario SET banido = 1 WHERE id = :player');

		$sql -> bindValue(':player', $player);
		$sql -> execute();

	}

	function UnBan($player){

		// player é Id nesse contexto

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('UPDATE usuario SET banido = 0 WHERE id = :player');

		$sql -> bindValue(':player', $player);
		$sql -> execute();

	}

	function Excluir($id){

		$bd = CriaConexãoBd();
		$tipoUsuario = TipoUsuario($id);

		$sql = $bd -> prepare('UPDATE usuario SET status = TRUE WHERE id = :id');
		$sql -> bindValue(':id', $id);

		$sql -> execute();

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('DELETE FROM reserva WHERE aluno_prof = :id');
		$sql -> bindValue(':id', $id);

		$sql -> execute();

	}

	function AlteraFoto($arquivo, $id){
		$bd = CriaConexãoBd();
		$sql = $bd->prepare('UPDATE usuario SET foto = :foto
	                     	 WHERE id = :id');

		$sql->bindValue(':foto', $arquivo);
		$sql->bindValue(':id', $id);

		$sql->execute();
	}

?>
