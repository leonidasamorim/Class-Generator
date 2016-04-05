<?
include_once dirname ( __FILE__ ) . "/class.Basica.php";
include_once dirname ( __FILE__ ) . "/class.CadPai.php";
include_once dirname ( __FILE__ ) . "/class.Cad.php";
include_once dirname ( __FILE__ ) . "/class.Fachada_Pai.php";
include_once dirname ( __FILE__ ) . "/class.Fachada.php";
include_once dirname ( __FILE__ ) . "/artefatos/SQL/class.SQL.php";

class Factory {
	
	function Factory() {
	}
	
	function criarBasicaPai($tipo, $table, $util) {
		switch ($tipo) {
			case "PHP" :
				return new BasicaPHP ( $table, $util );
			case "Java" :
				return new BasicaJava ( $table, $util );
			case "Phyton" :
				return new BasicaPhyton ( $table, $util );
		}
	}
	
	function criarFachadaPai($tipo, $padrao, $nameBD) {
		switch ($tipo) {
			case "PHP" :
				return new FachadaPHP ( $padrao, $nameBD );
			case "Java" :
				return new FachadaJava ( $padrao, $nameBD );
			case "Phyton" :
				return new FachadaPhyton ( $padrao, $nameBD );
		}
	}
	
	function criarFachada($tipo, $padrao, $nameBD) {
		if ($tipo == "PHP") {
			return new FachadaPHP2 ( $padrao, $nameBD );
		}
	
	}
	
	function criarCadPai($tipo, $table, $util, $nameBD) {
		switch ($tipo) {
			case "PHP" :
				return new CadPHP ( $table, $util, $nameBD );
			case "Java" :
				return new CadJava ( $table, $util, $nameBD );
			case "Phyton" :
				return new CadPHP ( $table, $util, $nameBD );
		}
	}
	
	function criarCad($tipo, $table, $util, $nameBD) {
		if ($tipo == "PHP") {
			return new CadPHP2 ( $table, $util, $nameBD );
		}
	}
	
	function createSQL($tipo) {
		switch ($tipo) {
			case "MySQL" :
				return new SQLMySQL ();
			case "DB2" :
				return new SQLDB2 ();
		}
	}
}

?>