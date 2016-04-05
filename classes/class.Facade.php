<?
include_once dirname(__FILE__).'/class.BD.php';
include_once dirname(__FILE__).'/class.CadDataBase.php';
include_once dirname(__FILE__).'/class.CadTable.php';

//na marra - isso tah no outro fachada
include_once dirname(__FILE__).'/../metodo/classes/class.CadClassearquitetura.php';
include_once dirname(__FILE__).'/../metodo/classes/class.CadMetodo.php';
include_once dirname(__FILE__).'/../metodo/classes/class.CadMetodoparametro.php';
include_once dirname(__FILE__).'/../metodo/classes/class.CadParametro.php';
include_once dirname(__FILE__).'/class.Conexao.php';
//include_once dirname(__FILE__).'/../metodo/classes/class.Erro.php';
//include_once dirname(__FILE__).'/../metodo/classes/class.SMTP.php';
include_once dirname(__FILE__).'/class.Util.php';
//fim dos includes na marra


class Facade{

	function Facade(){
		
	}
	
	//methods of class DataBase
	function getAllDataBase(){
		$cadDataBase = new CadDataBase();
		return $cadDataBase->getAllDataBase();	
	}
	
	//end methods
	
	//methods of class Table
	function getAllTableDB($nameDB){
		$cadTable = new CadTable();
		return $cadTable->getAllTableDB($nameDB);	
	}
	
	//end methods
	
	
//inicio dos métodos na marra	
	
	//Métodos da Classe Classearquitetura

  function getClassearquitetura($codClasseArquitetura) { 
    $cadClassearquitetura = new CadClassearquitetura();
    return $cadClassearquitetura->getClassearquitetura($codClasseArquitetura);
  }

  function getAllClassearquitetura() { 
    $cadClassearquitetura = new CadClassearquitetura();
    return $cadClassearquitetura->getAllClassearquitetura();
  }

//Métodos da Classe Metodo

  function getMetodo($codMetodo) { 
    $cadMetodo = new CadMetodo();
    return $cadMetodo->getMetodo($codMetodo);
  }

  function getAllMetodo() { 
    $cadMetodo = new CadMetodo();
    return $cadMetodo->getAllMetodo();
  }

//Métodos da Classe Metodoparametro

  function getMetodoparametro($codParametro, $codMetodo) { 
    $cadMetodoparametro = new CadMetodoparametro();
    return $cadMetodoparametro->getMetodoparametro($codParametro, $codMetodo);
  }

  function getAllMetodoparametro() { 
    $cadMetodoparametro = new CadMetodoparametro();
    return $cadMetodoparametro->getAllMetodoparametro();
  }

//Métodos da Classe Parametro

  function getParametro($codParametro) { 
    $cadParametro = new CadParametro();
    return $cadParametro->getParametro($codParametro);
  }

  function getAllParametro() { 
    $cadParametro = new CadParametro();
    return $cadParametro->getAllParametro();
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
	
//fim dos métodos na marra
	
}
?>