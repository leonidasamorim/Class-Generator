<?
include_once dirname(__FILE__)."/class.Tag.php";


class Body extends Tag{

	var $bgcolor;

	function Body($vetTag="",$bgcolor=""){
		$this->bgcolor = $bgcolor;
		$this->Tag("",$vetTag);
	}

	function getBgcolor(){
		return ($this->bgcolor)?' bgcolor="'.$this->bgcolor.'"':"";		
	}

	function setBgcolor($bgcolor){
		$this->bgcolor = $bgcolor;
	}

	function getConteudo(){
		$conteudo = "<BODY".$this->getBgcolor().">\n".
								$this->getVetTag()."</BODY>\n";
		return $conteudo;
	}
}
?>