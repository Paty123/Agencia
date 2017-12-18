<script type="text/javascript"><!--
var slhabtcs=new Array();
var promoanti;
var promolugrs;
$(document).ready(function() {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});
	$('.spinner').each(function(n,inpt){
          $('#'+inpt.id).spinner({ min:0,max:49,places:0,step:1});
        });
});
--></script>
<script type="text/javascript"><!--

function validateCircuito(){
  if(!validateDate()) return false;
  if(!validatePeople()) return false;
  if(!validateHabs()) return false;
  return true;
}

function validateHotel(){
  if(!validateDateH()) return false;
  if(!validateHabsH()) return false;
  if(!validatePeople()) return false;
  return true;
}

function validateTour(){
  if(!validateDate()) return false;
  if(!validatePeople()) return false;
  return true;
}

function validateTras(){
  var npers=parseInt($('#npersonas').val());
  var min=parseInt($('#trasminp').val());
  var max=parseInt($('#trasmaxp').val());
  if(npers<min || npers>max){
    alert('Debe reservar al menos: '+min+' o maximo: '+max+' lugares');
    return false;
  }
  if(!validatePeople()) return false;
  return true;
}

function validateDate(){
  var selDate=$('#finicio').val();
  var sldTkks=selDate.split('-');
  var dtToday=new Date();
  var f1=$('select#cddsal option:selected').attr('dtf1');
  var f1Tkks=f1.split('-');
  var f2=$('select#cddsal option:selected').attr('dtf2');
  var f2Tkks=f2.split('-');
  var slDate=new Date(sldTkks[0],sldTkks[1]-1,sldTkks[2]);
  var diff=slDate-dtToday;
  if(diff<115200000){
    alert('Debe reservar con al menos 48 horas de anticipacion');
    return false;
  }
  if( slDate<new Date(f1Tkks[0],f1Tkks[1]-1,f1Tkks[2]) || slDate>new Date(f2Tkks[0],f2Tkks[1]-1,f2Tkks[2]) ){
    alert('La fecha elegida esta fuera de vigencia');
    return false;
  }
  return true;
}

function validateDateH(){
  var selDate=$('#finicio').val();
  var selDate2=$('#finicio2').val();
  var sldTkks=selDate.split('-');
  var sldTkks2=selDate2.split('-');
  var dtToday=new Date();
  var slDate=new Date(sldTkks[0],sldTkks[1]-1,sldTkks[2]);
  var slDate2=new Date(sldTkks2[0],sldTkks2[1]-1,sldTkks2[2]);
  var diff=slDate-dtToday;
  if(diff<115200000){
    alert('Debe reservar con al menos 48 horas de anticipacion');
    return false;
  }
  if(slDate2<=slDate){
    alert('La fecha final es invalida');
    return false;
  }
  return true;
}

function getDaysDiffDateH(){
  var selDate=$('#finicio').val();
  var selDate2=$('#finicio2').val();
  var sldTkks=selDate.split('-');
  var sldTkks2=selDate2.split('-');
  var slDate=new Date(sldTkks[0],sldTkks[1]-1,sldTkks[2]);
  var slDate2=new Date(sldTkks2[0],sldTkks2[1]-1,sldTkks2[2]);
  var tdiff=slDate2-slDate;
  var dfdias=Math.floor(tdiff/(1000*60*60*24));
  return dfdias;
}

function validatePeople(){
  var npers=$('#npersonas').val();
  var regxp=/^(-)?[0-9]*$/;
  var kn;
  var nom;
  var dir;
  var tel;
  var eml;
  if(!regxp.test(npers)) { npers=0; }
  if(npers<=0){
    alert('Numero de personas no indicado');
    return false;
  }else{
    for(kn=0;kn<npers;kn++){
      nom=$('#nomper'+kn).val().trim();
      dir=$('#dirper'+kn).val().trim();
      tel=$('#telper'+kn).val().trim();
      eml=$('#emlper'+kn).val().trim();
      if(nom.length<=0 || nom.length>45){
        alert("Nombre no puede estar vacio ni ser mayor de 45 caracteres, persona "+(kn+1));
        return false;
      }if(dir.length<=0 || dir.length>255){
        alert("Direccion no puede estar vacio ni ser mayor de 255 caracteres, persona "+(kn+1));
        return false;
      }if((tel.length>0||kn==0) && !tel.match(/^[0-9 \(\)-]+$/)){
        alert("Telefono tiene un formato incorrecto, persona "+(kn+1));
        return false;
      }if((eml.length>0||kn==0) && !eml.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/i)){
        alert("Email tiene un formato incorrecto, persona "+(kn+1));
        return false;
      }
    }
  }
  return true;
}

function validateHabs(){
  var npers=$('#npersonas').val();
  var nadlts=0;
  $('.prageadlt').each(function(ind,ele){
    nadlts+=($(ele).is(':checked')?1:0);
  });
  var nmnors=0;
  $('.pragemnor').each(function(ind,ele){
    nmnors+=($(ele).is(':checked')?1:0);
  });
  var hsen=0;
  var hdob=0;
  var htri=0;
  var hcua=0;
  var hmnr=0;
  $.each(slhabtcs,function(ind,ele){
    if(ele[5]>0){
      hsen+=parseInt(ele[0]=='Sencilla'?ele[5]:0);
      hdob+=parseInt(ele[0]=='Doble'?ele[5]:0);
      htri+=parseInt(ele[0]=='Triple'?ele[5]:0);
      hcua+=parseInt(ele[0]=='Cuadruple'?ele[5]:0);
      hmnr+=parseInt(ele[0]=='Suplemento'?ele[5]:0);
    }
  });
  return valSelHabs(nadlts,nmnors,hsen,hdob,htri,hcua,hmnr);
}

function validateHabsH(){
  var notempty=false;
  $.each(slhabtcs,function(ind,ele){ if(ele[5]>0){ notempty=true; } });
  if(!notempty){ alert('No ha indicado habitaciones'); }
  return notempty;
}

function valSelHabs(padlts,pmnors,sen,dob,tri,cua,mnr){
  var emptyroom=false;
  var wronguse=false;
  var ttmnrs=pmnors;
  if(cua>0){
    if( Math.ceil(padlts/4)<cua ) emptyroom=true;
    padlts-=(cua*4);
    if(padlts<0) wronguse=true;
  }if(tri>0){
    if( Math.ceil(padlts/3)<tri ) emptyroom=true;
    padlts-=(tri*3); pmnors-=tri;
    if(padlts<0) wronguse=true;
  }if(dob>0){
    if( Math.ceil(padlts/2)<dob ) emptyroom=true;
    padlts-=(dob*2); pmnors-=(dob*2);
    if(padlts<0) wronguse=true;
  }if(sen>0){
    if(padlts>0){
      var temp=padlts; padlts-=sen;
      if(padlts<0){ padlts=0; wronguse=true; }
      if(pmnors>0) pmnors-=(sen*3);
      sen-=(temp-padlts);
    }if( sen>0 ) emptyroom=true;
  }
  if(padlts>0 || pmnors>0){
    var err_mensj='Las habitaciones elegidas no son suficientes para el cupo\nTome en cuenta lo siguiente:\n';
    err_mensj+='Hab Sencilla 1 adulto y hasta 3 menores\nHab Doble 2 adultos y hasta 2 menores\n';
    err_mensj+='Hab Triple 3 adultos y hasta 1 menor\nHab Cuadruple 4 adultos\n';
    alert(err_mensj);
    return false
  }else if(emptyroom){
    alert('Las habitaciones elegidas exceden el cupo');
    return false
  }else if(wronguse){
    alert('Las habitaciones elegidas dan un acomodo incorrecto');
    return false
  }else if(ttmnrs!=mnr){
    alert('Ha indicado personas menores de edad, debe elegir suplemento a menor para cada uno de ellos');
    return false
  }
  return true;
}

$('#buscarhotel').bind('click', function() {
	var finicio=$('#finicio').val();
	var ffin=$('#finicio2').val();
	var urlextra='&finicio='+finicio+'&ffin='+ffin;
		location.href='index.php?route=product/product&product_id=<?php echo $product_id; ?>'+urlextra;
	 
});

$('#buscarcircuito').bind('click', function() {
  var finicio=$('#finicio').val();
  var urlextra='&finicio='+finicio ;
  location.href='index.php?route=product/product&product_id=<?php echo $product_id; ?>'+urlextra;
});
$('#buscarfechahot').bind('click', function() {
  var finicio=$('#finicio').val();
  var urlextra='&finicio='+finicio ;
  location.href='index.php?route=product/product&product_id=<?php echo $product_id; ?>'+urlextra;
});
$('#buscartour').bind('click', function(){ reloadcircuito(); });
$('#cddsal').bind('change', function(){ reloadcircuito(); });
$('#tsalfecha').bind('change', function(){
  $('#trasminp').val( $('#tsalfecha option:selected').attr('dta-min') );
  $('#trasmaxp').val( $('#tsalfecha option:selected').attr('dta-max') );
  $('#finicio').val( $('#tsalfecha option:selected').attr('dta-jdt') );
  $('#cddsal').val( $('#tsalfecha option:selected').text() );
  $('#trassalida').html( $('#tsalfecha option:selected').text() );
  updatePrecios($('#tsalfecha option:selected').attr('dta-jdt'),$('#npersonas').val(),null);
});
function reloadcircuito(){
  var finicio=$('#finicio').val();
  var ciudad=$('#cddsal option:selected').val();
  var urlextra='&finicio='+finicio+'&saliendode='+ciudad;
  location.href='index.php?route=product/product&product_id=<?php echo $product_id; ?>'+urlextra;
}

$('#npersonas').bind('change paste keyup',function(){ showSpacesNPers(null); });


function showSpacesNPers(deftyp){
  var npers=$('#npersonas').val();
  var regxp=/^(-)?[0-9]*$/;
  var dvnode;
  var kn;

  if(!regxp.test(npers)) { 
    npers=0;

     }
  
  if(npers<=0){
    $('#dts_pers').empty();
    $('#dts_pers').css('height','3px');
    $("#nomtit").html("Titular: ---")
  }else{
    $('#dts_pers').empty();
    for(kn=0;kn<npers;kn++){
      if(deftyp!=null && deftyp.length>kn){
        dvnode='<p>'+(deftyp[kn][0]=='A'?'Adulto ':(deftyp[kn][0]=='M'?'Menor ':'Insen '));
      }else{ 

      dvnode='<p>Persona '+(kn+1);

       }

       if(kn<=0){
      dvnode+='<br />Nombre: <input type="text" id="nomper'+kn+'" name="nomper'+kn+'" />';
      dvnode+=' Direccion: <input type="text" id="dirper'+kn+'" name="dirper'+kn+'" />';
      dvnode+='<br />Telefono: <input type="text" id="telper'+kn+'" name="telper'+kn+'" />';
      dvnode+=' Email: <input type="text" id="emlper'+kn+'" name="emlper'+kn+'" /> <br />';
       }
       else {
             dvnode+='<br />Nombre: <input type="text" id="nomper'+kn+'" name="nomper'+kn+'" />';
      

       }
   
      if(deftyp!=null && deftyp.length>kn){
        dvnode+=' <input type="hidden" value="'+(deftyp[kn][0]=='A'?1:(deftyp[kn][0]=='M'?0:2))+'" name="prage'+kn+'" />';
        proff=getMinOff( deftyp[kn][1].split('_')[1] );
        if(proff==0){proff=crprttps[deftyp[kn][1].split('_')[1]].pre;}
        dvnode+=' <input type="hidden" value="'+proff+'" name="prtpre'+kn+'" />';
      }else{
        dvnode+=' <input type="radio" id="adlt'+kn+'" value="1" class="prageadlt" name="prage'+kn+'" checked/> Adulto ';
        dvnode+=' <input type="radio" id="mnor'+kn+'" value="0" class="pragemnor" name="prage'+kn+'" /> Menor ';
      }
      dvnode+='</p> <script> $("#nomper0").bind("change paste keyup", function(){ $("#nomtit").html("Titular: "+$(this).val()); }); </script>';
      $('#dts_pers').append(dvnode);
    }
    $("#nomtit").html("Titular: ---")
    $("#nperstit").html("Reservacion para "+npers+" personas")
    $('#dts_pers').css('height','8em');
  } updatePrecios(null,npers,null);
}

$('.spinner').bind("change paste keyup", function(){
   var kndapro=$('#kndapro').val();
   if(kndapro<3){ applyOffrsCiHo(this.id, $(this).val()); }
   else if(kndapro==3 || kndapro==4){ updateNPers(); }
});




function applyOffrsCiHo(selid, sel){
   var hab=new Array();
   var singid=selid.split('_')[1];
   var setted=false;
   var proff=getMinOff(singid);
   obp=crhabtpr[singid];
   hab[0]=obp.hab; //tipo
   hab[1]=obp.cat;   //catego
   hab[2]=(proff>0?proff:obp.pre);   //costo
   hab[3]=selid;   // id
   hab[5]=sel;   // num habs
   for(bji=0;bji<slhabtcs.length;bji++){
     if(slhabtcs[bji][3]==selid){
       slhabtcs[bji][5]=sel; slhabtcs[bji][2]=hab[2];
       setted=true; break;
     }
   }
   if(!setted){ slhabtcs[slhabtcs.length]=hab; }
   $('#ctghbs').html(':: '+slhabtcs.length);
   updateSelHabs();
}
function updateNPers(){
  var cntyhg=0;
  var cntyhd=0;
  var defnumpers='<span id="hdddefprs">';
  var ptypos2=new Array();
  var ttnprs=0;
  $('.spinner').each(function(idx,inpt){
    ttnprs+=parseInt($(this).val());
    if($(this).attr("dtx-typ").length!=0){
      for(cntyhg=0;cntyhg<$(this).val();cntyhg++){
        ptypos2[cntyhd]=new Array();
        ptypos2[cntyhd][0]=$(this).attr("dtx-typ");
        ptypos2[cntyhd][1]=this.id; cntyhd++;
      }
    }
  });
  $('#npersonas').attr('value',ttnprs); showSpacesNPers(ptypos2); updateSelPers(ptypos2);
}
function updateSelPers(ptypos){
  var cntbuilded='';
  var ttcosto=0;
  var adds=0;
  var mnns=0;
  var inns=0;
  var proff;
  $.each(ptypos,function(ind,ele){
    if(ele[0]=='A'){adds++;}else if(ele[0]=='M'){mnns++;}else if(ele[0]=='I'){inns++;}
    proff=getMinOff( ele[1].split('_')[1] );
    if(proff==0){proff=crprttps[ele[1].split('_')[1]].pre;}
    ttcosto+=parseFloat(proff);
  });
  cntbuilded=adds+' adultos '+mnns+' menores '+inns+' insen <input type="hidden" name="ttcosto" value="'+ttcosto+'" />';
  $('#ctghbs').html('Personas: '+cntbuilded);
  $('#revprodcstt').html('Costo $ '+ttcosto.toFixed(2));
}
function updateSelHabs(){
  var cntbuilded='';
  var ttcosto=0;
  var tthabs=0;
  var mfactr=1;
  var appind;
  var kndapro=$('#kndapro').val();
  var defnumhabs='<span id="hdddefhas">';
  if(kndapro==2){ mfactr=getDaysDiffDateH(); }
  if(slhabtcs.length==0){ cntbuilded='';
    $('.spinner').each(function(ind,elm){ $('#'+elm.id).attr('value','0'); });
  }else{ appind=0;
    $.each(slhabtcs,function(ind,ele){
        if(ele[5]>0){
          if(kndapro==1){ mfactr=1;
            if(ele[0]=='Doble'){ mfactr=2; }
            if(ele[0]=='Triple'){ mfactr=3; }
            if(ele[0]=='Cuadruple'){ mfactr=4; }
          }
          cntbuilded+=(cntbuilded.length>0?', ':'')+ele[5]+' '+ele[0]+' categoria: '+ele[1];
          ttcosto+=(ele[2]*ele[5]*mfactr); tthabs++;
          defnumhabs+='<input type="hidden" name="habtp_'+appind+'" value="'+ele[0]+'" />';
          defnumhabs+='<input type="hidden" name="habct_'+appind+'" value="'+ele[1]+'" />';
          defnumhabs+='<input type="hidden" name="habcs_'+appind+'" value="'+ele[2]+'" />';
          defnumhabs+='<input type="hidden" name="habnm_'+appind+'" value="'+ele[5]+'" />';
          appind++;
        }
    });
  }
  defnumhabs+='<input type="hidden" name="ttcosto" value="'+ttcosto+'" />';
  defnumhabs+='<input type="hidden" name="tthabs" value="'+tthabs+'" />';
  $('#ctghbs').html('Habitaciones: '+cntbuilded);
  $('#revprodcstt').html('Costo $ '+ttcosto.toFixed(2)+defnumhabs+'</span>');
}

$("#finicio").bind("change paste keyup", function() {
   var finicio2;
   if($('#kndapro').val()==2){ finicio2=$('#finicio2').val(); }
   else{ finicio2=null; }
   $('#inicia_en').html($(this).val());
   if(finicio2!=null){ $('#termina_en').html(finicio2); }
   updatePrecios($(this).val(),null,finicio2);
});

$("#finicio2").bind("change paste keyup", function(){
   $('#termina_en').html($(this).val());
   updatePrecios($('#finicio').val(),null,$(this).val());
});

function updatePrecios(dte,npers,nnights){
  var kndapro=$('#kndapro').val();
  var cnt;
  var prm;
  var disc=0;
  var dttdy=new Date();
    if(typeof promoanti!='undefined' && dte!=null && promoanti.length>0){
      for(cnt=0;cnt<promoanti.length;cnt++){
        prm=promoanti[cnt];
        var dtsel=buildate(dte);
        var dtini=buildate(prm[2]);
        var dtfin=buildate(prm[3]);
        var tdiff=dtsel.getTime()-dttdy.getTime();
	var dfdias=Math.floor(tdiff/(1000*60*60*24));
        if(dtsel>=dtini && dtsel<=dtfin && dfdias>=prm[0]){
          disc=prm[1]; break;
        }
      }
      if(kndapro<3){ $.each(crhabtpr,function(ind,obj){ obj.poa=disc*obj.pre; }); showMinOffer(); }
      else if(kndapro>=3){ $.each(crprttps,function(ind,obj){ obj.poa=disc*obj.pre; }); showMinOffer(); }
    }
    if(typeof promolugrs!='undefined' && npers!=null && promolugrs.length>0){
      for(cnt=0;cnt<promolugrs.length;cnt++){
        prm=promolugrs[cnt];
        var dtini=buildate(prm[3]);
        var dtfin=buildate(prm[4]);
        if(dttdy>=dtini&&dttdy<=dtfin && parseInt(npers)>=parseInt(prm[0])&&parseInt(npers)<=parseInt(prm[1])){
          disc=prm[2]; break;
        }
      }
      if(kndapro<3){ $.each(crhabtpr,function(ind,obj){ obj.pop=disc*obj.pre; }); }
      else if(kndapro==4){ $.each(crprttps,function(ind,obj){ obj.pop=disc*obj.pre; }); }
      showMinOffer();
    }
    if(typeof promonpers!='undefined' && npers!=null && promonpers.length>0){
      for(cnt=0;cnt<promonpers.length;cnt++){
        prm=promonpers[cnt];
        var dtini=buildate(prm[2]);
        var dtfin=buildate(prm[3]);
        if(dttdy>=dtini&&dttdy<=dtfin && npers==prm[0]){
          disc=prm[1]; break;
        }
      }
      $.each(crprttps,function(ind,obj){ obj.pop=disc*obj.pre; }); showMinOffer();
    }
    if(typeof promdnight!='undefined' && nnights!=null && dte!=null && promdnight.length>0){
      for(cnt=0;cnt<promdnight.length;cnt++){
        prm=promdnight[cnt];
        var dtini=buildate(prm[3]);
        var dtfin=buildate(prm[4]);
        var dtone=buildate(dte);
        var dttwo=buildate(nnights);
        var dtdiff=dttwo.getTime()-dtone.getTime();
	var dtfnigs=Math.floor(dtdiff/(1000*60*60*24));
        if(dttdy>=dtini&&dttdy<=dtfin && dtfnigs==prm[1]){
          disc=prm[2]; break;
        }
      }
      $.each(crhabtpr,function(ind,obj){ obj.pop=disc*obj.pre; }); showMinOffer();
    }
}
function buildate(strdte){
  var sldTkks=strdte.split('-');
  var bldDate=new Date(sldTkks[0],sldTkks[1]-1,sldTkks[2]);
  return bldDate;
}
function showMinOffer(){
  var kndapro=$('#kndapro').val();
  $('.prehb_bs').each(function(ind,ele){
        var dbar=$(ele).attr('dtaid');
        var preOff=getMinOff(dbar);
        if(preOff>0){
          $(ele).css("text-decoration","line-through"); $(ele).css("color","red");
          $('#pro_'+dbar).html('<br />$ '+preOff.toFixed(2));
          if(kndapro<3){$('.spinner').each(function(n,inpt){ $('#'+inpt.id).attr('value',0); });}
        }else{ $(ele).css("color","black"); $(ele).css("text-decoration","none"); $('#pro_'+dbar).html(''); }
  });
  if(kndapro<3){slhabtcs=new Array(); updateSelHabs();}
}
function getMinOff(idr){
  var kndapro=$('#kndapro').val();
  var obp;
  if(kndapro<3){ obp=crhabtpr[idr]; }
  else{ obp=crprttps[idr]; }
  var preOff=0;
  if(obp.poa>0 && obp.pop>0){ preOff=(obp.poa<obp.pop?obp.poa:obp.pop); }
  else if(obp.poa>0){ preOff=obp.poa; }
  else if(obp.pop>0){ preOff=obp.pop; }
  return preOff;
}

$('.button-cart').bind('click', function(){
        if($('#kndapro').val()==1 && !validateCircuito()){ return; }
        else if($('#kndapro').val()==2 && !validateHotel()){ return; }
        else if($('#kndapro').val()==3 && !validateTour()){ return; }
        else if($('#kndapro').val()==4 && !validateTras()){ return; }
        $.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
                dataType: 'json',
		success: function(json){
                        //alert(json);
			//alert(json['error']);
			$('.success, .warning, .attention, information, .error').remove();
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
					}
				}
			}if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				$('.success').fadeIn('slow');
				$('#cart-total').html(json['total']);
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
		}
	});
});

$('.downldinf').bind('click', function(){
    var dts=$(this).attr('prd_dta').split('_');
    $.fileDownload('index.php?route=checkout/confirm/downpdf&type='+dts[0]+'&prid='+dts[1], {
        preparingMessageHtml: "Concentrando informacion, espere unos segundos...",
        failMessageHtml: "Hubo un problema al concentrar la informacion, intente de nuevo."
    });
});

$('.sendmlinf').bind('click', function(){
    $('#frmsendif2cstm').toggle();
});

$('#sndinfnow').bind('click', function(){
  var nameku=$('#sndinfremt').val();
  var destku=$('#sndinfndest').val();
  var mailku=$('#sndinfedest').val();
  var idesku=$('#sndinfdtr').val();
  var cptchku=$('#sndinfctcha').val();
  if(nameku.length<=0){ alert('Debe indicar su nombre'); return; }
  if(destku.length<=0){ alert('Debe indicar el nombre del destinatario'); return; }
  if(!mailku.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/i)){
    alert("Correo del destinatario tiene un formato incorrecto"); return false;
  }
  if(cptchku.length<=0){ alert('Debe indicar el captcha'); return; }
  $.ajax({
    url:'index.php?route=checkout/confirm/send2MailInfoPdf',
    type:'post',
    data:'remit='+encodeURIComponent(nameku)+'&ddest='+encodeURIComponent(destku)+'&tomail='+encodeURIComponent(mailku)+'&idsn='+encodeURIComponent(idesku)+'&captcha='+encodeURIComponent(cptchku),
    dataType:'json',
    success: function(json){
      //alert(json);
      if(json['error']){ alert(json['error']); }
      if(json['success']){
        var rndvl=Math.random();
        $('#sndinfremt').val(''); $('#sndinfndest').val(''); $('#sndinfedest').val('');
        $('#sndinfctcha').val(''); $('#frmsendif2cstm').toggle();
        $("#smip_captcha").attr('src','index.php?route=product/product/captcha&rnd='+rndvl);
        alert(json['success']);
      }
    }
  });
});

--></script>
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs();
--></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
--></script>
