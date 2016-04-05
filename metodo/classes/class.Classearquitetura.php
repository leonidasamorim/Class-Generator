<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 07:00:19

class Classearquitetura{
  var $codClasseArquitetura;
  var $nome;

  function Classearquitetura($codClasseArquitetura, $nome){
   $this->codClasseArquitetura = $codClasseArquitetura;
   $this->nome = $nome;
  }

  function setAll($nome = false){
    if($nome !== false)
      $this->setNome($nome);
  }

  function getCodClasseArquitetura(){ return $this->codClasseArquitetura;}

  function getNome(){ return $this->nome;}

  function setCodClasseArquitetura($x){ $this->codClasseArquitetura = $x;}

  function setNome($x){ $this->nome = $x;}

}
?>