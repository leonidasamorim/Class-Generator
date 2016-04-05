<?
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 02/05/2004 às 22:53:09

include_once dirname(__FILE__).'/../../classes/class.Conexao.php';

class CadBD{

	var $con;
	
	function CadBD($conexao){
    if($conexao)
      $this->con = $conexao;
    else
      $this->con = new Conexao();
  }
  
  function executarIUD($sql){
    if($rs = $this->con->execute($sql)){
      $rs->Close();
	    if($this->con->getAutoCommit())
        $this->con->close();
      return true;
    }else
      return false;
  }
  
  
  function executarInsAuto($sql){
    if($rs = $this->con->execute($sql)){
      $id = $this->con->insertId();
      $rs->Close();
	  if($this->con->getAutoCommit())
        $this->con->close();
      return $id;
    }else
      return false;
  }

}
?>