<?

class Banco{
	
	var $nome;
	var $tabelas;
	
	function Banco($nome){
		$this->nome = $nome;
		$this->tabelas = @mysql_list_tables($nome);
		//no firebird
		//SELECT RDB$RELATION_NAME FROM RDB$RELATIONS;
		/*
		SELECT FIELD.RDB$FIELD_NAME, FIELDSD.RDB$FIELD_LENGTH, FIELDSD.RDB$FIELD_TYPE
		FROM 
		RDB$RELATION_FIELDS FIELD
		INNER JOIN RDB$FIELDS FIELDSD
		ON FIELDSD.RDB$FIELD_NAME = FIELD.RDB$FIELD_SOURCE
		WHERE RDB$RELATION_NAME = 'ALUNO'
		*/
	}
	
	function getTabelas(){
		return $this->tabelas;
	}
	
	function getTabela($i){
		return mysql_tablename($this->getTabelas(), $i);
	}
	
	function getNome(){
		return $this->nome;
	}
	
	function getNumTabs(){
		return mysql_numrows($this->getTabelas());
	}
	
}
?>