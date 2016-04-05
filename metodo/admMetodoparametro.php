<?php 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:32:03

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  $vetMetodoparametro = $fachada->getAllMetodoparametro();
?>
<HTML>
<HEAD>
<?php include('template/templateHeaders.php');?>
</HEAD>
<BODY>
<?php include('template/templateComeco.php');?>
<div id='divMensagem'>
<?=($_GET['msg'])?$_GET['msg']:''?>
</div>
<div id='divConteudo'>
<TABLE>
<caption >
Gerência de Par&acirc;metros do 
 M&eacute;todo 
</caption>
<tr>
<th scope='col'>CodParametro</th>
<th scope='col'>CodMetodo</th>
<th scope='col'>Ordem</th>
<th scope='col'>Editar</th>
<th scope='col'>Excluir</th>
</tr>
<?
	if ($vetMetodoparametro){
		while ($metodoparametro = array_shift($vetMetodoparametro)){
?>
<tr>
<td><?=$metodoparametro->getCodParametro();?></td>
<td><?=$metodoparametro->getCodMetodo();?></td>
<td><?=$metodoparametro->getOrdem();?></td>
<td><div align="center"><a href='editMetodoparametro.php?codParametro=<?=$metodoparametro->getCodParametro()?>&codMetodo=<?=$metodoparametro->getCodMetodo()?>&acao=editar'><img  src='./imagens/edit.gif' alt='Editar'></a></div></td>
<td><div align="center"><a href='editMetodoparametro.php?codParametro=<?=$metodoparametro->getCodParametro()?>&codMetodo=<?=$metodoparametro->getCodMetodo()?>&acao=excluir'><img  src='./imagens/del.gif' alt='Excluir'></a></div></td>
</tr>
<?
	}}else{
?>
<tr>
<td colspan='6'><strong>N&atilde;o h&aacute; nenhum registro cadastrado!</strong></td>
</tr>
<?
	}
?>
</TABLE>
</div>
<?php //include('template/templateFim.php');?>
</BODY>
</HTML>