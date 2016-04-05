<?
include_once dirname(__FILE__)."/class.T.php";

class Th extends T{
	var $scope;

	function Th($vetTag, $scope ='',$width='',$heigth='',$class='',$align='',$valign='',$background='',$style='',$bgColor=''){
		$this->scope = $scope;
		$this->T($vetTag,$width,$heigth,$class,$align,$valign,$background,$style,$bgColor);
	}
	
	function getScope(){
		return ($this->scope)?" scope='".$this->scope."'":"";
	}
	
	function setScope($scope){
		$this->scope = $scope;
	}
		
	function getConteudo(){
		$text = "<th".$this->getScope().$this->getWidth().$this->getHeigth().$this->getClass().$this->getAlign().$this->getValign().$this->getBackground().$this->getStyle().">".
				$this->getVetTag().
				"</th>\n";
		return $text;
	}
}
?>