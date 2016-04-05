<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 Ã s 02:32:03

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();
  
  $fachada = new Fachada();

  //vem do adm
  if($_GET['codMetodo']){
  	$_SESSION['metodo'] = $fachada->getMetodo($_GET['codMetodo']);
  }
  
  //vem do cad
  if($_GET['acao'] == 'cadastro'){
  	$sql = $_SESSION['metodo']->getSql();
  	//quebra pelo espaço
	$palavras = explode(" ",trim($sql));
	//procura um $ substituindo pelos caracteres especiais
//	print_r($palavras);
	while($palavra = array_shift($palavras)){
		if(strstr($palavra,"$")){
			$palavra = stripslashes(stripslashes($palavra));
			$aux = strstr(str_replace("'","",str_replace("(","",str_replace(")","",str_replace(",","",$palavra)))),"$");
			//$parametro = $fachada->getParametroNome(substr($aux,1,strlen($aux)-1));
			$parametros[] = ($parametro)?$parametro:new Parametro('',$_SESSION['metodo']->getCodMetodo(),substr($aux,1,strlen($aux)-1),'','','');
		}
	}
  }

  //$fachada->getVerificaPermissao($_SESSION['usuarioClassgenerator'],__FILE__);
  if($_POST['btnSalvar']){
  		if($_POST['txtNome']){
		  	$parametro = new Parametro('',$_SESSION['metodo']->getCodMetodo(),$_POST['txtNome'],$_POST['cmbTipoParametro'],$_POST['txtDescricao'],$_POST['txtOrdem']);
		  	$id = $fachada->inserirParametro($parametro);
  		}
  		if($_POST['hdNumParametrosAuto']){
  			
  			for($i=1;$i<=$_POST['hdNumParametrosAuto'];$i++)
  				if($_POST['txtNome'.$i]){
				  	$parametro = new Parametro('',$_SESSION['metodo']->getCodMetodo(),$_POST['txtNome'.$i],$_POST['cmbTipoParametro'.$i],$_POST['txtDescricao'.$i],$_POST['txtOrdem'.$i]);
				  	$id = $fachada->inserirParametro($parametro);
  				}
  		}
    $msg =($res)?(Util::getMsg('S')):(Util::getMsg('E'));
    header('location:cadMetodoparametro.php?msg='.urlencode($msg));
  }elseif($_POST['btnConcluir']){
  	$msg = "M&eacute;todo Conclu&iacute;do com sucesso!";
  	header('location:../metodos.php?msg='.urlencode($msg));
  }
  $vetParametro = $fachada->getParametrosMetodo($_SESSION['metodo']->getCodMetodo());
?>
<HTML>
<HEAD>
	<? include dirname(__FILE__).'/../template/templateHeaders.php';?>
</HEAD>
<BODY>
<? include dirname(__FILE__).'/template/templateComeco.php';?>
<div id='divConteudo'>
	<FORM name='frmMetodoparametro' method='POST' action='cadMetodoparametro.php' onSubmit=''>
		<TABLE>
			<caption >
				Cadastro de Par&acirc;metros
			</caption>
			<?
			if($parametros){
			for ($i=1;$i<=count($parametros);$i++){
					$parametro = $parametros[$i-1];
			?>
			<tr>
				<td class='itemForm'>Nome:</td>
				<td><INPUT type='text'  name='txtNome<?=$i?>' size='60' value='<?=$parametro->getNome()?>' maxlength='255' class='textForm'></td>
				<td class='itemForm'>Tipo:</td>
				<td>
				<SELECT name="cmbTipoParametro<?=$i?>">
					<OPTION value="<?=Constante::getValor("TipoParametro","variavel simples")?>" <?=(Constante::getValor("TipoParametro","variavel simples") == $parametro->getTipo())?"selected":""?>>Vari&aacute;vel Simples</OPTION>
					<OPTION value="<?=Constante::getValor("TipoParametro","objeto")?>" <?=(Constante::getValor("TipoParametro","objeto") == $parametro->getTipo())?"selected":""?>>Objeto</OPTION>
				</SELECT>
				</td>
			</tr>
		<tr>
			<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
			<td><INPUT type='text'  name='txtDescricao<?=$i?>' size='60' value='<?=$parametro->getDescricao()?>' maxlength='255' class='textForm'></td>
			<td class='itemForm'>Ordem:</td>
			<td><INPUT type='text'  name='txtOrdem<?=$i?>' size='2' value='<?=$i?>' maxlength='2' class='textForm'></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<?
		}}
		?>
		<tr>
			<td class='itemForm'>Nome:</td>
			<td><INPUT type='text'  name='txtNome' size='60' value='' maxlength='255' class='textForm'></td>
			<td class='itemForm'>Tipo:</td>
			<td>
			<SELECT name="cmbTipoParametro">
				<OPTION value="<?=Constante::getValor("TipoParametro","variavel simples")?>">Vari&aacute;vel Simples</OPTION>
				<OPTION value="<?=Constante::getValor("TipoParametro","objeto")?>" >Objeto</OPTION>
			</SELECT>
			</td>
		</tr>
		<tr>
			<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
			<td><INPUT type='text'  name='txtDescricao' size='60' value='' maxlength='255' class='textForm'></td>
			<td class='itemForm'>Ordem:</td>
			<td><INPUT type='text'  name='txtOrdem' size='2' value='<?=count($vetParametros)+1?>' maxlength='2' class='textForm'></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan='4'>
			<INPUT type='submit'  name='btnSalvar' value='Salvar' class='buttonForm'>
			<input type="hidden" name="hdNumParametrosAuto" value="<?=count($parametros)?>"> - <INPUT type='submit'  name='btnConcluir' value='Concluir' class='buttonForm'>
			</td>
		</tr>
		</TABLE>
	</FORM>
	<TABLE>
		<caption >
			Ger&ecirc;ncia dos Par&acirc;metros do M&eacute;todo <?=$_SESSION['metodo']->getNome()?> da Classe <?=$_SESSION['metodo']->getClasse()?>
		</caption>
		<tr>
			<th scope='col'>Nome</th>
			<th scope='col'>Tipo</th>
			<th scope='col'>Descri&ccedil;&atilde;o</th>
			<th scope='col'>Ordem</th>
			<th scope='col'>Editar</th>
			<th scope='col'>Excluir</th>
		</tr>
		<?
			if ($vetParametro){
				while ($parametro = array_shift($vetParametro)){
		?>
		<tr>
			<td><?=$parametro->getNome()?></td>
			<td><?=Constante::getLabel("TipoParametro",$parametro->getTipo());?></td>
			<td><?=$parametro->getDescricao();?></td>
			<td><?=$parametro->getOrdem();?></td>
			<td><div align="center"><a href='editParametro.php?codParametro=<?=$parametro->getCodParametro()?>&acao=editar'><img  src='./imagens/edit.gif' alt='Editar'></a></div></td>
			<td><div align="center"><a href='editParametro.php?codParametro=<?=$parametro->getCodParametro()?>&acao=excluir'><img  src='./imagens/del.gif' alt='Excluir'></a></div></td>
		</tr>
		<?
			}}else{
		?>
		<tr>
			<td colspan='6'><strong>N&atilde;o h&aacute; nenhum par&acirc;metro cadastrado!</strong></td>
		</tr>
		<?
			}
		?>
	</TABLE>
</div>
<?// include('template/templateFim.php');?>
</BODY>
</HTML>