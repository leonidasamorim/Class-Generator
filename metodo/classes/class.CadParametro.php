<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadParametroBD.php';
include_once dirname(__FILE__).'/class.Parametro.php';

class CadParametro{
  var $cadParametroBD;

  function CadParametro($conexao = ''){
    $this->cadParametroBD = new CadParametroBD($conexao);
  }

  function inserirParametro($parametro) { 
    return $this->cadParametroBD->inserirParametro($parametro->getCodParametro(), $parametro->getCodMetodo(), $parametro->getNome(), $parametro->getTipo(), $parametro->getDescricao(), $parametro->getOrdem());
  }

  function alterarParametro($parametro) { 
    return $this->cadParametroBD->alterarParametro($parametro->getCodParametro(), $parametro->getCodMetodo(), $parametro->getNome(), $parametro->getTipo(), $parametro->getDescricao(), $parametro->getOrdem());
  }

  function excluirParametro($parametro) { 
    return $this->cadParametroBD->excluirParametro($parametro->getCodParametro());
  }

  function getParametro($codParametro) { 
    if($rs = $this->cadParametroBD->getParametro($codParametro)){
      $va = array_shift($rs);
      return new Parametro($va['codparametro'], $va['codmetodo'], $va['nome'], $va['tipo'], $va['descricao'], $va['ordem']);
    }else
      return false;
    }

  function getAllParametro() { 
    if($rs = $this->cadParametroBD->getAllParametro()){
      while($va = array_shift($rs))
        $vet[] = new Parametro($va['codparametro'], $va['codmetodo'], $va['nome'], $va['tipo'], $va['descricao'], $va['ordem']);
      return $vet;
    }else
      return false;
    }

    function getParametrosMetodo($codMetodo) { 
    if($rs = $this->cadParametroBD->getParametrosMetodo($codMetodo)){
      while($va = array_shift($rs))
        $vet[] = new Parametro($va['codparametro'], $va['codmetodo'], $va['nome'], $va['tipo'], $va['descricao'], $va['ordem']);
      return $vet;
    }else
      return false;
    }
    
    function getParametroNome($nome) { 
    if($rs = $this->cadParametroBD->getParametroNome($nome)){
      $va = array_shift($rs);
      return new Parametro($va['codparametro'], $va['codmetodo'], $va['nome'], $va['tipo'], $va['descricao'], $va['ordem']);
    }else
      return false;
    }
}
?>