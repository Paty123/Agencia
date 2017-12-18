<?php
class ModelModuleOcreservation extends Model {
public function createTable() {

$querystring = "CREATE TABLE IF NOT EXISTS ".DB_PREFIX ."ocreservation (";
$querystring .= "reservation_id int(11) NOT NULL AUTO_INCREMENT,";
$querystring .= "product_id int(11) NOT NULL,";
$querystring .= "option_id int(11)  NULL,";
$querystring .= "dateres date NOT NULL,";
$querystring .= "quantity int(11) NOT NULL,";
$querystring .= "order_id int(11) NULL,";
$querystring .= "PRIMARY KEY (reservation_id));";

$this->db->query($querystring);


$querystring = "CREATE TABLE IF NOT EXISTS ".DB_PREFIX ."ocreservation_setting (";
$querystring .= "  product_id int(11) NOT NULL,";
$querystring .= "  option_id int(11) DEFAULT NULL,";
$querystring .= "  mon int(11) NOT NULL DEFAULT '0',";
$querystring .= "  tue int(11) NOT NULL DEFAULT '0',";
$querystring .= "  wed int(11) NOT NULL DEFAULT '0',";
$querystring .= "  thu int(11) NOT NULL DEFAULT '0',";
$querystring .= "  fri int(11) NOT NULL DEFAULT '0',";
$querystring .= "  sat int(11) NOT NULL DEFAULT '0',";
$querystring .= "  sun int(11) NOT NULL DEFAULT '0',"; 
$querystring .= "  type int(11) DEFAULT NULL);";

$this->db->query($querystring);

}

public function deleteTable() {

$querystring = "DROP TABLE ".DB_PREFIX ."ocreservation ";
$querystring = "DROP TABLE ".DB_PREFIX ."ocreservation_setting ";
$this->db->query($querystring);

}

public function getReservations($key)
{
	$lanq_id = (int)$this->config->get('config_language_id');
	$querystring = "SELECT pd.name productname, dateres, order_id, ovd.name modelname, o.quantity quantity FROM ".DB_PREFIX ."ocreservation o LEFT JOIN " . DB_PREFIX . "product_description pd ON (o.product_id = pd.product_id AND pd.language_id =". $lanq_id.")LEFT JOIN " . DB_PREFIX . "product_option_value pov ON (o.option_id = pov.product_option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (pov.option_value_id = ovd.option_value_id AND ovd.language_id =". $lanq_id.") WHERE   o.product_id=". $key. " ORDER BY o.dateres;";

	$results = $this->db->query($querystring);
	
  return $results->rows;
}

public function getSettings($key)
{
	$lanq_id = (int)$this->config->get('config_language_id');
	$querystring = "SELECT COUNT(*) as total FROM ".DB_PREFIX ."ocreservation_setting  WHERE product_id=". $key.";";

	$results = $this->db->query($querystring);
	$num_rows = $results->row['total'];
	
	if ($num_rows < 1){
		$querystring = "INSERT INTO ".DB_PREFIX ."ocreservation_setting VALUES (". $key .",0,0,0,0,0,0,0,0,0);";
		$results = $this->db->query($querystring);

	}
		$querystring = "SELECT pd.product_id productkey, pd.name productname, type,  mon, tue, wed, thu, fri, sat, sun FROM ".DB_PREFIX ."ocreservation_setting o LEFT JOIN ".DB_PREFIX ."product_description pd ON (o.product_id = pd.product_id) WHERE o.product_id=". $key ." AND pd.language_id = ". $lanq_id.";";
		$results = $this->db->query($querystring);
	
  return $results->rows;
}

public function setSetting($settings)
{
		$querystring = "UPDATE ".DB_PREFIX ."ocreservation_setting SET type=".$settings['ocreservation_type'].",  mon=".$settings['ocreservation_mon'].", tue=".$settings['ocreservation_tue'].", wed=".$settings['ocreservation_wed'].", thu=".$settings['ocreservation_thu'].", fri=".$settings['ocreservation_fri'].", sat=".$settings['ocreservation_sat'].", sun=".$settings['ocreservation_sun']." WHERE product_id=".$settings['ocreservation_prodid'].";";
		$results = $this->db->query($querystring);
}


public function getReservationProducts()
{
		$lanq_id = (int)$this->config->get('config_language_id');

	$querystring = "SELECT pd.name productname, pd.product_id productkey FROM ".DB_PREFIX ."product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id)  LEFT JOIN " . DB_PREFIX . "product_description pd ON (po.product_id = pd.product_id) WHERE  pd.language_id =". $lanq_id." AND o.type ='date';";

	$results = $this->db->query($querystring);
	
  return $results->rows;


}

}
?>