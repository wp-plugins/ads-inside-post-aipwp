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
	
	//Read Ads
	function readads()
	{
		global $wpdb;
		 $table_name = $wpdb->prefix . "AIPWP_ADS"; 
		 global $wpdb;
		 $res = $wpdb->get_results("SELECT AIPWP_AD_NAME FROM $table_name");
		 $count = 0;
		 foreach ($res as $rs) 
		 {
			 $DATA[$count]=$rs->AIPWP_AD_NAME;
			 $count++;
			 }
		return $DATA;
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
	//Load JS
	function pw_load_scripts() {
	wp_enqueue_script('custom-js', plugins_url('script.js',__FILE__));
	wp_localize_script('custom-js', 'pw_script_vars', array(
			'ad' => __(readads())
		));

	
}


 	//Delete options in database
	function uninstall() {

		global $wpdb;
   		$table_name = $wpdb->prefix . "AIPWP_ADS"; 
  		global $wpdb;
		$wpdb->query('DROP TABLE '.$table_name);
}


//Add Button
function Sbutton() {
    global $typenow;
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
   	return;
    }
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	// check if WYSIWYG is enabled
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_tinymce_plugin");
		add_filter('mce_buttons', 'register_my_tc_button');
	}
}

function add_tinymce_plugin($plugin_array) {
   	$plugin_array['AP_tc_button'] = plugins_url( '/button.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
   	return $plugin_array;
}

function register_my_tc_button($buttons) {
   array_push($buttons, "AP_tc_button");
   return $buttons;
}
/** Step 1. Menu */
function AIPWP_menu() {
	add_menu_page( 'Ads Inside Post Plugin Options', 'Ads Inside Post', 'manage_options', 'AIPWP', 'AIPWP_options', 'dashicons-migrate' );
}

?>