<?php
/*
Plugin Name: ADs Inside Post
Plugin URI: http://www.mytrickpages.com/AIPWP
Description: A Simple Plugin That Let You Add Adsense Ads Within Post Content. Add ads anywhere you need just you need to add short code.
Version: 1.7
Author: Rajika Nanayakkara
Author URI: http://www.mytrickpages.com
License: GPL2
*/
class AIPWP {
   function __construct() {
       include_once dirname( __FILE__ ) . '/admin/install.php';
	   include_once dirname( __FILE__ ) . '/admin/functions.php';
	   include_once dirname( __FILE__ ) . '/admin/admin.php';
	  
   }
   
   function register() {
	   register_activation_hook(__FILE__ ,'AIPWP_install');
	   register_uninstall_hook(__FILE__, 'uninstall');
   }


   function hooks()
   {
	   //HOOKS
		add_action('init','showads');
		add_action( 'admin_menu', 'AIPWP_menu' );
		add_action('wp_print_styles', 'add_stylesheet');
		add_action('admin_enqueue_scripts', 'pw_load_scripts');
		add_shortcode('showads', 'showads');
		add_action('admin_head', 'Sbutton');
		
	   }
	   
	
	


  
}
$AIPWP = new AIPWP();
$AIPWP->register();
$AIPWP->hooks();










?>