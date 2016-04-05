<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 08/09/2004 �s 19:19:28

include_once dirname(__FILE__).'/class.CadProjetoBD.php';
include_once dirname(__FILE__).'/class.Projeto.php';

class CadProjeto{
  var $cadProjetoBD;

  function CadProjeto($conexao = ''){
    $this->cadProjetoBD = new CadProjetoBD($conexao);
  }

  function inserirProjeto($projeto) { 
    return $this->cadProjetoBD->inserirProjeto($projeto->getCodProjeto(), $projeto->getDescricao(), $projeto->getCoordenador(), $projeto->getBanco());
  }

  function alterarProjeto($projeto) { 
    return $this->cadProjetoBD->alterarProjeto($projeto->getCodProjeto(), $projeto->getDescricao(), $projeto->getCoordenador(), $projeto->getBanco());
  }

  function excluirProjeto($projeto) { 
    return $this->cadProjetoBD->excluirProjeto($projeto->getCodProjeto());
  }

  function getProjeto($codProjeto) { 
    if($rs = $this->cadProjetoBD->getProjeto($codProjeto)){
      $va = array_shift($rs);
      return new Projeto($va['codprojeto'], $va['descricao'], $va['coordenador'], $va['banco']);
    }else
      return false;
    }

  function getAllProjeto() { 
    if($rs = $this->cadProjetoBD->getAllProjeto()){
      while($va = array_shift($rs))
        $vet[] = new Projeto($va['codprojeto'], $va['descricao'], $va['coordenador'], $va['banco']);
      return $vet;
    }else
      return false;
    }
    
   function getProjetoBanco($nomeBanco) { 
    if($rs = $this->cadProjetoBD->getProjetoBanco($nomeBanco)){
      $va = array_shift($rs);
      return new Projeto($va['codprojeto'], $va['descricao'], $va['coordenador'], $va['banco']);
    }else
      return false;
    }

}
?>