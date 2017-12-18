<?php
//verificamos las fechas que se ingresan
$now = new DateTime();

if (isset($this->request->get['finicio'])) {
  $finicio = $this->request->get['finicio'];
}else{
  $finicio = Date('Y-m-d', strtotime("+2 days"));
}
if (isset($this->request->get['saliendode'])) {
  $saliendode=$this->request->get['saliendode'];
}else{
  $saliendode=null;
}
if (isset($this->request->get['ffin'])) {
  $ffin = $this->request->get['ffin'];
}else{
  $ffin = Date('Y-m-d', strtotime("+3 days"));
} ?>

<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <script type="text/javascript" src="adds/jquery.fileDownload.js"></script>

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>

  <div id="tabs" class="htabs">
    <a href="#tab-description"> <?php echo ($tipoproducto=="Hotel"?'Informaci&oacute;n':'Itinerario');?> </a>
    <a href="#tab-attribute"> <?php echo ($tipoproducto=="Hotel"?'Servicios':'Incluye/No incluye');?> </a>
    <?php if($tipoproducto=="Circuito"){ ?>
      <a href="#tab-chotels">Hoteles</a>
    <?php }if($tipoproducto!="Hotel"){ ?>
      <a href="#tab-recomendations">Recomendaciones</a>
    <?php } if ($review_status) { ?>
      <a href="#tab-review"><?php echo $tab_review; ?></a>
    <?php }if ($products) { ?>
      <a href="#tab-related"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</a>
    <?php } ?>
  </div>

  <div id="tab-description" class="tab-content"><?php echo $description; ?></div>
  <div id="tab-attribute" class="tab-content"> <?php
    if($tipoproducto=="Hotel"){
      $query = $this->db->query("SELECT * FROM hoteles_servs WHERE id_producto=".$product_id  );
    }else{
      $query = $this->db->query("SELECT * FROM circuitos_incnoinc WHERE id_producto=".$product_id  );
    } if($query && count($query->rows)>0){
      echo $query->rows[0][($tipoproducto=="Hotel"?'servicios':'incnoinc')];
    } ?>
  </div>
  <?php if($tipoproducto=="Circuito"){ ?>
    <div id="tab-chotels" class="tab-content"> <?php
      $queryh=$this->db->query("SELECT name,description FROM oc_product_description,circuitos_hoteles WHERE product_id=hotel and id_producto=".$product_id);
      if($queryh && count($queryh->rows)>0){
        for($trg=0;$trg<count($queryh->rows);$trg++){
          echo '<h3>'.$queryh->rows[$trg]['name'].'</h3><br />'.html_entity_decode($queryh->rows[$trg]['description']);
        }
      }else{ ?>
        No hay hoteles registrados para este circuito.
      <?php } ?>
    </div>
  <?php } if($tipoproducto!="Hotel"){ ?>
  <div id="tab-recomendations" class="tab-content">
    <?php if($query && count($query->rows)>0){
      echo $query->rows[0]['recomens'];
    } ?>
  </div>
  <?php } if ($review_status) { ?>
  <div id="tab-review" class="tab-content">
    <div id="review"></div>
    <h2 id="review-title"><?php echo $text_write; ?></h2>
    <b><?php echo $entry_name; ?></b><br />
    <input type="text" name="name" value="" />
    <br />
    <br />
    <b><?php echo $entry_review; ?></b>
    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
    <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
    <br />
    <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
    <input type="radio" name="rating" value="1" />
    &nbsp;
    <input type="radio" name="rating" value="2" />
    &nbsp;
    <input type="radio" name="rating" value="3" />
    &nbsp;
    <input type="radio" name="rating" value="4" />
    &nbsp;
    <input type="radio" name="rating" value="5" />
    &nbsp;<span><?php echo $entry_good; ?></span><br />
    <br />
    <b><?php echo $entry_captcha; ?></b><br />
    <input type="text" name="captcha" value="" />
    <br />
    <img src="index.php?route=product/product/captcha" alt="" id="captcha" /><br />
    <br />
    <div class="buttons">
      <div class="right"><a id="button-review" class="button"><?php echo $button_continue; ?></a></div>
    </div>
  </div>
  <?php } ?>
  <?php if ($products) { ?>
  <div id="tab-related" class="tab-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" alt="<?php echo $product['description']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
         <div class="description"><?php echo $product['description']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        <a onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button"><?php echo $button_cart; ?></a></div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>


  <div class="product-info">
    <?php if ($thumb || $images) { ?>
    <div class="left">
      <?php if ($thumb) { ?>
      <div class="image"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a></div>
      <?php } ?>
      <?php if ($images) { ?>
      <div class="image-additional">
        <?php foreach ($images as $image) { ?>
        <a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    <div class="right">
      <div class="description">
        <?php if ($manufacturer){ ?>
        <span><?php echo $text_manufacturer; ?></span> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
        <?php } 
        if($tipoproducto=="Hotel"){
          $query = $this->db->query("SELECT * FROM hotels_ctgs WHERE idprod=".$product_id  );
          if($query && count($query->rows)>0){ $catgthot=$query->rows[0]['catg'];
            $hhini=$query->rows[0]['hhini']; $hhsal=$query->rows[0]['hhsal'];
            $showingcatg=' <img src="catalog/view/theme/default/image/stars-'.$catgthot.'.png" />';
          }else{ $catgthot='x'; }
        } ?>
        <span><?php echo $text_model; ?></span> <?php echo $model.(isset($showingcatg)?$showingcatg:''); ?><br />
        <?php if ($reward) { ?>
        <span><?php echo $text_reward; ?></span> <?php echo $reward; ?><br />
        <?php } ?>
        <span><?php echo $text_stock; ?></span> <?php echo $stock; ?>
      </div>
      <?php if ($price) { ?> <?php } ?>

  <?php if($tipoproducto=="Hotel"){ ?>
      Introduce la fecha de tu reservaci&oacute;n:
      <div style="text-align:right;">
        <input type="button" value="Descargar informaci&oacute;n" prd_dta="2_<?php echo $product_id;?>" class="button downldinf" />
        <input type="button" value="Enviar por email" class="button sendmlinf" />
        <p id="frmsendif2cstm" style="display:none;">Ingrese los siguientes datos: <br/>Su nombre <input type="text" id="sndinfremt" name="sndinfremt" />
            <br/>Nombre del destinatario <input type="text" id="sndinfndest" name="sndinfndest" />
            <br/>Correo del destinatario <input type="text" id="sndinfedest" name="sndinfedest" />
            <input type="hidden" id="sndinfdtr" name="sndinfdtr" value="2_<?php echo $product_id;?>" />
            <br /><?php echo $entry_captcha; ?> <input type="text" id="sndinfctcha" name="sndinfctcha" />
            <br /><img src="index.php?route=product/product/captcha" alt="" id="smip_captcha" />
            <br/><input type="button" id="sndinfnow" value="Enviar" class="button" />
        </p>
      </div>
      <table align="center" border="1" class="list" style="width:40%; background:#D3D3D3; ">
        <tr> <td>Fecha Ingreso</td> <td>Fecha Final</td> </tr>
        <tr>
          <td style="text-align:center;"> <p>
            <input type="text" size=10 class="date" name="finicio" id="finicio" value="<?php echo $finicio;?>" />
            <input type="button" value="buscar" id="buscarfechahot" class="button" /> </p>
          </td>
          <td><input type="text" size=10 class="date" name="ffin" id="finicio2" value="<?php echo $ffin;?>" /></td>
        </tr>
      </table>
      Seleccione habitaciones a reservar:
      <br />(Hora de entrada: <?php echo $hhini.', hora de salida: '.$hhsal; ?>)
      <input type="hidden" id="kndapro" name="kndapro" value="2" />
      <table width="100%" border="1" class="list">
        <?php $preciosh='';
        $consulta="SELECT * FROM  habitaciones WHERE id_producto = '".$product_id."' and (finicio<= '".$finicio."' and ffin>= '".$ffin."')";
        $query = $this->db->query($consulta);
        $prom1="SELECT * FROM habdescant WHERE id_producto=".$product_id;
        $qprom1=$this->db->query($prom1);
        $prom3="SELECT * FROM habdescnoches WHERE id_producto=".$product_id;
        $qprom3=$this->db->query($prom3);
        ?> <tr> <?php
        foreach ($query->rows as $result){ ?>
          <td><?php echo $result['tipo'];?></td>
        <?php } ?> </tr> <tr> <?php
        foreach ($query->rows as $result){ $idhab=$result['idhabitaciones']; $tprecio=$result['precio'];
          $preciosh.=(strlen($preciosh)==0?'':',').$idhab.':{"pre":"'.$tprecio.'","hab":"'.$result['tipo'].'","cat":"';
          $preciosh.=$catgthot.'","poa":"0","pop":"0"}'; ?>
          <td>
            <span class="prehb_bs" dtaid="<?php echo $idhab;?>"> <?php echo $this->currency->format($tprecio); ?> </span>
            <span id="pro_<?php echo $idhab;?>"></span>
            <br/> <input type="text" value="0" class="spinner" id="spin_<?php echo $idhab;?>" style="width:3.9em;" />
          </td>
        <?php } ?> </tr>
       </table>
       
       <div id="dts_pers" style="border: 1px solid black;">
         <p> Persona Encargada de la reservacion <input type="hidden" id="npersonas" name="npersonas" value="1" />
         <input type="hidden" name="prage0" value="1" />
         <br /> Nombre: <input type="text" id="nomper0" name="nomper0"> Direccion: <input type="text" id="dirper0" name="dirper0">
         <br/> Telefono: <input type="text" id="telper0" name="telper0"> Email: <input type="text" id="emlper0" name="emlper0">  </p>
       </div>

      <table align="center"  border="1" class="list" style="width:26em;margin:.5em auto;background:#D3D3D3; ">
        <tr> <td align="center">Reservaci&oacute;n en <?php echo $model; ?></td> </tr>
        <tr> <td id="ctghbs">Habitaciones --</td> </tr>
        <tr> <td>Iniciando en <span id="inicia_en"><?php echo $finicio;?></span> al <span id="termina_en"><?php echo $ffin;?></span> </td> </tr>
        <tr>
          <td id="revprodcstt" align="center">Costo $--</td>
        </tr>
        <tr>
          <td colspan="1" align="center" > <br> <p>
            <input type="button" value="Reservar" id="<?php echo $product_id;?>" class="button button-cart">
          </p> </td>
        </tr>
      </table>
      <?php $promanti=buildPromoAnticipacion($qprom1);
      $promdnight=buildPromoNights($qprom3); ?>
      <script type="text/javascript">
        $(document).ready(function(){
          <?php if($preciosh!=''){ ?> crhabtpr={<?php echo $preciosh;?>}; <?php } ?>
          <?php if(isset($promanti) && strlen($promanti)>0){ ?>
            promoanti=new Array(<?php echo $promanti;?>);
            updatePrecios('<?php echo $finicio;?>',null,null);
          <?php }if(isset($promdnight) && strlen($promdnight)>0){ ?>
            promdnight=new Array(<?php echo $promdnight;?>);
          <?php } ?>
        });
      </script> <?php
  } ?>

<?php if($tipoproducto=="Tour"){ ?>
    <table align="center" style="width:413px;">
        <tr> <td colspan="3" style="text-align:right;">
          <input type="button" value="Descargar informaci&oacute;n" prd_dta="3_<?php echo $product_id;?>" class="button downldinf" />
          <input type="button" value="Enviar por email" class="button sendmlinf" />
          <p id="frmsendif2cstm" style="display:none;">Ingrese los siguientes datos: <br/>Su nombre <input type="text" id="sndinfremt" name="sndinfremt" />
            <br/>Nombre del destinatario <input type="text" id="sndinfndest" name="sndinfndest" />
            <br/>Correo del destinatario <input type="text" id="sndinfedest" name="sndinfedest" />
            <input type="hidden" id="sndinfdtr" name="sndinfdtr" value="3_<?php echo $product_id;?>" />
            <br /><?php echo $entry_captcha; ?> <input type="text" id="sndinfctcha" name="sndinfctcha" />
            <br /><img src="index.php?route=product/product/captcha" alt="" id="smip_captcha" />
            <br/><input type="button" id="sndinfnow" value="Enviar" class="button" />
          </p>
        </td> </tr>
    <tr> <td>
      <table border="1" class="list" style="width:200px; min-height:16em; background:#D3D3D3;">
        <tr> <td align="center">Fecha Ingreso</td> </tr>
        <tr>
          <td align="center"><input type="text" size=12 class="date" name="finicio" id="finicio" value="<?php echo $finicio;?>" /></td>
        </tr>
        <tr>
          <td colspan="1" align="center" > <br> <p> <input type="button" value="buscar" id="buscartour" class="button" /> </p> </td>
        </tr>
      </table>
    </td> <td></td> <td>
      <table border="1" class="list" style="width:200px; min-height:16em; background:#D3D3D3;">
        <tr> <td align="center">Ciudad de salida</td> </tr>
        <tr> <td align="center">
          <?php $sentence="SELECT circuitos_cddsal.*,finicio,ffin FROM circuitos_cddsal,circuitos_salidas WHERE idprod =";
          $sentence.=$product_id." and idcsal=idcdd";
          $query = $this->db->query($sentence); ?>
          <select name="cddsal" id="cddsal">
            <?php if(count($query->rows)==0){ $selvigen=''; ?>
              <option value="0"> No hay ciudades disponibles </option>
            <?php }else{
              for($rft=0;$rft<count($query->rows);$rft++){
                $result=$query->rows[$rft];
                $vigen='Vigente: '.cutTimeFDate($result['finicio']).' hasta '.cutTimeFDate($result['ffin']);
                if($rft==0 && $saliendode==null){
                  $saliendode=$result['ciudad'];
                  $selvigen=ereg_replace(' ','<br />',$vigen);
                }else if($saliendode==$result['ciudad']){ $selvigen=ereg_replace(' ','<br />',$vigen); } ?>
                <option value="<?php echo $result['ciudad'];?>" <?php echo($saliendode==$result['ciudad']?'selected':'');?>
                  title="<?php echo $vigen;?>" dtf1="<?php echo cutTimeFDate($result['finicio']);?>" dtf2="<?php echo cutTimeFDate($result['ffin']);?>" >
                  <?php echo $result['ciudad'];?>
                </option>
              <?php }
            } ?>
          </select> <br />
          <span id="vgncct"> <?php echo $selvigen;?> </span>
        </td> </tr>
      </table>
    </td></tr></table>

    Indique numero de personas
    <table width="100%" >
    <tr> <td></td> <td>Adulta</td> <td>Menor</td> <td>Insen</td> </tr>
    <?php $preciosp='';
      $consulta="SELECT tours.idtours,tours.tipo,tours.precio,circuitos_salidas.finicio,circuitos_salidas.ffin FROM ";
      $consulta.="tours,circuitos_salidas,circuitos_cddsal WHERE circuitos_cddsal.idprod='".$product_id."' and ciudad='";
      $consulta.=$saliendode."' and circuitos_salidas.idcdd=circuitos_cddsal.idcsal and tours.id_producto=circuitos_salidas";
      $consulta.=".id_producto AND circuitos_cddsal.idprod=tours.id_producto and tours.idsalida=circuitos_salidas.idcircuitos_salidas ";
      $consulta.="and (finicio<= '".$finicio."' and ffin>= '".$finicio."') group by idtours";
      $query = $this->db->query($consulta);

      $prom1="SELECT * FROM habdescant WHERE id_producto=".$product_id;
      $qprom1 = $this->db->query($prom1);

      $prom2="SELECT * FROM habdescnoches WHERE id_producto=".$product_id;
      $qprom2 = $this->db->query($prom2);

      $dataopc=array();
      for($row=0;$row<count($query->rows);$row++){
        $result=$query->rows[$row]; $ondopc=false;
        for($flq=0;$flq<count($dataopc);$flq++){
          if($dataopc[$flq][$result['tipo']]==null){ $ondopc=true;
            $dataopc[$flq][$result['tipo']]=$result['precio'];
            $dataopc[$flq][$result['tipo'].'_id']=$result['idtours']; break;
          }
        }
        if(!$ondopc){
          $newrowidx=count($dataopc);
          $dataopc[$newrowidx]['Menor']=($result['tipo']=='Menor'?$result['precio']:null);
          $dataopc[$newrowidx]['INSEN']=($result['tipo']=='INSEN'?$result['precio']:null);
          $dataopc[$newrowidx]['Adulta']=($result['tipo']=='Adulta'?$result['precio']:null);
          $dataopc[$newrowidx][$result['tipo'].'_id']=$result['idtours'];
        }
      }
      for($fgh=0;$fgh<count($dataopc);$fgh++){ ?> <tr><td>Costo</td> <td><?php
          if($dataopc[$fgh]['Adulta']!=null){ $idtrs=$dataopc[$fgh]['Adulta_id']; $tprecio=$dataopc[$fgh]['Adulta'];
            $preciosp.=(strlen($preciosp)==0?'':',').$idtrs.':{"pre":"'.$tprecio.'","tpr":"Adulta","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idtrs;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idtrs;?>"></span>
            <br/> <input type="text" value="0" class="spinner" dtx-typ="A" id="spin_<?php echo $idtrs;?>" style="width:3.9em;" />
          <?php } ?> </td> <td> <?php
          if($dataopc[$fgh]['Menor']!=null){ $idtrs=$dataopc[$fgh]['Menor_id']; $tprecio=$dataopc[$fgh]['Menor'];
            $preciosp.=(strlen($preciosp)==0?'':',').$idtrs.':{"pre":"'.$tprecio.'","tpr":"Menor","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idtrs;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idtrs;?>"></span>
            <br/> <input type="text" value="0" class="spinner" dtx-typ="M" id="spin_<?php echo $idtrs;?>" style="width:3.9em;" />
          <?php } ?> </td> <td> <?php
          if($dataopc[$fgh]['INSEN']!=null){ $idtrs=$dataopc[$fgh]['INSEN_id']; $tprecio=$dataopc[$fgh]['INSEN'];
            $preciosp.=(strlen($preciosp)==0?'':',').$idtrs.':{"pre":"'.$tprecio.'","tpr":"INSEN","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idtrs;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idtrs;?>"></span>
            <br/> <input type="text" value="0" class="spinner" dtx-typ="I" id="spin_<?php echo $idtrs;?>" style="width:3.9em;" />
          <?php } ?> </td> <td>
        </tr> <?php
      }
      if(isset($dataopc)){
        $promanti=buildPromoAnticipacion($qprom1);
        $pronpers=buildPromoToursNPers($qprom2);
      } ?>
      <script type="text/javascript">
        $(document).ready(function(){
          <?php if($preciosp!=''){ ?> crprttps={<?php echo $preciosp;?>}; <?php } ?>
          <?php if(isset($promanti) && strlen($promanti)>0){ ?>
            promoanti=new Array(<?php echo $promanti;?>);
            updatePrecios('<?php echo $finicio;?>',null,null);
          <?php }if(isset($pronpers) && strlen($pronpers)>0){ ?>
            promonpers=new Array(<?php echo $pronpers;?>);
          <?php } ?>
        });
      </script>
    </table>

    Datos del reservante(s) <input type="hidden" name="npersonas" id="npersonas" value="0" />
    <div id="dts_pers" style="border:solid 1px black;height:3px;overflow:auto;"> </div>
    <a href="index.php?route=information/information/info&amp;information_id=3" alt="Privacy Policy" target="_blank">
      Politicas de privacidad
    </a> <input type="hidden" id="kndapro" name="kndapro" value="3" /> <br />
    <table align="center"  border="1" class="list" style="width:em;margin:.5em auto;background:#D3D3D3; ">
        <tr> <td align="center" id="nperstit">Reservacion para 0 personas</td> </tr>
        <tr> <td>Iniciando en <span id="inicia_en"><?php echo $finicio;?></span> saliendo de <?php echo $saliendode;?> </td> </tr>
        <tr> <td id="ctghbs">Personas --</td> </tr>
        <tr> <td id="nomtit">Titular --</td> </tr>
        <tr> <td id="revprodcstt" align="center">Costo $--</td> </tr>
        <tr>
          <td colspan="1" align="center" > <br> <p>
            <input type="button" value="Reservar" id="<?php echo $product_id;?>" class="button button-cart">
          </p> </td>
        </tr>
      </table>
<?php } ?>

<?php if($tipoproducto=="Traslado"){ ?>
        <div style="text-align:right;">
          <input type="button" value="Descargar informaci&oacute;n" prd_dta="4_<?php echo $product_id;?>" class="button downldinf" />
          <input type="button" value="Enviar por email" class="button sendmlinf" />
          <p id="frmsendif2cstm" style="display:none;">Ingrese los siguientes datos: <br/>Su nombre <input type="text" id="sndinfremt" name="sndinfremt" />
            <br/>Nombre del destinatario <input type="text" id="sndinfndest" name="sndinfndest" />
            <br/>Correo del destinatario <input type="text" id="sndinfedest" name="sndinfedest" />
            <input type="hidden" id="sndinfdtr" name="sndinfdtr" value="4_<?php echo $product_id;?>" />
            <br /><?php echo $entry_captcha; ?> <input type="text" id="sndinfctcha" name="sndinfctcha" />
            <br /><img src="index.php?route=product/product/captcha" alt="" id="smip_captcha" />
            <br/><input type="button" id="sndinfnow" value="Enviar" class="button" />
          </p>
        </div>
      <table border="1" class="list" style="width:15em; min-height:8em; background:#D3D3D3; margin:0.6em auto;">
        <tr> <td align="center">Fecha de salida</td> </tr>
        <tr>
          <td align="center">
            <?php $sentence="SELECT * FROM traslados_salidas WHERE id_producto=".$product_id;
            $query = $this->db->query($sentence);
            if(count($query->rows)==0){
              echo 'No hay fechas';
            }else{ ?>
              <select name="tsalfecha" id="tsalfecha"> <?php
                for($rft=0;$rft<count($query->rows);$rft++){
                  $result=$query->rows[$rft];
                  $descdia='Dia: '.cutTimeFDate($result['fecha']).' hora '.$result['hora'].' '.$result['via'];
                  if($rft==0){
                    $trassalida=$descdia; $trasminp=$result['minper'];
                    $trasmaxp=$result['maxper']; $finicio=cutTimeFDate($result['fecha']);
                  } ?>
                  <option value="<?php echo $descdia;?>"
                    dta-min="<?php echo $result['minper'];?>" dta-jdt="<?php echo cutTimeFDate($result['fecha']);?>"
                    dta-max="<?php echo $result['maxper'];?>">
                    <?php echo $descdia;?>
                  </option>
                <?php } ?>
              </select>
              <input type="hidden" name="finicio" id="finicio" value="<?php echo $finicio;?>" />
              <input type="hidden" name="cddsal" id="cddsal" value="<?php echo $trassalida;?>" />
            <?php } ?>
          </td>
        </tr>
      </table>

    Indique numero de personas
    <table width="100%" >
    <tr> <td></td> <td>Adulta</td> <td>Menor</td> <td>Insen</td> </tr>
    <?php $preciosp='';
      $consulta="SELECT * FROM traslados WHERE id_producto=".$product_id;
      $queryx = $this->db->query($consulta);
      $query=$queryx->rows[0];

      $prom1="SELECT * FROM habdescant WHERE id_producto=".$product_id;
      $qprom1 = $this->db->query($prom1);

      $prom2="SELECT * FROM habdescnoches WHERE id_producto=".$product_id;
      $qprom2=$this->db->query($prom2); ?>

      <tr><td>Costo</td> <td><?php
          if($query['pre_adult']>0){ $idtrs='1'.$query['pre_adult']; $tprecio=$query['pre_adult'];
            $preciosp.=(strlen($preciosp)==0?'':',').$idtrs.':{"pre":"'.$tprecio.'","tpr":"Adulta","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idtrs;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idtrs;?>"></span>
            <br/> <input type="text" value="0" class="spinner" dtx-typ="A" id="spin_<?php echo $idtrs;?>" style="width:3.9em;" />
          <?php } ?> </td> <td> <?php
          if($query['pre_inft']!=null){ $idtrs='2'.$query['pre_inft']; $tprecio=$query['pre_inft'];
            $preciosp.=(strlen($preciosp)==0?'':',').$idtrs.':{"pre":"'.$tprecio.'","tpr":"Menor","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idtrs;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idtrs;?>"></span>
            <br/> <input type="text" value="0" class="spinner" dtx-typ="M" id="spin_<?php echo $idtrs;?>" style="width:3.9em;" />
          <?php } ?> </td> <td> <?php
          if($query['pre_inft']!=null){ $idtrs='3'.$query['pre_inft']; $query['pre_inft'];
            $preciosp.=(strlen($preciosp)==0?'':',').$idtrs.':{"pre":"'.$tprecio.'","tpr":"INSEN","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idtrs;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idtrs;?>"></span>
            <br/> <input type="text" value="0" class="spinner" dtx-typ="I" id="spin_<?php echo $idtrs;?>" style="width:3.9em;" />
          <?php } ?> </td> <td>
        </tr> <?php

      if(isset($qprom1)){
        $promanti=buildPromoAnticipacion($qprom1);
      }if(isset($qprom2)){
        $prolugrs=buildPromoPersonas($qprom2);
      } ?>
      <script type="text/javascript">
        $(document).ready(function(){
          <?php if($preciosp!=''){ ?> crprttps={<?php echo $preciosp;?>}; <?php } ?>
          <?php if(isset($promanti) && strlen($promanti)>0){ ?>
            promoanti=new Array(<?php echo $promanti;?>);
            updatePrecios('<?php echo $finicio;?>',null,null);
          <?php }if(isset($prolugrs) && strlen($prolugrs)>0){ ?>
            promolugrs=new Array(<?php echo $prolugrs;?>);
          <?php } ?>
        });
      </script>
    </table>

    Datos del reservante(s) <input type="hidden" name="npersonas" id="npersonas" value="0" />
   <div id="dts_pers" style="border:solid 1px black;height:3px;overflow:auto;"> </div>
    <a href="index.php?route=information/information/info&amp;information_id=3" alt="Privacy Policy" target="_blank">
    Politicas de privacidad
    </a> <input type="hidden" id="kndapro" name="kndapro" value="4" />
    <input type="hidden" id="trasminp" name="trasminp" value="<?php echo $trasminp;?>" />
    <input type="hidden" id="trasmaxp" name="trasmaxp" value="<?php echo $trasmaxp;?>" /> <br />
    <table align="center"  border="1" class="list" style="width:26em;margin:.5em auto;background:#D3D3D3; ">
        <tr> <td align="center" id="nperstit">Reservacion para 0 personas</td> </tr>
        <tr> <td>Salida <span id="trassalida"> <?php echo $trassalida;?> </span> </td> </tr>
        <tr> <td id="ctghbs">Personas --</td> </tr>
        <tr> <td id="nomtit">Titular --</td> </tr>
        <tr> <td id="revprodcstt" align="center">Costo $--</td> </tr>
        <tr>
          <td colspan="1" align="center" > <br> <p>
            <input type="button" value="Reservar" id="<?php echo $product_id;?>" class="button button-cart">
          </p> </td>
        </tr>
      </table>
<?php } ?>

 <?php if($tipoproducto=="Circuito"){ ?>
    <table align="center" style="width:413px;">
    <tr> <td colspan="3" style="text-align:right;">
      <input type="button" value="Descargar informaci&oacute;n" prd_dta="1_<?php echo $product_id;?>" class="button downldinf" />
      <input type="button" value="Enviar por email" class="button sendmlinf" />
      <p id="frmsendif2cstm" style="display:none;">Ingrese los siguientes datos: 
            <br/>Su nombre <input type="text" id="sndinfremt" name="sndinfremt" />
            <br/>Nombre del destinatario <input type="text" id="sndinfndest" name="sndinfndest" />
            <br/>Correo del destinatario <input type="text" id="sndinfedest" name="sndinfedest" />
            <input type="hidden" id="sndinfdtr" name="sndinfdtr" value="1_<?php echo $product_id;?>" />
            <br /><?php echo $entry_captcha; ?> <input type="text" id="sndinfctcha" name="sndinfctcha" />
            <br /><img src="index.php?route=product/product/captcha" alt="" id="smip_captcha" />
            <br/><input type="button" id="sndinfnow" value="Enviar" class="button" />
      </p>
    </td> </tr>
    <tr> <td>
      <table border="1" class="list" style="width:200px; min-height:16em; background:#D3D3D3;">
        <tr> <td align="center">Fecha Ingreso</td> </tr>
        <tr>
          <td align="center"><input type="text" size=12 class="date" name="finicio" id="finicio" value="<?php echo $finicio;?>" /></td>
        </tr>
        <tr>
          <td colspan="1" align="center" > <br> <p> <input type="button" value="buscar" id="buscartour" class="button" /> </p> </td>
        </tr>
      </table>
    </td> <td></td> <td>
      <table border="1" class="list" style="width:200px; min-height:16em; background:#D3D3D3;">
        <tr> <td align="center">Numero de personas</td> </tr>
        <tr> <td align="center"><input type="text" size=5 name="npersonas" id="npersonas" /></td> </tr>
        <tr> <td align="center">Ciudad de salida</td> </tr>
        <tr> <td align="center">
          <?php $sentence="SELECT circuitos_cddsal.*,finicio,ffin FROM circuitos_cddsal,circuitos_salidas WHERE idprod =";
          $sentence.=$product_id." and idcsal=idcdd";
          $query = $this->db->query($sentence); ?>
          <select name="cddsal" id="cddsal">
            <?php if(count($query->rows)==0){ $selvigen=''; ?>
              <option value="0"> No hay ciudades disponibles </option>
            <?php }else{
              for($rft=0;$rft<count($query->rows);$rft++){
                $result=$query->rows[$rft];
                $vigen='Vigente: '.cutTimeFDate($result['finicio']).' hasta '.cutTimeFDate($result['ffin']);
                if($rft==0 && $saliendode==null){
                  $saliendode=$result['ciudad'];
                  $selvigen=ereg_replace(' ','<br />',$vigen);
                }else if($saliendode==$result['ciudad']){ $selvigen=ereg_replace(' ','<br />',$vigen); } ?>
                <option value="<?php echo $result['ciudad'];?>" <?php echo($saliendode==$result['ciudad']?'selected':'');?>
                  title="<?php echo $vigen;?>" dtf1="<?php echo cutTimeFDate($result['finicio']);?>" dtf2="<?php echo cutTimeFDate($result['ffin']);?>" >
                  <?php echo $result['ciudad'];?>
                </option>
              <?php }
            } ?>
          </select> <br />
          <span id="vgncct"> <?php echo $selvigen;?> </span>
        </td> </tr>
      </table>
    </td></tr></table>

  Datos del reservante(s)
     <div id="dts_pers" style="border:solid 1px black;height:3px;overflow:auto;"> </div>
 
  <a href="index.php?route=information/information/info&amp;information_id=3" alt="Privacy Policy" target="_blank">
    Politicas de privacidad
  </a> <input type="hidden" id="kndapro" name="kndapro" value="1" />
  <br /><br />

  <div class="wishlist-info">
    Seleccione categoria y numero de habitaciones
    <table width="100%" >
    <tr>
      <td>Categoria</td> <td>Sencilla</td> <td>Doble</td> <td>Triple</td> <td>Cuadruple</td> <td>Menor</td>
    </tr>
    <?php
      $types=array(0=>'Sencilla',1=>'Doble',2=>'Triple',3=>'Cuadruple',4=>'Suplemento');
      $preciosh='';
      $consulta="SELECT circuitos.idcircuitos,circuitos.tipo,circuitos.precio,circuitos.estrellas,circuitos_salidas.finicio,";
      $consulta.="circuitos_salidas.ffin FROM circuitos,circuitos_salidas,circuitos_cddsal WHERE circuitos.id_producto='".$product_id."'";
      $consulta.="and ciudad='".$saliendode."' and circuitos.id_producto=circuitos_salidas.id_producto and circuitos.idsalida=";
      $consulta.="circuitos_salidas.idcircuitos_salidas and circuitos_salidas.idcdd=circuitos_cddsal.idcsal AND (finicio<= '";
      $consulta.=$finicio."' and ffin>= '".$finicio."') order by estrellas asc";
      $query = $this->db->query($consulta);

      $prom1="SELECT * FROM habdescant WHERE id_producto=".$product_id;
      $qprom1 = $this->db->query($prom1);

      $prom2="SELECT * FROM habdescnoches WHERE id_producto=".$product_id;
      $qprom2 = $this->db->query($prom2);

      for($row=0;$row<count($query->rows);$row++){
        $catgst=$query->rows[$row]['estrellas'];
        $result=$query->rows[$row];
        $dataopc=array();
        $dataopc['estrellas']=$catgst;
        $dataopc['finicio']=$result['finicio'];
        $dataopc['ffin']=$result['ffin'];
        while($catgst==$result['estrellas']){
          $result=$query->rows[$row];
          $dataopc[$result['tipo'].'_id']=$result['idcircuitos'];
          $dataopc[$result['tipo']]=$result['precio'];
          $catgst=($row+1<count($query->rows)?$query->rows[++$row]['estrellas']:-1);
        }
        if($catgst!=-1 && $row<count($query->rows) && $query->rows[$row]['estrellas']!=$query->rows[$row-1]['estrellas']){ $row--; } ?>
        <tr> <td> <img src="catalog/view/theme/default/image/stars-<?php echo $dataopc['estrellas'];?>.png" alt="<?php echo $reviews;?>" /></td> <?php
        for($fgh=0;$fgh<count($types);$fgh++){ ?> <td> <?php
          if( isset($dataopc[$types[$fgh]]) ){ $idcirc=$dataopc[$types[$fgh].'_id']; $tprecio=$dataopc[$types[$fgh]];
            $preciosh.=(strlen($preciosh)==0?'':',').$idcirc.':{"pre":"'.$tprecio.'","hab":"'.$types[$fgh].'","cat":"';
            $preciosh.=$dataopc['estrellas'].'","poa":"0","pop":"0"}'; ?>
            <span class="prehb_bs" dtaid="<?php echo $idcirc;?>"> <?php echo $this->currency->format($tprecio);?></span>
            <span id="pro_<?php echo $idcirc;?>"></span>
            <br/> <input type="text" value="0" class="spinner" id="spin_<?php echo $idcirc;?>" style="width:3.9em;" /> </td>
          <?php } ?> </td> <?php
        } ?> </tr> <?php
      }
      if(isset($dataopc)){
        $promanti=buildPromoAnticipacion($qprom1);
        $prolugrs=buildPromoPersonas($qprom2);
      } ?>
      <script type="text/javascript">
        $(document).ready(function(){
          <?php if($preciosh!=''){ ?> crhabtpr={<?php echo $preciosh;?>}; <?php } ?>
          <?php if(isset($promanti) && strlen($promanti)>0){ ?>
            promoanti=new Array(<?php echo $promanti;?>);
            updatePrecios('<?php echo $finicio;?>',null,null);
          <?php }if(isset($prolugrs) && strlen($prolugrs)>0){ ?>
            promolugrs=new Array(<?php echo $prolugrs;?>);
          <?php } ?>
        });
      </script>
    </table>
    <table align="center"  border="1" class="list" style="width:26em;margin:.5em auto;background:#D3D3D3; ">
        <tr> <td align="center" id="nperstit">Reservacion para 0 personas</td> </tr>
        <tr> <td>Iniciando en <span id="inicia_en"><?php echo $finicio;?></span> saliendo de <?php echo $saliendode;?> </td> </tr>
        <tr> <td id="nomtit">Titular --</td> </tr>
        <tr> <td id="ctghbs">Habitaciones --</td> </tr>
        <tr> 
          <td id="revprodcstt" align="center">Costo $--</td>
        </tr>
        <tr>
          <td colspan="1" align="center" > <br> <p>
            <input type="button" value="Reservar" id="<?php echo $product_id;?>" class="button button-cart">
          </p> </td>
        </tr>
      </table>
  </div>
<?php } ?>

      
      
      <?php if ($options) { ?>
      <div class="options">
        <h2><?php echo $text_option; ?></h2>
        <br />
        <?php foreach ($options as $option) { ?>
        <?php if ($option['type'] == 'select') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <select name="option[<?php echo $option['product_option_id']; ?>]">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'radio') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'checkbox') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <table class="option-image">
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <tr>
              <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                </label></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'text') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'textarea') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'file') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'date') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'datetime') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'time') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
        </div>
        <br />
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
      <div class="cart">
        <div><!--<?php echo $text_qty; ?>-->
          <input type="hidden" name="quantity" size="2" value="<?php echo $minimum; ?>" />
          <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
          &nbsp;
          <!--<input type="button" value="<?php echo $button_cart; ?>" id="button-cart" class="button" />
          <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span>
          <span class="links"><a onclick="addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a><br />
            <a onclick="addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a></span>-->
        </div>
        <?php if ($minimum > 1) { ?>
        <div class="minimum"><?php echo $text_minimum; ?></div>
        <?php } ?>
      </div>
      <?php if ($review_status) { ?>
      <div class="review">
        <div><img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $text_write; ?></a></div>
        <div class="share"><!-- AddThis Button BEGIN -->
          <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
          <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script>
          <!-- AddThis Button END -->
        </div>
      </div>
      <?php } ?>
    </div>
  </div>


  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php for ($i = 0; $i < count($tags); $i++) { ?>
    <?php if ($i < (count($tags) - 1)) { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
    <?php } else { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<?php include(DIR_TEMPLATE.$this->config->get('config_template')."/template/product/product.php");?>
<?php echo $footer; ?>

<?php
function buildPromoAnticipacion($anticipacion){
  $prm1data='';
  for($bhu=0;$bhu<count($anticipacion->rows);$bhu++){
    $rec=$anticipacion->rows[$bhu];
    $prdesc=(1-($rec['porcentaje']/100));
    $prm1data.=(strlen($prm1data)>0?',':'').'new Array("'.$rec['dias'].'","'.$prdesc.'","'.substr($rec['finicio'],0,10).'","'.substr($rec['ffin'],0,10).'")';
  }
  return $prm1data;
}

function buildPromoPersonas($lugares){
  $prm2data='';
  for($bhu=0;$bhu<count($lugares->rows);$bhu++){
    $rec=$lugares->rows[$bhu];
    $prdesc=(1-($rec['nochesdescuento']/100));
    $prm2data.=(strlen($prm2data)>0?',':'').'new Array("'.$rec['minper'].'","'.$rec['nochestotales'].'","'.$prdesc.'","'.substr($rec['finicio'],0,10).'","'.substr($rec['ffin'],0,10).'")';
  }
  return $prm2data;
}

function buildPromoToursNPers($prs){
  $prm2data='';
  for($bhu=0;$bhu<count($prs->rows);$bhu++){
    $rec=$prs->rows[$bhu];
    $prdesc=(1-($rec['nochesdescuento']/100));
    $prm2data.=(strlen($prm2data)>0?',':'').'new Array("'.$rec['nochestotales'].'","'.$prdesc.'","'.substr($rec['finicio'],0,10).'","'.substr($rec['ffin'],0,10).'")';
  }
  return $prm2data;
}

function buildPromoNights($nights){
  $prm2data='';
  for($bhu=0;$bhu<count($nights->rows);$bhu++){
    $rec=$nights->rows[$bhu];
    $prdesc=(100-( $rec['nochesdescuento']/($rec['nochestotales']/100) ))/100;
    $prm2data.=(strlen($prm2data)>0?',':'').'new Array("'.$rec['nochesdescuento'].'","'.$rec['nochestotales'].'","'.$prdesc.'","'.substr($rec['finicio'],0,10).'","'.substr($rec['ffin'],0,10).'")';
  }
  return $prm2data;
}

function cutTimeFDate($wdate){
  $tks=explode(' ',$wdate);
  return $tks[0];
}
?>