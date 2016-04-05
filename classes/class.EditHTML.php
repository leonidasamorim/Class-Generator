<?
include_once dirname(__FILE__)."/class.InterfaceHTML.php";

class EditHTML extends InterfaceHTML{

	function EditHTML(){
		$this->InterfaceHTML();
	}
	
	function getEditTradicional($table){
		return $this->templateFormCadastro($table,array($this->getForm($table,"edit")));	
	}

}

?>