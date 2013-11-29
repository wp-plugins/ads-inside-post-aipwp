<?php
/********************************************************/
/* FUNCTIONS
********************************************************/
	function showads($atts) {
	 
	 extract(shortcode_atts(array(
                'ad' => 'default'
       ), $atts));
	   
	   global $wpdb;
		 $table_name = $wpdb->prefix . "AIPWP_ADS"; 
		 global $wpdb;
	$res = $wpdb->get_results("SELECT AIPWP_AD_CODE,AIPWP_AD_STYLE FROM $table_name WHERE AIPWP_AD_NAME = '$ad'");
	foreach ($res as $rs) 
 	return '<div class="'.$rs->AIPWP_AD_STYLE.'" id="'.$ad.'" >'.stripslashes($rs->AIPWP_AD_CODE).'</div>';
	}
	

	//Insert Data to DB
	function insert($IN_AD_NAME,$IN_AD_CODE,$IN_AD_STYLE)
	{
		global $wpdb;
   		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
  		global $wpdb;
		$AD_NAME = $IN_AD_NAME;
		$AD_CODE = $IN_AD_CODE;
		$AD_STYLE = $IN_AD_STYLE;

  	$rows_affected = $wpdb->insert( $table_name, array( 'AIPWP_AD_NAME' => $AD_NAME, 'AIPWP_AD_CODE' => $AD_CODE, 'AIPWP_AD_STYLE' => $AD_STYLE ) );
	}

	//Update table	
	function update($IN_AD_ID,$IN_AD_CODE,$IN_AD_STYLE)	{
	
		global $wpdb;
 		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
  		global $wpdb;
		$wpdb->update($table_name, 
		array( 
			'AIPWP_AD_CODE' => $IN_AD_CODE,
			'AIPWP_AD_STYLE' => $IN_AD_STYLE
		),
		array(
			'AIPWP_AD_ID' => $IN_AD_ID
		)
 
	);

}

	//Delete data in table
	function delete($IN_AD_ID)	{
		global $wpdb;
 		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
  		global $wpdb;
		$wpdb->query('DELETE FROM '.$table_name.' WHERE AIPWP_AD_ID = '.$IN_AD_ID);
}

		//Register Styles
    	function add_stylesheet() {
       
            wp_register_style('base-style', plugins_url('style.css',__FILE__), array(), '1', 'screen'); 
			wp_enqueue_style('base-style');
        
    }
	
	
 	//Delete options in database
	function uninstall() {

		global $wpdb;
   		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
  		global $wpdb;
		$wpdb->query('DROP TABLE '.$table_name);
}
?>