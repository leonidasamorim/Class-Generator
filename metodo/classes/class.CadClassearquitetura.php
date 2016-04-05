<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadClassearquiteturaBD.php';
include_once dirname(__FILE__).'/class.Classearquitetura.php';

class CadClassearquitetura{
  var $cadClassearquiteturaBD;

  function CadClassearquitetura($conexao = ''){
    $this->cadClassearquiteturaBD = new CadClassearquiteturaBD($conexao);
  }

  function inserirClassearquitetura($classearquitetura) { 
    return $this->cadClassearquiteturaBD->inserirClassearquitetura($classearquitetura->getCodClasseArquitetura(), $classearquitetura->getNome());
  }

  function alterarClassearquitetura($classearquitetura) { 
    return $this->cadClassearquiteturaBD->alterarClassearquitetura($classearquitetura->getCodClasseArquitetura(), $classearquitetura->getNome());
  }

  function excluirClassearquitetura($classearquitetura) { 
    return $this->cadClassearquiteturaBD->excluirClassearquitetura($classearquitetura->getCodClasseArquitetura());
  }

  function getClassearquitetura($codClasseArquitetura) { 
    if($rs = $this->cadClassearquiteturaBD->getClassearquitetura($codClasseArquitetura)){
      $va = array_shift($rs);
      return new Classearquitetura($va['codclassearquitetura'], $va['nome']);
    }else
      return false;
    }

  function getAllClassearquitetura() { 
    if($rs = $this->cadClassearquiteturaBD->getAllClassearquitetura()){
      while($va = array_shift($rs))
        $vet[] = new Classearquitetura($va['codclassearquitetura'], $va['nome']);
      return $vet;
    }else
      return false;
    }

}
?>