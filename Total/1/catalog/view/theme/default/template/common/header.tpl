<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0, initial-scale=1.0">
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />

  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/themes/ui-lightness/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="adds/jqueryui/ui.spinner.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
  <script type="text/javascript" src="adds/jqueryui/ui.spinner.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
 <script type="text/javascript" src="catalog/view/javascript/cssrefresh.js"></script>


<!-- Config Languaje-->
<script type="text/javascript" src="https://cdn.weglot.com/weglot_jimdo.js"></script>
<script >
  
  Weglot.setup({

api_key:'wg_d54680ab7dfecddb1c636506797299ab',
originalLanguage:'es',
destinationLanguages:'en,de',

  });
</script>




<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body>


<!--   Navegación superior-->


<nav  id="top">
 
  
    <div class="header_right">
    
 <div class="dropdown">
  <button class="dropbtn">Mi Cuenta</button>
  <div class="dropdown-content">
    <a href="#">Registro</a>
    <a href="#">Login</a>
    
  </div>
</div>



<div class="dropdown">
  <button class="dropbtn">Idiomas</button>
  <div class="dropdown-content">
    <a href="#">Español</a>
    <a href="#">Ingles</a>
    <a href="#">Frances</a>
  </div>
</div>


<div class="dropdown">
  <button class="dropbtn">Tipo de Moneda</button>
  <div class="dropdown-content">
    <a href="#">Dolar</a>
    <a href="#">Pesos Mexicanos</a>
  
  </div>
</div>




  </div>
</nav>

<!-- /*****************************Fin  superior*************************************+-->


<div class="contentheader">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  <?php echo $currency; ?>
  
 <div id="search">
    <div class="button-search"></div>
    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
  </div>




<div class="info">  </div>
    <div class="info-content"><p>Contáctanos al 01 967 678 40 45</p></div>

    

<div class="button-buy"></div>
  
<div class="links">
<a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart;?></a>
</div>
</div>

</div>



<!--<div id="menu">
  <?php if ($categories) { ?>
  <ul>
    <?php foreach ($categories as $category) { ?>
    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
  </ul>-->


<div id="menu" >


  <ul>
<?php foreach ($categories as $category) { ?>
    <li>
<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
  </ul>

  
</div>
<?php } ?>



<div id="notification"></div>





