<?

class JavaScript{
	var $table;
	var $text;
	

	function JavaScript($table){
			$this->table = $table;
			$this->text = "<SCRIPT language='javascript'>\n".
										"formulario = new FormContext(document.frm".ucfirst($table->getNameF()).");\n";
			$this->generation();
	}
	
	function generation(){
		$vetFields = $this->table->getVetFields();
		for($i=0;$i<count($vetFields);$i++)
			$this->addField($vetFields[$i]);
	}
	
	function addField($field){
		if($field->getPK() && $field->getExtra() == "auto_increment"){
			return false;
		}else{
				// adicionar regra para pegar tb o cpf e colocar um eskema de adicionamento de regras...
				if((!$field->getNull()) || $field->getType() ==  "int"	|| 	$field->getType() ==  "date" || 	$field->getType() ==  "year"){
					switch ($field->getType()){
						case "int":
							$type = "numero";
							break;
						case "date":
							$type = "data";
							break;
						case "year":
							$type = "numero";
							break;
						default:
							$type = '';
					}
					$this->text .= "formulario.addCampo('txt".ucfirst($field->getNameF())."','".ucfirst($field->getNameF())."' , '".$type."', ".(($field->getNull())?"true":"false").");\n";
				}
			}
		}
		
	function getResult(){
		return $this->text.'</SCRIPT>';
	}		
		
}
?>