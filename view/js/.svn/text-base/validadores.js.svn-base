

function rtrim(str){
	while(str.charAt(str.length-1)==' '){
		str = str.substring(0,str.length-2);
	}
	return str;
}

function ltrim(str){
	while(str.charAt(0)==' '){
		str = str.substring(1,str.length);
	}
	return str;
}

function trim(str){
	return ltrim(rtrim(str));
}

function remove(str, sub) {
	var i = str.indexOf(sub);
	var r = "";
	if (i == -1) return str;
	r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
	return r;
}	

function removeNaN(str){
	tmp = "";
	for(i=0;i<str.length;i++){
		if (!isNaN(str.charAt(i))){
			tmp = tmp.concat(ltrim(str.charAt(i)));
		}
	}
	return tmp;
}


function validaDATA(str){
  d = str.substring(0,str.indexOf('/'));
  m = str.substring(str.indexOf('/')+1,str.lastIndexOf('/'));
  y = str.substring(str.lastIndexOf('/')+1,str.length);
  dt=new Date(m.concat("/").concat(d).concat("/").concat(y));
  return (dt.getFullYear()==y && (dt.getMonth()+1)==m && dt.getDate()==d);
}

function converteDATA(str){
  d = str.substring(0,str.indexOf('/'));
  m = str.substring(str.indexOf('/')+1,str.lastIndexOf('/'));
  y = str.substring(str.lastIndexOf('/')+1,str.length);
  return new Date(m.concat("/").concat(d).concat("/").concat(y));
}

function comparaDATA(str1,str2){
	if(validaDATA(str1)&&validaDATA(str2)){
	  if(converteDATA(str1)<converteDATA(str2)){
		return 2								
	  }
	  else{
		 if(converteDATA(str1)>converteDATA(str2)){
		   return 1
		 }
		 else{
			 return 0;
		 }
	  }
	}
	else{
		return -1;
	}
}

function validaDDD(str){
  str = removeNaN(str);
  return (str.length==2);
}

function validaFone(str){
  str = removeNaN(str);
  return ((str.length>6) && (str.length<9));
}



function validaCEP(str){
	str=removeNaN(str);
	return (str.length==8);
}

function validaCPF(cpf) {

    cpf=removeNaN(cpf);
	while(cpf.length<11){
		cpf = "0".concat(cpf);
	}
	if(cpf == "00000000000" || cpf == "11111111111" ||
		cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
		cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
		cpf == "88888888888" || cpf == "99999999999"){
		return false;
	}
	
	soma = 0;
	for(i = 0; i < 9; i++)
		soma += parseInt(cpf.charAt(i)) * (10 - i);
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
		resto = 0;
	if(resto != parseInt(cpf.charAt(9))){
		return false;
	}
	soma = 0;
	for(i = 0; i < 10; i ++)
		soma += parseInt(cpf.charAt(i)) * (11 - i);
	resto = 11 - (soma % 11);
	if(resto == 10 || resto == 11)
		resto = 0;
	if(resto != parseInt(cpf.charAt(10))){
		return false;
	}
	return true;

}	


function validaEMAIL(mail){
    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
    if(typeof(mail) == "string"){
        if(er.test(mail)){ return true; }
    }else if(typeof(mail) == "object"){
        if(er.test(mail.value)){
                    return true;
                }
    }else{
        return false;
        }
}
