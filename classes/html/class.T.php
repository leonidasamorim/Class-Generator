<?
include_once dirname(__FILE__)."/class.Tag.php";

class T{
	
	var $vetTag;
	var $width;
	var $heigth;
	var $class;
	var $align;
	var $valign;
	var $background;
	var $style;
	var $bgColor;

	function T($vetTag,$width='',$heigth='',$class='',$align='',$valign='',$background='',$style='',$bgColor=''){
		$this->vetTag = $vetTag;
		$this->width = $width;
		$this->heigth = $heigth;
		$this->class = $class;
		$this->align = $align;
		$this->valign = $valign;
		$this->background = $background;
		$this->style = $style;
	}
	
	function setVetTag($vetTag){
		$this->vetTag = $vetTag;
	}
	
	function setWidth($width){
		$this->width = $width;
	}
	
	function getWidth(){
		return $this->width;
	}
	
	function setHeigth($heigth){
		$this->heigth = $heigth;
	}
	
	function getHeigth(){
		return $this->heigth;
	}
		
	function setClass($class){
		$this->class = $class;
	}
	
	function getClass(){
		return $this->class;
	}
	
	function setAlign($align){
		$this->align = $align;
	}
	
	function getAlign(){
		return $this->align;
	}
	
	function setValign($valign){
		$this->valign = $valign;
	}
	
	function getValign(){
		return $this->valign;
	}
	
	function setBackground($background){
		$this->background = $background;
	}
	
	function getBackground(){
		return $this->background;
	}
	
	function setStyle($style){
		$this->style = $style;
	}
	
	function getStyle(){
		return $this->style;
	}
	
	function getBgColor(){
		return $this->bgColor;
	}
	
	function setBgColor($bgColor){
		$this->bgColor = $bgColor;
	}
	
	function getConteudo(){
	}
	
	function getVetTag(){
		if($this->vetTag && is_array($this->vetTag))
			for($i=0;$i<count($this->vetTag);$i++){
				if(!is_object($this->vetTag[$i]))
					$this->vetTag[$i] = new Tag($this->vetTag[$i]);
				$text .= $this->vetTag[$i]->getConteudo();
			}
		return $text;
	}
}
?>