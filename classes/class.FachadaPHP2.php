<?
include_once dirname(__FILE__).'/class.Facade.php';
include_once dirname(__FILE__).'/class.Fachada.php';


class FachadaPHP2 extends Fachada {
		
	function FachadaPHP2($padrao,$projeto){
		$this->Classe("Fachada","",new Util($padrao),array("conexao"),'',$projeto);
	}
	
	function adicionarTabela($table){
		$this->setTable($table);
		$this->addInclude($this->includes());
	}
	
	function setBasica($basica){
		$this->basica = $basica;
	}
	
	function includes(){
		return "";
	}
	
	function getIncludes(){
		return $this->includes;
	}	
	
	function addInclude($texto){
		$this->includes .= $texto;
	}
	
	function gerar(){
		//Gerando a Classe
		$texto  = $this->comeco();
		$this->addInclude("include_once dirname(__FILE__).'/class.Fachada_Pai.php';\n\n");
		$texto .= $this->getIncludes();
		$texto .= $this->dClasse2("Fachada_Pai");
		$texto .= $this->fim();
		return $texto;
	}	
	
}
?>