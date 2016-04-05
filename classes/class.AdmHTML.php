<?
include_once dirname(__FILE__)."/class.InterfaceHTML.php";

class AdmHTML extends InterfaceHTML{

	function AdmHTML(){
		$this->InterfaceHTML();
	}
	
	function getAdmTradicional($table){
		$tituloPagina = "Ger&ecirc;ncia de ".ucfirst($table->getNameF());
		$vetFields = $table->getVetFields();
		$vetPK	= $table->getVetPK();
		$vetTh = array("th","");
		$vetTd = array("td","");
		$vetTd1 = array("td","");
		
		/* php embutido */
		for($i=0;$i<count($vetFields);$i++){
			if(!($vetFields[$i]->getPK() && $vetFields[$i]->getExtra() == "auto_increment")){
				$vetTh[] = ucfirst($vetFields[$i]->getNameF());
				$vetTd[] = "<?=$".$table->getNameF()."->get".ucfirst($vetFields[$i]->getNameF())."();?>";
				$vetTd1[] = "";
			}
		}
		
		
		//link e imagem edicao
		$img  = new Img("./imagens/edit.gif","Editar");
		$href = "edit".ucfirst($table->getNameF()).".php?";
		if($vetPK)
	  	while($field = array_shift($vetPK))
				$href .= $field->getNameF()."=<?=$".$table->getNameF()."->get".ucfirst($field->getNameF())."()?>".((0 != count($vetPK))?"&":"");
		$hrefEd = $href."&acao=editar";
		$a = new A(array($img),$hrefEd);
		//fim link e imagem edi�o
		$vetTd[] = $a;
		$vetTh[] = "&nbsp;";
		//link e imagem exclus�
		$img  = new Img("./imagens/del.gif","Excluir");
		$href = $href."&acao=excluir";
		$a->setVetTag(array($img));
		$a->setHref($href);
		//fim link e imagem exclus�
		$vetTd[] = $a;
		$vetTh[] = "&nbsp;";
		
		$strong = new Strong("N&atilde;o h&aacute; nenhum registro cadastrado!");
		$vetTd1 = array_merge($vetTd1,array("","",$strong));
		
		$textPHP = 	"<?\n".
				   	"\tif (\$vet".ucfirst($table->getNameF())."){\n".
				   	"\t\twhile ($".$table->getNameF()." = array_shift(\$vet".ucfirst($table->getNameF()).")){\n?>\n";
		$textPHP2 =	"<?\n".
					"\t}}else{\n?>\n";
		$textPHP3 = "<?\n".
					"\t}\n?>\n";
		
		$vetTr = array($vetTh,array("text","",$textPHP),$vetTd,array("text","",$textPHP2),$vetTd1,array("text","",$textPHP3));
		return $this->templateAdm(array($this->getTableHTML($vetTr,$tituloPagina)));
	}
	
	function getAdmCheck($table){
		$tituloPagina = "Ger&ecirc;ncia de ".ucfirst($table->getNameF());
		$vetFields = $table->getVetFields();
		$vetPK	= $table->getVetPK();
		$vetTh = array("th","");
		$vetTd = array("td","");
		
		$vetTh[] = "&nbsp;";

		if($vetPK){
			$valor = "<?=Util::Encode(";
			while($field = array_shift($vetPK))
				$valor .= "$".$table->getNameF()."->get".ucfirst($field->getNameF())."()".((0 != count($vetPK))?",":"");
			$valor .= ")?>";
		}
			
		$vetTd[] = new InputRadio($valor,"rdOpcao");
		
		for($i=0;$i<count($vetFields);$i++){
			if(!($vetFields[$i]->getPK() && $vetFields[$i]->getExtra() == "auto_increment")){
				$vetTh[] = ucfirst($vetFields[$i]->getNameF());
				$vetTd[] = "<?=$".$table->getNameF()."->get".ucfirst($vetFields[$i]->getNameF())."();?>";
			}
		}

		$btnExlcuir = new InputButton("Excluir","btnExcluir",'','','buttonForm','submitForm(document.formAction, "del'.ucfirst($table->getNameF()).'.php",true);');
		$btnEditar = new InputButton("Editar","btnEditar",'','','buttonForm','submitForm(document.formAction, "edit'.ucfirst($table->getNameF()).'.php",false);');
		$btnDetalhes = new InputButton("Detalhes","btnDetalhes",'','','buttonForm','submitForm(document.formAction, "det'.ucfirst($table->getNameF()).'.php",false);');
		$divBotoes = new Div('botoesAcao',array($btnExlcuir,$btnEditar,$btnDetalhes));
		
		$strong = new Strong("N&atilde;o h&aacute; nenhum registro cadastrado!");
				
		$textPHP =  "<?\n"."\tif (\$vet".ucfirst($table->getNameF())."){\n"
				."\t\twhile ($".$table->getNameF()." = array_shift(\$vet".ucfirst($table->getNameF()).")){\n?>\n";
		$textPHP3 = "<?\n"."\t}\n?>\n";
		$tagPHP1 = new Tag("<?\n"."\t}else{\n?>\n</TABLE>\n");
		$tagPHP2 = new Tag($textPHP3);
			
		$vetTr = array($vetTh,array("text","",$textPHP),$vetTd,array("text","",$textPHP3));
		$form = new Form('formAction', '', 'POST', '',array($this->getTableHTML($vetTr),$divBotoes,$tagPHP1,$strong,$tagPHP2));
		$divTitulo = new Div('tituloPagina',array(new Div('divImagemMarcador'),new Tag($tituloPagina)));
		return $this->templateAdm(array($divTitulo,$form));
	}
	
	
}

?>