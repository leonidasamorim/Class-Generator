<?
class Script{
	
	var $text;
	var $language;
	var $src;
	
	function Script($language,$src,$text=''){
		$this->language = $language;
		$this->src			= $src;
		$this->text			= $text;
	}
	
	 function getLanguage(){
		 	return " language='".$this->language."'";
	 }
	 
	 function getSrc(){
	 		return " src='".$this->src."'";
	 }
	 
	 function getText(){
	 		return ($this->text)?$this->text:'';
	 }
	 
	 function setLanguage($language){
	 		$this->language = $language;
	 }
	 
	 function setSrc($src){
	 		$this->src = $src;
	 }
	 
	 function setText($text){
	 		$this->text = $text;
	 }
	 
	 function getConteudo(){
	 		return "<script".$this->getLanguage().$this->getSrc().">\n".$this->getText()."</script>\n";
	 }
	 
}
?>