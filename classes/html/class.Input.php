<?
include_once dirname(__FILE__)."/class.Elemento.php";


class Input extends Elemento {

	var $value;

	function Input($value, $name, $onBlur='',$disable='',$css=''){
		//die($disable);
		$this->Elemento($name,$onBlur,$css , $disable);
		$this->value = $value;
	}

	function getValue(){
		return " value='".$this->value."'";
	}

	function setValue($value){
		$this->value = $value;
	}
	
	function getConteudo(){
	
	}
}
?>