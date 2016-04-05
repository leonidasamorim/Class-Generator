<?
include_once dirname(__FILE__).'/class.Facade.php';
include_once dirname(__FILE__).'/class.Fachada_Pai.php';


class FachadaPHP extends Fachada_Pai {
	var $includes;
	var $metodos;
	
	function Fachada($padrao,$projeto){
		$this->Classe("Fachada_Pai","",new Util($padrao),array("conexao"),'',$projeto);
	}
	
	function construtor(){
		return   "  function Fachada_Pai(){\n".
						 "    \$this->conexao = NULL;\n  }\n\n";
	}
	
	function adicionarTabela($table){
		$this->setTable($table);
		$this->addInclude($this->includes());
		$this->addMetodos($this->gerarMetodos());
	}
	
	function setBasica($basica){
		$this->basica = $basica;
	}
	
	function includes(){
		$diretorio = ucfirst($this->table->getNameF());
		return "include_once dirname(__FILE__).'/".strtolower($diretorio)."/class.Cad".ucfirst($this->table->getNameF()).".php';\n";
	}
	
	function getIncludes(){
		return $this->includes;
	}	
	
	function addInclude($texto){
		$this->includes .= $texto;
	}
	
	function gerar(){
		//Gerando a Classe
		$texto  = $this->comeco();
		$this->addInclude("include_once dirname(__FILE__).'/class.Conexao.php';\n");
		$this->addInclude("include_once dirname(__FILE__).'/class.Util.php';\n");
		$this->addInclude("include_once dirname(__FILE__).'/class.Paginacao.php';\n");
		$this->addInclude("include_once dirname(__FILE__).'/class.Constante.php';\n");
		$this->addInclude("include_once dirname(__FILE__).'/dompdf/dompdf_config.inc.php';\n");
		$this->addInclude("include_once dirname(__FILE__).'/Template.class.php';\n\n\n");
		$texto .= $this->getIncludes();
		$texto .= $this->dClasse();
		$texto .= $this->construtor();
		$texto .= $this->getConexao();
		$texto .= $this->iniciarTrans();
		$texto .= $this->commitTrans();
		$texto .= $this->rollBackTrans();
		$texto .= $this->getMetodos();
		$texto .= $this->fim();
		//$this->setConteudo($texto);
		return $texto;
	}
	
	function gerarMetodos(){
		$texto  = $this->metodo("inserir".ucfirst($this->table->getNameF()),"I",array($this->table->getNameF()));
		$texto .= ($this->table->getVetPK())?$this->metodo("alterar".ucfirst($this->table->getNameF()),"U",array($this->table->getNameF())):'';
		$texto .= ($this->table->getVetPK())?$this->metodo("excluir".ucfirst($this->table->getNameF()),"D",array($this->table->getNameF())):'';
		$texto .= ($this->table->getVetPK())?$this->metodo("get".ucfirst($this->table->getNameF()),"S",$this->table->getVetPK()):'';
		$texto .= $this->metodo("getAll".ucfirst($this->table->getNameF()),"S",array(array("ini","NULL"),array("num","NULL")));
		$texto .= $this->getMetodosCadastrados();
	
		return $texto;
	}
	
	function metodo($nome,$tipo,$parametros=NULL,$padrao=NULL){
		$texto  .= "  function $nome(";
		if($parametros)
			for($j=0;$j<count($parametros);$j++){
				$field = $parametros[$j];
				if(is_array($field))
					$par = $field[0]." = ".$field[1];
				elseif(is_object($field))
					$par = $field->getNameF();
				else 
					$par = $field;
				// o valor padrao pode ficar indexado pelo nome do atributo
				$texto .= "$".$par.$valorPadrao.(($j != (count($parametros)-1))?", ":"");
			}
		$texto .= ") { \n";
		$texto .= "    \$cad".ucfirst($this->table->getNameF())." = new Cad".ucfirst($this->table->getNameF())."(";
		if($tipo != "S")
			$texto .= "\$this->getConexao()";
		$texto .= ");\n";
		$texto .= "    return \$cad".ucfirst($this->table->getNameF())."->$nome(";
		if($parametros)
			for($j=0;$j<count($parametros);$j++){
				$field = $parametros[$j];
				if(is_array($field))
					$par = $field[0];
				elseif(is_object($field))
					$par = $field->getNameF();
				else 
					$par = $field;
				$texto .= "$".$par.(($j != (count($parametros)-1))?", ":"");
			}
		$texto .= ");\n  }\n\n";
		return $texto;
	}
	
	function getMetodos(){
		return $this->metodos;
	}
	
	function addMetodos($texto){
		$this->metodos .= "//Metodos da Classe ".ucfirst($this->table->getNameF())."\n\n";
		$this->metodos .= $texto;
	}
	
	function iniciarTrans(){
  		$texto =  "  function iniciarTransacao(){\n";
		$texto .= "    \$this->conexao = new Conexao();\n";
		$texto .= "    \$this->conexao->iniciarTrans();\n";
		$texto .= "  }\n\n";
		return $texto;
	}
	
	function commitTrans(){
		$texto =  "  function commitTransacao(){\n";
		$texto .= "    \$this->conexao->commitTrans();\n";
		$texto .= "    \$this->conexao = NULL;\n";
		$texto .= "  }\n\n";
		return $texto;
	}
	
	function rollBackTrans(){
		$texto =  "  function rollBackTransacao(){\n";
		$texto .= "    \$this->conexao->rollBackTrans();\n";
		$texto .= "    \$this->conexao = NULL;\n";
		$texto .= "  }\n\n";
		return $texto;
	}
	
	function getConexao(){
		$texto = "  function getConexao(){\n";
		$texto.= "    return \$this->conexao;\n";
		$texto.= "  }\n\n";
		return $texto;
	}
	
	function getMetodosCadastrados(){
		//cï¿½digo na marra , acho que este gera qualquer mï¿½todo
		$facade = new Facade();
		$vetMetodos = $facade->getMetodosClasseArquiteturaTab(2,$this->table->getName(),$this->getProjeto());
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
						$vetParPadrao = array(array("ini","NULL"),array("num","NULL"));
						$vetNomeParametro = ($vetNomeParametro)?array_merge($vetNomeParametro,$vetParPadrao):$vetParPadrao;
					}
					//tah fixando o tipo do método, isso tem que mudar.
					$texto .= $this->metodo($metodo->getNome(),"S",$vetNomeParametro);
				}
			}
		//fim do cï¿½digo na marra
		return $texto;
	}
	
}
?>