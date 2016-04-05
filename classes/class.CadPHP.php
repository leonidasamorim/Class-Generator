<?
include_once dirname(__FILE__)."/class.CadPai.php";

class CadPHP extends CadPai{
		
	function CadPHP($table,$util,$projeto){
		$atributos = array("cad".ucfirst($table->getNameF())."BD");
		$this->Classe("Cad".ucfirst($table->getNameF())."_Pai",$table,$util,$atributos,'',$projeto);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->includes();
		$texto .= $this->dClasse();
		$texto .= $this->construtor();
		$texto .= $this->metodo("inserir".ucfirst($this->table->getNameF()),$this->table->getVetFields());
		$texto .= ($this->table->getVetPK())?$this->metodo("alterar".ucfirst($this->table->getNameF()),$this->table->getVetFields()):'';
		$texto .= ($this->table->getVetPK())?$this->metodo("excluir".ucfirst($this->table->getNameF()),$this->table->getVetPK()):'';
		$texto .= $this->arrayToObject();
		$texto .= ($this->table->getVetPK())?$this->get():'';
		$texto .= $this->getAll();
		$texto .= $this->getMetodosCadastrados();
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//inicio e comentï¿½rios
	function includes(){
  		return  "include_once dirname(__FILE__).'/class.Cad".ucfirst($this->table->getNameF())."BD.php';\n".
  				"include_once dirname(__FILE__).'/class.".ucfirst($this->table->getNameF()).".php';\n\n";
	}

	// Mï¿½todo construtor
	function construtor(){
  		$texto  = "  function ".$this->getNome()."(\$conexao = ''){\n";
  		$texto .= "    \$this->cad".ucfirst($this->table->getNameF())."BD = new Cad".ucfirst($this->table->getNameF())."BD(\$conexao);\n";
  		$texto .= "  }\n\n";
  		return $texto;
	}

	function metodo($nome,$atts){
		$texto  = "  function $nome($".$this->table->getNameF().") { \n";
		$texto .= "    return \$this->cad".ucfirst($this->table->getNameF())."BD->$nome(";
		for($j=0;$j<count($atts);$j++){
			if($atts[$j]->getCategory() == "date"){
				$textoI = "Util::converteDataBanco(";
				$textoF = ")";
			}elseif ($atts[$j]->getCategory() == "string") {
				$textoI = "addslashes(htmlspecialchars (";
				$textoF = "))";
			}
			
			
			$texto .= $textoI."$".$this->table->getNameF()."->get".ucfirst($atts[$j]->getNameF())."()".$textoF;
			$texto .= (($j != (count($atts)-1))?", ":");\n  }\n\n");
			$textoI = $textoF = '';
		}
		return $texto;
	}
	
	function arrayToObject(){
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  function arrayToObject(\$va){ \n";
		$texto .= "    return new ".ucfirst($this->table->getNameF())."(";
		while($field = array_shift($vetFields))
			$texto .= "\$va['".strtolower($field->getName())."']".((count($vetFields) != 0)?", ":");\n");
		$texto .= "  }\n\n";
		return $texto;
	}

	function get(){
		$vetPK 			= $this->table->getVetPK();
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  function get".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetPK);$j++)
				$texto .= "$".$vetFields[$j]->getNameF().(($j != (count($vetPK)-1))?", ":") { \n");
		$texto.= "    if(\$rs = \$this->cad".ucfirst($this->table->getNameF())."BD->get".ucfirst($this->table->getNameF())."(";
		while($field = array_shift($vetPK))
				$texto .= "$".$field->getNameF().((count($vetPK) != 0)?", ":"");
		$texto .= "))\n      return \$this->arrayToObject(array_shift(\$rs));\n";
		$texto .= "    else\n      return false;\n  }\n\n";
		return $texto;
	}
	
	function getAll(){
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  function getAll".ucfirst($this->table->getNameF())."(\$ini,\$num) { \n";
		$texto .= "    if(\$rs = \$this->cad".ucfirst($this->table->getNameF())."BD->getAll".ucfirst($this->table->getNameF())."(\$ini,\$num))\n";
		$texto .= "      while(\$va = array_shift(\$rs))\n";
		$texto .= "        \$vet[] = \$this->arrayToObject(\$va);\n";
		$texto .= "    else\n      return false;\n";
		$texto .= "    return \$vet;\n  }\n\n";
		return $texto;
	}
	
	function getMetodosCadastrados(){
		//cï¿½digo na marra , acho que este gera qualquer mï¿½todo
		$facade = new Facade();
		$vetMetodos = $facade->getMetodosClasseArquiteturaTab(4,$this->table->getName(),$this->getProjeto());
		if($vetMetodos)
			while ($metodo = array_shift($vetMetodos)) {  
				if($metodo->getCodigo()){
					$texto .= "  ".str_replace("\n","\n  ",$metodo->getCodigo())."\n";
					$texto = stripslashes($texto);
				}else{
					$vetNomeParametro = NULL;
					$vetParametros = $facade->getParametrosMetodo($metodo->getCodMetodo());
					if($vetParametros)
						while ($metodoparametro = array_shift($vetParametros)){
							$parametro = $facade->getParametro($metodoparametro->getCodParametro());
							$vetNomeParametro[] = $parametro->getNome();
						}
					if(($metodo->getTipoMetodo() == "S") && ($metodo->getTipoRetorno() == "ARRAY")){
						$vetParPadrao = array("ini","num");
						$vetNomeParametro = ($vetNomeParametro)?array_merge($vetNomeParametro,$vetParPadrao):$vetParPadrao;
					}
					//tah fixando o tipo do método, isso tem que mudar.
					$texto .= $this->newMetodo($metodo->getNome(),"S",$vetNomeParametro,$metodo->getTipoRetorno());
				}
			}
		//fim do cï¿½digo na marra
		return $texto;
	}
		
		
	function newMetodo($nome,$tipo,$vetNomeParametro,$tipoRetorno=''){	
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  function $nome(";
		for($i=0;$i<count($vetNomeParametro);$i++)
			$texto .= "$".$vetNomeParametro[$i].(($i != (count($vetNomeParametro)-1))?", ":"");
		$texto .= ") { \n";
		$texto .= "    if(\$rs = \$this->cad".ucfirst($this->table->getNameF())."BD->$nome(";
		for($i=0;$i<count($vetNomeParametro);$i++)
			$texto .= "$".$vetNomeParametro[$i].(($i != (count($vetNomeParametro)-1))?", ":"");
		$texto .= ")){\n";
		
		/*$auxTexto = "new ".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$auxTexto .= "\$va['".strtolower($vetFields[$j]->getName())."']".(($j != (count($vetFields)-1))?", ":"");
		$auxTexto .= ");\n";*/
		
		if($tipoRetorno == "OBJ")
			$texto .= "      return \$this->arrayToObject(array_shift(\$rs));\n";
		elseif($tipoRetorno == "ARRAY"){
			$texto .= "      while(\$va = array_shift(\$rs))\n";
			$texto .= "        \$vet[] = \$this->arrayToObject(\$va);\n";
			$texto .= "      return \$vet;\n";
		}
		$texto .= "    }else\n      return false;\n    }\n\n";
		return $texto;
	}
	
}
?>