<?
include_once dirname(__FILE__).'/class.Field.php';
include_once dirname(__FILE__).'/class.Util.php';

class Table {
  var $name;
  var $nameF;
  var $nameDB;
  var $vetFields;
  var $vetPK;
  var $vetFK;
  var $vetNK;
  
  
  function Table($name,$nameDB,$vetFields='') {
		$this->name 			= $name;
		$this->nameF			= $name;
		$this->nameDB 		= $nameDB;
		if($vetFields){
			$this->vetFields 	= $vetFields;
			for($i=0;$i<count($vetFields);$i++){
				if($vetFields[$i]->getPK())
					$this->vetPK[] 	= $vetFields[$i];
				else 
					$this->vetNK[]	= $vetFields[$i];
				if($vetFields[$i]->getFK())
					$this->vetFK[] 	= $vetFields[$i];
			}
		}
  }

	function getName(){
		return $this->name;
	}
	
	function getNameF(){
		return strtolower($this->nameF[0]).substr($this->nameF,1,strlen($this->nameF)-1);
	}
	
	function getNameDB(){
		return $this->nameDB;
	}
	
	function getVetFields(){
		return $this->vetFields;
	}
	
	function getVetPK(){
		return $this->vetPK;
	}
	
	function getVetFK(){
		return $this->vetFK;
	}
	
	function getVetNK(){
		return $this->vetNK;
	}
	
	function setNameF($padrao){
		$this->nameF = Util::forNAtt($this->name,$padrao);
		for($i=0;$i<count($this->getVetFields());$i++){
			$this->vetFields[$i]->setNameF(Util::forNAtt($this->vetFields[$i]->getName(),$padrao));
		}
		for($i=0;$i<count($this->getVetPK());$i++){
			$this->vetPK[$i]->setNameF(Util::forNAtt($this->vetPK[$i]->getName(),$padrao));
		}
		for($i=0;$i<count($this->getVetFK());$i++){
			$this->vetFK[$i]->setNameF(Util::forNAtt($this->vetFK[$i]->getName(),$padrao));
		}
		for($i=0;$i<count($this->getVetNK());$i++){
			$this->vetNK[$i]->setNameF(Util::forNAtt($this->vetNK[$i]->getName(),$padrao));
		}
	}
	
}
?>