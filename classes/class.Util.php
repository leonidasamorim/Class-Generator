<?

class Util {
	// tipos OO - REL
	var $padrao;
	
	function Util($padrao = "OO") {
		$this->padrao = $padrao;
	}
	
	function cabecalho() {
		return "// Powered by ClassGenerator - http://www.marcelioleal.net/classgenerator\n// Artefato gerado em " . date ( "d/m/Y" ) . " - " . date ( "H:i:s" ) . "\n\n";
	}
	
	/*
	PS.:Eh interesante colocar a letra que vier em mai�scula em mai�scula tb no nome da classe,
		mas ai eu acho que ser� interessante ter o padr�o setado no banco
	* Padr�es indicados
	Transforma��o:
	*ALUNO_PROFESSOR  	=> 	AlunoProfessor - "REL"
	*AlunoProfessor		=>	AlunoProfessor - "OO"
	Alunoprofessor		=>	Alunoprofessor - "REL"
	alunoProfessor		=>	Alunoprofessor - "REL"
	ALUNOPROFESSOR		=>	Alunoprofessor - "REL"
	*/
	function forNClassMet($nome, $pad = "") {
		if (($this->padrao == "OO") || ($pad == "OO"))
			return Util::tPadraoOO ( $nome );
		else
			return Util::tPadraoRel ( $nome );
	}
	
	function forNAtt($nome, $pad = "") {
		if (($this->padrao == "OO") || ($pad == "OO"))
			return $nome;
		else {
			$nome = Util::tPadraoRel ( $nome );
			return strtolower ( $nome [0] ) . substr ( $nome, 1, strlen ( $nome ) - 1 );
		}
	}
	
	function tPadraoOO($nome) {
		return ucfirst ( $nome );
	}
	
	function tPadraoRel($nome) {
		return str_replace ( " ", "", ucwords ( strtolower ( str_replace ( "_", " ", $nome ) ) ) );
	}
	
	function getPadrao() {
		return $this->padrao;
	}
	
	function setPadrao($padrao) {
		$this->padrao = $padrao;
	}
	
	function getMsg($mod) {
		switch ($mod) {
			case "S" :
				return "<br><div id='divMensagem'><br>A opera&ccedil;&atilde;o foi realizada com sucesso!</div>";
			case "E" :
				return "<br><div id='divMensagem'><br>A opera&ccedil;&atilde;o n&atilde;o foi realizada!</div>";
		}
	}
	
	function getDataAtual() {
		return date ( "Y-m-d" );
	}
	
	function getHoraAtual() {
		return date ( "h:i:s" );
	}
	
	function converteData($data) {
		return $this->converteAmdParaDma ( $data );
	}
	
	function &converteMdaParaDma(&$data) {
		$data = substr ( $data, 0, 10 );
		list ( $mes, $dia, $ano ) = explode ( "/", $data );
		$data = $dia . "/" . $mes . "/" . $ano;
		return $data;
	}
	
	function &converteDmaParaMda(&$data) {
		$data = substr ( $data, 0, 10 );
		list ( $dia, $mes, $ano ) = explode ( "/", $data );
		$data = $mes . "/" . $dia . "/" . $ano;
		return $data;
	}
	
	function &converteDmaParaAmd(&$data) {
		$data = substr ( $data, 0, 10 );
		list ( $dia, $mes, $ano ) = explode ( "/", $data );
		$data = $ano . "-" . $mes . "-" . $dia;
		return $data;
	}
	
	function &converteAmdParaDma(&$data) {
		$data = substr ( $data, 0, 10 );
		list ( $ano, $mes, $dia ) = explode ( "-", $data );
		$data = $dia . "/" . $mes . "/" . $ano;
		return $data;
	}

}
?>