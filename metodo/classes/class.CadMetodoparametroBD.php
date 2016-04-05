<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadBD.php';
class CadMetodoparametroBD extends CadBD{

  function CadMetodoparametroBD($conexao = ""){
    $this->CadBD($conexao);
  }

  function inserirMetodoparametro($codParametro, $codMetodo, $ordem) { 
    $sql = "INSERT INTO metodoparametro
                  VALUES('$codParametro', '$codMetodo', '$ordem')";
    return $this->executarIUD($sql);
  }

  function alterarMetodoparametro($codParametro, $codMetodo, $ordem) { 
    $sql = "UPDATE metodoparametro
                  SET
                    ordem = '$ordem'
                  WHERE
                    codParametro = '$codParametro' AND 
                    codMetodo = '$codMetodo'";
    return $this->executarIUD($sql);
  }

  function excluirMetodoparametro($codParametro, $codMetodo) { 
    $sql = "DELETE FROM metodoparametro
                  WHERE
                    codParametro = '$codParametro' AND 
                    codMetodo = '$codMetodo'";
    return $this->executarIUD($sql);
  }

  function getMetodoparametro($codParametro, $codMetodo) { 
    $sql = "SELECT * FROM metodoparametro
                  WHERE
                    codParametro = '$codParametro' AND 
                    codMetodo = '$codMetodo'
                  ORDER BY
                    codParametro, codMetodo";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

  function getAllMetodoparametro() { 
    $sql = "SELECT * FROM metodoparametro
                  ORDER BY
                    ordem";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

}
?>