<?
include_once dirname(__FILE__)."/class.Style.php";

class ImportStyle extends Style {
	
	function ImportStyle($type,$src){
			$this->Style($type,$src);
	}

	function getConteudo(){
		return "<style".$this->getType().">\n @import url('".$this->getSrc()."');\n</style>\n";
	}
	
}
?>