<?
include_once dirname(__FILE__).'/class.Conexao.php';

class BD{

	var $con;
	
	function BD($conexao = ""){
    if($conexao)
      $this->con = $conexao;
    else
      $this->con = new Conexao();
  }
  
  function executarIUD($sql){
    if($rs = $this->con->execute($sql)){
      $rs->Close();
	    if($this->con->autoCommit())
        $this->con->close();
      return true;
    }else
      return false;
  }

}
?>