<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 ?s 00:42:31

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  include_once dirname(__FILE__).'/../classes/class.Facade.php';
  session_start();

  $fachada = new Fachada();
  if($_POST['btnSalvar']){
  	$projeto = $fachada->getProjetoBanco($_SESSION['dataBaseS']->getName());
  	if(!$projeto){
  		$projeto = new Projeto("",$_SESSION['dataBaseS']->getName(),"Nao cadastrado",$_SESSION['dataBaseS']->getName());
  		$projeto->setCodProjeto($fachada->inserirProjeto($projeto));
	}
    $metodo = new Metodo('',$projeto->getCodProjeto() ,$_POST['cmbClasseArquitetura'],$_POST['txtNome'], $_POST['txtDescricao'],  addslashes($_POST['txtSql']), $_POST['cmbClasse'], "S", addslashes($_POST['txtCodigo']),$_POST['cmbTipoRetorno']);
    $id = $fachada->inserirMetodo($metodo);
    $metodo->setCodMetodo($id);
    $msg =($id)?(Util::getMsg('S')):(Util::getMsg('E'));
    if($metodo->getCodigo())
    	header('location:../metodos.php?msg='.urlencode($msg));
    else{
    	unset($_SESSION['metodo']);
		$_SESSION['metodo'] = $metodo;    
		header('location:cadMetodoparametro.php?acao=cadastro&msg='.urlencode($msg));
    }
  }
  $vetClasseArquitetura = $fachada->getAllClassearquitetura();
  $facade = new Facade();
  $vetTables = $facade->getAllTableDB($_SESSION['dataBaseS']->getName());
?>
<HTML>
<HEAD>
	<? include dirname(__FILE__).'/../template/templateHeaders.php';?>
</HEAD>
<BODY>
<? include dirname(__FILE__).'/template/templateComeco.php';?>
<div id='divConteudo'>
<FORM name='frmMetodo' method='POST' action='cadMetodo.php' onSubmit='return checarDados(this)'>
	<TABLE>
		<caption >
			Cadastro M&eacute;todo
		</caption>
		<tr>
			<td class='itemForm'>Nome:</td>
			<td colspan="3"><INPUT type='text'  name='txtNome' size='60' value='' maxlength='255' class='textForm'></td>
		</tr>
		<tr>
			<td class='itemForm'>Classe:</td>
			<td>
				<SELECT name="cmbClasse">
				<?
				if($vetTables){
					while ($table = array_shift($vetTables)) {  
				?>
						<option><?=$table->getName()?></option>
				<?
					}
				}
				?>
				</SELECT>
			</td>
			<td class='itemForm'>Tipo de retorno:</td>
			<td>
				<SELECT name="cmbTipoRetorno">
					<option value="ARRAY">Array</option>
					<option value="OBJ">Objeto</option>
					<option value="BOOL">Boolean</option>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td class='itemForm'>Classe(s) da Arquitetura:</td>
			<td colspan="3">
				<SELECT name="cmbClasseArquitetura">
				<?
					while ($classeArquitetura = array_shift($vetClasseArquitetura)) {  
				?>
						<OPTION value="<?=$classeArquitetura->getCodClasseArquitetura()?>"><?=$classeArquitetura->getNome()?></OPTION>
				<?
					}
				?>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
			<td colspan="3"><TEXTAREA name="txtDescricao" cols="90" rows="5"></TEXTAREA></td>
		</tr>
		<tr>
			<td class='itemForm'>Sql:</td>
			<td colspan="3"><TEXTAREA name="txtSql" cols="90" rows="5"></TEXTAREA></td>	
		</tr>
		<tr>
			<td class='itemForm'>C&oacute;digo Fonte:</td>
			<td colspan="3"><TEXTAREA name="txtCodigo" cols="90" rows="7"></TEXTAREA>
			  <br>
			  *Somente se o m&eacute;todo n&atilde;o &eacute; padr&atilde;o ou &eacute; somente em uma classe.<br>
			Quando o C&oacute;digo for preenchido os parametros e o Sql ser&atilde;o descartados. </td>
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