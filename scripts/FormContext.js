//Classes
 function FormContext(FormBase){
		this.form = FormBase;
		this.itens = new Array();
		this.vetErro = new Array();
		this.regras = new Array();
		this.listErro = true;
		this.erro = false;
		this.verMsg = true;
		this.campoErro = 0;
		
		this.setVerMsg = setVerMsg;
		this.getVerMsg = getVerMsg;
		this.setListErro = setListErro;
		this.getListErro = getListErro;
		this.getReport = getReport;
		this.getLen = getLen;
		this.addCampo = addCampo;
		this.defineCampos = defineCampos;
		this.verificaCPF = verificaCPF;
		this.setFocus = setFocus;
		this.mostraMensagem = mostraMensagem;
		this.validaForm = validaForm;
		this.limpaErro = limpaErro;
		this.addErro = addErro;
		this.iniciaErro = iniciaErro;
		this.addRegra = addRegra;
 }
	
	function Regra(regra, mensagem){
		this.regra = regra;
		this.mensagem = mensagem;
		this.setMensagem = setMensagem;
		this.getMensagem = getMensagem;
		this.getRegra = getRegra;
	}
	
	function Campo(campo, tipo, label, nulo, formObj){
	/*
	tipos : inteiro, moeda, data, texto
	*/
	
		this.campo = campo;
		this.tipo = tipo;
		this.label = label;
		this.nulo = nulo;
		this.objeto = formObj;
		this.mensagem = "";
	
		this.validaCampo = validaCampo;
		this.getCampo = getCampo;
		this.getTipo = getTipo;
		this.getLabel = getLabel;
		this.getNulo = getNulo;
		this.getMensagem = getMensagem;
		this.getValor = getValor;
		this.setMensagem = setMensagem;
		this.validaCampo = validaCampo;
		this.setMascara = setMascara;
		
		this.setMascara();
	}

	function addRegra(regra, mensagem){
		this.regras[this.regras.length] = new Regra(regra, mensagem);
	}

	function getLen(){ return this.itens.length; }
	function setListErro(valor){ this.listErro = valor;	}
	function getListErro(){	return this.listErro; }
	
	function setVerMsg(valor){ this.verMsg = valor; }
	function getVerMsg(){ return this.verMsg; }
	
	function getReport(){
		msg = "Ocorreram os seguintes erros :\n";
		for(i=0; i< this.vetErro.length; i++){
			n = i+1;
			msg += n + " - " + this.vetErro[i];			
		}
		return msg;
	}
	
	function iniciaErro(campo){
		this.erro = true;
		this.campoErro = campo;
	}
	
	function addCampo(campo, label, tipo, nulo){
		  if(tipo=='cpf'){
			  this.form.elements[campo].onkeypress = formataCPF;
		  }
	      this.itens[this.getLen()] = new Campo(campo, tipo, label, nulo, this.form.elements[campo]);
    }
	
	function defineCampos(campos){
		vetCampos = campos.split(",");
		for(i=0; i<vetCampo.length; i++){
			this.addCampo(vetCampo[i], 'texto', '', false, vetCampo[i]);
		}
	}
	function validaForm(){
		this.limpaErro();
		for(n=0; n < this.getLen(); n++){
			campo = this.itens[n];
			valor = campo.getValor();
			valor = limpaString(valor," ");
			if(valor.length<1){
				if(!campo.getNulo()){
					if(this.getListErro()){
						this.addErro("Prenchimento do campo "+campo.getLabel()+" obrigatório!"+"\n");
						if(!this.erro) this.iniciaErro(this.form.elements[campo.getCampo()]);
					}else{
						if(this.getVerMsg()){
							mostraMensagem("Prenchimento Obrigatório!");
							setFocus(this.form.elements[campo.getCampo()]);
						}
						return false;
					}
				}				
			}else{
				if(!campo.validaCampo()){
					if(this.getListErro()){
						this.addErro(campo.getMensagem()+"\n");
						if(!this.erro){ this.iniciaErro(this.form.elements[campo.getCampo()])};
					}else{
						if(this.getVerMsg()){
							mostraMensagem(campo.getMensagem());
							setFocus(this.form.elements[campo.getCampo()]);
						}
						return false;
					}
				}			
			}
		}
		for(i=0; i<this.regras.length; i++){
			Regra = this.regras[i];
			if(!eval(Regra.getRegra())){
				if(this.getListErro()){
					this.addErro(Regra.getMensagem()+"\n");
					if(!this.erro) this.iniciaErro(this.form.elements[0]);
				}else{
					if(this.getVerMsg()){
						mostraMensagem(Regra.getMensagem());
					}
					return false;
				}
			}
		}
		if(this.getListErro() && this.erro){
			if(this.getVerMsg()){
				mostraMensagem(this.getReport());
			}
			return false;
		}else{
			return true;
		}
	}

	
	function addErro(msg){
		this.vetErro[this.vetErro.length] = msg;
	}
	
	function limpaErro(){
		this.vetErro = new Array();
		this.erro = false;
		this.campoErro = 0;
	}
	
//M�todos da Classe Regra
	function getRegra(){
		return this.regra;
	}
//M�todos Classe Campo
	function setMascara(){
		switch(this.getTipo()){
			case "moeda":
				this.objeto.onkeyup = formataMoeda;
			break;
			case "data":
				this.objeto.onkeyup = formataData;
			break;
			case "cpf":
				this.objeto.onkeyup = formataCPF;
			break;
			case "cnpj":
				this.objeto.onkeyup = formataCNPJ;
			break;
		}
		return true;
	}
	
	function validaCampo(){
		switch(this.getTipo()){
			case "numero":
				if(isNaN(this.getValor())){
					this.setMensagem('O campo '+this.getLabel()+' deve conter um numero valido!');
					return false;
				}
			break;
			case "moeda":
				if(!isMoeda(this.getValor())){
					this.setMensagem('O campo '+this.getLabel()+' deve conter um valor de moeda valido!');
					return false;
				}
			break;
			case "data":
				if(!isData(this.getValor())){
					this.setMensagem('O campo '+this.getLabel()+' deve conter uma data valida!');
					return false;
				}
			break;
			case "cpf":
				if(!verificaCPF(this.getValor())){
					this.setMensagem('O campo '+this.getLabel()+' deve conter um CPF valido!');
					return false;
				}
			break;
			default:
				return true;
			break
		}
		return true;
	}
	
	function getCampo(){ return this.campo; }
	function getTipo(){ return this.tipo; }
	function getLabel(){ return this.label; }
	function getNulo(){ return this.nulo; }
	function getMensagem(){ return this.mensagem; }
	function getValor(){ return this.objeto.value; }
	
	function setMensagem(mensagem){ this.mensagem = mensagem; }

//Funcoes de Formatacao

function formataData(){
	// dd/mm/aaaa =>10 Digitos
	var valor = verificaString(this.value,'0123456789/');
	if(valor.length == 2) valor = valor + '/';
	if(valor.length == 5) valor = valor + '/';
	this.value = valor;
}

function formataCPF(){
	valor = this.value;
	valorStr = verificaString(valor,"0123456789");
	valorFinal = '';
	if(valorStr.length>11) valorStr = valorStr.substr(valorStr.length-11,11);
	if(valorStr.length<=2) valorFinal = valorStr;
	if(valorStr.length>2){
		part1 = valorStr.substr(0,valorStr.length-2);
		part2 = valorStr.substr(valorStr.length-2,2);
		valorFinal = divideTres(part1) + '-' + part2;
	}
	this.value = valorFinal;
}

function formataCNPJ(){
	valor = this.value;
	valorStr = verificaString(valor,"0123456789");
	valorFinal = '';
	if(valorStr.length>14) valorStr = valorStr.substr(valorStr.length-14,14);
	if(valorStr.length<=2) valorFinal = valorStr;
	if((valorStr.length>2)&(valorStr.length<7)){
		part1 = valorStr.substr(0,valorStr.length-2);
		part2 = valorStr.substr(valorStr.length-2,2);
		valorFinal = part1 + '-' + part2;
	}
	if(valorStr.length>6){
		part1 = valorStr.substr(0,valorStr.length-6);
		part2 = valorStr.substr(valorStr.length-6,4);
		part3 = valorStr.substr(valorStr.length-2,2);
		valorFinal = divideTres(part1) + '/' + part2 + '-' + part3;
	}
	this.value = valorFinal
}

function formataMoeda(){
	valorStr = verificaString(this.value,"0123456789");
	valorFinal = '';
	if(valorStr.length==1) valorFinal = '0,0' + valorStr;
	if(valorStr.length==2) valorFinal = '0,' + valorStr;
	if(valorStr.length>2){
		part1 = valorStr.substr(0,valorStr.length-2);
		part2 = valorStr.substr(valorStr.length-2,2);
		valorFinal = divideTres(part1) + ',' + part2;
	}
	this.value = valorFinal;
}

// Funcoes Extras
function mostraMensagem(msg){	alert(msg);	}
function isVazio(str){	return (str.length==0)?true:false;	}
function setFocus(campo){	campo.focus();	}

function space(num){
	str = "";
	for(i=0; i<num; i++){
		str = str + " ";
	}
	return str;
}

function isData(Valor) {
/* Fun��o de valida��o de data que utiliza express�o
regular. Aceita qualquer data no formato dd/mm/aaaa ou
dd/mm/aa */
	var Er = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
	if (Er.test( Valor )){
		return true;
	}else{
		return false;
	}
}

function isMoeda(str) {
	str = limpaString(str,".,");
	if(isNaN(str)){
		return false;
	}else{
		return true;
	}
}
function verificaCPF (CPF) {
	if(CPF=='')
	 return true;
	if (CPF == "00000000000" || CPF == "11111111111" ||
		CPF == "22222222222" ||	CPF == "33333333333" || CPF == "44444444444" ||
		CPF == "55555555555" || CPF == "66666666666" || CPF == "77777777777" ||
		CPF == "88888888888" || CPF == "99999999999")
		return false;
	soma = 0;
		
	for (i=0; i < 9; i ++)
		soma += parseInt(CPF.charAt(i)) * (10 - i);
	resto = 11 - (soma % 11);
	if (resto == 10 || resto == 11)
		resto = 0;
	if (resto != parseInt(CPF.charAt(9)))
		return false;
	soma = 0;
	for (i = 0; i < 10; i ++)
		soma += parseInt(CPF.charAt(i)) * (11 - i);
	resto = 11 - (soma % 11);
	if (resto == 10 || resto == 11)
		resto = 0;
	if (resto != parseInt(CPF.charAt(10)))
		return false;
	return true;
 }
	 

function DivideData(sData){
	aData = new Array();
	aData[0] = sData.substr(0,2);
	aData[1] = sData.substr(3,2);
	aData[2] = sData.substr(6,4);
	return aData;
}

function VerificaData(aData){
	if(aData[0]>31||aData[1]>12){
		return false;
	} else {
		return true;
	}
}

function ComparaData(Data1,Data2,i){
	if(i>=0){
		if(Data1[i]<Data2[i]){
			return false;//Data2 � maior que a data1
		} else if(Data1[i]==Data2[i]){
			return ComparaData(Data1,Data2,i-1);
		} else {
			return true;//Data1 � maior que a data2
		}
	} else {
		return true;//Data1 � igual a data2
	}
}

function limpaString(str, caracteres){
	for(i=0; i<caracteres.length; i++){
		while(str.indexOf(caracteres.charAt(i))>=0) { str = str.replace(caracteres.charAt(i),"");}
	}
	return str;
}

function verificaString(str, caracteres){
	strFinal = '';
	for(i=0; i<str.length; i++){
		if(caracteres.indexOf(str.charAt(i))>=0) {
			strFinal = strFinal + str.charAt(i);
		}
	}
	return strFinal;
}

function divideTres(valor){
	//Funciona para no maximo 16 caracteres
	valorNum = parseInt(valor);
	valorStr = valorNum + '';
	numChar = valorStr.length;
	valorFinal = '';
	while(numChar>0){
		if(numChar>3){
			valorFinal =  '.' + valorStr.substr(numChar-3,3) + valorFinal;
		}else{
			valorFinal = valorStr + valorFinal;
		}
		valorStr = valorStr.substr(0,numChar-3);
		numChar = valorStr.length;
	}
	//alert(valorFinal);
	return valorFinal;
}