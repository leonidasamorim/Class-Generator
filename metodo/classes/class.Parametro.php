<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 07:00:19

class Parametro{
  var $codParametro;
  var $codMetodo;
  var $nome;
  var $tipo;
  var $descricao;
  var $ordem;

  function Parametro($codParametro, $codMetodo, $nome, $tipo, $descricao,$ordem){
   $this->codParametro = $codParametro;
   $this->codMetodo = $codMetodo;
   $this->nome = $nome;
   $this->tipo = $tipo;
   $this->descricao = $descricao;
   $this->ordem = $ordem;
  }

  function setAll($codMetodo = false,$nome = false, $tipo = false, $descricao = false, $ordem = false){
  	if($codMetodo !== false)
  		$this->codMetodo = $codMetodo;
    if($nome !== false)
      $this->setNome($nome);
    if($tipo !== false)
      $this->setTipo($tipo);
    if($descricao !== false)
      $this->setDescricao($descricao);
     if($ordem !== false)
      $this->setOrdem($ordem); 
  }

  function getCodParametro(){ return $this->codParametro;}

  function getCodMetodo(){ return $this->codMetodo;}
  
  function getNome(){ return $this->nome;}
  
  function getTipo(){ return $this->tipo;}

  function getDescricao(){ return $this->descricao;}
  
  function getOrdem(){ return $this->ordem;}

  function setCodParametro($x){ $this->codParametro = $x;}
  
  function setCodMetodo($x){ $this->codMetodo = $x;}

  function setNome($x){ $this->nome = $x;}

  function setTipo($x){ $this->tipo = $x;}

  function setDescricao($x){ $this->descricao = $x;}
  
  function setOrdem($x){ $this->ordem = $x;}

}
?>