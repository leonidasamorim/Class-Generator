<?
include_once dirname(__FILE__)."/class.Input.php";


class InputFile extends Input {

	function InputFile($value,$name,$onBlur='',$disable='',$css=''){
		$this->Input($value,$name,$onBlur,$disable,$css);
	}

	function getConteudo(){
		$conteudo = "<INPUT type='file' ".$this->getName().$this->getValue().
								$this->getOnBlur().$this->getCss().$this->getDisable().">\n";
		return $conteudo;	
	}
}
?>