<?
class Tabela {
  var $nome;
  var $campos;
  var $chaves;
  var $banco;
  var $camposN;
  
  function Tabela($db,$nome) {
  	$this->banco   = $db;
    $this->nome    = $nome;
    $this->campos  = mysql_list_fields($db, $nome);
    for ($i=0;$i<$this->numCampos();$i++){
    	if (stristr(mysql_field_flags($this->campos,$i),"primary")){
  			$this->chaves[]  = mysql_field_name($this->campos, $i);
    	}else{
    		$this->camposN[] = mysql_field_name($this->campos, $i);
    	}
    		$atributos[]       = mysql_field_name($this->campos, $i);
  	}
  	$this->campos = $atributos;
  }

  function getNome() {
    return $this->nome;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }
  
  function getBanco() {
    return $this->banco;
  }

  function numCampos(){
  	return mysql_num_fields($this->campos);
  }

  function getCampo($indice) {
  	return $this->campos[$indice];
  }

  function setCampo($indice, $campo) {
    $this->campos[$indice] = $campo;
  }
  
  function getCampos(){
  	return $this->campos;
  }
  
  function getChaves(){
  	return $this->chaves;
  }

  function getCamposN(){
  	return $this->camposN;
  }
  
  function getChavesAss(){
  	$chs="";
  	$chavesT = $this->chaves;
  	for($i=0; $i<count($chavesT) ;$i++){
		$chs .=$chavesT[$i];
		if($i != count($chavesT)-1) {
			$chs .=",";	
		}  	
  	}
  	return $chs;
  }

}
?>