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

	function MaisAcessados(){

		$bd = CriaConexãoBd();
		$sql = $bd -> prepare('SELECT livro FROM emprestimo');
		$sql -> execute();

		$lista_matriz = $sql -> fetchAll();
		$lista_array = [];

		foreach ($lista_matriz as $item) {

			$lista_array[] = $item[0];

		}

		$frequencias = array_count_values($lista_array);
		$maisAcessados = [];

		foreach ($frequencias as $id_livro => $valor) {

			if( count($maisAcessados) < 10){

				$maisAcessados[] = $id_livro;

			} else {

				foreach ($maisAcessados as $posicao => $item) {

					if ( ($valor > $item) AND (in_array( $id_livro, $maisAcessados)) == FALSE ){

						$maisAcessados[$posicao] = $frequencias[$id_livro];

					}

				}

			}

		}

		/* for ($i= 0; $i < 10; $i++) {

			$maisAcessados[] = -1;

		}

		foreach ($frequencias as $valor) {

			foreach ($maisAcessados as $item) {

				if ( ($valor > $item) AND (in_array( array_search($valor, $frequencias), $maisAcessados)) == FALSE ){

					$posicao = array_search($item, $maisAcessados);
					$maisAcessados[$posicao] = $frequencias[array_search($valor, $frequencias)];

				}

			}

		} */

		$resultado = [];

		foreach ($maisAcessados as $item) {

			if ($item != -1){

				$resultado[] = $item;

			}

		}

		/* var_dump($lista_matriz);
		var_dump($lista_array);
		var_dump($frequencias);
		var_dump($maisAcessados);
		var_dump($resultado);
		exit(); */

		return ($resultado);

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

	function AlteraLivro($autor, $aquisicao, $classificacao, $edicao, $editora, $qtd_exemplares, $observacao, $titulo, $volume, $id_livro){

		$bd = CriaConexãoBd();

		$id_livro = intval($id_livro);

		$sql = $bd -> prepare('UPDATE livro SET autor = :autor, aquisicao = :aquisicao, classificacao = :classificacao, edicao = :edicao, editora = :editora, exemplar = :qtd_exemplares, observacao = :observacao, titulo = :titulo, volume = :volume WHERE id = :id');
		$sql -> bindValue(':autor', $autor);
		$sql -> bindValue(':aquisicao', $aquisicao);
		$sql -> bindValue(':classificacao', $classificacao);
		$sql -> bindValue(':edicao', $edicao);
		$sql -> bindValue(':editora', $editora);
		$sql -> bindValue(':qtd_exemplares', $qtd_exemplares);
		$sql -> bindValue(':observacao', $observacao);
		$sql -> bindValue(':titulo', $titulo);
		$sql -> bindValue(':volume', $volume);
		$sql -> bindValue(':id', $id_livro, PDO::PARAM_INT);

		$sql -> execute();

	}

	function IdPorClassificacao($classificacao){

		$bd = CriaConexãoBd();

		$sql = $bd -> prepare('SELECT id FROM livro WHERE classificacao = :classificacao');

		$sql -> bindValue(':classificacao', $classificacao);
		$sql -> execute();

		$sql = $sql -> fetch();
		$sql = $sql['id'];

		return($sql);

	}

?>
