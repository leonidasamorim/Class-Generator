<?
include_once dirname(__FILE__)."/class.Tr.php";

class TableHtml extends Tag{
	var $caption;
	var $border;
	var $width;

	function TableHtml($vetTag,$caption='',$border='',$width=''){
		$this->Tag('',$vetTag);
		$this->caption = $caption;
		$this->border = $border;
		$this->width = $width;
	}
	
	function getBorder(){
		return ($this->border != '')?" border='".$this->border."'":'';
	}
	
	function setBorder($border){
		$this->border = $border;
	}
	
	function getCaption(){
		return ($this->caption)?$this->caption->getConteudo():'';
	}
	
	function setCaption($caption){
		$this->caption = $caption;
	}
	
	
	function getWidth(){
		return ($this->width != '')?" width='".$this->width."'":'';
	}
	
	function setWidth($width){
		$this->width = $width;
	}
	
	function getConteudo(){
		$text = "<TABLE".$this->getBorder().$this->getWidth().">\n".
				$this->getCaption().
				$this->getVetTag().
				"</TABLE>\n";		
		return $text;
	}
	
}
?>