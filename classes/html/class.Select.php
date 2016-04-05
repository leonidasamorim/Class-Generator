<?
include_once dirname(__FILE__)."/class.Elemento.php";


class Select extends Elemento{

	var $onChange;
	var $size;

	function Select($name,$size='',$onBlur='',$disable='',$css='',$onChange=''){
		$this->Elemento($name,$size,$onBlur,$disable,$css);
		$this->onChange = $onChange;
		$this->size = $size;
	}

	function getOnChange(){
		return " onChange='".$this->onChange."'";
	}

	function setOnChange($onChange){
		$this->onChange = $onChange;
	}
	
	// Métodos do Atributo Size	
	function getSize(){
		return ' size="'.$this->size.'"';
	}
	
	function setSize($size){
		$this->size = $size;
	}

	function getConteudo(){
		return '<SELECT ';
	}
	
}
?>