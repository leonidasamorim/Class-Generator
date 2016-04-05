<?
include_once dirname(__FILE__).'/../class.Fachada.php';

class FachadaJava extends Fachada {
	var $includes;
	var $metodos;
	
	function Fachada($padrao,$projeto){
		$this->Classe("Fachada","",new Util($padrao),array("conexao"),'',$projeto);
	}
	
		//inicio e comentários
	function comeco(){
  		return $this->util->cabecalho()."\n\npackage ".$this->table->getNameDB().";\nimport java.util.*;\n\n";  
	}
	
		//Declaração da Classe
	function dClasse(){
  		$texto  = "public class fachada {\n\n";

  		return $texto;
	}
	
	
	//finalizando
	function fim(){
  		return "}\n?>";
	}
		
	function construtor(){
		return   " public void Fachada(){\n".
						 "    }\n\n";
	}
	
	function adicionarTabela($table){
		$this->setTable($table);
		$this->addInclude($this->includes());
		$this->addMetodos($this->gerarMetodos());
	}
	
	function setBasica($basica){
		$this->basica = $basica;
	}
	
	function gerar(){
		//Gerando a Classe
		$texto  = $this->comeco();
		$texto .= $this->dClasse();
		$texto .= $this->construtor();
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
		$texto .= $this->metodo("getAll".ucfirst($this->table->getNameF()),"SS",array(),array("NULL","NULL"));
		$texto .= $this->getMetodosCadastrados();
	
		return $texto;
	}
	
	function metodo($nome,$tipo,$parametros=NULL,$padrao=NULL){
		switch ($tipo) {
			case "I":
			case "U":	
			case "D":
				$retorno = "boolean";
				break;
			case "S":
				$retorno = ucfirst($this->table->getNameF());
				break;
			case "SS":
				$retorno = ucfirst($this->table->getNameF())."[]";
				break;
			default:
				break;
		}
		$texto  .= "  public ".$retorno." $nome(";
		if($parametros)
			for($j=0;$j<count($parametros);$j++){
				$field = $parametros[$j];
				if(is_object($field))
					$par = $field->getNameF();
				else 
					$par = $field;
				$valorPadrao = ($padrao[$j])?(($padrao[$j] !== false)?"=".$padrao[$j]:""):'';
				$texto .= "".$par.$valorPadrao.(($j != (count($parametros)-1))?", ":"");
			}
		$texto .= ") { \n";
		$texto .= "    cad".ucfirst($this->table->getNameF())." = new Cad".ucfirst($this->table->getNameF())."(";
		$texto .= ");\n";
		$texto .= "    return cad".ucfirst($this->table->getNameF()).".$nome(";
		if($parametros)
			for($j=0;$j<count($parametros);$j++){
				$field = $parametros[$j];
				if(is_object($field))
					$par = Maping::typeLanguage($field,"Java")." ".$field->getNameF();
				else 
					$par = ucfirst($field)." ".$field;
				$texto .= "".$par.(($j != (count($parametros)-1))?", ":"");
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
	/*
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
	*/
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
					$texto .= $this->metodo($metodo->getNome(),"S",$vetNomeParametro);
				}
			}
		//fim do cï¿½digo na marra
		return $texto;
	}
	
}
?>