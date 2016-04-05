<br>
	<a href="index.php">Home</a>
	<h2>Banco de Dados</h2>
	<form action="opcoes.php" method="post" name="frmLista">
		<select name="cmbBanco" onChange="frmLista.submit()" class='textForm'>
		<option value="9999">Banco de Dados</option>
			<?php
			while ($dataBaseC = array_shift($vetDataBases)) {
			?>
			<option value="<?=$dataBaseC->getName()?>" <?=($dataBaseC->getName()==$_POST['cmbBanco'])?"selected":""?>><?=$dataBaseC->getName()?></option>
			<?php
			}
			?>
		</select>
		<br><br>
		<hr>
		<h1>Selecione um Banco de Dados</h1>
		<hr>
	</form>