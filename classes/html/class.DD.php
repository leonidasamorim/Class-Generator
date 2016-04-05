<?
include_once dirname(__FILE__)."/class.Tag.php";

class DD extends Tag{

	function DD($vetTag=""){
		$this->Tag('',$vetTag);
	}
	
	function getConteudo(){
		return "<DD>".$this->getVetTag()."</DD>\n";
	}
	
}
?>