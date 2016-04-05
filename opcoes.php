<?php
// +-----------------------------------------------------------------+
// | ClassGenerator                                                  |
// | Copyleft 2004  UFPA Belém-Pará - Brasil       					 |
// +-----------------------------------------------------------------+
// | Licensed under GPL: www.fsf.org for further details             |
// |                                                                 |
// | Site:   http://www.marcelioleal.net/classgenerator              |
// +-----------------------------------------------------------------+
// | 																 |
// |       Gerador de Artefatos, escrito em PHP, que a partir dos    |
// |       meta-dados de Banco de Dados gera diversos artefatos 	 |
// |       e integra com um Framework embutido.                      |
// |                                                                 |
// | Created at December, 16, 2001                                   |
// | Created by Marcelio Leal  										 |
// | (contato@marcelioleal.net)                      				 |
// +-----------------------------------------------------------------+
include_once "./classes/class.Facade.php";

session_start();
$facade = new Facade();

if($_POST['cmbBanco']){
	if($_POST['cmbBanco'] == '9999')
		header("location:index.php");
	$dataBase = new DataBase($_POST['cmbBanco']);
	$_SESSION['dataBaseS'] = $dataBase;
}elseif($_SESSION['dataBaseS']){
	$dataBase = $_SESSION['dataBaseS'];
}

$vetDataBasesMap = $vetDataBases = $facade->getAllDataBase();
	
?>
<html>
<head>
	<?php include dirname(__FILE__).'/template/templateHeaders.php';?>
</head>
<body>
<table width="100%" border="1">
		<h1 align="center">ClassGenerator - Passo II - Configura&ccedil;&atilde;o para Gera&ccedil;&atilde;o dos Artefatos</h1>
		<hr>
		<div id="divMenu">
			<dt>Menu
				<dd><a href='index.php'>Home</a></dd>
				<dd><a href="metodos.php">Novos M&eacute;todos</a></dd>
			</dt>
		</div>
		<br><br>
		<hr>		
		<h1>Banco de Dados Escolhido: <font color="#3366CC"><?=$dataBase->getName()?></font></h1>
		<form action="gera.php" method="post" name="frmOpcao" id="frmOpcao">
			<fieldset>
				<legend>Artefatos</legend>
				<h5>
				<input name="chkClasses" type="checkbox" id="chkClasses" value="Forms" checked>
				Classes
				<br>Linguagem: 
				<INPUT name="linguagem" type="radio" value="PHP" checked> PHP
				<!-- <INPUT name="linguagem" type="radio" value="Phyton"> Phyton
				<INPUT name="linguagem" type="radio" value="Java"> Java -->
				<br>
				<br>
				SQL
				<br>Estilo: 
				<INPUT name="tipoBanco" type="radio" value="MySQL" checked> MySQL(Simples)
				<INPUT name="tipoBanco" type="radio" value="DB2"> DB2
				<br>
				<br>
				<input name="chkInterfaces" type="checkbox" id="chkInterfaces" value="Forms">
				Interfaces
				<br>Estilo: 
				<INPUT name="estilo" type="radio" value="icone" checked> 1(Icone por <a href='http://www.abstractbi.com' target='_blank'>Abstract BI</a>)
				<INPUT name="estilo" type="radio" value="assai"> 2(Assai por <a href='http://www.abstractbi.com' target='_blank'>Abtract BI</a>)
				</h5>
			</fieldset>
			<br>
			<fieldset>
				<legend>Padr&atilde;o de Nomeclatura</legend>
				<h5>
				<input name="rdPadrao" type="radio" value="OO" checked>1 - nome1Nome2 <br>
				<input type="radio" name="rdPadrao" value="REL">2 - nome1_Nome2(Com _ entre as palavras)
				</h5>
			</fieldset>
			<h5>Banco de Mapeamento*:
			<select name="cmbBancoMap" >
				<option value="">Banco de Dados</option>
				<?
				while ($dataBaseMap = array_shift($vetDataBasesMap)) {
				?>
				<option value="<?=$dataBaseMap->getName()?>"><?=$dataBaseMap->getName()?></option>
				<?	}?>
			</select>
			</h5>
			<input name="banco" type="hidden" id="banco" value="<?=$dataBase->getName()?>">
			<input name="btnOk" type="submit" id="btnOk" value="Gerar">
		</form>
</body>
</html>