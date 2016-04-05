<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 ás 00:42:31

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  $vetMetodo = $fachada->getAllMetodo();
?>
<HTML>
<HEAD>
<? include dirname(__FILE__).'/template/templateHeaders.php';?>
</HEAD>
<BODY>
<? include dirname(__FILE__).'/template/templateComeco.php';?>
<?=($_GET['msg'])?$_GET['msg']:''?>
<div id='divConteudo'>
<TABLE>
<caption >Ger&ecirc;ncia de M&eacute;todo</caption>
<tr>
<th scope='col'>Nome</th>
<th scope='col'>Descri&ccedil;&atilde;o</th>
<th scope='col'>Classe</th>
<th scope='col'>Classe Arquitetura</th>
<th scope='col'>&nbsp;</th>
<th scope='col'>&nbsp;</th>
<th scope='col'>&nbsp;</th>
</tr>
<?
	if ($vetMetodo){
		$i=0;
		while ($metodo = array_shift($vetMetodo)){
?>
<tr>
<td><?=$metodo->getNome();?></td>
<td><?=$metodo->getDescricao();?></td>
<td><?=$metodo->getClasse();?></td>
<td><?
$classeArquitetura = $fachada->getClassearquitetura($metodo->getCodClasseArquitetura());
print $classeArquitetura->getNome();
?></td>
<td><a href='cadMetodoparametro.php?codMetodo=<?=$metodo->getCodMetodo()?>'>Par&acirc;metros</a></td>
<td><a href='editMetodo.php?codMetodo=<?=$metodo->getCodMetodo()?>&acao=editar'><img  src='./imagens/edit.gif' alt='Editar'></a></td>
<td><a href='editMetodo.php?codMetodo=<?=$metodo->getCodMetodo()?>&acao=excluir'><img  src='./imagens/del.gif' alt='Excluir'></a></td>
</tr>
<?
		$i++;
	}}else{
?>
<tr>
<td colspan='10'><strong>N&atilde;o h&aacute; nenhum registro cadastrado!</strong></td>
</tr>
<?
	}
?>
</TABLE>
</div>
<? //include('template/templateFim.php');?>
</BODY>
</HTML>