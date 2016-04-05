<?php 
// ClassGenerator 1.5 Lite - www.classgenerator.net
// Classe gerada em 23/05/2004 ás 00:42:31

  include_once dirname(__FILE__).'/metodo/classes/class.Fachada.php';
  include_once dirname(__FILE__).'/classes/class.Facade.php';
  session_start();

  $fachada = new Fachada();
  $vetMetodo = $fachada->getMetodosProjetoBanco($_SESSION['dataBaseS']->getName(),$_GET['ordem']);
  $projeto = $fachada->getProjetoBanco($_SESSION['dataBaseS']->getName());
?>
<HTML>
<HEAD>
<?php include dirname(__FILE__).'/template/templateHeaders.php';?>
</HEAD>
<BODY>
<h1 align="center">ClassGenerator - Manuten&ccedil;&atilde;o de Artefatos</h3>
<hr>
<div id="divMenu">
<dt>Menu
<dd><a href='metodo/cadMetodo.php'>Cadastrar</a> - <a href='gera.php'>Gerar</a> - <a href='opcoes.php'>Voltar</a></dd>
</dt>
</div>
<br><br>
<hr>		
<?=($_GET['msg'])?"<h1>".$_GET['msg']."</h1>":''?>
<div id='divConteudo'>
	<?php
	if($projeto){
	?>
	<table>
		<caption>Projeto: <font color="#000000"><?=$projeto->getDescricao()?></font></caption>
		<tr>
		<th>Coordenador de Desenvolvimento:</th><th><?=$projeto->getCoordenador()?> </th><td> <a href='#'<? //'editProjeto.php'?>>Modificar o Projeto</a></td>
		</tr>
	</table>
	<br>
	<?php }else{?>
		<h1>Projeto: <font color="#3366CC"><?=$_SESSION['dataBaseS']->getName()?></font></h1>
	<?php }?>
	<TABLE>
		<caption >Ger&ecirc;ncia de M&eacute;todo</caption>
		<tr>
			<th scope='col'><a href="metodos.php?ordem=nome">Nome</a></th>
			<th scope='col'><a href="metodos.php?ordem=classe">Classe</a></th>
			<th scope='col'>&nbsp;</th>
			<th scope='col'>&nbsp;</th>
			<th scope='col'>&nbsp;</th>
		</tr>
		<?php
			if ($vetMetodo){
				while ($metodo = array_shift($vetMetodo)){
					$classeArquitetura = $fachada->getClassearquitetura($metodo->getCodClasseArquitetura());
		?>
			<tr>
				<td><a href="#" onclick="abrirJanela('metodo/detalheMetodo.php?codMetodo=<?=$metodo->getCodMetodo()?>')"><?=$metodo->getNome();?></a></td>
				<td><?=$metodo->getClasse();?> (<?=$classeArquitetura->getNome()?>)</td>
				<td><a href='metodo/cadMetodoparametro.php?codMetodo=<?=$metodo->getCodMetodo()?>'>Par&acirc;metros</a></td>
				<td><a href='metodo/editMetodo.php?codMetodo=<?=$metodo->getCodMetodo()?>&acao=editar'><img  src='./imagens/edit.gif' alt='Editar'></a></td>
				<td><a href='metodo/editMetodo.php?codMetodo=<?=$metodo->getCodMetodo()?>&acao=excluir'><img  src='./imagens/del.gif' alt='Excluir'></a></td>
			</tr>
		<?php
			}}else{
		?>
		<tr>
			<td colspan='10'><strong>N&atilde;o h&aacute; nenhum registro cadastrado!</strong></td>
		</tr>
		<?php
			}
		?>
	</TABLE>
</div>
<?php //include('template/templateFim.php');?>
</BODY>
</HTML>