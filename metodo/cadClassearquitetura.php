<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:32:03

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
    $classearquitetura = new Classearquitetura($_POST['txtCodClasseArquitetura'], $_POST['txtNome']);
    $res = $fachada->inserirClassearquitetura($classearquitetura);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks);
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    header('location:admClassearquitetura.php?msg='.urlencode($msg));
  }
?>
<HTML>
<HEAD>
<? include('template/templateHeaders.php');?>
</HEAD>
<BODY>
<? include('template/templateComeco.php');?>
<div id='divConteudo'>
<FORM name='frmClassearquitetura' method='POST' action='cadClassearquitetura.php' onSubmit='return checarDados(this)'>
<TABLE>
<caption >
Cadastro/Edi&ccedil;&atilde;o Classe Arquitetura
</caption>
<tr>
<td class='itemForm'>C&oacute;d. Classe Arquitetura:</td>
<td><INPUT type='text'  name='txtCodClasseArquitetura' size='60' value='' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Nome:</td>
<td><INPUT type='text'  name='txtNome' size='60' value='' maxlength='40' class='textForm'>
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