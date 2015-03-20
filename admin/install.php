<?php
//SETUP
function jal_install () {
   global $wpdb;

   $table_name = $wpdb->prefix . "AIPWP_ADS"; 
  global $wpdb;
$sql = "CREATE TABLE $table_name (
  AIPWP_AD_ID mediumint(9) NOT NULL AUTO_INCREMENT,
 AIPWP_AD_NAME VARCHAR(500) NOT NULL UNIQUE,
 AIPWP_AD_CODE VARCHAR(10000) NOT NULL,
 AIPWP_AD_STYLE VARCHAR(20) NOT NULL,
  UNIQUE KEY id (AIPWP_AD_ID)
);";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}

function AIPWP_install(){
    jal_install ();
	
	
}
?>