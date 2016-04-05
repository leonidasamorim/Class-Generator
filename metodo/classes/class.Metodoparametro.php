<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 07:00:19

class Metodoparametro{
  var $codParametro;
  var $codMetodo;
  var $ordem;

  function Metodoparametro($codParametro, $codMetodo, $ordem){
   $this->codParametro = $codParametro;
   $this->codMetodo = $codMetodo;
   $this->ordem = $ordem;
  }

  function setAll($ordem = false){
    if($ordem !== false)
      $this->setOrdem($ordem);
  }

  function getCodParametro(){ return $this->codParametro;}

  function getCodMetodo(){ return $this->codMetodo;}

  function getOrdem(){ return $this->ordem;}

  function setCodParametro($x){ $this->codParametro = $x;}

  function setCodMetodo($x){ $this->codMetodo = $x;}

  function setOrdem($x){ $this->ordem = $x;}

}
?>