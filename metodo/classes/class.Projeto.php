<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 08/09/2004 �s 19:19:28

class Projeto{
  var $codProjeto;
  var $descricao;
  var $coordenador;
  var $banco;

  function Projeto($codProjeto, $descricao, $coordenador, $banco){
   $this->codProjeto = $codProjeto;
   $this->descricao = $descricao;
   $this->coordenador = $coordenador;
   $this->banco = $banco;
  }

  function setAll($descricao = false, $coordenador = false, $banco = false){
    if($descricao !== false)
      $this->setDescricao($descricao);
    if($coordenador !== false)
      $this->setCoordenador($coordenador);
    if($banco !== false)
      $this->setBanco($banco);
  }

  function getCodProjeto(){ return $this->codProjeto;}

  function getDescricao(){ return $this->descricao;}

  function getCoordenador(){ return $this->coordenador;}

  function getBanco(){ return $this->banco;}

  function setCodProjeto($x){ $this->codProjeto = $x;}

  function setDescricao($x){ $this->descricao = $x;}

  function setCoordenador($x){ $this->coordenador = $x;}

  function setBanco($x){ $this->banco = $x;}

}
?>