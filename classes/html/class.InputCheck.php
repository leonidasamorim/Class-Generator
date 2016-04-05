<?
include_once dirname(__FILE__)."/class.Input.php";


class InputCheck extends Input {

	var $check;

	function InputCheck($value,$name,$onBlur='',$disable='',$css='',$check =''){
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
		$conteudo = "<INPUT type='checkbox' ".$this->getName().$this->getValue().
		$this->getOnBlur().$this->getCheck().$this->getCss().$this->getDisable().">";
		
		return $conteudo;
	}
}
?>