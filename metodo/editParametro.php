<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:53:39

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
    $parametro = $_SESSION['parametro'];
    $parametro->setAll($_POST['txtNome'], $_POST['txtTipo'], $_POST['txtDescricao']);
    $res = $fachada->alterarParametro($parametro);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Alteração');
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    unset($_SESSION['parametro']);
    header('location:admParametro.php?msg='.urlencode($msg));
  }else{
	   $parametro = $fachada->getParametro($_GET['codParametro']);
    if(!$parametro)
      header("location:admParametro.php?msg=".urlencode('O registro não foi encontrado, verifique os dados informados!'));
    if ($_GET['acao']=="editar")
      $_SESSION['parametro'] = $parametro;
    elseif ($_GET['acao']=="excluir"){
      $res = $fachada->excluirParametro($parametro);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Exclusão');
      $msg =($res)?(Util::getMsg("S")):(Util::getMsg("E"));
      header("location:admParametro.php?msg=".urlencode($msg));
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
<FORM name='frmParametro' method='POST' action='editParametro.php' onSubmit='return checarDados(this)'>
<TABLE>
<caption >
Cadastro/Edi&ccedil;&atilde;o Parametro
</caption>
<tr>
<td class='itemForm'>Cod. Par&acirc;metro:</td>
<td><INPUT type='text'  name='txtCodParametro' size='60' value='<?=$parametro->getCodParametro()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Nome:</td>
<td><INPUT type='text'  name='txtNome' size='60' value='<?=$parametro->getNome()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Tipo:</td>
<td><INPUT type='text'  name='txtTipo' size='60' value='<?=$parametro->getTipo()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
<td><INPUT type='text'  name='txtDescricao' size='60' value='<?=$parametro->getDescricao()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td colspan='2'><INPUT type='submit'  name='btnSalvar' value='Salvar' class='buttonForm'>
</td>
</tr>
</TABLE>
</FORM>
</div>
<?php //include('template/templateFim.php');?>
</BODY>
</HTML>