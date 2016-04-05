<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 05:37:35

include_once dirname(__FILE__).'/class.CadClassearquitetura.php';
include_once dirname(__FILE__).'/class.CadMetodo.php';
include_once dirname(__FILE__).'/class.CadParametro.php';
include_once dirname(__FILE__).'/class.CadProjeto.php';
include_once dirname(__FILE__).'/../../classes/class.Conexao.php';
//include_once dirname(__FILE__).'/class.Erro.php';
//include_once dirname(__FILE__).'/class.SMTP.php';
include_once dirname(__FILE__).'/../../classes/class.Util.php';
include_once dirname(__FILE__).'/../../classes/class.Constante.php';


class Fachada{
  var $conexao;

  function Fachada(){
    $this->conexao = NULL;
  }

  function getConexao(){
    return $this->conexao;
  }

  function iniciarTransacao(){
    $this->conexao = new Conexao();
    $this->conexao->iniciarTrans();
  }

  function commitTransacao(){
    $this->conexao->commitTrans();
    $this->conexao = NULL;
  }

  function rollBackTransacao(){
    $this->conexao->rollBackTrans();
    $this->conexao = NULL;
  }

//Métodos da Classe Classearquitetura

  function inserirClassearquitetura($classearquitetura) { 
    $cadClassearquitetura = new CadClassearquitetura($this->getConexao());
    return $cadClassearquitetura->inserirClassearquitetura($classearquitetura);
  }

  function alterarClassearquitetura($classearquitetura) { 
    $cadClassearquitetura = new CadClassearquitetura($this->getConexao());
    return $cadClassearquitetura->alterarClassearquitetura($classearquitetura);
  }

  function excluirClassearquitetura($classearquitetura) { 
    $cadClassearquitetura = new CadClassearquitetura($this->getConexao());
    return $cadClassearquitetura->excluirClassearquitetura($classearquitetura);
  }

  function getClassearquitetura($codClasseArquitetura) { 
    $cadClassearquitetura = new CadClassearquitetura();
    return $cadClassearquitetura->getClassearquitetura($codClasseArquitetura);
  }

  function getAllClassearquitetura() { 
    $cadClassearquitetura = new CadClassearquitetura();
    return $cadClassearquitetura->getAllClassearquitetura();
  }

//Métodos da Classe Metodo

  function inserirMetodo($metodo) { 
    $cadMetodo = new CadMetodo($this->getConexao());
    return $cadMetodo->inserirMetodo($metodo);
  }

  function alterarMetodo($metodo) { 
    $cadMetodo = new CadMetodo($this->getConexao());
    return $cadMetodo->alterarMetodo($metodo);
  }

  function excluirMetodo($metodo) { 
    $cadMetodo = new CadMetodo($this->getConexao());
    return $cadMetodo->excluirMetodo($metodo);
  }

  function getMetodo($codMetodo) { 
    $cadMetodo = new CadMetodo();
    return $cadMetodo->getMetodo($codMetodo);
  }

  function getAllMetodo() { 
    $cadMetodo = new CadMetodo();
    return $cadMetodo->getAllMetodo();
  }

//Métodos da Classe Parametro

  function inserirParametro($parametro) { 
    $cadParametro = new CadParametro($this->getConexao());
    return $cadParametro->inserirParametro($parametro);
  }

  function alterarParametro($parametro) { 
    $cadParametro = new CadParametro($this->getConexao());
    return $cadParametro->alterarParametro($parametro);
  }

  function excluirParametro($parametro) { 
    $cadParametro = new CadParametro($this->getConexao());
    return $cadParametro->excluirParametro($parametro);
  }

  function getParametro($codParametro) { 
    $cadParametro = new CadParametro();
    return $cadParametro->getParametro($codParametro);
  }

  function getAllParametro() { 
    $cadParametro = new CadParametro();
    return $cadParametro->getAllParametro();
  }
  
  //Métodos da Classe Projeto

  function inserirProjeto($projeto) { 
    $cadProjeto = new CadProjeto($this->getConexao());
    return $cadProjeto->inserirProjeto($projeto);
  }

  function alterarProjeto($projeto) { 
    $cadProjeto = new CadProjeto($this->getConexao());
    return $cadProjeto->alterarProjeto($projeto);
  }

  function excluirProjeto($projeto) { 
    $cadProjeto = new CadProjeto($this->getConexao());
    return $cadProjeto->excluirProjeto($projeto);
  }

  function getProjeto($codProjeto) { 
    $cadProjeto = new CadProjeto();
    return $cadProjeto->getProjeto($codProjeto);
  }

  function getAllProjeto($ini=NULL, $num=NULL) { 
    $cadProjeto = new CadProjeto();
    return $cadProjeto->getAllProjeto($ini, $num);
  }

  #Novos Métodos
  function getParametrosMetodo($codMetodo) { 
    $cadParametro = new CadParametro();
    return $cadParametro->getParametrosMetodo($codMetodo);
  }
  
  function getMetodosClasseArquiteturaTab($codClasseArquitetura,$nomeTabela=false,$nomeBanco=false){
  	$cadMetodo = new CadMetodo();
  	return $cadMetodo->getMetodosClasseArquiteturaTab($codClasseArquitetura,$nomeTabela,$nomeBanco);
  }
  
  function getMetodosProjetoBanco($nomeBanco,$ordem=false){
  	$cadMetodo = new CadMetodo();
  	return $cadMetodo->getMetodosProjetoBanco($nomeBanco,$ordem);
  }
  
  function getProjetoBanco($nomeBanco){
  	$cadProjeto = new CadProjeto();
  	return $cadProjeto->getProjetoBanco($nomeBanco);
  }
  
  function getParametroNome($nome){
  	$cadParametro = new CadParametro();
  	return $cadParametro->getParametroNome($nome);
  }
  
}
?>
