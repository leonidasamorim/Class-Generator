<?
include_once dirname(__FILE__)."/class.Tag.php";

class Div extends Tag{
	var $id;

	function Div($id='',$vetTags=''){
		$this->Tag('',$vetTags);
		$this->id = $id;
	}
	
	function getId(){
		return ($this->id)?" id='".$this->id."'":"";
	}
	
	function setId($id){
		$this->id = $id;
	}
	
	function getConteudo(){
		return "<div".$this->getId().">\n".
					$this->getVetTag().
				"</div>\n";
	}
	
}
?>