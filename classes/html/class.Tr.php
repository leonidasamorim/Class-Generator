<?
include_once dirname(__FILE__)."/class.T.php";

/* falta implemnetar as ondas que o dreamweaver faz, ou seja, quando se setar a largura da linha, automaticamente seta-se a largura de todas as colunas e não da linha em si
não esquecer disso

falta barrar conteudo diferente das td e th
*/

class Tr extends T{

	var $onMouseOver;
	var $onMouseOut;
	
	function Tr($vetTag,$width='',$heigth='',$class='',$align='',$valign='',$background='',$style='',$bgColor='',$onMouseOver='',$onMouseOut=''){
		$this->onMouseOver = $onMouseOver;
		$this->onMouseOut = $onMouseOut;
		$this->T($vetTag,$width,$heigth,$class,$align,$valign,$background,$style,$bgColor);
	}
	
	function getOnMouseOver(){
		return $this->onMouseOver;
	}
	
	function setOnMouseOver($onMouseOver){
		$this->onMouseOver = $onMouseOver;
	}
	
	function getOnMouseOut(){
		return $this->onMouseOut;
	}
	
	function setOnMouseOut($onMouseOut){
		$this->onMouseOut = $onMouseOut;
	}
	
	function getConteudo(){
		$text = "<tr".$this->getClass().$this->getAlign().$this->getValign().$this->getBackground().">\n".
				$this->getVetTag().
				"</tr>\n";
		return $text;
	}
	
}
?>