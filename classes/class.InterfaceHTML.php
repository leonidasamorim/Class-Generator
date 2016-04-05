<?
include_once dirname(__FILE__)."/class.CodHTML.php";


class InterfaceHTML extends CodHTML{
	
	var $include1;
	var $include2;
	var $include3;

	function InterfaceHTML(){
		$this->include1 = new Tag("<?php include_once dirname(__FILE__).'/template/templateHeaders.php';?>\n");
		$this->include2 = new Tag("<?php include_once dirname(__FILE__).'/template/templateComeco.php';?>\n");
		$this->include3 = new Tag("<?php include_once dirname(__FILE__).'/template/templateFim.php';?>\n");
	}
	
	function getInclude1(){
		return $this->include1;
	}
	
	function getInclude2(){
		return $this->include2;
	}
	
	function getInclude3(){
		return $this->include3;
	}
	
	function templateTela($table,$vetTagsConteudo){
		$conteudo = new Div("divConteudo",$vetTagsConteudo);
		
		$head = new Head(array($this->getInclude1()));
		$body = new Body(array($this->getInclude2(),$conteudo,$this->getInclude3()));
		$html = new Html($body,$head);
		return $html->getConteudo();
	}
	
	function templateFormCadastro($table,$vetTagsConteudo){
		$conteudo = new Div("divConteudo",$vetTagsConteudo);
		
		$javaScript = new JavaScript($table);
		$tagJavaScript = new Tag($javaScript->getResult());
		
		$head = new Head(array($this->getInclude1()));
		$body = new Body(array($this->getInclude2(),$conteudo,$tagJavaScript,$this->getInclude3()));
		$html = new Html($body,$head);
		return $html->getConteudo();
	}
	
	function templateAdm($vetTagsConteudo){
		$paginacao = new Tag("<?=\$frontController->paginacao->paginas()?>\n");
		
		$vetTags = array_merge($vetTagsConteudo,array($paginacao));
		$conteudo = new Div("divConteudo",$vetTags);
		
		$msg = new Tag("<?=Util::getMsg(\$_GET['msg'])?>\n");
		
		$head = new Head(array($this->getInclude1()));
		$body = new Body(array($this->getInclude2(),$msg,$conteudo,$this->getInclude3()));
		$html = new Html($body,$head);
		return $html->getConteudo();
	}
	
	function getForm($table,$tipo){
		switch ($tipo){
			case "edit":
				$labelTipo = "Edi&ccedil;&atilde;o";
				break;
			case "cad":
				$labelTipo = "Cadastro";
				break;
		}
		$fieldToHTML = new FieldToHTML();
		
		$nCaption = "$labelTipo ".ucfirst($table->getNameF());
		$vetFields = $table->getVetFields();
		for($i=0;$i<count($vetFields);$i++){
			//problem maping Language
			if($tipo == "edit")
				$valor = "<?=\$".$table->getNameF()."->get".ucfirst($vetFields[$i]->getNameF())."()?>";
				
			$tag = $fieldToHTML->transformar($vetFields[$i],$valor);
			$label = ucfirst($vetFields[$i]->getNameF()).":";
			if($tag)
				$vetTag[] = array("td","itemForm",$label,$tag);
		}
		$vetTag[] = array("td","","",new InputSubmit("Salvar","btnSalvar","","","buttonForm"));
		$vetTags = array($this->getTableHTML($vetTag,$nCaption));
		return new Form("frm".ucfirst($table->getNameF()),$tipo.ucfirst($table->getNameF()).".php","POST","return formulario.validaForm();",$vetTags);
	}
	
	
}
?>