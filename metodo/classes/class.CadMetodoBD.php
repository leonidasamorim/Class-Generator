<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 27/06/2004 �s 04:15:18

include_once dirname(__FILE__).'/class.CadBD.php';
class CadMetodoBD extends CadBD{

  function CadMetodoBD($conexao = ""){
    $this->CadBD($conexao);
  }

  function inserirMetodo($codMetodo, $codProjeto, $codClasseArquitetura, $nome, $descricao, $sql, $classe, $tipoMetodo, $codigo, $tipoRetorno) { 
    $sql = "INSERT INTO metodo
                  VALUES('$codMetodo', '$codProjeto',  '$codClasseArquitetura', '$nome', '$descricao', '$sql', '$classe', '$tipoMetodo', '$codigo', '$tipoRetorno')";
    return $this->executarInsAuto($sql);
  }

  function alterarMetodo($codMetodo, $codProjeto, $codClasseArquitetura, $nome, $descricao, $sql, $classe, $tipoMetodo, $codigo, $tipoRetorno) { 
    $sql = "UPDATE metodo
                  SET
    			 codProjeto = '$codProjeto',
                    codClasseArquitetura = '$codClasseArquitetura',
                    nome = '$nome',
                    descricao = '$descricao',
                    sql = '$sql',
                    classe = '$classe',
                    tipoMetodo = '$tipoMetodo',
                    codigo = '$codigo',
                    tipoRetorno = '$tipoRetorno'
                  WHERE
                    codMetodo = '$codMetodo'";
    return $this->executarIUD($sql);
  }

  function excluirMetodo($codMetodo) { 
    $sql = "DELETE FROM metodo
                  WHERE
                    codMetodo = '$codMetodo'";
    return $this->executarIUD($sql);
  }

  function getMetodo($codMetodo) { 
    $sql = "SELECT * FROM metodo
                  WHERE
                    codMetodo = '$codMetodo'
                  ORDER BY
                    codMetodo";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

  function getAllMetodo() { 
    $sql = "SELECT * FROM metodo
                  ORDER BY
                    codMetodo";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

  function getMetodosClasseArquiteturaTab($codClasseArquitetura,$nomeTabela,$nomeBanco) { 
	$sql = "SELECT * FROM metodo m";
	if(($nomeTabela)&&($nomeBanco))
		$sql .= " INNER JOIN projeto p ON(m.codProjeto = p.codProjeto)";
	$sql .= " WHERE
		(codClasseArquitetura = '$codClasseArquitetura' OR  (codClasseArquitetura = '1' AND ($codClasseArquitetura = 2 OR $codClasseArquitetura = 4 OR $codClasseArquitetura = 5)))";
	if(($nomeTabela)&&($nomeBanco))
		$sql .= "         AND classe = '$nomeTabela'  AND p.banco = '$nomeBanco'";
	$sql .= " ORDER BY	codMetodo";
	$rs = $this->con->execute($sql);
	return $this->con->fetch_array($rs);
  }
  
  function getMetodosProjetoBanco($nomeBanco,$ordem) { 
    $sql = "SELECT * FROM metodo m INNER JOIN projeto p ON(m.codProjeto = p.codProjeto)
    			WHERE
    				p.banco = '$nomeBanco'";
    if($ordem)
                  $sql .= "ORDER BY $ordem";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }
  
}
?>