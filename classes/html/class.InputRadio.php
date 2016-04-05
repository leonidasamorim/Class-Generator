<?
include_once dirname(__FILE__)."/class.Input.php";


class InputRadio extends Input {

	var $check;

	function InputRadio($value,$name,$onBlur='',$disable='',$css='',$check =''){
		$this->Input($value,$name,$onBlur,$disable,$css);
		$this->check = $check;
	}

	function getCheck(){
		return ($this->check)?"checked":"";
	}

	function setCheck($check){
		$this->check = $check;
	}
	
	function getConteudo(){
		$conteudo = "<INPUT type='radio' ".$this->getName().$this->getValue().
								$this->getOnBlur().$this->getCheck().$this->getCss().$this->getDisable().">\n";
		return $conteudo;	
	}
}
?>