<?
include_once dirname(__FILE__)."/class.Classe.php";
include_once dirname(__FILE__).'/class.Facade.php';

class MetaCadBDPai extends Classe{
	
	var $sql;
		
	function MetaCadBDPai($tipoBanco,$table,$util){
		$this->Classe("Cad".ucfirst($table->getNameF())."BD_Pai",$table,$util);
		$this->sql = Factory::createSQL($tipoBanco);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->includes();
		$texto .= $this->dClasse("CadBD");
		$texto .= $this->construtor();
		$texto .= $this->inserir($table->getVetFields(),$table->getVetPK());
		if($table->getVetPK()){
			if($table->getVetNK())
				$texto .= $this->alterar($table->getVetFields(),$table->getVetPK(),$table->getVetNK());
			$texto .= $this->excluir($table->getVetPK());
			$texto .= $this->get($table->getVetPK());
		}
		$texto .= $this->getAll($table->getVetPK());
		$texto .= $this->getMetodosCadastrados();
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//inicio e comentários
	function includes(){
  		return  "include_once dirname(__FILE__).'../../class.CadBD.php';\n\n";
	}
		
	// Método construtor
	function construtor(){
  		$texto  = 	"  function ".$this->getNome()."(\$conexao = \"\"){\n".
  					"    \$this->CadBD(\$conexao);\n".
  					"  }\n\n";
  		return $texto;
	}
	
	function inserir($vetFields,$vetPK){
		$texto  = "  function inserir".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$texto .= "$".$vetFields[$j]->getNameF().(($j != (count($vetFields)-1))?", ":") { \n");
		$texto .= "    \$sql = \"".$this->sql->insert($this->getTable(),$vetFields)."\";\n";
		if(($vetPK) && ($field = array_shift($vetPK)) && (stristr($field->getExtra(),"auto_increment")))
			$texto .= "    return \$this->executarInsAuto(\$sql);\n  }\n\n";
		else
			$texto .= "    return \$this->executarIUD(\$sql);\n  }\n\n";
		return $texto;
	}
	
	function alterar($vetFields,$vetPK,$vetNK){
		$texto  = 	"  function alterar".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$texto .= "$".$vetFields[$j]->getNameF().(($j != (count($vetFields)-1))?", ":") { \n");
		$texto .= 	"    \$sql = \"".$this->sql->update($this->getTable(),$vetPK,$vetNK)."\";\n".
					"    return \$this->executarIUD(\$sql);\n  }\n\n";
		return $texto;
	}
	
	function excluir($vetPK){
		$texto  = 	"  function excluir".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetPK);$j++)
			$texto .= "$".$vetPK[$j]->getNameF().(($j != (count($vetPK)-1))?", ":") { \n");
		$texto .= 	"    \$sql = \"".$this->sql->delete($this->getTable(),$vetPK)."\";\n".
					"    return \$this->executarIUD(\$sql);\n  }\n\n";
		return $texto;
	}
	
	

	function get($vetPK){
		$texto  = "  function get".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetPK);$j++)
			$texto .= "$".$vetPK[$j]->getNameF().(($j != (count($vetPK)-1))?", ":") { \n");
		$texto .= 	"    \$sql = \"".$this->sql->selectPK($this->getTable(),$vetPK)."\";\n".
					"    \$rs = \$this->con->execute(\$sql);\n".
					"    return \$this->con->fetch_array(\$rs);\n  }\n\n";
		return $texto;
	}
	
	function getAll($vetPK){
		$texto  = "  function getAll".ucfirst($this->table->getNameF())."(\$ini,\$num) { \n";
		$texto .= 	"    \$sql = \"".$this->sql->selectAll($this->getTable(),$vetPK)."\";\n".
					"    if((\$ini !== NULL) && (\$num !== NULL))\n".
					"	    \$sql .=\"".$this->sql->limit()."\";\n".
					"    \$rs = \$this->con->execute(\$sql);\n".
					"    return \$this->con->fetch_array(\$rs);\n  }\n\n";
		return $texto;
	}
	
	function getMetodosCadastrados(){
		//código na marra , acho que este gera qualquer método
		$facade = new Facade();
		$vetMetodos = $facade->getMetodosClasseArquiteturaTab(5,$this->table->getName(),$this->table->getNameDB());
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
					$texto .= $this->metodo($metodo->getNome(),"S",$vetNomeParametro,$metodo->getSql(),$metodo->getTipoRetorno());
				}
			}
		//fim do código na marra
		return $texto;
	}
		
		
	function metodo($nome,$tipo,$vetNomeParametro,$sql,$retorno){	
		$texto  = "  function $nome(";
		for($i=0;$i<count($vetNomeParametro);$i++)
			$texto .= "$".$vetNomeParametro[$i].(($i != (count($vetNomeParametro)-1))?", ":"");
		$texto .= ") { \n";
		$texto .= "    \$sql = \"".stripslashes($sql)."\";\n";
		if(($tipo == "S") && ($retorno == "ARRAY")){
			$texto .=  	"    if((\$ini !== NULL) && (\$num !== NULL))\n".
						"	    \$sql .=\"".$this->sql->limit()."\";\n";
		}
		$texto .= "    \$rs = \$this->con->execute(\$sql);\n";
	    $texto .= "    return \$this->con->fetch_array(\$rs);\n  }\n\n";
		return $texto;
	}
}
?>