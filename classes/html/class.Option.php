<?

class Option{
	var $value;
	var $label;

	function Option($value,$label){
		$this->value = $value;
		$this->label = $label;
	}
	
	function getValue(){
		return $this->value;
	}
	
	function getLabel(){
		return $this->label;
	}
	
	function setLabel($label){
		$this->label = $label;
	}
	
	function setValue($value){
		$this->value = $value;
	}
	
	function getConteudo(){
		return '<OPTION value="'.$this->getValue().'">'.$this->getLabel().'</OPTION>';
	}

}


?>