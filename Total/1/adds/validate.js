
function validateFields(fields){
	var numf=fields.length;
	var cnt;
	// fields every row 0=type (1=int, 2=texto requerido, 3=float), 1=val, 2=name
	/*
  		var data2vl=new Array();
  		data2vl[0]=[2,org,"Origen"];
  		...
  		if( !validateFields(data2vl) ){ return; }
	*/
	for(cnt=0;cnt<numf;cnt++){
		if( fields[cnt][0]==1 && !validateInt(fields[cnt][1]) ){
			alert("Error, valor invalido para: "+fields[cnt][2]);
			return false;
		}else if( fields[cnt][0]==2 && !validateString(fields[cnt][1]) ){
			alert("Error, valor invalido para: "+fields[cnt][2]);
			return false;
		}else if( fields[cnt][0]==3 && !validateFloat(fields[cnt][1]) ){
			alert("Error, valor invalido para: "+fields[cnt][2]);
			return false;
		}
	}
	return true;
}

function validateInt(val){
	var gval=parseInt(val);
	return (gval>0);
}

function validateFloat(val){
	var gval=parseFloat(val);
	return (gval>0);
}


function validateString(val){
	var gval=$.trim(val);
	return gval.length>0;
}