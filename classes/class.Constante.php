<?
class Constante{

	var $valores;
	
	function Constante(){
		
	}
	
	function setValores(){
	//todos os valores não são acentuados e sempre em minusculo
		$valores = Array();
		//--------------------------------------------------------------------
		$valores['TipoParametro']['variavel simples'] 	= 1;
		$valores['TipoParametro']['objeto']				= 2;
		//--------------------------------------------------------------------
		//$this->valores[''][''] = ;
		return $valores;
	}
	
	function getValor($entidade,$nome){
		$valores = Constante::setValores();
		return $valores[$entidade][$nome];	
	}
	
	function getLabel($entidade,$valor){
		$valores = Constante::setValores();
		$arrAux = $valores[$entidade];
		$label = array_search($valor,$arrAux);
		return $label;
	}

	function getMaxRegistrosPag(){
		return 15;
	}
}
?>
