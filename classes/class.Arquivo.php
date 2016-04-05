<?

class Arquivo{
	var	$nome;
	var $diretorio;
	var $conteudo;
	var $extensao;
	var $nomeCompleto;
	
	function Arquivo($diretorio="",$nome="",$conteudo="",$extensao="",$nomeCompleto=""){
		$this->diretorio = $diretorio;
		$this->nome = $nome;
		$this->conteudo = $conteudo;
		$this->extensao = $extensao;
		$this->nomeCompleto = $nomeCompleto;
	}
	
	function getDiretorio(){
		return $this->diretorio;
	}
	
	function setDiretorio($diretorio){
		$this->diretorio = $diretorio;
	}
	
	function getNome(){
		return $this->nome;
	}
	
	function setNome($nome){
		$this->nome = $nome;
	}
	
	function getConteudo(){
		return $this->conteudo;
	}
	
	function setConteudo($conteudo){
		$this->conteudo= $conteudo;
	}
	
	function getExtensao(){
		return $this->extensao;
	}
	
	function setExtensao($extensao){
		$this->extensao = $extensao;
	}
	
	function getNomeCompleto(){
		if($this->getDiretorio() && ($this->getNome() && $this->getExtensao()))
			$this->nomeCompleto = $this->getDiretorio().$this->getNome().".".$this->getExtensao();
		return $this->nomeCompleto;
	}
	
	function setNomeCompleto($nomeCompleto){
		$this->nomeCompleto = $nomeCompleto;
	}
	
	
	function salvar(){
		$file = $this->abrir();
		$this->escrever($file);
		$this->fechar($file);
		chmod($this->getNomeCompleto(), 0777);
	}
	
	function escrever($file){
		return fwrite($file, $this->getConteudo());
	}
	
	function fechar($file){
		return fclose($file);
	}
	
	function grava($nome,$conteudo){
		$this->setNome($nome);
		$this->setConteudo($conteudo);
		$this->setNomeCompleto($this->getDiretorio().$this->getNome());
		$this->salvar();
	}
	
	function abrir($modo='w'){
		return fopen($this->getNomeCompleto(), $modo);
	}
	
	function criaDir($modo=0777){
		clearstatcache();
		return mkdir($this->getDiretorio(),0777);
	}
	
	function remDir(){
		clearstatcache();
		return rmdir($this->getDiretorio());
	}
	function copiar($dirCompAtual,$dirCompDest){
		return copy($dirCompAtual,$dirCompDest);
	}
	
	function getParametros(){
		$parametros = "File_Name=".$this->getNome()."&File_Extension=".$this->getExtensao()."&Dir=".$this->getDiretorio();
		return $parametros;
	}
	
	function criaNovoDiretorio($nome,$modo=0777){
		$this->setDiretorio($nome);
		return $this->criaDir($modo);
	}
	
	function copiarArquivos($dirOrigem,$dirDestino,$vetNomesArqOrigem,$vetNomesArqDestino=NULL){
		for($i=0;$i<count($vetNomesArqOrigem);$i++)
			$this->copiar($dirOrigem.$vetNomesArqOrigem[$i],$dirDestino.(($vetNomesArqDestino[$i])?$vetNomesArqDestino[$i]:$vetNomesArqOrigem[$i]));
	}
	
}
?>