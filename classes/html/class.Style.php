<?

class Style{

	var $type;
	var $src;
	var $text;
	
	function Style($type,$src,$text=''){
		$this->type 		= $type;
		$this->src			= $src;
		$this->text			= $text;		
	}
	
	function getSrc(){
	 		return $this->src;
	}
	
	function getType(){
	 		return " type='".$this->type."'";
	}
	
	function getText(){
	 		return $this->text;
	}
	 
	function setType($type){
	 		$this->type = $type;
	}
	 
	function setSrc($src){
	 		$this->src = $src;
	}
	 
	function setText($text){
			$this->text = $text;
	}
	
	function getConteudo(){
		return "<style".$this->getType().">\n".$this->getText()."\n</style>\n";
	}
	
}
?>