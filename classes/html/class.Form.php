<?
include_once dirname(__FILE__)."/class.Elemento.php";


class Form extends Tag{

	var $name;
	var $action;
	var $method;
	var $onSubmit;

	function Form($name, $action, $method, $onSubmit, $vetTag){
		$this->name = $name;
		$this->action = $action;
		$this->method = $method;
		$this->onSubmit = $onSubmit;
		$this->Tag("",$vetTag);
	}

	function getName(){
		return " name='".$this->name."'";
	}

	function getAction(){
		return " action='".$this->action."'";
	}

	function getMethod(){
		return " method='".$this->method."'";
	}

	function getOnSubmit(){
		return ($this->onSubmit)?" onSubmit='".$this->onSubmit."'":"";
	}
	
	function setName($name){
		$this->name = $name;
	}

	function setAction($action){
		$this->action = $action;
	}

	function setMethod($method){
		$this->method = $method;
	}
	
	function setOnSubmit($onSubmit){
		$this->onSubmit = $onSubmit;
	}
	
	function getConteudo(){
		$conteudo = "<FORM".$this->getName().$this->getMethod().$this->getAction().$this->getOnSubmit().">\n".
								$this->getVetTag().
								"</FORM>\n";
		return $conteudo;
	}
	
}
?>