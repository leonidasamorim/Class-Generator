<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 27/06/2004 às 04:15:18

class Metodo{
  var $codMetodo;
  var $codProjeto;
  var $codClasseArquitetura;
  var $nome;
  var $descricao;
  var $sql;
  var $classe;
  var $tipoMetodo;
  var $codigo;
  var $tipoRetorno;

  function Metodo($codMetodo,$codProjeto, $codClasseArquitetura, $nome, $descricao, $sql, $classe, $tipoMetodo, $codigo, $tipoRetorno){
   $this->codMetodo = $codMetodo;
   $this->codProjeto = $codProjeto;
   $this->codClasseArquitetura = $codClasseArquitetura;
   $this->nome = $nome;
   $this->descricao = $descricao;
   $this->sql = $sql;
   $this->classe = $classe;
   $this->tipoMetodo = $tipoMetodo;
   $this->codigo = $codigo;
   $this->tipoRetorno = $tipoRetorno;
  }

  function setAll($codClasseArquitetura = false, $codProjeto = false, $nome = false, $descricao = false, $sql = false, $classe = false, $tipoMetodo = false, $codigo = false, $tipoRetorno = false){
    if($codProjeto !== false)
    	$this->codProjeto = $codProjeto;
    if($codClasseArquitetura !== false)
      $this->setCodClasseArquitetura($codClasseArquitetura);
    if($nome !== false)
      $this->setNome($nome);
    if($descricao !== false)
      $this->setDescricao($descricao);
    if($sql !== false)
      $this->setSql($sql);
    if($classe !== false)
      $this->setClasse($classe);
    if($tipoMetodo !== false)
      $this->setTipoMetodo($tipoMetodo);
    if($codigo !== false)
      $this->setCodigo($codigo);
    if($tipoRetorno !== false)
      $this->setTipoRetorno($tipoRetorno);
  }

  function getCodMetodo(){ return $this->codMetodo;}
  
  function getCodProjeto(){ return $this->codProjeto;}

  function getCodClasseArquitetura(){ return $this->codClasseArquitetura;}

  function getNome(){ return $this->nome;}

  function getDescricao(){ return $this->descricao;}

  function getSql(){ return $this->sql;}

  function getClasse(){ return $this->classe;}

  function getTipoMetodo(){ return $this->tipoMetodo;}

  function getCodigo(){ return $this->codigo;}

  function getTipoRetorno(){ return $this->tipoRetorno;}

  function setCodMetodo($x){ $this->codMetodo = $x;}
  
  function setCodProjeto($x){ $this->codProjeto= $x;}

  function setCodClasseArquitetura($x){ $this->codClasseArquitetura = $x;}

  function setNome($x){ $this->nome = $x;}

  function setDescricao($x){ $this->descricao = $x;}

  function setSql($x){ $this->sql = $x;}

  function setClasse($x){ $this->classe = $x;}

  function setTipoMetodo($x){ $this->tipoMetodo = $x;}

  function setCodigo($x){ $this->codigo = $x;}

  function setTipoRetorno($x){ $this->tipoRetorno = $x;}
}
?>