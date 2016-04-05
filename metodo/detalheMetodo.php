<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 00:42:31

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  include_once dirname(__FILE__).'/../classes/class.Facade.php';
  
  session_start();

  $fachada = new Fachada();

  $metodo = $fachada->getMetodo($_GET['codMetodo']);
  if(!$metodo)
  	die("Não há método");
  $vetParametros = $fachada->getParametrosMetodo($metodo->getCodMetodo());
  $classeArquitetura = $fachada->getClasseArquitetura($metodo->getCodClasseArquitetura());
?>
<HTML>
<HEAD>
	<? include dirname(__FILE__).'/../template/templateHeaders.php';?>
</HEAD>
<BODY>
<h1>Projeto: <font color="#3366CC"><?=$_SESSION['dataBaseS']->getName()?></font></h1>
<div id='divConteudo'>
<TABLE>
<caption >
Detalhe do M&eacute;todo - <?=$metodo->getNome()?>(
<?
if($vetParametros)
	for($i=0;$i<count($vetParametros);$i++){
		$parametro = $vetParametros[$i];
		print "\$".$parametro->getNome().(($i<(count($vetParametros)-1))?",":"");
	}
?>
)
</caption>
	<tr>
		<td class='itemForm'>Nome:</td>
		<td><?=$metodo->getNome()?></td>
	</tr>
	<tr>
		<td class='itemForm'>Classe:</td>
		<td><?=$metodo->getClasse()?></td>
	</tr>
	<tr>
		<td class='itemForm'>Classe Arquitetura:</td>
		<td><?=$classeArquitetura->getNome()?></td>
	</tr>
	<tr>
		<td class='itemForm'>Descri&ccedil;&atilde;o:</td>
		<td colspan="3"><?=$metodo->getDescricao()?></td>
	</tr>
</TABLE>
<TABLE>
<tr>
	<CAPTION>Par&acirc;metros</CAPTION>
</tr>
<?
if($vetParametros){
?>
<tr>
	<th>Ordem:</th>
	<th>Nome:</th>
	<th>Descri&ccedil;&atilde;o:</th>
</tr>
<?
	while ($parametro = array_shift($vetParametros)) {
?>
<tr>
	<td><?=$parametro->getOrdem()?></td>
	<td><?=$parametro->getNome()?></td>
	<td><?=$parametro->getDescricao()?></td>
</tr>
<?
	}}else{
?>	
<tr>
	<td class="itemform">N&atilde;o h&aacute; par&acirc;metros</td>
</tr>
<?
	}
?>
</FORM>
</div>
<? //include('template/templateFim.php');?>
</BODY>
</HTML>