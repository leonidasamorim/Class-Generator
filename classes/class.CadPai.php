<?
include_once dirname(__FILE__)."/class.Classe.php";
include_once dirname(__FILE__)."/class.CadPHP.php";
include_once dirname(__FILE__)."/artefatos/class.CadJava.php";
//include_once dirname(__FILE__)."/artefatos/class.BasicaPhyton.php";
include_once dirname(__FILE__).'/class.Facade.php';

class CadPai extends Classe{
		
	function CadPai($table,$util,$projeto){
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
		$texto .= ($this->table->getVetPK())?$this->get():'';
		$texto .= $this->getAll();
		$texto .= $this->getMetodosCadastrados();
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//inicio e coment�rios
	function includes(){
  		return  "include_once dirname(__FILE__).'/class.Cad".ucfirst($this->table->getNameF())."BD.php';\n".
  				"include_once dirname(__FILE__).'/class.".ucfirst($this->table->getNameF()).".php';\n\n";
	}

	// M�todo construtor
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
			$texto .= "$".$this->table->getNameF()."->get".ucfirst($atts[$j]->getNameF())."()";
			$texto .= (($j != (count($atts)-1))?", ":");\n  }\n\n");
		}
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
		$texto .= ")){\n      \$va = array_shift(\$rs);\n";
		$texto .= "      return new ".ucfirst($this->table->getNameF())."(";
		while($field = array_shift($vetFields))
				$texto .= "\$va['".strtolower($field->getNameF())."']".((count($vetFields) != 0)?", ":");\n");
		$texto .= "    }else\n      return false;\n    }\n\n";
		return $texto;
	}
	
	function getAll(){
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  function getAll".ucfirst($this->table->getNameF())."(\$ini,\$num) { \n";
		$texto .= "    if(\$rs = \$this->cad".ucfirst($this->table->getNameF())."BD->getAll".ucfirst($this->table->getNameF())."(\$ini,\$num)){\n";
		$texto .= "      while(\$va = array_shift(\$rs))\n";
		$texto .= "        \$vet[] = new ".ucfirst($this->table->getNameF());
		$texto .= "(";
		for($j=0;$j<count($vetFields);$j++)
			$texto .= "\$va['".strtolower($vetFields[$j]->getNameF())."']".(($j != (count($vetFields)-1))?", ":");\n");
		$texto .= "      return \$vet;\n";
		$texto .= "    }else\n      return false;\n    }\n\n";
		return $texto;
	}
	
	function getMetodosCadastrados(){
		//c�digo na marra , acho que este gera qualquer m�todo
		$facade = new Facade();
		$vetMetodos = $facade->getMetodosClasseArquiteturaTab(4,$this->table->getName(),$this->getProjeto());
		if($vetMetodos)
			while ($metodo = array_shift($vetMetodos)) {  
				if($metodo->getCodigo())
					$texto .= $metodo->getCodigo()."\n";
				else{
					$vetNomeParametro = NULL;
					$vetParametros = $facade->getParametrosMetodo($metodo->getCodMetodo());
					if($vetParametros)
						while ($metodoparametro = array_shift($vetParametros)){
							$parametro = $facade->getParametro($metodoparametro->getCodParametro());
							$vetNomeParametro[] = $parametro->getNome();
						}
					$texto .= $this->newMetodo($metodo->getNome(),"S",$vetNomeParametro,$metodo->getTipoRetorno());
				}
			}
		//fim do c�digo na marra
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
		
		$auxTexto = "new ".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$auxTexto .= "\$va['".strtolower($vetFields[$j]->getNameF())."']".(($j != (count($vetFields)-1))?", ":"");
		$auxTexto .= ");\n";
		
		if($tipoRetorno == "OBJ"){
			$texto .= "      \$va = array_shift(\$rs);\n";
			$texto .= "      return $auxTexto";
		}elseif($tipoRetorno == "ARRAY"){
			$texto .= "      while(\$va = array_shift(\$rs))\n";
			$texto .= "        \$vet[] = $auxTexto";
			$texto .= "      return \$vet;\n";
		}
		$texto .= "    }else\n      return false;\n    }\n\n";
		return $texto;
	}
	
}
?>