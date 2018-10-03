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

	function DetalhaLivro($id){

		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('SELECT * FROM livro WHERE id = :id');
		$sql -> bindValue(':id', $id);

		$sql -> execute();
		$sql = $sql -> fetch();

		return($sql);

	}

	function PesquisaLivro($string, $tipo){

		$bd = CriaConexãoBd();

		if($tipo == 'pp_titulo'){ // pp_ é Pesquisar Por

			$sql = $bd -> prepare("SELECT id, titulo, autor FROM livro WHERE titulo LIKE :string ORDER BY titulo ASC");
			$sql -> bindValue(':string', '%'.$string.'%');

			$sql -> execute();
			$sql = $sql -> fetchAll();

			return ($sql);

		}

		if($tipo == 'pp_autor'){

			$sql = $bd -> prepare('SELECT id, titulo, autor FROM livro WHERE autor LIKE :string ORDER BY autor ASC');
			$sql -> bindValue(':string', '%'.$string.'%');

			$sql -> execute();
			$sql = $sql -> fetchAll();

			return ($sql);

		}

		if($tipo == 'pp_editora'){

			$sql = $bd -> prepare('SELECT id, titulo, autor FROM livro WHERE editora LIKE :string ORDER BY editora ASC');
			$sql -> bindValue(':string', '%'.$string.'%');

			$sql -> execute();
			$sql = $sql -> fetchAll();

			return ($sql);

		}

	}

	function VerificaTipo($id){

		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('SELECT observacao FROM livro WHERE id = :id');
		$sql -> bindValue(':id', $id);
		$sql -> execute();

		$sql = $sql -> fetch();

		$tipo = trim($sql['observacao']);

		return $tipo;

	}

	function HQ($id){

		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('SELECT classificacao FROM livro WHERE classificacao LIKE :string AND id = :id');

		$sql -> bindValue(':string', '741.5%');
		$sql -> bindValue(':id', $id);
		$sql -> execute();

		$sql = $sql -> fetch();
		$sql = $sql['classificacao'];

		return($sql);

	}

	function MesmaClassificacao($classificacao){
		$bd = CriaConexãoBd();
		$dadosbd = $bd->prepare('SELECT classificacao FROM livro WHERE classificacao = :classificacao ');
		$dadosbd->bindValue(':classificacao', $classificacao);
		$dadosbd->execute();

		if($dadosbd->rowCount() != 0){
			return 1;
		}
		else{
			return 0;
		}
	}

	function MaisRecentes(){

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('SELECT id, titulo FROM livro ORDER BY aquisicao DESC');
		$sql -> execute();

		$maisRecentes = [];

		$maisRecentes[] = $sql -> fetch();
		$maisRecentes[] = $sql -> fetch();
		$maisRecentes[] = $sql -> fetch();

		return ($maisRecentes);

	}



	function IdsLivro(){

		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('SELECT id FROM livro');
		$sql -> execute();

		$sql = $sql -> fetchAll(PDO::FETCH_ASSOC);
		$ids = [];

		foreach ($sql as $item) {
			$ids[] = $item['id'];
		}

		return($ids);

	}

?>
