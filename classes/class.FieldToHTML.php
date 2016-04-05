<?

class FieldToHTML{

	function FieldToHTML(){
	
	}
	
	function transformar($field,$valor){
		if($field->getPK() && $field->getExtra() == "auto_increment"){
			return false;
		}else{
			if($field->getFK()){
				//codigo complexo com combo e um while com os valores ou seja engloba as linguagens
			}else{
				switch ($field->getCategory()){
					case "long string":
						return new TextArea($valor,"txt".ucfirst($field->getNameF()),"",0,"textForm",7,60);
						break;
					case "file":
						return new InputFile($valor,"txt".ucfirst($field->getNameF()),"",0,"textForm");
						break;
					case "date":
						return new InputText($valor,"txt".ucfirst($field->getNameF()),"",0,"textForm",10,11);
					case "time":
						return new InputText($valor,"txt".ucfirst($field->getNameF()),"",0,"textForm",8,9);
					default:
						if($field->getSize())
							 if($field->getSize() <= 10)
							 	$size =  $field->getSize();
							 elseif($field->getSize() <= 40)
							 	$size = 40;
							 else 
								$size = 60;						 	
						else 
								$size = 60;
						return new InputText($valor,"txt".ucfirst($field->getNameF()),"",0,"textForm",($field->getSize())?$field->getSize():255,$size);
				}
			}
		}
		
	}
	
}

?>