<?
include_once dirname(__FILE__).'/../class.Facade.php';

class BasicaJava extends Basica {
	
	function BasicaJava($table,$util){
		$this->Classe(ucfirst($table->getName()),$table,$util);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->dClasse();
		$texto .= $this->construtor();
		//if($table->getVetNK())
			//$texto .= $this->setAll();
		$texto .= $this->getSet();
		$texto .= $this->getMetodosCadastrados();
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
//Declaração da Classe
	function dClasse($superClasse=''){
  		$texto  = "public class ".$this->getNome();
  		$texto .= ($superClasse)?" extends $superClasse{\n":"{\n";
  		// Atributos da classe
  		if($vetAtt = $this->getAtributos())
  				while($field = array_shift($vetAtt))
  					$texto .= "  private  ".Maping::typeLanguage($field,"Java")." ".$field->getNameF().";\n";
  		$texto .= "\n";
  		return $texto;
	}
	
	// Método construtor
	function construtor(){
  		$atts = $this->table->getVetFields();
			$texto = "  public ".$this->getNome()."(";
  		for($j=0;$j<count($atts);$j++)
     		$texto .= Maping::typeLanguage($atts[$j],"Java")." ".$atts[$j]->getNameF().(($j != (count($atts)-1))?", ":"){\n");
  		for($j=0;$j<count($atts);$j++)
     		$texto .= "   this.".$atts[$j]->getNameF()." = ".$atts[$j]->getNameF().";\n";
  		$texto .= "  }\n\n";
  		return $texto;
	}
	
	/*
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
     		$texto1 .= "  public ".Maping::typeLanguage($atts[$j],"Java")." get".ucfirst($atts[$j]->getNameF())."(){ return this.".$atts[$j]->getNameF().";}\n\n";
     		$texto2 .= "  public void set".ucfirst($atts[$j]->getNameF())."(".Maping::typeLanguage($atts[$j],"Java")." x){ this.".$atts[$j]->getNameF()." = x;}\n\n";
  		}
  		return $texto1.$texto2;
	}
	
	//isso pode ficar em uma superClasse(verificar)
	//inicio e comentários
	function comeco(){
  		return $this->util->cabecalho()."package ".$this->table->getNameDB().";\n\n";
	}
	
	//finalizando
	function fim(){
  		return "}";
	}
	
}
?>