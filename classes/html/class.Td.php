<?

class Td extends T{

	function Td($vetTag,$colspan='',$width='',$heigth='',$class='',$align='',$valign='',$background='',$style='',$bgColor=''){
		$this->colspan = $colspan;
		$this->T($vetTag,$width,$heigth,$class,$align,$valign,$background,$style,$bgColor);
	}
		
	function getColSpan(){
		return (($this->colspan) && ($this->colspan>1))?" colspan='".$this->colspan."'":"";
	}
	
	function setColSpan($colspan){
		$this->colspan = $colspan;
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
		return ($this->class)?" class='".$this->class."'":'';
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
	
	function getConteudo(){
		$text = "<td".$this->getColSpan().$this->getWidth().$this->getHeigth().$this->getClass().$this->getAlign().$this->getValign().$this->getBackground().$this->getStyle().">".
				$this->getVetTag().
				"</td>\n";
		return $text;
	}
}
?>