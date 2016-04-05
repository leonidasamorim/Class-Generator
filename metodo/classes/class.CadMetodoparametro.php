<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadMetodoparametroBD.php';
include_once dirname(__FILE__).'/class.Metodoparametro.php';

class CadMetodoparametro{
  var $cadMetodoparametroBD;

  function CadMetodoparametro($conexao = ''){
    $this->cadMetodoparametroBD = new CadMetodoparametroBD($conexao);
  }

  function inserirMetodoparametro($metodoparametro) { 
    return $this->cadMetodoparametroBD->inserirMetodoparametro($metodoparametro->getCodParametro(), $metodoparametro->getCodMetodo(), $metodoparametro->getOrdem());
  }

  function alterarMetodoparametro($metodoparametro) { 
    return $this->cadMetodoparametroBD->alterarMetodoparametro($metodoparametro->getCodParametro(), $metodoparametro->getCodMetodo(), $metodoparametro->getOrdem());
  }

  function excluirMetodoparametro($metodoparametro) { 
    return $this->cadMetodoparametroBD->excluirMetodoparametro($metodoparametro->getCodParametro(), $metodoparametro->getCodMetodo());
  }

  function getMetodoparametro($codParametro, $codMetodo) { 
    if($rs = $this->cadMetodoparametroBD->getMetodoparametro($codParametro, $codMetodo)){
      $va = array_shift($rs);
      return new Metodoparametro($va['codparametro'], $va['codmetodo'], $va['ordem']);
    }else
      return false;
    }

  function getAllMetodoparametro() { 
    if($rs = $this->cadMetodoparametroBD->getAllMetodoparametro()){
      while($va = array_shift($rs))
        $vet[] = new Metodoparametro($va['codparametro'], $va['codmetodo'], $va['ordem']);
      return $vet;
    }else
      return false;
    }
    
}
?>