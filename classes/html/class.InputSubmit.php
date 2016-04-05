<?
include_once dirname(__FILE__)."/class.Input.php";

class InputSubmit extends Input {
	
	var $onClick;

	function InputSubmit($value,$name,$onBlur='',$disable='',$css='',$onClick=''){
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
		return "<INPUT type='submit' ".$this->getName().$this->getValue().$this->getOnBlur().$this->getCss().$this->getDisable().$this->getOnClick().">\n";
	}
}
?>