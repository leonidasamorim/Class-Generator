<?
include_once dirname(__FILE__)."/class.InterfaceHTML.php";

class DetHTML extends InterfaceHTML{

	function DetHTML(){
		$this->InterfaceHTML();
	}
	
	function getDet($table){
		return $this->templateTela($table,array($this->getConteudo($table)));	
	}
	
	function getConteudo($table){
		$nCaption = "Detalhe ".ucfirst($table->getNameF());
		$vetFields = $table->getVetFields();
		for($i=0;$i<count($vetFields);$i++){
			//problem maping Language
			$valor = "<?=\$".$table->getNameF()."->get".ucfirst($vetFields[$i]->getNameF())."()?>";
			$label = ucfirst($vetFields[$i]->getNameF()).":";
			$vetTag[] = array("td","itemForm",$label,$valor);
		}
		$vetTag[] = array("td","","",new A(array(new Tag("Voltar")),"adm".ucfirst($table->getNameF()).".php"));
		return $this->getTableHTML($vetTag,$nCaption);
	}

}

?>