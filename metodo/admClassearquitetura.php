<?php 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 às 02:32:03

  include_once dirname(__FILE__).'/classes/class.Fachada.php';
  session_start();

  $fachada = new Fachada();
  $vetClassearquitetura = $fachada->getAllClassearquitetura();
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
Ger&ecirc;ncia da Arquitetura da Classe 
</caption>
<tr>
<th scope='col'>CodClasseArquitetura</th>
<th scope='col'>Nome</th>
<th scope='col'>Editar</th>
<th scope='col'>Excluir</th>
</tr>
<?php
	if ($vetClassearquitetura){
		while ($classearquitetura = array_shift($vetClassearquitetura)){
?>
<tr>
<td><?=$classearquitetura->getCodClasseArquitetura();?></td>
<td><?=$classearquitetura->getNome();?></td>
<td><div align="center"><a href='editClassearquitetura.php?codClasseArquitetura=<?=$classearquitetura->getCodClasseArquitetura()?>&acao=editar'><img  src='./imagens/edit.gif' alt='Editar'></a></div></td>
<td><div align="center"><a href='editClassearquitetura.php?codClasseArquitetura=<?=$classearquitetura->getCodClasseArquitetura()?>&acao=excluir'><img  src='./imagens/del.gif' alt='Excluir'></a></div></td>
</tr>
<?php
	}}else{
?>
<tr>
<td colspan='5'><strong>N&atilde;o h&aacute; nenhum registro cadastrado!</strong></td>
</tr>
<?php
	}
?>
</TABLE>
</div>
<?php //include('template/templateFim.php');?>
</BODY>
</HTML>