<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 ás 02:53:39

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  include_once dirname(__FILE__).'/../classes/class.Facade.php';
  session_start();

  $fachada = new Fachada();
  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
    $metodo = $_SESSION['metodo'];
    $metodo->setAll($_POST['cmbClasseArquitetura'], false, $_POST['txtNome'], $_POST['txtDescricao'], addslashes($_POST['txtSql']), $_POST['cmbClasse'], "S", addslashes($_POST['txtCodigo']), $_POST['cmbTipoRetorno']);
    $res = $fachada->alterarMetodo($metodo);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Alteração');
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    unset($_SESSION['metodo']);
    header('location:../metodos.php?msg='.urlencode($msg));
  }else{
	   $metodo = $fachada->getMetodo($_GET['codMetodo']);
    if(!$metodo)
      header("location:../metodos.php?msg=".urlencode('O registro n&atilde;o foi encontrado, verifique os dados informados!'));
    if ($_GET['acao']=="editar")
      $_SESSION['metodo'] = $metodo;
    elseif ($_GET['acao']=="excluir"){
      $res = $fachada->excluirMetodo($metodo);
    //--Log
    //$fachada->inserirLog($_SESSION['usuarioClassgenerator'],__FILE__,$_SERVER['REMOTE_ADDR'],$pks,'Exclusão');
      $msg =($res)?(Util::getMsg("S")):(Util::getMsg("E"));
      header("location:../metodos.php?msg=".urlencode($msg));
    }
  }
  $vetClasseArquitetura = $fachada->getAllClassearquitetura();
  $projeto = $fachada->getProjeto($metodo->getCodProjeto());
  $facade = new Facade();
  $vetTables = $facade->getAllTableDB($projeto->getBanco());
?>
<HTML>
<HEAD>
	<? include dirname(__FILE__).'/../template/templateHeaders.php';?>
</HEAD>
<BODY>
<? include dirname(__FILE__).'/template/templateComeco.php';?>
<div id='divConteudo'>
<FORM name='frmMetodo' method='POST' action='editMetodo.php' onSubmit='return checarDados(this)'>
<TABLE>
	<caption >
		Edi&ccedil;&atilde;o de M&eacute;todo
	</caption>
	<tr>
		<td class='itemForm'>Nome:</td>
		<td colspan="3"><INPUT type='text'  name='txtNome' size='60' value='<?=$metodo->getNome()?>' maxlength='40' class='textForm'></td>
	</tr>
	<tr>
		<td class='itemForm'>Classe:</td>
		<td>
			<SELECT name="cmbClasse">
				<?
				if($vetTables){
					while ($table = array_shift($vetTables)) {  
				?>
						<option <?=($table->getName() == $metodo->getClasse())?'selected':''?>><?=$table->getName()?></option>
				<? }
				}?>
			</SELECT>
		</td>
		<td class='itemForm'>Tipo de retorno:</td>
		<td>
			<SELECT name="cmbTipoRetorno">
				<option value="ARRAY" <?=($metodo->getTipoRetorno() == 'ARRAY')?'selected':''?>>Array</option>
				<option value="OBJ" <?=($metodo->getTipoRetorno() == 'OBJ')?'selected':''?>>Objeto</option>
				<option value="BOOL" <?=($metodo->getTipoRetorno() == 'BOOL')?'selected':''?>>Boolean</option>
			</SELECT>
		</td>
	</tr>
	<tr>
		<td class='itemForm'>Classe da Arquitetura que Pertence:</td>
		<td colspan="3">
			<SELECT name="cmbClasseArquitetura">
			<?
				while ($classeArquitetura = array_shift($vetClasseArquitetura)) {  
			?>
					<OPTION value="<?=$classeArquitetura->getCodClasseArquitetura()?>" <?=($classeArquitetura->getCodClasseArquitetura() == $metodo->getCodClassearquitetura())?"selected":""?>><?=$classeArquitetura->getNome()?></OPTION>
			<? }?>
			</SELECT>
		</td>
	</tr>
	<tr>
		<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
		<td colspan="3"><TEXTAREA name="txtDescricao" cols="90" rows="5"><?=stripslashes($metodo->getDescricao())?></TEXTAREA></td>
	</tr>
	<tr>
		<td class='itemForm'>Sql:</td>
		<td colspan="3"><TEXTAREA name="txtSql" cols="90" rows="5"><?=stripslashes($metodo->getSql())?></TEXTAREA></td>
	</tr>
	<tr>
		<td class='itemForm'>C&oacute;digo Fonte:</td>
		<td colspan="3"><TEXTAREA name="txtCodigo" cols="90" rows="7"><?=stripslashes($metodo->getCodigo())?></TEXTAREA><br>
		*Somente se o m&eacute;todo n&atilde;o &eacute; padr&atilde;o ou &eacute; somente em uma classe.<br>
		 Quando o C&oacute;digo for preenchido os parametros e o Sql ser&atilde;o descartados.
		</td>
	</tr>
	<tr>
		<td colspan='4'><INPUT type='submit'  name='btnSalvar' value='Salvar' class='buttonForm'></td>
	</tr>
</TABLE>
</FORM>
</div>
<? //include('template/templateFim.php');?>
</BODY>
</HTML>
