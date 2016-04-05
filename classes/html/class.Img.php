<?

class Img extends Tag{
	
	var $src;
	var $alt;
	var $border;

	function Img($src,$alt='',$border=''){
		$this->src 		= $src;
		$this->alt 		= $alt;	
		$this->border 	= $border;
	}
	
	function getSrc(){
		return ($this->src)?" src='".$this->src."'":"";
	}
	
	function setSrc($src){
		$this->src = $src;
	}
	
	function getAlt(){
		return ($this->alt)?" alt='".$this->alt."'":"";
	}
	
	function setAlt($alt){
		$this->alt = $alt;
	}
	
	function getBorder(){
		return ($this->border)?" border='".$this->border."'":"";
	}
	
	function setBorder($border){
		$this->border = $border;
	}
	
	function getConteudo(){
		return "<img ".$this->getSrc().$this->getAlt().$this->getBorder().">";
	}
}
?>