<?php
	function CriaConexãoBd(){
		$bd = new PDO('mysql:host=localhost;
		dbname=alexandria;charset=utf8',
		'alexandria',
		'bibliteclinha'
		);
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $bd;
	}

	function MesmoEmail($email){
		$bd = CriaConexãoBd();
		$dadosbd = $bd->prepare('SELECT email FROM Usuario WHERE email = :email ');
		$dadosbd->bindValue(':email', $email);
		$dadosbd->execute();

		if($dadosbd->rowCount() != 0){
			return 1;
		}
		else{
			return 0;
		}
	}

	function InsereUsuario($dadosNovoUsuario)
	{
		$bd = CriaConexãoBd();

		$sql = $bd ->prepare('INSERT INTO usuario(matricula, nome, email, senha) VALUES( :matricula, :nome, :email, :senha);');

		$sql ->bindValue(':matricula',$dadosNovoUsuario['matricula']);
		$sql ->bindValue(':nome',$dadosNovoUsuario['nome']);
		$sql ->bindValue(':email', $dadosNovoUsuario['email']);
		$sql ->bindValue(':senha', $dadosNovoUsuario['senha']);
		$sql -> execute();
		
		$bd = CriaConexãoBd();
		$sql = NULL;

		$id = $bd -> prepare('SELECT id FROM usuario WHERE email = :email');
		$id -> bindValue(':email', $dadosNovoUsuario['email']);
		$id -> execute();
		
		$bd = CriaConexãoBd();
		
		$sql = $bd -> prepare('INSERT INTO aluno_professor(id) VALUES(:id)');

		$id = $id -> fetch();
		$id = $id['id'];

		$sql -> bindValue(':id', $id);
		$sql -> execute();
	}
?>
