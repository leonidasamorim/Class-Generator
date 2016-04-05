<?
class Util{

	function Util(){}
	
	function getMsg($mod,$msg=''){
		if(!($msg)){
			switch ($mod){
				case "S":
					$msg =  "A operacao foi realizada com sucesso!";
					break;
				case "E":
					$msg = "A operacao não foi realizada!";
					break;
			}
		}
		switch ($mod){
			case "S":
				return "<br><div id='divMensagem'><br>$msg</div>";
			case "E":
				return "<br><div id='divMensagem'><br>$msg</div>";
		}
	}
		
	function getDataAtual(){
		return date("Y-m-d");
	}
	
	function getHoraAtual(){
		return date("h:i:s");
	}
	
	function converteData($data){
		//return $this->converteAmdParaDma($data);
		return Util::converteAmdParaDma($data);
	}
	
	function converteDataBanco($data){
		//return $this->converteDmaParaAmd($data);
		return Util::converteDmaParaAmd($data);
	}
	
	function converteMdaParaDma(&$data){
		$data = substr($data,0,10);    
		list($mes,$dia,$ano) = explode("/",$data);
		$data = $dia."/".$mes."/".$ano;
		return $data;
	}
	
	function converteDmaParaMda(&$data){
		$data = substr($data,0,10);    
		list($dia,$mes,$ano) = explode("/",$data);
		$data = $mes."/".$dia."/".$ano;
		return $data;
	}	

	function converteDmaParaAmd(&$data){
		$data = substr($data,0,10);    
		list($dia,$mes,$ano) = explode("/",$data);
		$data = $ano."-".$mes."-".$dia;
		return $data;
	}	
	
	function converteAmdParaDma(&$data){
 		$data = substr($data,0,10);    
		list($ano,$mes,$dia) = explode("-",$data);
		$data = $dia."/".$mes."/".$ano;
		return $data;
	}		
	
}
?>