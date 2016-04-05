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
unset($_SESSION['dataBaseS']);

$facade 		= new Facade();
$vetDataBases 	= $facade->getAllDataBase();
?>
<html>
<head>
	<?php include dirname(__FILE__).'/template/templateHeaders.php';?>
</head>
<body>
<table width="100%" border="1">
  <tr>
    <td width="21%" valign="top">
		<?php include dirname(__FILE__).'/left.php';?>
	</td>
    <td width="79%" bordercolor="#FFFFFF">
		<p align="center"><img src="./imagens/Logo.gif" width="221" height="127"></p>
		<h1 align="center">Compat&iacute;vel PHP 4 e 5</h2>
		<br>
		<p align="center">
		<a href="creditos.php">CopyLeft&copy; Todos os Direitos Reservados aos Autores</a>
		</p>
		<br>
		<table width="100%" border="0">
			<tr> 
				<td><div align="center"><a onClick="javascript:abrirJanela('http://www.php.net')"><img src="imagens/phpqa.jpg" width="133" height="70" border="0"></a></div></td>
				<td><div align="center"><a href="#" onClick="javascript:abrirJanela('http://sig.ufpa.br/phppaidegua')"><img src="imagens/LogoGrupo.jpg" width="124" height="78" border="0"></a></div></td>
				<td><div align="center"><a href="#" onClick="javascript:abrirJanela('http://www.mysql.com')"><img src="imagens/myssql.jpg" width="108" height="57" border="0"></a></div></td>
			</tr>
			<tr> 
				<td colspan="3">
				<br>
				<h1 align="center">Apoio:<br>
				<a href="#" onClick="javascript:abrirJanela('http://www.ufpa.br')"><img src="imagens/logo_ufpa.jpg" width="38" height="50" border="0"></a>
				<br>
				Universidade Federal do Par&aacute;</h1>
				</td>
			</tr>
		</table>
	</td>
  </tr>
</table>
</body>
</html>