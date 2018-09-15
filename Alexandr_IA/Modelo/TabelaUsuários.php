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
	
	function InsereUsuario($dadosNovoUsuario)
	{
		$bd = CriaConexãoBd();
		
		$sql = $bd ->prepare('INSERT INTO usuario(matricula, nome, email, senha) VALUES( :matricula, :nome, :email, :senha);');
		
		$sql ->bindValue(':matricula',$dadosNovoUsuario['matricula']);
		$sql ->bindValue(':nome',$dadosNovoUsuario['nome']);
		$sql ->bindValue(':email', $dadosNovoUsuario['email']);
		$sql ->bindValue(':senha', $dadosNovoUsuario['senha']);
		$sql -> execute();
	}
?>