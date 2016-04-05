<?
include_once dirname(__FILE__)."/class.Tag.php";

class Head extends Tag{

	function Head($vetTag=""){
		$this->vetTag = $vetTag;
	}

	function getConteudo(){
		$conteudo = "<HEAD>\n".$this->getVetTag()."</HEAD>\n";
		return $conteudo;
	}
}
?>