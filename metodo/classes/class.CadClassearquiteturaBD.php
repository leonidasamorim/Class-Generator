<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadBD.php';
class CadClassearquiteturaBD extends CadBD{

  function CadClassearquiteturaBD($conexao = ""){
    $this->CadBD($conexao);
  }

  function inserirClassearquitetura($codClasseArquitetura, $nome) { 
    $sql = "INSERT INTO classearquitetura
                  VALUES('$codClasseArquitetura', '$nome')";
    return $this->executarInsAuto($sql);
  }

  function alterarClassearquitetura($codClasseArquitetura, $nome) { 
    $sql = "UPDATE classearquitetura
                  SET
                    nome = '$nome'
                  WHERE
                    codClasseArquitetura = '$codClasseArquitetura'";
    return $this->executarIUD($sql);
  }

  function excluirClassearquitetura($codClasseArquitetura) { 
    $sql = "DELETE FROM classearquitetura
                  WHERE
                    codClasseArquitetura = '$codClasseArquitetura'";
    return $this->executarIUD($sql);
  }

  function getClassearquitetura($codClasseArquitetura) { 
    $sql = "SELECT * FROM classearquitetura
                  WHERE
                    codClasseArquitetura = '$codClasseArquitetura'
                  ORDER BY
                    codClasseArquitetura";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

  function getAllClassearquitetura() { 
    $sql = "SELECT * FROM classearquitetura
                  ORDER BY
                    codClasseArquitetura";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

}
?>