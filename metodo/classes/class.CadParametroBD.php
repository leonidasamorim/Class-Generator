<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadBD.php';
class CadParametroBD extends CadBD{

  function CadParametroBD($conexao = ""){
    $this->CadBD($conexao);
  }

  function inserirParametro($codParametro, $codMetodo, $nome, $tipo, $descricao, $ordem) { 
    $sql = "INSERT INTO parametro
                  VALUES('$codParametro', '$codMetodo', '$nome', '$tipo', '$descricao', '$ordem')";
    return $this->executarInsAuto($sql);
  }

  function alterarParametro($codParametro, $codMetodo, $nome, $tipo, $descricao, $ordem) { 
    $sql = "UPDATE parametro
                  SET
                    codMetodo = '$codMetodo',
                    nome = '$nome',
                    tipo = '$tipo',
                    descricao = '$descricao',
                    ordem = '$ordem'
                  WHERE
                    codParametro = '$codParametro'";
    return $this->executarIUD($sql);
  }


  function excluirParametro($codParametro) { 
    $sql = "DELETE FROM parametro
                  WHERE
                    codParametro = '$codParametro'";
    return $this->executarIUD($sql);
  }

  function getParametro($codParametro) { 
    $sql = "SELECT * FROM parametro
                  WHERE
                    codParametro = '$codParametro'
                  ORDER BY
                    codParametro";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

  function getAllParametro() { 
    $sql = "SELECT * FROM parametro
                  ORDER BY
                    codParametro";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }
  
  function getParametrosMetodo($codMetodo) {
  	$sql = "SELECT * FROM parametro WHERE codMetodo = '$codMetodo' ORDER BY ordem";
    	$rs = $this->con->execute($sql);
    	return $this->con->fetch_array($rs);
  }
  
  function getParametroNome($nome) {
  	$sql = "SELECT * FROM parametro WHERE nome = '$nome'";
    	$rs = $this->con->execute($sql);
    	return $this->con->fetch_array($rs);
  }

}
?>