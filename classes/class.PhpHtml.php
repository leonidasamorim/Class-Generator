<?

class PhpHtml{
	var $basica;
	
	function PhpHtml($basica){
		$this->basica = $basica;
	}
	
	function inserir(){
		$table = $this->basica->getTable();
		$vetFields = $table->getVetFields();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
				  "  session_start();\n\n".
				  "  \$fachada = new Fachada();\n";
		$texto .= "  if(\$_POST['btnSalvar']){\n".
				  "    $".$table->getNameF()." = new ".ucfirst($table->getNameF())."(";
		for($i=0;$i<count($vetFields);$i++)
			$texto .= "\$_POST['txt".ucfirst($vetFields[$i]->getNameF())."']".(($i != (count($vetFields)-1))?", ":");\n");
		$texto .= "    \$res = \$fachada->inserir".ucfirst($table->getNameF())."($".$table->getNameF().");\n";
		$texto .= "    \$msg =(\$res)?1:2;\n";
		$texto .= "    header('location:adm".ucfirst($table->getNameF()).".php?msg='.urlencode(\$msg));\n  }\n?>\n";
		return $texto;
	}
	
	function editDel(){
		$table 	= $this->basica->getTable();
		$vetNK	= $table->getVetNK();
		$vetPK	= $table->getVetPK();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
				  "  session_start();\n\n".
				  "  \$fachada = new Fachada();\n";
		$texto .= "  if(\$_POST['btnSalvar']){\n".
				  "    $".$table->getNameF()." = \$_SESSION['".$table->getNameF()."'];\n".
				  "    $".$table->getNameF()."->setAll(";
		if($vetNK)
	  	while($field = array_shift($vetNK))
				$texto .= "\$_POST['txt".ucfirst($field->getNameF())."']".((0 != count($vetNK))?", ":");\n");		  
		$texto .= "    \$res = \$fachada->alterar".ucfirst($table->getNameF())."($".$table->getNameF().");\n";
		$texto .= "    \$msg =(\$res)?(Util::getMsg('S')):(Util::getMsg('E'));\n".
				  "    unset(\$_SESSION['".$table->getNameF()."']);\n".
				  "    header('location:adm".ucfirst($table->getNameF()).".php?msg='.urlencode(\$msg));\n".
				  "  }else{\n".
				  "	   $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."(";
		if($vetPK)
	  	while($field = array_shift($vetPK))
				$texto .= "\$_GET['".$field->getNameF()."']".((0 != count($vetPK))?", ":");\n");
		$texto .= "    if(!$".$table->getNameF().")\n".
				  		"      header(\"location:adm".ucfirst($table->getNameF()).".php?msg=\".urlencode('O registro n�o foi encontrado, verifique os dados informados!'));\n".
				  		"    if (\$_GET['acao']==\"editar\")\n".
				  		"      \$_SESSION['".$table->getNameF()."'] = $".$table->getNameF().";\n".
				  		"    elseif (\$_GET['acao']==\"excluir\"){\n".
				  		"      \$res = \$fachada->excluir".ucfirst($table->getNameF())."(\$".$table->getNameF().");\n";
		$texto .=  	"      \$msg =(\$res)?(Util::getMsg(\"S\")):(Util::getMsg(\"E\"));\n".
				  	"      header(\"location:adm".ucfirst($table->getNameF()).".php?msg=\".urlencode(\$msg));\n    }\n  }\n?>\n";
		return $texto;
	}
	
	
	function editCheck(){
		$table 	= $this->basica->getTable();
		$vetNK	= $table->getVetNK();
		$vetPK	= $table->getVetPK();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
			  "  session_start();\n\n".
			  "  \$fachada = new Fachada();\n";
		$texto .= "  if(\$_POST['btnSalvar']){\n".
			  "    $".$table->getNameF()." = \$_SESSION['".$table->getNameF()."'];\n".
			  "    $".$table->getNameF()."->setAll(";
		if($vetNK)
	  	while($field = array_shift($vetNK))
			$texto .= "\$_POST['txt".ucfirst($field->getNameF())."']".((0 != count($vetNK))?", ":");\n");		  
		$texto .= "    \$res = \$fachada->alterar".ucfirst($table->getNameF())."($".$table->getNameF().");\n";
		$texto .= "    \$msg =(\$res)?1:2;\n".
				  "    unset(\$_SESSION['".$table->getNameF()."']);\n".
				  "    header('location:adm".ucfirst($table->getNameF()).".php?msg='.urlencode(\$msg));\n".
				  "  }else{\n";
		if($vetPK)
	  		while($field = array_shift($vetPK))
				$textoList .= "\$".$field->getNameF().((0 != count($vetPK))?", ":"");
			
		$texto .= "    list($textoList) = Util::decode(\$_POST['rdOpcao']);\n".
			  "    $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."($textoList);\n".
			  "    if(!$".$table->getNameF().")\n".
			  "      header(\"location:adm".ucfirst($table->getNameF()).".php?msg=3\");\n".
			  "    \$_SESSION['".$table->getNameF()."'] = $".$table->getNameF().";\n".
			  "  }\n?>\n";
		return $texto;
	}
	
	function editTradicional(){
		$table 	= $this->basica->getTable();
		$vetNK	= $table->getVetNK();
		$vetPK	= $table->getVetPK();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
			  "  session_start();\n\n".
			  "  \$fachada = new Fachada();\n";
		$texto .= "  if(\$_POST['btnSalvar']){\n".
			  "    $".$table->getNameF()." = \$_SESSION['".$table->getNameF()."'];\n".
			  "    $".$table->getNameF()."->setAll(";
		if($vetNK)
	  	while($field = array_shift($vetNK))
			$texto .= "\$_POST['txt".ucfirst($field->getNameF())."']".((0 != count($vetNK))?", ":");\n");		  
		$texto .= "    \$res = \$fachada->alterar".ucfirst($table->getNameF())."($".$table->getNameF().");\n";
		$texto .= "    \$msg =(\$res)?(Util::getMsg('S')):(Util::getMsg('E'));\n".
				  "    unset(\$_SESSION['".$table->getNameF()."']);\n".
				  "    header('location:adm".ucfirst($table->getNameF()).".php?msg='.urlencode(\$msg));\n".
				  "  }else{\n".
				  "    $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."(";
		if($vetPK)
	  	while($field = array_shift($vetPK))
				$texto .= "\$_GET['".$field->getNameF()."']".((0 != count($vetPK))?", ":");\n");
		$texto .= "    if(!$".$table->getNameF().")\n".
			  "      header(\"location:adm".ucfirst($table->getNameF()).".php?msg=\".urlencode('O registro nao foi encontrado, verifique os dados informados!'));\n".
			  "    \$_SESSION['".$table->getNameF()."'] = $".$table->getNameF().";\n".
			  "  }\n?>\n";
		return $texto;
	}
	
	function excluir(){
		$table 	= $this->basica->getTable();
		$vetPK	= $table->getVetPK();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
				  "  session_start();\n\n".
				  "  \$fachada = new Fachada();\n".
				  "  $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."(";
		if($vetPK)
	  	while($field = array_shift($vetPK))
				$texto .= "$".$field->getNameF().((0 != count($vetPK))?", ":");\n");
		$texto .= "	 \$res = \$fachada->excluir".ucfirst($table->getNameF())."(\$".$table->getNameF().");\n".	
				  "  \$msg =(\$res)?1:2;\n".
				  "  header(\"location:adm".ucfirst($table->getNameF()).".php?msg=\".urlencode('O registro n�o foi encontrado, verifique os dados informados!'));\n?>\n";
		return $texto;	
	}
	
	function delCheck(){
		$table 	= $this->basica->getTable();
		$vetPK	= $table->getVetPK();
		if($vetPK)
	  		while($field = array_shift($vetPK))
				$textoList .= "\$".$field->getNameF().((0 != count($vetPK))?", ":"");
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
			  "  session_start();\n\n".
			  "  \$fachada = new Fachada();\n";
		$texto .= "    list($textoList) = Util::decode(\$_POST['rdOpcao']);\n".
			  "    $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."($textoList);\n".
			  "    if(!$".$table->getNameF().")\n".
			  "      header(\"location:adm".ucfirst($table->getNameF()).".php?msg=3\");\n".
			  "    \$res = \$fachada->excluir".ucfirst($table->getNameF())."(\$".$table->getNameF().");\n".	
			  "    \$msg =(\$res)?1:2;\n".
			  "  header(\"location:adm".ucfirst($table->getNameF()).".php?msg=\$msg\");\n?>\n";
		return $texto;	
	}
	
	function getAll(){
		$table 	= $this->basica->getTable();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.FrontController.php';\n".
				  "  session_start();\n\n".
				  "  \$frontController = new FrontController();\n".
  				  "  \$vet".ucfirst($table->getNameF())." = \$frontController->iniciarAdm(\$_GET['pag'],'".$table->getNameF()."','adm".ucfirst($table->getNameF()).".php');\n?>\n";
		return $texto;
	}
	
	function getObjeto(){
		$table 	= $this->basica->getTable();
		$vetPK	= $table->getVetPK();
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
				  "  session_start();\n\n".
				  "  \$fachada = new Fachada();\n".
				  "  $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."(";
		if($vetPK)
	  	while($field = array_shift($vetPK))
				$texto .= "$".$field->getNameF().((0 != count($vetPK))?", ":");\n");
		$texto .= "	 if(!$".$table->getNameF().")\n".
				  "    header(\"location:adm".ucfirst($table->getNameF()).".php?msg=3\");\n?>\n";
		return $texto;	
	}
	
	function getObjetoCheck(){
		$table 	= $this->basica->getTable();
		$vetPK	= $table->getVetPK();
		if($vetPK)
	  		while($field = array_shift($vetPK))
				$textoList .= "\$".$field->getNameF().((0 != count($vetPK))?", ":"");
		$texto  = $this->basica->comeco();
		$texto .= "  include_once dirname(__FILE__).'/classes/class.Fachada.php';\n".
			  "  session_start();\n\n".
			  "  \$fachada = new Fachada();\n";
		$texto .= "    list($textoList) = Util::decode(\$_POST['rdOpcao']);\n".
			  "    $".$table->getNameF()." = \$fachada->get".ucfirst($table->getNameF())."($textoList);\n".
			  "    if(!$".$table->getNameF().")\n".
			  "      header(\"location:adm".ucfirst($table->getNameF()).".php?msg=3\");\n?>\n";
		return $texto;
	}
}
?>