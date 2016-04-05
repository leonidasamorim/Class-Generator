<?

class Tag{
	
	var $text;
	var $vetTag;
	
	function Tag($text,$vetTag=""){
		$this->text = $text;
		$this->vetTag = $vetTag;
	}
	
	function getText(){
		return $this->text;
	}
	
	function setText($text){ 
		$this->text = $text;
	}
	
	function getConteudo(){
		return $this->text;
	}
	
	function setVetTag($vetTag){
		$this->vetTag = $vetTag;
	}
	
	function getVetTag(){
		if($this->vetTag && is_array($this->vetTag))
			for($i=0;$i<count($this->vetTag);$i++){
				//print_r($this->vetTag[$i]);
				$text .= $this->vetTag[$i]->getConteudo();
			}
		return $text;
	}
}


?>