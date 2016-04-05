<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:53:39

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
    $classearquitetura = $_SESSION['classearquitetura'];
    $classearquitetura->setAll($_POST['txtNome']);
    $res = $fachada->alterarClassearquitetura($classearquitetura);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Alteração');
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    unset($_SESSION['classearquitetura']);
    header('location:admClassearquitetura.php?msg='.urlencode($msg));
  }else{
	   $classearquitetura = $fachada->getClassearquitetura($_GET['codClasseArquitetura']);
    if(!$classearquitetura)
      header("location:admClassearquitetura.php?msg=".urlencode('O registro não foi encontrado, verifique os dados informados!'));
    if ($_GET['acao']=="editar")
      $_SESSION['classearquitetura'] = $classearquitetura;
    elseif ($_GET['acao']=="excluir"){
      $res = $fachada->excluirClassearquitetura($classearquitetura);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Exclusão');
      $msg =($res)?(Util::getMsg("S")):(Util::getMsg("E"));
      header("location:admClassearquitetura.php?msg=".urlencode($msg));
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
<FORM name='frmClassearquitetura' method='POST' action='editClassearquitetura.php' onSubmit='return checarDados(this)'>
<TABLE>
<caption >
Cadastro/Edi&ccedil;&atilde;o Classe Arquitetura
</caption>
<tr>
<td class='itemForm'>C&oacute;d. Classe Arquitetura:</td>
<td><INPUT type='text'  name='txtCodClasseArquitetura' size='60' value='<?=$classearquitetura->getCodClasseArquitetura()?>' maxlength='40' class='textForm'>
</td>
</tr>
<tr>
<td class='itemForm'>Nome:</td>
<td><INPUT type='text'  name='txtNome' size='60' value='<?=$classearquitetura->getNome()?>' maxlength='40' class='textForm'>
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