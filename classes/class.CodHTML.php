<?
include_once dirname(__FILE__)."/html/class.Html.php";
include_once dirname(__FILE__)."/html/class.Form.php";
include_once dirname(__FILE__)."/class.PhpHtml.php";
include_once dirname(__FILE__)."/class.InterfaceHTML.php";
include_once dirname(__FILE__)."/html/class.Caption.php";
include_once dirname(__FILE__)."/html/class.Tr.php";
include_once dirname(__FILE__)."/html/class.Img.php";
include_once dirname(__FILE__)."/html/class.A.php";
include_once dirname(__FILE__)."/html/class.Td.php";
include_once dirname(__FILE__)."/html/class.Th.php";
include_once dirname(__FILE__)."/html/class.TableHtml.php";
include_once dirname(__FILE__)."/html/class.Strong.php";
include_once dirname(__FILE__)."/html/class.Script.php";
include_once dirname(__FILE__)."/html/class.ImportStyle.php";
include_once dirname(__FILE__)."/html/class.Title.php";
include_once dirname(__FILE__)."/html/class.Div.php";
include_once dirname(__FILE__)."/html/class.DD.php";
include_once dirname(__FILE__)."/html/class.DT.php";
include_once dirname(__FILE__)."/class.FieldToHTML.php";
include_once dirname(__FILE__)."/class.JavaScript.php";
include_once dirname(__FILE__)."/class.AdmHTML.php";
include_once dirname(__FILE__)."/class.EditHTML.php";
//include_once dirname(__FILE__)."/class.CadTML.php";
include_once dirname(__FILE__)."/class.DetHTML.php";

class CodHTML{
	var $phpHtml;
	var $table;

	function CodHTML($basica,$table){
		//falta portar
		$this->phpHtml = new PhpHtml($basica);
		$this->table = $table;
	}
	
	function getTable(){
		return $this->table;
	}
	
	function setTable($table){
		$this->table = $table;
	}
	
	function cad(){
		$intHTML = new InterfaceHTML();
		$div = new Div("divConteudo",array($this->getForm($this->getTable(),"cad")));
		$javaScript = new JavaScript($this->getTable());
		$tagJavaScript = new Tag($javaScript->getResult());
		$head = new Head(array($intHTML->getInclude1()));
		$body = new Body(array($intHTML->getInclude2(),$div,$tagJavaScript,$intHTML->getInclude3()));
		$html = new Html($body,$head);
		return $this->phpHtml->inserir().$html->getConteudo();
	}
	
	function edit($estilo){
		$editHTML = new EditHTML();
		if($estilo == "assai")
			return $this->phpHtml->editDel().$editHTML->getEditTradicional($this->getTable());
		else
			return $this->phpHtml->editCheck().$editHTML->getEditTradicional($this->getTable());
	}
	
	function del($estilo){
		if($estilo == "assai")
			return "";
		else
			return $this->phpHtml->delCheck();
	}
	
	function adm($estilo){
		$admHTML = new AdmHTML();
		if($estilo == "assai")
			return $this->phpHtml->getAll().$admHTML->getAdmTradicional($this->getTable());
		else
			return $this->phpHtml->getAll().$admHTML->getAdmCheck($this->getTable());
	}
	
	function det($estilo){
		$detHTML = new detHTML();
		//if($estilo == "assai")
		//	return $this->phpHtml->getObjeto().$detHTML->getDet($this->getTable());
		//else
			return $this->phpHtml->getObjetoCheck().$detHTML->getDet($this->getTable());
	}
	
	function getMenu(){
		$a1 = new A(array(new Tag("Cadastrar")),"cad".ucfirst($this->table->getNameF()).".php");
		$a2 = new A(array(new Tag("Gerenciar")),"adm".ucfirst($this->table->getNameF()).".php");
		$dt = new DT(ucfirst($this->table->getNameF()),array(new DD(array($a1)),new DD(array($a2))));
		return $dt->getConteudo();
	}
	
	function getCabecalho($titulo,$style,$script){
		$vetTag = array(new Title($titulo),new ImportStyle("text/css","scripts/".$style), new Script("javaScript","scripts/".$script));
		return new Head($vetTag);
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
	
	function getTableHTML($vetLinhas,$nCaption=""){		
		if($nCaption)
			$caption = new Caption($nCaption);
		$numCols = 0;
		for($i=0;$i<count($vetLinhas);$i++){
			$vetTag = "";
			$colspan = 1;
			for($j=2;$j<count($vetLinhas[$i]);$j++){
				if($vetLinhas[$i][0] == "th")
					$vetTag[] = new Th(array($vetLinhas[$i][$j]),"col");
				elseif($vetLinhas[$i][0] == "text")
					$vetTr[] = new Tag($vetLinhas[$i][$j]);
				elseif($vetLinhas[$i][$j])
					$vetTag[] = new Td(array($vetLinhas[$i][$j]),$colspan,'','',($vetLinhas[$i][1] && $j=="2")?$vetLinhas[$i][1]:'');
				else
					$colspan++;
			}
			if($vetTag)
				$vetTr[] = new Tr($vetTag);
		}
		return new TableHtml($vetTr,$caption,'');
	}
}

?>