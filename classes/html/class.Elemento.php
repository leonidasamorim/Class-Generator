<?
class Elemento{

	var $name;
	var $label;
	var $onBlur;
	var $disable;
	var $css;

	function Elemento($name, $onBlur ="", $css="", $disable=""){
		$this->name = $name;
		$this->onBlur = $onBlur;
		$this->disable = $disable;
		$this->css = $css;
	}

	// M�todos do Atributo Class
	function getCss(){
		return " class='".$this->css."'";
	}	

	function setCss($css){
		$this->css = $css;
	}
	
	// M�todos da propriedade disabled
	function getDisable(){
		return ($this->disable)?" disabled ":'';
	}	
	
	function setDisable($disable){
		$this->disable = $disable;
	}
	
	// M�todos do Atributo Name
	function getName(){
		return " name='".$this->name."'";
	}

	function setName($name){
		$this->name = $name;
	}	
	
	// M�todos da Propriedade onBlur
	function getOnBlur(){
		return ($this->onBlur)?" onBlur='".$this->onBlur."'":"";
	}

	function setOnBlur($onBlur){
		$this->onBlur = $onBlur;
	}
	
	function getConteudo(){	
			
	}
}
?>