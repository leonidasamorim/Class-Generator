<?
include_once dirname(__FILE__)."/class.Classe.php";
include_once dirname(__FILE__).'/class.Facade.php';

class MetaCadBD extends Classe{
		
	function MetaCadBD($table,$util){
		$this->Classe("Cad".ucfirst($table->getNameF())."BD",$table,$util);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->dClasse("CadBD");
		$texto .= $this->construtor();
		$texto .= $this->inserir();
		$texto .= ($this->table->getVetPK())?$this->alterar():'';
		$texto .= ($this->table->getVetPK())?$this->excluir():'';
		$texto .= ($this->table->getVetPK())?$this->get():'';
		$texto .= $this->getAll();
		$texto .= $this->getMetodosCadastrados();
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//Declaração da Classe
	function dClasse($superClasse=''){
  		$texto  = "public class ".$this->getNome();
  		$texto .= ($superClasse)?" extends $superClasse{\n":"{\n";
  		// Atributos da classe
  		$texto .= "  private  Conexao conexao;\n\n";
  		$texto .= "\n";
  		return $texto;
	}
			
	// Mï¿½todo construtor
	function construtor(){
  		$texto  = "  public void ".$this->getNome()."(){\n";
  		$texto .= "    this.conexao = new Conexao();\n";
  		$texto .= "  }\n\n";
  		return $texto;
	}
	
	function inserir(){
		$vetFields = $this->table->getVetFields();
		$vetPK = $this->table->getVetPK();
		$texto  = "  public ResultSet inserir".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$texto .= Maping::typeLanguage($vetFields[$j],"Java")." ".$vetFields[$j]->getNameF().(($j != (count($vetFields)-1))?", ":") { \n");
		//SQL
		$texto .= "    String sql = \"INSERT INTO ".$this->table->getName()."\n";
      	$texto .= "                  VALUES(";
      	for($j=0;$j<count($vetFields);$j++)
			$texto .= "'".$vetFields[$j]->getNameF()."'".(($j != (count($vetFields)-1))?", ":")\";\n");
		//SQL
		if($vetPK && (count($vetPK) == 1)){
			$field = array_shift($vetPK);
			if(stristr($field->getExtra(),"auto_increment"))
				$texto .= "    return this.executarInsAuto(sql);\n  }\n\n";
			else
				$texto .= "    return this.executarIUD(sql);\n  }\n\n";
		}else{
			$texto .= "    return this.executarIUD(sql);\n  }\n\n";
		}
		return $texto;
	}
	
	function alterar(){
		$vetFields 	= $this->table->getVetFields();
		$vetPK			= $this->table->getVetPK();
		$vetNK			= $this->table->getVetNK();
		$texto  = "  function alterar".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$texto .= "$".$vetFields[$j]->getNameF().(($j != (count($vetFields)-1))?", ":") { \n");
		//SQL
		$texto .= "    \$sql = \"UPDATE ".$this->table->getName()."\n";
    $texto .= "                  SET\n";
    if($vetNK)
    	while($field = array_shift($vetNK))
				$texto .= "                    ".$field->getName()." = '$".$field->getNameF()."'".((0 != count($vetNK))?",\n":"\n                  WHERE\n");
		while($field = array_shift($vetPK))
			$texto .= "                    ".$field->getName()." = '$".$field->getNameF()."'".((0 != count($vetPK))?" AND \n":"\";\n");
		//SQL
		$texto .= "    return \$this->executarIUD(\$sql);\n  }\n\n";
		return $texto;
	}
	
	function excluir(){
		$vetPK	= $this->table->getVetPK();
		$texto  = "  function excluir".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetPK);$j++)
			$texto .= "$".$vetPK[$j]->getNameF().(($j != (count($vetPK)-1))?", ":") { \n");
		//SQL
		$texto .= "    \$sql = \"DELETE FROM ".$this->table->getName()."\n";
    $texto .= "                  WHERE\n";
		while($field = array_shift($vetPK))
			$texto .= "                    ".$field->getName()." = '$".$field->getNameF()."'".((0 != count($vetPK))?" AND \n":"\";\n");
		//SQL
		$texto .= "    return \$this->executarIUD(\$sql);\n  }\n\n";
		return $texto;
	}

	function get(){
		$vetPK	= $this->table->getVetPK();
		$texto  = "  function get".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetPK);$j++)
			$texto .= "$".$vetPK[$j]->getNameF().(($j != (count($vetPK)-1))?", ":") { \n");
		$texto .= "    \$sql = \"SELECT * FROM ".$this->table->getName()."\n";
    	$texto .= "                  WHERE\n";
		for($j=0;$j<count($vetPK);$j++)
			$texto .= "                    ".$vetPK[$j]->getName()." = '$".$vetPK[$j]->getNameF()."'".(($j != (count($vetPK)-1))?" AND \n":"\n");
		$texto .= "                  ORDER BY\n                    ";
		while($field = array_shift($vetPK))
				$texto .= $field->getName().((0 != count($vetPK))?", ":"\";\n");	
		$texto .= "    \$rs = \$this->con->execute(\$sql);\n";
		$texto .= "    return \$this->con->fetch_array(\$rs);\n  }\n\n";
		return $texto;
	}
	
	function getAll(){
		$texto  = "  function getAll".ucfirst($this->table->getNameF())."(\$ini,\$num) { \n";
		$texto .= "    \$sql = \"SELECT * FROM ".$this->table->getName()."\";\n";
		if($vetPK = $this->table->getVetPK()){
			$texto .= "    \$sql .= \" ORDER BY\n                    ";
			while($field = array_shift($vetPK))
				$texto .= $field->getName().((0 != count($vetPK))?", ":"\";\n");	
		}
		$texto .= "	   if((\$ini !== NULL) && (\$num !== NULL))\n";
		$texto .= "	     \$sql .=\" LIMIT \$ini,\$num\";\n";
		$texto .= "    \$rs = \$this->con->execute(\$sql);\n";
	    $texto .= "    return \$this->con->fetch_array(\$rs);\n  }\n\n";
		return $texto;
	}
	
	function getMetodosCadastrados(){
		//código na marra , acho que este gera qualquer método
		$facade = new Facade();
		$vetMetodos = $facade->getMetodosClasseArquiteturaTab(5,$this->table->getName(),$this->table->getNameDB());
		if($vetMetodos)
			while ($metodo = array_shift($vetMetodos)) {  
				if($metodo->getCodigo())
					$texto .= stripslashes($metodo->getCodigo());
				else{
					$vetNomeParametro = NULL;
					$vetParametros = $facade->getParametrosMetodo($metodo->getCodMetodo());
					if($vetParametros)
						while ($metodoparametro = array_shift($vetParametros)){
							$parametro = $facade->getParametro($metodoparametro->getCodParametro());
							$vetNomeParametro[] = $parametro->getNome();
						}
					$texto .= $this->metodo($metodo->getNome(),"S",$vetNomeParametro,$metodo->getSql());
				}
			}
		//fim do código na marra
		return $texto;
	}
		
		
	function metodo($nome,$tipo,$vetNomeParametro,$sql){	
		$texto  = "  function $nome(";
		for($i=0;$i<count($vetNomeParametro);$i++)
			$texto .= "$".$vetNomeParametro[$i].(($i != (count($vetNomeParametro)-1))?", ":"");
		$texto .= ") { \n";
		$texto .= "    \$sql = \"".stripslashes($sql)."\";\n";
		//print_r($vetNomeParametro);
		$texto .= "    \$rs = \$this->con->execute(\$sql);\n";
	    $texto .= "    return \$this->con->fetch_array(\$rs);\n  }\n\n";
		return $texto;
	}
	
		//inicio e comentários
	function comeco(){
  		return $this->util->cabecalho()."package ".$this->table->getNameDB().";\n\n";
	}
	
	//finalizando
	function fim(){
  		return "}";
	}
}
?>