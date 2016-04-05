<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 27/06/2004 �s 04:15:18

include_once dirname(__FILE__).'/class.CadMetodoBD.php';
include_once dirname(__FILE__).'/class.Metodo.php';

class CadMetodo{
  var $cadMetodoBD;

  function CadMetodo($conexao = ''){
    $this->cadMetodoBD = new CadMetodoBD($conexao);
  }

  function inserirMetodo($metodo) { 
    return $this->cadMetodoBD->inserirMetodo($metodo->getCodMetodo(), $metodo->getCodProjeto(), $metodo->getCodClasseArquitetura(), $metodo->getNome(), $metodo->getDescricao(), $metodo->getSql(), $metodo->getClasse(), $metodo->getTipoMetodo(), $metodo->getCodigo(), $metodo->getTipoRetorno());
  }

  function alterarMetodo($metodo) { 
    return $this->cadMetodoBD->alterarMetodo($metodo->getCodMetodo(), $metodo->getCodProjeto(), $metodo->getCodClasseArquitetura(), $metodo->getNome(), $metodo->getDescricao(), $metodo->getSql(), $metodo->getClasse(), $metodo->getTipoMetodo(), $metodo->getCodigo(), $metodo->getTipoRetorno());
  }

  function excluirMetodo($metodo) { 
    return $this->cadMetodoBD->excluirMetodo($metodo->getCodMetodo());
  }

  function getMetodo($codMetodo) { 
    if($rs = $this->cadMetodoBD->getMetodo($codMetodo)){
      $va = array_shift($rs);
      return new Metodo($va['codmetodo'], $va['codprojeto'], $va['codclassearquitetura'], $va['nome'], $va['descricao'], $va['sql'], $va['classe'], $va['tipometodo'], $va['codigo'], $va['tiporetorno']);
    }else
      return false;
    }

  function getAllMetodo() { 
    if($rs = $this->cadMetodoBD->getAllMetodo()){
      while($va = array_shift($rs))
        $vet[] = new Metodo($va['codmetodo'], $va['codprojeto'], $va['codclassearquitetura'], $va['nome'], $va['descricao'], $va['sql'], $va['classe'], $va['tipometodo'], $va['codigo'], $va['tiporetorno']);
      return $vet;
    }else
      return false;
    }

    function getMetodosClasseArquiteturaTab($codClasseArquitetura,$nomeTabela,$nomeBanco) { 
    if($rs = $this->cadMetodoBD->getMetodosClasseArquiteturaTab($codClasseArquitetura,$nomeTabela,$nomeBanco)){
      while($va = array_shift($rs))
        $vet[] = new Metodo($va['codmetodo'], $va['codprojeto'], $va['codclassearquitetura'], $va['nome'], $va['descricao'], $va['sql'], $va['classe'], $va['tipometodo'], $va['codigo'], $va['tiporetorno']);
      return $vet;
    }else
      return false;
    }
    
   function getMetodosProjetoBanco($nomeBanco,$ordem) { 
    if($rs = $this->cadMetodoBD->getMetodosProjetoBanco($nomeBanco,$ordem)){
      while($va = array_shift($rs))
        $vet[] = new Metodo($va['codmetodo'], $va['codprojeto'], $va['codclassearquitetura'], $va['nome'], $va['descricao'], $va['sql'], $va['classe'], $va['tipometodo'], $va['codigo'], $va['tiporetorno']);
      return $vet;
    }else
      return false;
    }
    
}
?>