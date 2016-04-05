<?
include_once dirname(__FILE__)."/class.Body.php";
include_once dirname(__FILE__)."/class.Head.php";
include_once dirname(__FILE__)."/class.InputText.php";
include_once dirname(__FILE__)."/class.InputRadio.php";
include_once dirname(__FILE__)."/class.InputCheck.php";
include_once dirname(__FILE__)."/class.InputSubmit.php";
include_once dirname(__FILE__)."/class.InputButton.php";
include_once dirname(__FILE__)."/class.InputFile.php";
include_once dirname(__FILE__)."/class.TextArea.php";

class Html {
	var $body;
	var $head;
	
	function Html($body, $head) {
		$this->body = $body;
		$this->head = $head;
	}
	
	function getHead(){
		return $this->head->getConteudo();
	}

	function getBody(){
		return $this->body->getConteudo();
	}

	function setHead($head){
		$this->head = $head;
	}

	function setBody($body){
		$this->body = $body;
	}
	
	function getConteudo() {
		return "<HTML>\n".$this->getHead().$this->getBody()."</HTML>";
	}

}
?>
