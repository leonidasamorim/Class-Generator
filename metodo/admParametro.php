<? 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:32:03

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  $vetParametro = $fachada->getAllParametro();
?>
<HTML>
<HEAD>
<? include('template/templateHeaders.php');?>
</HEAD>
<BODY>
<? include('template/templateComeco.php');?>
<?=($_GET['msg'])?$_GET['msg']:''?>
<div id='divConteudo'>
<TABLE>
<caption >
Ger&ecirc;ncia de Par&acirc;metro
</caption>
<tr>
<th scope='col'>CodParametro</th>
<th scope='col'>Nome</th>
<th scope='col'>Tipo</th>
<th scope='col'>Descri&ccedil;&atilde;o</th>
<th scope='col'>Editar</th>
<th scope='col'>Excluir</th>
</tr>
<?
	if ($vetParametro){
		while ($parametro = array_shift($vetParametro)){
?>
<tr>
<td><?=$parametro->getCodParametro();?></td>
<td><?=$parametro->getNome();?></td>
<td><?=$parametro->getTipo();?></td>
<td><?=$parametro->getDescricao();?></td>
<td><div align="center"><a href='editParametro.php?codParametro=<?=$parametro->getCodParametro()?>&acao=editar'><img  src='./imagens/edit.gif' alt='Editar'></a></div></td>
<td><div align="center"><a href='editParametro.php?codParametro=<?=$parametro->getCodParametro()?>&acao=excluir'><img  src='./imagens/del.gif' alt='Excluir'></a></div></td>
</tr>
<?
	}}else{
?>
<tr>
<td colspan='7'><strong>N&atilde;o h&aacute; nenhum registro cadastrado!</strong></td>
</tr>
<?
	}
?>
</TABLE>
</div>
<?php //include('template/templateFim.php');?>
</BODY>
</HTML>