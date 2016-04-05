<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 08/09/2004 �s 19:19:28

include_once dirname(__FILE__).'/class.CadBD.php';
class CadProjetoBD extends CadBD{

  function CadProjetoBD($conexao = ""){
    $this->CadBD($conexao);
  }

  function inserirProjeto($codProjeto, $descricao, $coordenador, $banco) { 
    $sql = "INSERT INTO projeto
                  VALUES('$codProjeto', '$descricao', '$coordenador', '$banco')";
    return $this->executarInsAuto($sql);
  }

  function alterarProjeto($codProjeto, $descricao, $coordenador, $banco) { 
    $sql = "UPDATE projeto
                  SET
                    descricao = '$descricao',
                    coordenador = '$coordenador',
                    banco = '$banco'
                  WHERE
                    codProjeto = '$codProjeto'";
    return $this->executarIUD($sql);
  }

  function excluirProjeto($codProjeto) { 
    $sql = "DELETE FROM projeto
                  WHERE
                    codProjeto = '$codProjeto'";
    return $this->executarIUD($sql);
  }

  function getProjeto($codProjeto) { 
    $sql = "SELECT * FROM projeto
                  WHERE
                    codProjeto = '$codProjeto'
                  ORDER BY
                    codProjeto";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

  function getAllProjeto() { 
    $sql = "SELECT * FROM projeto
                  ORDER BY
                    codProjeto";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }

   function getProjetoBanco($nomeBanco) { 
    $sql = "SELECT * FROM projeto
                  WHERE
                    banco = '$nomeBanco'
                  ORDER BY
                    codProjeto";
    $rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
  }
}
?>