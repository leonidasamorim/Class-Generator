<?
include_once dirname(__FILE__)."/class.Input.php";


class InputText extends Input {

	var $maxlength;
	var $size;

	function InputText($value,$name,$onBlur='',$disable='',$css='',$maxlength ='',$size=''){
		$this->Input($value,$name,$onBlur,$disable,$css);
		$this->maxlength = $maxlength;
		$this->size = $size;		
	}

	function getMaxlength(){
		return " maxlength='".$this->maxlength."'";
	}

	function setMaxlength($maxlength){
		$this->maxlength = $maxlength;
	}
	
	// Métodos do Atributo Size	
	function getSize(){
		return " size='".$this->size."'";
	}
	
	function setSize($size){
		$this->size = $size;
	}
	
	function getConteudo(){
		$conteudo = "<INPUT type='text' ".$this->getName().$this->getSize().$this->getValue().
		$this->getOnBlur().$this->getMaxlength().$this->getCss().$this->getDisable().">\n";
		
		return $conteudo;		
	}
}
?>