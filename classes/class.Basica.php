<?
include_once dirname(__FILE__)."/class.Classe.php";
include_once dirname(__FILE__)."/class.BasicaPHP.php";
include_once dirname(__FILE__)."/artefatos/class.BasicaJava.php";
include_once dirname(__FILE__)."/artefatos/class.BasicaPhyton.php";
include_once dirname(__FILE__).'/class.Facade.php';

class Basica extends Classe {

	function getMetodosCadastrados(){
		//c�digo na marra
		$facade = new Facade();
		$vetMetodos = $facade->getMetodosClasseArquiteturaTab(3,$this->table->getName());
		if($vetMetodos)
			while ($metodo = array_shift($vetMetodos)) {  
				if($metodo->getCodigo())
					$texto .= $metodo->getCodigo()."\n";
			}
		//fim do c�digo na marra
		return $texto;
	}
	
	

}
?>