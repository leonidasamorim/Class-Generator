<?
include_once dirname(__FILE__)."/class.Tag.php";

class DL extends Tag{

	function DL($text,$vetTag=""){
		$this->Tag($text,$vetTag);
	}
	
	function getConteudo(){
		return "<DL>".$this->getText().$this->getVetTag()."</DL>\n";
	}
	
}
?>