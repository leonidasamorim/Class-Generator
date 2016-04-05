<?
include_once dirname(__FILE__)."/class.Classe.php";
include_once dirname(__FILE__).'/class.Facade.php';

class MetaCadBD extends Classe{
	
	var $sql;
	var $nome_tb;
		
	function MetaCadBD($tipoBanco,$table,$util){
		$this->nome_tb = "class.Cad".ucfirst($table->getNameF())."BD_Pai.php";
		$this->Classe("Cad".ucfirst($table->getNameF())."BD",$table,$util);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->includes();
		$texto .= $this->dClasse("Cad".ucfirst($table->getNameF())."BD_Pai");
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//inicio e comentários
	function includes(){
  		return  "include_once dirname(__FILE__).'/".$this->nome_tb."';\n\n";
	}	
}
?>