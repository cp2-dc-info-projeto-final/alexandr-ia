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

	function InsereLivro($dadosNovoLivro)
	{
		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('INSERT INTO livro(autor, aquisicao, classificacao, edicao, editora, exemplar, observacao, titulo, volume) VALUES( :autor, :aquisicao, :classificacao, :edicao, :editora, :exemplar, :observacao, :titulo, :volume);');

		$sql ->bindValue(':autor',$dadosNovoLivro['autor']);
		$sql ->bindValue(':aquisicao',$dadosNovoLivro['aquisicao']);
		$sql ->bindValue(':classificacao',$dadosNovoLivro['classificacao']);
		$sql ->bindValue(':edicao',$dadosNovoLivro['edicao']);
		$sql ->bindValue(':editora',$dadosNovoLivro['editora']);
		$sql ->bindValue(':exemplar',$dadosNovoLivro['qtd_exemplares']);
		$sql ->bindValue(':observacao',$dadosNovoLivro['observacao']);
		$sql ->bindValue(':titulo', $dadosNovoLivro['titulo']);
		$sql ->bindValue(':volume', $dadosNovoLivro['volume']);
		$sql -> execute();
		
	}
?>
