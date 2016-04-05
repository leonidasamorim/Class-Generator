<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:53:39

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
    $metodoparametro = $_SESSION['metodoparametro'];
    $parametro = $_SESSION['parametro'];
    $fachada->iniciarTransacao();
	  	$parametro->setAll($_POST['txtNome'],$_POST['cmbTipoParametro'],$_POST['txtDescricao']);
	  	$res1 = $fachada->alterarParametro($parametro);
	    $metodoparametro->setAll($_POST['txtOrdem']);
	    $res2 = $fachada->alterarMetodoparametro($metodoparametro);
	if(!($res1 || $res2))
	  	$fachada->rollBacktransacao();
	else
    	$fachada->commitTransacao();
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Alteração');
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    unset($_SESSION['metodoparametro']);
    unset($_SESSION['parametro']);
    header('location:cadMetodoparametro.php?msg='.urlencode($msg));
  }else{
  	   $parametro		= $fachada->getParametro($_GET['codParametro']);
	   $metodoparametro = $fachada->getMetodoparametro($_GET['codParametro'], $_GET['codMetodo']);
    if(!($metodoparametro || $parametro))
      header("location:cadMetodoparametro.php?msg=".urlencode('O registro não foi encontrado, verifique os dados informados!'));
    if ($_GET['acao']=="editar"){
      $_SESSION['metodoparametro'] = $metodoparametro;
      $_SESSION['parametro'] = $parametro;
    }
    elseif ($_GET['acao']=="excluir"){
      $fachada->iniciarTransacao();
      	$res = $fachada->excluirParametro($parametro);
        $res = $fachada->excluirMetodoparametro($metodoparametro);
      if(!($res))
	  	$fachada->rollBacktransacao();
	  else
    	$fachada->commitTransacao();	
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Exclusão');
      $msg =($res)?(Util::getMsg("S")):(Util::getMsg("E"));
      header("location:cadMetodoparametro.php?msg=".urlencode($msg));
    }
  }
?>
<HTML>
<HEAD>
<? include('template/templateHeaders.php');?>
</HEAD>
<BODY>
<? include('template/templateComeco.php');?>
<div id='divConteudo'>
<FORM name='frmMetodoparametro' method='POST' action='editMetodoparametro.php' onSubmit='return checarDados(this)'>
<TABLE>
<caption >
Edi&ccedil;&atilde;o Par&acirc;metro
</caption>
<tr>
<td class='itemForm'>Nome:</td>
<td><INPUT type='text'  name='txtNome' size='60' value='<?=$parametro->getNome()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Tipo:</td>
<td>
<SELECT name="cmbTipoParametro">
	<OPTION <?=($parametro->getTipo() == "Variável Simples")?"selected":""?>>Variável Simples</OPTION>
	<OPTION <?=($parametro->getTipo() == "Objeto")?"selected":""?>>Objeto</OPTION>
</SELECT>
</td>
</tr>
<tr>
<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
<td><INPUT type='text'  name='txtDescricao' size='60' value='<?=$parametro->getDescricao()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Ordem:</td>
<td><INPUT type='text'  name='txtOrdem' size='2' value='<?=$metodoparametro->getOrdem()?>' maxlength='2' class='textForm'>
</td>
</tr>
<tr>
<td colspan='2'><INPUT type='submit'  name='btnSalvar' value='Salvar' class='buttonForm'>
</td>
</tr>
</TABLE>
</FORM>
</div>
<?// include('template/templateFim.php');?>
</BODY>
</HTML>