<?
include_once dirname(__FILE__)."/../class.Cad.php";


class CadJava extends Cad{
		
	function CadJava($table,$util,$projeto){
		$atributos = array("cad".ucfirst($table->getNameF())."BD");
		$this->Classe("Cad".ucfirst($table->getName()),$table,$util,$atributos,'',$projeto);
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->dClasse();
		$texto .= $this->construtor();
		$texto .= $this->metodo("inserir".ucfirst($this->table->getNameF()),$this->table->getVetFields());
		$texto .= ($this->table->getVetPK())?$this->metodo("alterar".ucfirst($this->table->getNameF()),$this->table->getVetFields()):'';
		$texto .= ($this->table->getVetPK())?$this->metodo("excluir".ucfirst($this->table->getNameF()),$this->table->getVetPK()):'';
		//$texto .= ($this->table->getVetPK())?$this->get():'';
		//$texto .= $this->getAll();
		//$texto .= $this->getMetodosCadastrados();
		
		$texto .= $this->fim();
		$this->setConteudo($texto);
	}
	
	//Declara��o da Classe
	function dClasse($superClasse=''){
  		$texto  = "public class ".$this->getNome();
  		$texto .= ($superClasse)?" extends $superClasse{\n":"{\n";
  		// Atributos da classe
  		$texto .= "  private  Cad".ucfirst($this->table->getNameF())."BD cad".ucfirst($this->table->getNameF())."BD;\n\n";
  		$texto .= "\n";
  		return $texto;
	}
	
	// M�todo construtor
	function construtor(){
  		$texto  = "  public void ".$this->getNome()."(){\n";
  		$texto .= "    this.cad".ucfirst($this->table->getNameF())."BD = new ".$this->getNome()."BD();\n";
  		$texto .= "  }\n\n";
  		return $texto;
	}

	function metodo($nome,$atts){
		$texto  = "  public boolean $nome(".ucfirst($this->table->getNameF())." ".$this->table->getNameF().") { \n";
		$texto .= "    return this.cad".ucfirst($this->table->getNameF())."BD.$nome(";
		for($j=0;$j<count($atts);$j++){
			$texto .= $this->table->getNameF().".get".ucfirst($atts[$j]->getNameF())."()";
			$texto .= (($j != (count($atts)-1))?", ":");\n  }\n\n");
		}
		return $texto;
	}

	function get(){
		$vetPK 			= $this->table->getVetPK();
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  public ".ucfirst($this->table->getNameF())." get".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetPK);$j++)
				$texto .= Maping::typeLanguage($atts[$j],"Java").$vetFields[$j]->getNameF().(($j != (count($vetPK)-1))?", ":") { \n");
		$texto.= "    if(rs = this->cad".ucfirst($this->table->getNameF())."BD.get".ucfirst($this->table->getNameF())."(";
		while($field = array_shift($vetPK))
				$texto .= $field->getNameF().((count($vetPK) != 0)?", ":"");
		$texto .= ")){\n      va = rs.next();\n";
		$texto .= "      return new ".ucfirst($this->table->getNameF())."(";
		while($field = array_shift($vetFields))
				$texto .= "va['".strtolower($field->getNameF())."']".((count($vetFields) != 0)?", ":");\n");
		$texto .= "    }else\n      return new ;\n    }\n\n";
		return $texto;
	}
	
	function getAll(){
		$vetFields 	= $this->table->getVetFields();
		$texto  = "  public rs getAll".ucfirst($this->table->getNameF())."() { \n";
		$texto .= "    if(rs = this->cad".ucfirst($this->table->getNameF())."BD->getAll".ucfirst($this->table->getNameF())."(ini,num)){\n";
		$texto .= "      while(va = array_shift(rs))\n";
		$texto .= "        vet[] = new ".ucfirst($this->table->getNameF());
		$texto .= "(";
		for($j=0;$j<count($vetFields);$j++)
			$texto .= "va['".strtolower($vetFields[$j]->getNameF())."']".(($j != (count($vetFields)-1))?", ":");\n");
		$texto .= "      return vet;\n";
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
		$texto .= "    if(rs = this->cad".ucfirst($this->table->getNameF())."BD->$nome(";
		for($i=0;$i<count($vetNomeParametro);$i++)
			$texto .= "$".$vetNomeParametro[$i].(($i != (count($vetNomeParametro)-1))?", ":"");
		$texto .= ")){\n";
		
		$auxTexto = "new ".ucfirst($this->table->getNameF())."(";
		for($j=0;$j<count($vetFields);$j++)
			$auxTexto .= "va['".strtolower($vetFields[$j]->getNameF())."']".(($j != (count($vetFields)-1))?", ":"");
		$auxTexto .= ");\n";
		
		if($tipoRetorno == "OBJ"){
			$texto .= "      va = array_shift(rs);\n";
			$texto .= "      return $auxTexto";
		}elseif($tipoRetorno == "ARRAY"){
			$texto .= "      while(va = array_shift(rs))\n";
			$texto .= "        vet[] = $auxTexto";
			$texto .= "      return vet;\n";
		}
		$texto .= "    }else\n      return false;\n    }\n\n";
		return $texto;
	}
	
	
	//isso pode ficar em uma superClasse(verificar)
	//inicio e coment�rios
	function comeco(){
  		return $this->util->cabecalho()."package ".$this->table->getNameDB().";\n\n";
	}
	
	//finalizando
	function fim(){
  		return "}";
	}
}
?>