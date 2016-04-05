<?

class Caption{
	var $cont;
	var $aling;

	function Caption($cont,$aling=''){
		$this->cont = $cont;
		$this->aling = $aling;
	}
	
	function getCont(){
		return $this->cont;
	}
	
	function setCont($cont){
		$this->cont = $cont;
	}
	
	function getAling(){
		return ($this->aling)?" aling='".$this->aling."'":"";
	}
	
	function setAling($aling){
		$this->aling = $aling;
	}
	
	function getConteudo(){
		$text = "<caption ".$this->getAling().">".
				$this->getCont().
				"</caption>\n";
		return $text;
	}
}
?>