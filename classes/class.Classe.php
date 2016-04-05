<?
include_once dirname ( __FILE__ ) . "/class.Util.php";
include_once dirname ( __FILE__ ) . "/class.Table.php";
include_once dirname ( __FILE__ ) . "/class.Maping.php";

class Classe {
	
	var $nome;
	var $table;
	var $conteudo;
	var $util;
	var $atributos;
	var $projeto;
	
	function Classe($nome = "", $table = "", $util = "", $atributos = '', $conteudo = "", $projeto = "") {
		$this->util = $util;
		$this->nome = $nome;
		$this->table = $table;
		$this->atributos = $atributos;
		$this->projeto = $projeto;
	}
	
	function getConteudo() {
		return $this->conteudo;
	}
	
	function setConteudo($x) {
		$this->conteudo = $x;
	}
	
	function getProjeto() {
		return $this->projeto;
	}
	
	function setProjeto($x) {
		$this->projeto = $x;
	}
	
	function getNome() {
		return $this->nome;
	}
	
	function setNome($x) {
		$this->nome = $x;
	}
	
	function getTable() {
		return $this->table;
	}
	
	function setTable($x) {
		$this->table = $x;
	}
	
	function getUtil() {
		return $this->util;
	}
	
	function setUtil($util) {
		$this->util = $util;
	}
	
	function getAtributos() {
		return $this->atributos;
	}
	
	function setAtributos($atributos) {
		$this->atributos = $atributos;
	}
	
	//inicio e comentários
	function comeco() {
		return "<?php \n" . $this->util->cabecalho ();
	}
	
	//Declaração da Classe
	function dClasse($superClasse = '') {
		$texto = "class " . $this->getNome ();
		$texto .= ($superClasse) ? " extends $superClasse{\n" : "{\n";
		// Atributos da classe
		if ($vetAtt = $this->getAtributos ())
			while ( $field = array_shift ( $vetAtt ) )
				$texto .= "  var $" . $field . ";\n";
		$texto .= "\n";
		return $texto;
	}
	
	function dClasse2($superClasse = '') {
		$texto = "class " . $this->getNome ();
		$texto .= ($superClasse) ? " extends $superClasse{\n" : "{\n";
		$texto .= "\n";
		return $texto;
	}
	
	//finalizando
	function fim() {
		return "}\n?>";
	}

}
?>