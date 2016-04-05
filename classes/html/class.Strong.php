<?

class Strong extends Tag{
	
	var $cont;
	
	function Strong($cont){
		$this->cont = $cont;
	}
	
	function getCont(){
		return $this->cont;
	}
	
	function setCont($cont){
		$this->cont = $cont;
	}
	
	function getConteudo(){
		return "<strong>".$this->getCont()."</strong>\n";
	}
}

?>