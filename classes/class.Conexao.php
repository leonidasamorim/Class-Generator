<?
include_once dirname(__FILE__)."/adodb/adodb.inc.php";

class Conexao {
	var $conexao;
	var $usuario;
	var $senha;
 	var $bdPath;
 	var $bd;
 	var $tipoBd;
 	var $charSet;
 	var $buffers;
 	var $dialect;
 	var $autoCommit;

  function Conexao() {
	  $this->usuario 	= "root";
		$this->senha  	= "root";
		$this->bdPath 	= "localhost";
		$this->bd 		= "classgenerator";
		$this->tipoBd 	= "mysqlt";
		$this->charSet 	= "ASCII";
		$this->buffers 	= 100;
		$this->dialect 	= 3;
		$this->autoCommit = true;
	  // Cria uma instancia do objeto
		// Configura uma conexão com a biblioteca
		$this->conexao = NewADOConnection($this->tipoBd);
		$this->conexao->charSet = $this->charSet;
		$this->conexao->buffers = $this->buffers;
		$this->conexao->dialect = $this->dialect;
		// Abre a conexão com o banco
		if (!$this->conexao->Connect($this->bdPath,$this->usuario,$this->senha,$this->bd)) {
		   header("Location: manutencao.php");
		}
  }

	/**
  * @return ResultSet[]
  * @param ResultSet
  * @desc Return a vector whith values of rows indexed names fields
  */   
	function &fetch_array(&$rs){
		$numeroColunas = $rs->FieldCount();	
		while (!$rs->EOF) {
			for($i=0;$i < $numeroColunas;$i++){
    	   		$coluna = $rs->FetchField($i);
       			$nomeColuna = strtolower($coluna->name);
       			$tipoColuna = $rs->MetaType($coluna->type);
       			if ( ($tipoColuna == 'D') || ($tipoColuna == 'T')){
       			    $vetor["$nomeColuna"] = $this->converteAmdParaDma($rs->fields[$i]);
       			}else{
       				$vetor["$nomeColuna"] = $rs->fields[$i];
       			}               
     		}
     	$vetorRegistro[] = $vetor;
	 	$rs->MoveNext(); 
		} 	
	return $vetorRegistro;
	}

	function &converteMdaParaDma(&$data){
		$data = substr($data,0,10);    
		list($mes,$dia,$ano) = explode("/",$data);
		$data = $dia."/".$mes."/".$ano;
		return $data;
	}
	
	function &converteDmaParaMda(&$data){
		$data = substr($data,0,10);    
		list($dia,$mes,$ano) = explode("/",$data);
		$data = $mes."/".$dia."/".$ano;
		return $data;
	}	

	function &converteDmaParaAmd(&$data){
		$data = substr($data,0,10);    
		list($dia,$mes,$ano) = explode("/",$data);
		$data = $ano."-".$mes."-".$dia;
		return $data;
	}	
	
	function &converteAmdParaDma(&$data){
 		$data = substr($data,0,10);    
		list($ano,$mes,$dia) = explode("-",$data);
		$data = $dia."/".$mes."/".$ano;
		return $data;
	}		
	
 /*function Conexao() {
    $this->conexao = mysql_connect("localhost","root");
  }*/

  
  //funçoes da classe conexao antiga
  
  
   function consulta($sql) {
 //die($sql."<br><br>");
    $rs = mysql_query($sql);
    if (!$rs) {$erro = mysql_error(); print($sql."<br><br>".$erro."<br><br>");}
    if ($rs)
            return $rs;
    else
      die("Não foi possível executar o comando no banco de dados.<br>Clique no botão Voltar do seu navegador.");
  }
	
	function fetch_object($rs) {
     while($obj = mysql_fetch_object($rs))
       $vetReg[] = $obj;
    return $vetReg;
  }

  function num_rows($rs) {
    return mysql_num_rows($rs);
  }
  function insert_id($conexaoatual){
      return mysql_insert_id($conexaoatual);
  }
  
  function  list_tables($db){
  	  return  @mysql_list_tables($db);
  }
  
  function db_query($db, $sql){
  	return mysql_db_query($db, $sql);
  }
  
  function tablename($tables, $tb){
  	return mysql_tablename($tables, $tb);
  }
  
  function getConexao() {
    return $this->conexao;
  }
  
  //funçao específica para o ClassGenerator
  function setBD($bd){
  	$this->bd = $bd;
  	$this->conexao->Connect($this->bdPath,$this->usuario,$this->senha,$this->bd);
  }
  //fim da funçao
  
 
  	function close(){
		$this->conexao->Close();
	}
	
	function execute($sql){
		//Quando o Sistema está em Produção é recomendavel comentar a partir do or die da linha abaixo, para que não apareçam as msgs de erro do Banco
		$rs = $this->conexao->Execute($sql) or die("Erro na consulta: $sql. <br>" . $this->conexao->ErrorMsg());
		$_SESSION['lastSQL']  = $sql;
		return $rs;
	}
	
	function getAutoCommit(){
		return $this->autoCommit;
	}
	
	function setAutoCommit($bol){
		$this->autoCommit = $bol;
	}
	
	function insertId(){
		return $this->conexao->Insert_id();
	}
	
	function iniciarTrans(){
		$this->setAutoCommit(false);
		$this->conexao->BeginTrans();
	}
	
	function commitTrans(){
		$this->setAutoCommit(true);
		$this->conexao->CommitTrans();
		$this->close();
	}
	
	function rollBackTrans(){
		$this->setAutoCommit(true);
		$this->conexao->RollbackTrans();
		$this->close();
	}
}

?>
