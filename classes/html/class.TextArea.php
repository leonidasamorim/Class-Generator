<?
include_once dirname(__FILE__)."/class.Input.php";


class TextArea extends Input {

	var $rows;
	var $cols;

	function TextArea($value,$name,$onBlur='',$disable='',$css='',$rows ='',$cols=''){
		$this->Input($value,$name,$onBlur,$disable,$css);
		$this->rows = $rows;
		$this->cols = $cols;		
	}

	function getCols(){
		return " cols='".$this->cols."'";
	}

	function setCols($cols){
		$this->cols = $cols;
	}
	
	// Métodos do Atributo Size	
	function getRows(){
		return " rows='".$this->rows."'";
	}
	
	function setRows($rows){
		$this->rows = $rows;
	}
	
	function getValue(){
		return $this->value;
	}
	
	function getConteudo(){
		$conteudo = "<TEXTAREA ".$this->getName().$this->getRows().
		$this->getOnBlur().$this->getCols().$this->getCss().$this->getDisable().">".$this->getValue()."</TEXTAREA>\n";
		
		return $conteudo;		
	}
}
?>