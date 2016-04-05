<?
include_once dirname(__FILE__)."/class.Style.php";

class LinkStyle extends Style {
	
	function LinkStyle($type,$src){
			$this->Style($type,$src);
	}

	function getConteudo(){
		return "<link href='".$this->getSrc()."' rel='stylesheet' ".$this->getType().">\n";
	}
	
}
?>