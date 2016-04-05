<?
include_once dirname(__FILE__).'/../class.Facade.php';

class BasicaPhyton extends Basica {
	
	function BasicaPhyton($table,$util){
		$this->Classe(ucfirst($table->getName()),$table,$util);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->dClasse();
		$texto .= $this->construtor();
		if($table->getVetNK())
			$texto .= $this->setAll();
		$texto .= $this->getSet();
		$texto .= $this->getMetodosCadastrados();
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
		//Declaração da Classe
	function dClasse(){
  		$texto  = "class ".$this->getNome().":\n";
  		// Atributos da classe
  		/*
 			$vetAtt = $this->table->getVetFields();
 			while($field = array_shift($vetAtt))
 				$texto .= "  var $".$field->getNameF().";\n";
  		$texto .= "\n";
  		*/
  		return $texto;
	}
	/*
	// Método construtor
	function construtor(){
  		$atts = $this->table->getVetFields();
			$texto = "  function ".$this->getNome()."(";
  		for($j=0;$j<count($atts);$j++)
     		$texto .= "$".$atts[$j]->getNameF().(($j != (count($atts)-1))?", ":"){\n");
  		for($j=0;$j<count($atts);$j++)
     		$texto .= "   \$this->".$atts[$j]->getNameF()." = $".$atts[$j]->getNameF().";\n";
  		$texto .= "  }\n\n";
  		return $texto;
	}
	
	//Método setAll, não tem como parametro as chaves primárias
	function setAll(){
		$nAtts = $this->table->getVetNK();
		$texto  = "  function setAll(";
  	for($j=0;$j<count($nAtts);$j++)
     	$texto .= "$".$nAtts[$j]->getNameF()." = false".(($j != (count($nAtts)-1))?", ":"){\n");
  	for($j=0;$j<count($nAtts);$j++)
  		$texto .= "    if($".$nAtts[$j]->getNameF()." !== false)\n".
  				"      \$this->set".ucfirst($nAtts[$j]->getNameF())."($".$nAtts[$j]->getNameF().");\n";
  	$texto .= "  }\n\n";
  	return $texto;
	}
	*/
	// Métodos Get e Set
	function getSet(){
			$atts = $this->table->getVetFields();
  		for($j=0;$j<count($atts);$j++){
			//$tamanho = strlen("function get".ucfirst($atts[$j]->getNameF())."(){");
     		$texto1 .= "  def get".ucfirst($atts[$j]->getNameF())."(self):\n    pass\n\n";
     		$texto2 .= "  def set".ucfirst($atts[$j]->getNameF())."(self,x):\n    pass\n\n";
  		}
  		return $texto1.$texto2;
	}
	
	//inicio e comentários
	function comeco(){
  		return "from Int import *\nfrom String import *\nfrom Double import *;\n\n";
	}
	
	//finalizando
	function fim(){
  		return "";
	}
	
}
?>