<?

class A extends Tag{
	
	var $href;
	var $vetTag;
	
	function A($vetTag,$href){
		$this->href = $href;
		$this->vetTag = $vetTag;
	}
	
	function getHref(){
		return ($this->href)?" href='".$this->href."'":"";
	}
	
	function setHref($href){
		$this->href = $href;
	}
	
	function getVetTag(){
		if($this->vetTag && is_array($this->vetTag))
			for($i=0;$i<count($this->vetTag);$i++){
				$text .= $this->vetTag[$i]->getConteudo();
			}
		return $text;
	}
	
	function setVetTag($vetTag){
		$this->vetTag = $vetTag;
	}
	
	function getConteudo(){
		return "<a".$this->getHref().">".$this->getVetTag()."</a>";
	}
}
?>