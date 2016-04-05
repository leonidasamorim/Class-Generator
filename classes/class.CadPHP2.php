<?
include_once dirname(__FILE__)."/class.Cad.php";

class CadPHP2 extends Cad{
	
	var $nome_tb;
		
	function CadPHP2($table,$util,$projeto){
		$this->nome_tb = ucfirst($table->getNameF());
		$atributos = "";
		$this->Classe("Cad".ucfirst($table->getNameF()),$table,$util,$atributos,'',$projeto);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->includes();
		$texto .= $this->dClasse2("Cad".ucfirst($table->getNameF())."_Pai");
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//inicio e coment�rios
	function includes(){
  		return  "include_once dirname(__FILE__).'/class.Cad".$this->nome_tb."_Pai.php';\n\n";
	}	
	
}
?>