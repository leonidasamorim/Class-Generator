<?php
// +-----------------------------------------------------------------+
// | ClassGenerator                                                  |
// | Copyleft 2004  UFPA Bel�m-Par� - Brasil       					 |
// +-----------------------------------------------------------------+
// | Licensed under GPL: www.fsf.org for further details             |
// |                                                                 |
// | Site:   http://www.marcelioleal.net/classgenerator              |
// +-----------------------------------------------------------------+
// | 																 |
// |       Gerador de Artefatos, escrito em PHP, que a partir dos    |
// |       meta-dados de Banco de Dados gera diversos artefatos 	 |
// |       e integra com um Framework embutido.                      |
// |                                                                 |
// | Created at December, 16, 2001                                   |
// | Created by Marcelio Leal  										 |
// | (contato@marcelioleal.net)                      				 |
// +-----------------------------------------------------------------+
//ini_set('display_errors',true);
include_once dirname(__FILE__)."/classes/class.Arquivo.php";
include_once dirname(__FILE__)."/classes/class.Banco.php";
include_once dirname(__FILE__)."/classes/class.MetaCadBD.php";
include_once dirname(__FILE__)."/classes/class.MetaCadBDPai.php";
include_once dirname(__FILE__)."/classes/class.CodHTML.php";

include_once dirname(__FILE__)."/classes/class.Facade.php";
include_once dirname(__FILE__)."/classes/class.Factory.php";

session_start();
//receiving data of forms and creating news objects
$facade = new Facade();

$util = new Util($_POST['rdPadrao']);
 $_SESSION['dataBaseS']->setNameF($util->forNClassMet($_SESSION['dataBaseS']->getName()));
 $dataBase = $_SESSION['dataBaseS'];
$vetTables = $facade->getAllTableDB($dataBase->getName());

//se tiver um banco de mapeamento
if($_POST['cmbBancoMap']){
	$dataBaseMap = new DataBase($_POST['cmbBancoMap']);
	$vetTablesMap = $facade->getAllTableDB($dataBaseMap->getName());
	for($i=0;$i<count($vetTablesMap);$i++)
		$vetTbMap[$vetTablesMap[$i]->getName()] = $vetTablesMap[$i];
}

//--Come�ando a  festa da geracao de artefatos
//criando os diretorios padroes
$dirBase = dirname(__FILE__)."/arquivos/".strtolower($util->forNAtt($_SESSION['dataBaseS']->getNameF()).date("dmY-his"));
$arquivo = new Arquivo($dirBase);

if(!$arquivo->criaDir(0775))
	print("erro de permissao de escrita");

if($_POST['chkClasses'])
	$arquivo->criaNovoDiretorio($dirBase."/classes");

if($_POST['chkInterfaces']){
	$arquivo->criaNovoDiretorio($dirBase."/imagens");
	$arquivo->criaNovoDiretorio($dirBase."/scripts");
	$arquivo->criaNovoDiretorio($dirBase."/template");
	$arquivo->criaNovoDiretorio($dirBase."/documentacao");
	$arquivo->criaNovoDiretorio($dirBase."/componentes");
}
$arquivo->setDiretorio($dirBase."/classes/");
//fim dir

$factory = new Factory();
switch ($_POST['linguagem']) {
	case "PHP":
		$ext = ".php";
		break;
	case "Java":
		$ext = ".java";
		break;
	case "Phyton":
		$ext = ".py";
		break;
	default:
		break;
}

$fachadaPai = $factory->criarFachadaPai($_POST['linguagem'],$util->getPadrao(),$dataBase->getName());
$fachada = $factory->criarFachada($_POST['linguagem'],$util->getPadrao(),$dataBase->getName());

for($j=0;$j<count($vetTables);$j++){
	$table 		= $vetTables[$j];
	$table->setNameF($util->getPadrao());
	//mapeamento
	$tableMap = $vetTbMap[$table->getName()];
	if($tableMap)
		$tableMap->setNameF($util->getPadrao());
		
	if($_POST['chkClasses']){
		
		/**********as b�sicas, cads e cadsBDs s�o geradas em diret�rios pr�prios************************/
		$arquivo->criaNovoDiretorio($arquivo->getDiretorio()."/".$table->getNameF());
		$arquivo->setDiretorio($dirBase."/classes/".$table->getNameF()."/");
		/***********************************************************************************************/
		
		$fachadaPai->adicionarTabela((($tableMap)?$tableMap:$table));
		$fachada->adicionarTabela((($tableMap)?$tableMap:$table));
		
		$basicaPai		= $factory->criarBasicaPai($_POST['linguagem'],(($tableMap)?$tableMap:$table),$util);
		$cadPai 		= $factory->criarCadPai($_POST['linguagem'],(($tableMap)?$tableMap:$table),$util,$dataBase->getName());
		$cadBDPai 	= new MetaCadBDPai($_POST['tipoBanco'],$table,$util);
				
		$arquivo->grava("class.".$basicaPai->getNome().$ext,$basicaPai->getConteudo());
		$arquivo->grava("class.".$cadPai->getNome().$ext,$cadPai->getConteudo());
		$arquivo->grava("class.".$cadBDPai->getNome().$ext,$cadBDPai->getConteudo());
		
		$cad 		= $factory->criarCad($_POST['linguagem'],(($tableMap)?$tableMap:$table),$util,$dataBase->getName());
		$cadBD 	= new MetaCadBD($_POST['tipoBanco'],$table,$util);
		
		$arquivo->grava("class.".$cad->getNome().$ext,$cad->getConteudo());
		$arquivo->grava("class.".$cadBD->getNome().$ext,$cadBD->getConteudo());
		
		/*volta ao dir�torio de origem, afim de evitar cria��o desnecess�rios de subdiret�rios*/
		$arquivo->setDiretorio($dirBase."/classes/");
		/**************************************************************************************/
		
	}
	
	if($_POST['chkInterfaces']){
		$codHTML 	= new CodHTML($basicaPai,(($tableMap)?$tableMap:$table));
		$cadHTML 	= $codHTML->cad($_POST['estilo']);
		if($table->getVetNK()){
			$editHTML	= $codHTML->edit($_POST['estilo']);
		}
		$delHTML 	= $codHTML->del($_POST['estilo']);
		$admHTML= $codHTML->adm($_POST['estilo']);
		$detHTML = $codHTML->det($_POST['estilo']);
		$menu 	.= $codHTML->getMenu();
		$arquivo->grava("../cad".$basicaPai->getNome().".php",$cadHTML);
		if($table->getVetNK()){
			$arquivo->grava("../edit".$basicaPai->getNome().".php",$editHTML);
		}
		$arquivo->grava("../del".$basicaPai->getNome().".php",$delHTML);
		$arquivo->grava("../adm".$basicaPai->getNome().".php",$admHTML);
		$arquivo->grava("../det".$basicaPai->getNome().".php",$detHTML);
	}
}

if($_POST['chkClasses']){
	$arquivo->grava("class.Fachada_Pai".$ext,$fachadaPai->gerar());
	$arquivo->grava("class.Fachada".$ext,$fachada->gerar());
	$vetArquivosOrigem = array("class.Util.php", "class.Conexao.php", "class.Paginacao.php", "class.Constante.php","class.CadBD.php", "class.FrontController.php", "Template.class.php", "adodb.zip", "dompdf.zip");
	$arquivo->copiarArquivos($dirBase."/../../base/php/classes/",$dirBase."/classes/",$vetArquivosOrigem);
}

if($_POST['chkInterfaces']){
	$arquivo->grava("../template/menu.php",$menu);
	//figuras
	$vetArquivosOrigem = array("edit.gif", "del.gif", "back.gif","bgDegrade.gif");
	$arquivo->copiarArquivos($dirBase."/../../base/imagens/",$dirBase."/imagens/",$vetArquivosOrigem);
	//scripts
	$vetArquivosOrigem = array("estilos.css", "FormContext.js", "funcoes.js");
	$arquivo->copiarArquivos($dirBase."/../../base/scripts/",$dirBase."/scripts/",$vetArquivosOrigem);
	//template
	$vetArquivosOrigem = array("templateHeaders.php", "templateComeco.php", "templateFim.php");
	$arquivo->copiarArquivos($dirBase."/../../base/php/template/",$dirBase."/template/",$vetArquivosOrigem);
	//telas padrÃ£o
	$vetArquivosOrigem = array("indexPadrao.php");
	$arquivo->copiarArquivos($dirBase."/../../base/php/",$dirBase."/",$vetArquivosOrigem);
}

?>
<html>
<head>
	<?php include dirname(__FILE__).'/template/templateHeaders.php';?>
</head>
<body>
<br>
	<h1 align="center">
	Artefatos gerados com sucesso!<br><br>
	Copie em <?=dirname(__FILE__)."/arquivos"?><br><br>
	Para maiores informa��es visite:<br>
	http://classgenerator.codigolivre.org.br <br>
	http://sig.ufpa.br/~marcelio.<br><br>
	<a href='opcoes.php'>Voltar</a>
	</h1>
</body>
</html>

