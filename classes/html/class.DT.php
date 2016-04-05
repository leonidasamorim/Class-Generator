<?
include_once dirname(__FILE__)."/class.Tag.php";

class DT extends Tag{

	function DT($text,$vetTag=""){
		$this->Tag($text,$vetTag);
	}
	
	function getConteudo(){
		return "<DT>".$this->getText()."\n".$this->getVetTag()."</DT>\n";
	}
	
}
?>