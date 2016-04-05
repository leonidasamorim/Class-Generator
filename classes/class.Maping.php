<?

class Maping{

	function typeLanguage($field,$type){
		//if($field->getFK()){
			//codigo complexo com combo e um while com os valores ou seja engloba as linguagens
		//}else{
		//}
		return Maping::typeToJava($field);
	}
	
	function typeToJava($field){
		if(is_object($field))
		switch ($field->getCategory()){
			case "int":
				return "int";
				break;
			case "float":
				return "double";
				break;
			case "year":
				return "int";
				break;
			default:
				return "String";
				break;
		}
	}
	
}


?>