<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:32:03

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
    $parametro = new Parametro($_POST['txtCodParametro'], $_POST['txtNome'], $_POST['txtTipo'], $_POST['txtDescricao']);
    $res = $fachada->inserirParametro($parametro);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks);
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    header('location:admParametro.php?msg='.urlencode($msg));
  }
?>
<HTML>
<HEAD>
<? include('template/templateHeaders.php');?>
</HEAD>
<BODY>
<? include('template/templateComeco.php');?>
<div id='divConteudo'>
<FORM name='frmParametro' method='POST' action='cadParametro.php' onSubmit='return checarDados(this)'>
<TABLE>
<caption >
Cadastro/Edi&ccedil;&atilde;o Parametro
</caption>
<tr>
<td class='itemForm'>C&oacute;d. Parametro:</td>
<td><INPUT type='text'  name='txtCodParametro' size='60' value='' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Nome:</td>
<td><INPUT type='text'  name='txtNome' size='60' value='' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Tipo:</td>
<td><INPUT type='text'  name='txtTipo' size='60' value='' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
<td><INPUT type='text'  name='txtDescricao' size='60' value='' maxlength='40' class='textForm'>
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