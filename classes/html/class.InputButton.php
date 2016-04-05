<?
include_once dirname(__FILE__)."/class.Input.php";

class InputButton extends Input {
	
	var $onClick;

	function InputButton($value,$name,$onBlur='',$disable='',$css='',$onClick=''){
		$this->Input($value,$name,$onBlur,$disable,$css);
		$this->onClick = $onClick;
	}
	
	function getOnClick(){
		return " onClick = '".$this->onClick."'";
	}
	
	function setOnClick($onClick){
		$this->onClick = $onClick;
	}
	
	function getConteudo(){
		return "<INPUT type='button' ".$this->getName().$this->getValue().$this->getOnBlur().$this->getCss().$this->getDisable().$this->getOnClick().">\n";
	}
}
?>