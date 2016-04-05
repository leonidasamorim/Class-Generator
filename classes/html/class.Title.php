<?

class Title{
	
	var $text;

	function Title($text){
		$this->text = $text;
	}
	
	function getText(){
		return $this->text;
	}
	
	function setText($text){
		$this->text = $text;
	}
	
	function getConteudo(){
		return "<title>".$this->getText()."</title>\n";
	}
	
}

?>